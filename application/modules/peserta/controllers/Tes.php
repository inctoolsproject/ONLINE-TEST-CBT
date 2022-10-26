<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		peserta_init();
	}

	public function index()
	{
		$today = date('Y-m-d H:i:s');

		$id_list_ujian = $this->session->userdata('id_list_ujian');

		$list_ujian = $this->peserta->getOneListUjian(['list_ujian.id' => $id_list_ujian]);

		$timer = $this->universal->getOne([
			'id_user'        => $this->user->id,
			'id_jenis_ujian' => $list_ujian->id_jenis_ujian
		], 'timer');

		if ($list_ujian->status == 1) {
		}

		if ($timer) {
			if ($today > $timer->selesai) {
				$this->notifikasi->warning('Waktu ujian anda sudah berakhir');

				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}

			$dataSoal = $this->universal->getMulti([
				'id_list_ujian' => $id_list_ujian,
				'id_user'       => $this->user->id
			], 'jawaban_soal');

			if (!$dataSoal) {
				$this->_insertSoal($id_list_ujian, $list_ujian);
			}
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

			$this->_insertSoal($id_list_ujian, $list_ujian);
		}

		$timer = $this->universal->getOne([
			'id_user'        => $this->user->id,
			'id_jenis_ujian' => $list_ujian->id_jenis_ujian
		], 'timer');

		$urut = dekrip($this->u3);

		if ($urut) {
			$urutan_soal = $this->universal->getOrderBy([
				'id_list_ujian' => $id_list_ujian,
				'id_user'       => $this->user->id,
				'urutan'        => $urut
			], 'jawaban_soal', 'urutan', 'ASC', '1');
		} else {
			$urutan_soal = $this->universal->getOrderBy([
				'id_list_ujian' => $id_list_ujian,
				'id_user'       => $this->user->id,
				'jawaban'       => null
			], 'jawaban_soal', 'urutan', 'ASC', '1');

			if (!$urutan_soal) {
				$urutan_soal = $this->universal->getOrderBy([
					'id_list_ujian' => $id_list_ujian,
					'id_user'       => $this->user->id
				], 'jawaban_soal', 'urutan', 'DESC', '1');
			}
		}

		$soal = $this->universal->getMulti(['id' => $urutan_soal[0]->id_soal], 'bank_soal');

		$jawaban = [];
		foreach ($soal as $hasil) {
			$jwb = [
				[
					'pil' => 'a',
					'jwb' => $hasil->a
				],
				[
					'pil' => 'b',
					'jwb' => $hasil->b
				],
				[
					'pil' => 'c',
					'jwb' => $hasil->c
				],
				[
					'pil' => 'd',
					'jwb' => $hasil->d
				],
				[
					'pil' => 'e',
					'jwb' => $hasil->e
				],
			];

			shuffle($jwb);
			$jwb = array_slice($jwb, 0, 5);

			array_push($jawaban, [
				$hasil->id => $jwb
			]);
		}

		$allSoal = $this->universal->getMultiSelect('id, status, urutan', [
			'id_list_ujian' => $id_list_ujian,
			'id_user'       => $this->user->id
		], 'jawaban_soal');

		$allUrutan = [];
		foreach ($urutan_soal as $aS) {
			array_push($allUrutan, [
				$aS->id_soal     => $aS
			]);
		}

		$params = array(
			'title'         => 'Tes',
			'waktu_selesai' => $timer->waktu_selesai,
			'urutan'        => $urutan_soal,
			'soal'          => $soal,
			'allSoal'       => $allSoal,
			'allUrutan'     => $allUrutan,
			'jawaban'       => $jawaban
		);

		$this->load->view('tes', $params);
	}

	private function _insertSoal($id_list_ujian, $list_ujian)
	{
		$this->universal->delete([
			'id_list_ujian' => $id_list_ujian,
			'id_user'       => $this->user->id
		], 'jawaban_soal');

		$jumlahSoal = $list_ujian->jumlah_soal;

		$data_soal = [];
		$i = 1;

		$soal = $this->universal->getOrderBy([
			'id_jenis_ujian' => $list_ujian->id_jenis_ujian
		], 'bank_soal', 'id', 'RANDOM', $jumlahSoal);

		foreach ($soal as $sl) {
			array_push($data_soal, [
				'id_list_ujian' => $id_list_ujian,
				'id_user'       => $this->user->id,
				'id_soal'       => $sl->id,
				'urutan'        => $i++,
				'jawaban'       => null,
				'status'        => 0
			]);
		}

		$insert_soal = $this->universal->insert_batch($data_soal, 'jawaban_soal');

		if (!$insert_soal) {
			$this->notifikasi->error('Server sibuk, silahkan coba lagi');
		}
	}
}

/* End of file Tes.php */
