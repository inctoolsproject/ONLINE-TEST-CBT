<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_Login extends CI_Model
{
    public function validasi($username, $password)
    {
        $data = $this->db->get_where('users', ['username' => $username])->row();
        if ($data) {
            if (password_verify($password, $data->password)) {
                return $dt        =    array(
                    'is_logged_in'  => true,
                    'id'            => $data->id,
                    'username'      => $username,
                    'role'          => nameGroup($data->level)
                );
            } else {
                return 0;
            }
        }
    }
}
