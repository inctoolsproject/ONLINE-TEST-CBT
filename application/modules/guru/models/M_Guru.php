<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Guru extends CI_Model
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

        return $this->db->get('users')->result();
    }
}

/* End of file M_Guru.php */