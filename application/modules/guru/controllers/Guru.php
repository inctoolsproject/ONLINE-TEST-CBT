<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		guru_init();
	}

	public function index()
	{
		if ($this->u2 == 'profile') {
			if ($this->u3 == 'updateFoto') {
				$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
				if ($this->form_validation->run() == false) {
					$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
					redirect('guru/profile', 'refresh');
				} else {
					$nama = $this->input->post('nama', TRUE);
					$email = trim($this->input->post('email', TRUE));

					$upload_foto = $_FILES['foto']['name'];

					if ($upload_foto) {
						$this->load->library('upload');
						$config['upload_path']          = './upload/guru';
						$config['allowed_types']        = 'jpg|jpeg|png';
						// $config['max_size']             = 3072; // 3 mb
						$config['remove_spaces']        = TRUE;
						$config['detect_mime']          = TRUE;
						$config['encrypt_name']         = TRUE;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if (!$this->upload->do_upload('foto')) {
							$this->notifikasi->error($this->upload->display_errors());
							redirect('guru/profile', 'refresh');
						} else {

							$upload_data = $this->upload->data();
							$dataSebelumnya = $this->universal->getOne(['id' => $this->id_user], 'users');
							$path = FCPATH . 'upload/guru/';
							if ($dataSebelumnya->foto != 'default.jpg') {
								unlink($path . $dataSebelumnya->foto);
							}
							$data = [
								"email"             => $email,
								"foto"              => $upload_data['file_name']
							];
							img_resize(300, $path . $data['foto'], $path . $data['foto']);

							$update = $this->universal->update($data, ['id' => $this->id_user], 'users');

							($update) ? $this->notifikasi->success('Update profil dengan foto berhasil') : $this->notifikasi->error('Update gagal');

							redirect('guru/profile', 'refresh');
						}
					} else {
						$data = [
							"email"             => $email
						];

						$update = $this->universal->update($data, ['id' => $this->id_user], 'users');

						($update) ? $this->notifikasi->success('Update profil tanpa foto berhasil') : $this->notifikasi->error('Update gagal');

						redirect('guru/profile', 'refresh');
					}
				}
			} elseif ($this->u3 == 'updatePass') {
				$this->form_validation->set_rules('oldPass', 'Password Lama', 'required', [
					'required' => 'Password lama harap di isi !'
				]);
				$this->form_validation->set_rules('newPass', 'Password Baru', 'required|trim|min_length[5]', [
					'required' => 'Password baru harap di isi !',
					'min_length' => 'Password baru kurang dari 5'
				]);
				$this->form_validation->set_rules('confirPass', 'Password Konfirmasi', 'required|trim|min_length[5]|matches[newPass]', [
					'required' => 'Password konfirmasi harap di isi !',
					'matches' => 'Password konfirmasi salah !',
					'min_length' => 'Password konfirmasi kurang dari 5'
				]);

				if ($this->form_validation->run() == false) {
					$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
					redirect('guru/profile', 'refresh');
				} else {
					$oldPass = $this->input->post('oldPass', TRUE);
					$newPass = $this->input->post('newPass', TRUE);

					$user = $this->universal->getOne(['id'  => $this->id_user], 'users');

					if (password_verify($oldPass, $user->password)) {
						$data = [
							"password" =>  password_hash($newPass, PASSWORD_BCRYPT, ['const' => 14])
						];

						$update = $this->universal->update($data, ['id' => $this->id_user], 'users');

						($update) ? $this->notifikasi->success('Password berhasil diupdate') : $this->notifikasi->error('Password gagal diupdate');
					} else {
						$this->notifikasi->error('Password lama salah');
					}

					redirect('guru/profile', 'refresh');
				}
			} elseif ($this->u3 == 'updateBio') {
				$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
				$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|numeric|min_length[10]|max_length[13]');
				$this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');

				if ($this->form_validation->run() == false) {
					$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
					redirect('guru/profile', 'refresh');
				} else {
					$cek = $this->universal->getOne(['id_user' => $this->user[0]->id], 'biodata');

					if ($cek) {
						$data = [
							'jk'           => $this->input->post('jk'),
							'no_hp'        => $this->input->post('no_hp'),
							'nama_sekolah' => $this->input->post('nama_sekolah'),
							'alamat'       => $this->input->post('alamat')
						];

						$update = $this->universal->update($data, ['id_user' => $this->id_user], 'biodata');

						($update) ? $this->notifikasi->success('Biodata berhasil diupdate') : $this->notifikasi->error('Biodata gagal diupdate');
					} else {
						$data = [
							'id_user'	   => $this->id_user,
							'jk'           => $this->input->post('jk'),
							'no_hp'        => $this->input->post('no_hp'),
							'nama_sekolah' => $this->input->post('nama_sekolah'),
							'alamat'       => $this->input->post('alamat')
						];

						$insert = $this->universal->insert($data, 'biodata');

						($insert) ? $this->notifikasi->success('Biodata berhasil diupdate') : $this->notifikasi->error('Biodata gagal diupdate');
					}

					redirect('guru/profile', 'refresh');
				}
			} else {
				$params = [
					'title'     => 'Profile'
				];
				$this->load->view('profile', $params);
			}
		} else {
			$params = [
				'title'       => 'Dashboard',
				'jenis_ujian' => $this->universal->getCount(['id_user' => $this->user[0]->id], 'jenis_ujian')
			];

			$this->load->view('dashboard', $params);
		}
	}
}

/* End of file Guru.php */
