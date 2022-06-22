<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
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

    public function countUser()
    {
        $this->db->select('COUNT(users.id) as total, groups.name as nama_group');
        $this->db->from('users');
        $this->db->join('groups', 'groups.id = users.level', 'inner');
        $this->db->group_by('users.level');

        return $this->db->get()->result();
    }
}

/* End of file M_Admin.php */