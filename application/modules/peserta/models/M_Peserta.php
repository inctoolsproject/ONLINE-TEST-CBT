<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Peserta extends CI_Model
{
    public function getUser($where)
    {
        $this->db->select('users.*, groups.name as nama_group, biodata.jk, biodata.no_hp, biodata.nama_sekolah, biodata.alamat');
        $this->db->join('groups', 'groups.id = users.level', 'inner');
        $this->db->join('biodata', 'users.id = biodata.id_user', 'left');

        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by('users.nama', 'asc');

        return $this->db->get('users')->row();
    }

    public function getListUjian($where)
    {
        $this->db->select('list_ujian.*, jenis_ujian.nama_ujian, jenis_ujian.topik, jenis_ujian.jumlah_soal, jenis_ujian.waktu, jenis_ujian.keterangan');
        $this->db->join('jenis_ujian', 'jenis_ujian.id = list_ujian.id_jenis_ujian', 'inner');

        if ($where != '') {
            $this->db->where($where);
        }

        $this->db->order_by('list_ujian.created_at', 'desc');

        return $this->db->get('list_ujian')->result();
    }

    public function getOneListUjian($where)
    {
        $this->db->select('list_ujian.*, jenis_ujian.nama_ujian, jenis_ujian.topik, jenis_ujian.jumlah_soal, jenis_ujian.waktu, jenis_ujian.keterangan');
        $this->db->join('jenis_ujian', 'jenis_ujian.id = list_ujian.id_jenis_ujian', 'inner');

        if ($where != '') {
            $this->db->where($where);
        }

        return $this->db->get('list_ujian')->row();
    }
}

/* End of file M_Peserta.php */