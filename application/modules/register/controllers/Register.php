<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->u1        = $this->uri->segment(1);
        $this->u2        = $this->uri->segment(2);
    }

    function index()
    {
        $params = array('title' => 'Register | Online Test');
        $this->load->view('register', $params);
    }

    public function proses()
    {
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $level = dekrip($this->input->post('level'));
            $nama  = $this->input->post('nama');
            $email = $this->input->post('email');
            $pass  = $this->input->post('password');

            $cek = $this->universal->getOne(['email' => $email], 'users');

            if ($cek) {
                $this->session->set_flashdata('error', 'Email anda sudah terdaftar!');
            } else {
                $data = [
                    'nama' => $nama,
                    'username' => $email,
                    'email' => $email,
                    'password' => password_hash($pass, PASSWORD_BCRYPT, ['const' => 14]),
                    'level' => $level
                ];

                $insert = $this->universal->insert($data, 'users');

                if ($insert) {
                    $this->session->set_flashdata('success', 'Akun berhasil didaftarkan');
                } else {
                    $this->session->set_flashdata('error', 'Akun gagal didaftarkan');
                }
            }

            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
