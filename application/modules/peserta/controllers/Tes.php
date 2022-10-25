<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		peserta_init();
	}

	public function index($no = null)
	{
		$id_list_ujian = $this->session->userdata('id_list_ujian');

		$list_ujian = $this->peserta->getOneListUjian(['list_ujian.id' => $id_list_ujian]);

		$timer = $this->universal->getOne([
			'id_user'        => $this->user->id,
			'id_jenis_ujian' => $list_ujian->id_jenis_ujian
		], 'timer');

		if ($list_ujian->status == 1) {
		}

		if ($timer) {
		} else {
			$dates = date('Y-m-d H:i:s');
			$date = strtotime($dates);
			$max_date = date("Y-m-d H:i:s", strtotime("+" . $list_ujian->waktu . " minutes", $date));

			$data = [
				"id_user"        => $this->user->id,
				"id_jenis_ujian" => $list_ujian->id_jenis_ujian,
				"mulai"          => $dates,
				"selesai"        => $max_date
			];

			$this->universal->insert($data, 'timer');
		}

		$timer = $this->universal->getOne([
			'id_user'        => $this->user->id,
			'id_jenis_ujian' => $list_ujian->id_jenis_ujian
		], 'timer');

		echo json_encode($timer);
		die;
		$params = array(
			'title' => 'Tes'
		);

		$this->load->view('tes', $params);
	}
}

/* End of file Tes.php */
