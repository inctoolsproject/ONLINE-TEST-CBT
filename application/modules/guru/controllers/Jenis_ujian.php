<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_ujian extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		guru_init();
	}

	public function index()
	{
		$params = [
			'title' => 'Jenis Ujian',
			'jenis_ujian' => $this->universal->getOrderBy(['id_user' => $this->user[0]->id], 'jenis_ujian', 'nama_ujian', 'asc', '')
		];

		$this->load->view('jenis_ujian', $params);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_ujian', 'Nama Ujian', 'required');
		$this->form_validation->set_rules('topik', 'Topik', 'required');
		$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required|trim|numeric');
		$this->form_validation->set_rules('bobot', 'Bobot Soal', 'required|trim|numeric');
		$this->form_validation->set_rules('kkm', 'KKM', 'required|trim|numeric');
		$this->form_validation->set_rules('waktu', 'Estimasi Waktu', 'required|trim|numeric');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() == false) {
			$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = [
				'id_user'     => $this->user[0]->id,
				'nama_ujian'  => $this->input->post('nama_ujian'),
				'topik'       => $this->input->post('topik'),
				'jumlah_soal' => $this->input->post('jumlah_soal'),
				'bobot'       => $this->input->post('bobot'),
				'kkm'         => $this->input->post('kkm'),
				'waktu'       => $this->input->post('waktu'),
				'keterangan'  => $this->input->post('keterangan')
			];

			$insert = $this->universal->insert($data, 'jenis_ujian');

			if ($insert) {
				$this->notifikasi->success('Berhasil menambahkan jenis ujian');
			} else {
				$this->notifikasi->success('Gagal menambahkan jenis ujian');
			}

			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function edit()
	{
		$this->form_validation->set_rules('nama_ujian', 'Nama Ujian', 'required');
		$this->form_validation->set_rules('topik', 'Topik', 'required');
		$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required|trim|numeric');
		$this->form_validation->set_rules('bobot', 'Bobot Soal', 'required|trim|numeric');
		$this->form_validation->set_rules('kkm', 'KKM', 'required|trim|numeric');
		$this->form_validation->set_rules('waktu', 'Estimasi Waktu', 'required|trim|numeric');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() == false) {
			$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$id   = dekrip($this->input->post('id'));
			$data = [
				'nama_ujian'  => $this->input->post('nama_ujian'),
				'topik'       => $this->input->post('topik'),
				'jumlah_soal' => $this->input->post('jumlah_soal'),
				'bobot'       => $this->input->post('bobot'),
				'kkm'         => $this->input->post('kkm'),
				'waktu'       => $this->input->post('waktu'),
				'keterangan'  => $this->input->post('keterangan')
			];

			$update = $this->universal->update($data, ['id' => $id], 'jenis_ujian');

			if ($update) {
				$this->notifikasi->success('Berhasil mengubah jenis ujian');
			} else {
				$this->notifikasi->success('Gagal mengubah jenis ujian');
			}

			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function getOne($id)
	{
		$data = $this->universal->getOne(['id' => dekrip($id)], 'jenis_ujian');

		echo json_encode($data);
	}

	public function getToken($id)
	{
		$this->db->order_by('created_at', 'desc');
		$data = $this->universal->getOne([
			'id_jenis_ujian' => dekrip($id),
		], 'token');

		$res = [
			'token'       => $data->token,
			'selesai'     => $data->token_selesai,
			'tanggal'     => ($data->mulai_ujian) ? date('Y-m-d', strtotime($data->mulai_ujian)) : '',
			'jam'         => ($data->mulai_ujian) ? date('H:i', strtotime($data->mulai_ujian)) : '',
			'mulai_ujian' => $data->mulai_ujian
		];

		echo json_encode($res);
	}

	public function generateToken()
	{
		$id = $this->input->get('id');
		$tanggal = $this->input->get('tanggal');
		$jam = $this->input->get('jam');

		$date = date('Y-m-d H:i:s');
		$dates = strtotime($date);
		$selesai = date("Y-m-d H:i:s", strtotime("+30" . " minutes", $dates));

		$token = $this->_getToken();
		$cekToken = $this->universal->getOne([
			'token' => $token,
		], 'token');

		while ($cekToken) {
			$token = $this->_getToken();
			$cekToken = $this->universal->getOne([
				'token' => $token,
			], 'token');
		}

		$data = [
			'id_jenis_ujian' => dekrip($id),
			'token'          => $token,
			'token_selesai'  => $selesai,
			'mulai_ujian'    => $tanggal . ' ' . $jam
		];

		$this->universal->insert($data, 'token');

		$res = [
			'token'       => $data['token'],
			'selesai'     => $data['token_selesai'],
			'tanggal'     => $tanggal,
			'jam'         => $jam,
			'mulai_ujian' => $data['mulai_ujian']
		];

		echo json_encode($res);
	}

	public function delete($id)
	{
		$delete = $this->universal->delete(['id' => dekrip($id)], 'jenis_ujian');

		if ($delete) {
			$this->notifikasi->success('Berhasil menghapus jenis ujian');
		} else {
			$this->notifikasi->success('Gagal menghapus jenis ujian');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	private function _getToken()
	{
		$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($data), 0, 10);
	}
}

/* End of file Jenis_ujian.php */
