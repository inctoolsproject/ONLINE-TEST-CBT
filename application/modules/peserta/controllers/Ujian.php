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
			'title' 			=> 'Token'
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
				'token' => $this->security->get_csrf_hash(),
				'data'  => $jenis_ujian,
				'status' => $cek->status
			];
		} else {
			$res = [
				'token'  => $this->security->get_csrf_hash(),
				'data'   => NULL,
				'status' => 2
			];
		}

		echo json_encode($res);
	}
}

/* End of file Ujian.php */
