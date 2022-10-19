<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bank_soal extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		guru_init();
	}

	public function index()
	{
		$id_jenis_ujian = dekrip($this->u3);

		$params = [
			'title'       => 'Jenis Ujian',
			'jenis_ujian' => $this->universal->getOne(['id' => $id_jenis_ujian], 'jenis_ujian'),
			'bank_soal'   => $this->universal->getOrderBy(['id_jenis_ujian' => $id_jenis_ujian], 'bank_soal', 'created_at', 'desc', '')
		];

		$this->load->view('bank_soal', $params);
	}

	public function add()
	{
		$this->form_validation->set_rules('soal', 'Soal', 'required');
		$this->form_validation->set_rules('kunci', 'Kunci Jawaban', 'required|alpha|max_length[1]');
		if ($this->form_validation->run() == false) {
			$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = [
				'id_jenis_ujian' => dekrip($this->input->post('id_jenis_ujian')),
				'soal'           => $this->input->post('soal', FALSE),
				'a'              => $this->input->post('a', FALSE),
				'b'              => $this->input->post('b', FALSE),
				'c'              => $this->input->post('c', FALSE),
				'd'              => $this->input->post('d', FALSE),
				'e'              => $this->input->post('e', FALSE),
				'kunci'          => $this->input->post('kunci')
			];

			$insert = $this->universal->insert($data, 'bank_soal');

			if ($insert) {
				$this->notifikasi->success('Berhasil menambahkan soal');
			} else {
				$this->notifikasi->success('Gagal menambahkan soal');
			}

			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function add_old($id)
	{
		$id_jenis_ujian = dekrip($id);

		$params = [
			'title'       => 'Jenis Ujian',
			'jenis_ujian' => $this->universal->getOne(['id' => $id_jenis_ujian], 'jenis_ujian')
		];

		$this->load->view('bank_soal_add', $params);
	}

	public function edit()
	{
		$this->form_validation->set_rules('soal', 'Soal', 'required');
		$this->form_validation->set_rules('kunci', 'Kunci Jawaban', 'required|alpha|max_length[1]');
		if ($this->form_validation->run() == false) {
			$this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$id   = dekrip($this->input->post('id'));
			$data = [
				'soal'           => $this->input->post('soal', FALSE),
				'a'              => $this->input->post('a', FALSE),
				'b'              => $this->input->post('b', FALSE),
				'c'              => $this->input->post('c', FALSE),
				'd'              => $this->input->post('d', FALSE),
				'e'              => $this->input->post('e', FALSE),
				'kunci'          => $this->input->post('kunci')
			];

			$update = $this->universal->update($data, ['id' => $id], 'bank_soal');

			if ($update) {
				$this->notifikasi->success('Berhasil mengubah soal');
			} else {
				$this->notifikasi->success('Gagal mengubah soal');
			}

			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function getOne($id)
	{
		$data = $this->universal->getOne(['id' => dekrip($id)], 'bank_soal');

		echo json_encode($data);
	}

	public function delete($id)
	{
		$delete = $this->universal->delete(['id' => dekrip($id)], 'bank_soal');

		if ($delete) {
			$this->notifikasi->success('Berhasil menghapus soal');
		} else {
			$this->notifikasi->success('Gagal menghapus soal');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
}

/* End of file Bank_soal.php */
