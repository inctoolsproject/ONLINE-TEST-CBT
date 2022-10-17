<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Guru extends CI_Model
{
    public function getUser($where)
    {
        $this->db->select('users.*, groups.name as nama_group');
        $this->db->join('groups', 'groups.id = users.level', 'inner');

        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by('users.nama', 'asc');

        return $this->db->get('users')->result();
    }
}

/* End of file M_Guru.php */