<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->u1        = $this->uri->segment(1);
        $this->u2        = $this->uri->segment(2);
        if (!empty($this->session->userdata('log_super'))) {
            if ($this->u1 != 'logout') {
                redirect('admin', 'refresh');
            }
        } elseif (!empty($this->session->userdata('log_guru'))) {
            if ($this->u1 != 'logout') {
                redirect('guru', 'refresh');
            }
        }

        $this->load->model('M_Login', 'login');
    }

    function index()
    {
        $params = array('title' => 'Login | Online Test');
        $this->load->view('login', $params);
    }

    public function proses()
    {
        $username     = addslashes(trim($this->input->post('username', true)));
        $password     = addslashes(trim($this->input->post('password', true)));
        $row = $this->login->validasi($username, $password);

        if ($row != null) {
            if ($row['role'] == 'Admin') {
                $this->session->set_userdata('log_super', $row);

                redirect('admin');
            } else if ($row['role'] == 'Guru') {
                $this->session->set_userdata('log_guru', $row);

                redirect('guru');
            } else if ($row['role'] == 'Peserta') {
                $this->session->set_userdata('log_peserta', $row);

                redirect('peserta');
            }
        } else {
            $message = "Sepertinya Anda salah memasukkan username atau password!!";
            $this->session->set_flashdata('error', $message);

            redirect(base_url());
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
