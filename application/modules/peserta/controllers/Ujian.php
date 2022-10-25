<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		peserta_init();
	}
	public function token()
	{
		$params = array(
			'title' => 'Token'
		);

		$this->load->view('token', $params);
	}

	public function cekToken()
	{
		$token = $this->input->post('token');

		$cek = $this->universal->getOne(['token' => $token], 'token');

		if ($cek) {
			$jenis_ujian = $this->universal->getOne(['id' => $cek->id_jenis_ujian], 'jenis_ujian');

			$res         = [
				'csrf_token' => $this->security->get_csrf_hash(),
				'data'       => $jenis_ujian,
				'token'      => $cek,
				'status'     => 1
			];
		} else {
			$res = [
				'csrf_token' => $this->security->get_csrf_hash(),
				'data'       => NULL,
				'status'     => 0
			];
		}

		echo json_encode($res);
	}

	public function ambilUjian()
	{
		$token = $this->input->post('token');

		$data_token = $this->universal->getOne(['token' => $token], 'token');

		$hari_ini = date('Y-m-d H:i:s');

		if ($hari_ini <= $data_token->token_selesai) {
			$data = [
				'id_user'        => $this->user->id,
				'id_jenis_ujian' => $data_token->id_jenis_ujian,
				'tanggal_ujian'  => $data_token->mulai_ujian
			];

			$cek = $this->universal->getOne([
				'id_user'        => $this->user->id,
				'id_jenis_ujian' => $data_token->id_jenis_ujian,
			], 'list_ujian');

			if (!$cek) {
				$insert = $this->universal->insert($data, 'list_ujian');

				if ($insert) {
					$res = [
						'csrf_token' => $this->security->get_csrf_hash(),
						'status'     => 1
					];

					$this->notifikasi->success('Token ujian berhasil diambil');
				} else {
					$res = [
						'csrf_token' => $this->security->get_csrf_hash(),
						'status'     => 0,
						'error'      => 'Server error !'
					];
				}
			} else {
				$res = [
					'csrf_token' => $this->security->get_csrf_hash(),
					'status'     => 0,
					'error'      => 'Anda sudah mengambil ujian ini !'
				];
			}
		} else {
			$res = [
				'csrf_token' => $this->security->get_csrf_hash(),
				'status'     => 0,
				'error'      => 'Token sudah berakhir !'
			];
		}

		echo json_encode($res);
	}

	public function list()
	{
		$params = array(
			'title' => 'List Ujian',
			'list_ujian' => $this->peserta->getListUjian(['list_ujian.id_user' => $this->user->id])
		);

		$this->load->view('list_ujian', $params);
	}

	public function detail($id)
	{
		$this->session->set_userdata('id_list_ujian', dekrip($id));

		$params = array(
			'title'      => 'Detail Ujian',
			'list_ujian' => $this->peserta->getOneListUjian(['list_ujian.id' => dekrip($id)])
		);

		$this->load->view('detail_ujian', $params);
	}
}

/* End of file Ujian.php */
