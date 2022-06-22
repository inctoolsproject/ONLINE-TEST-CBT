<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        admin_init();
    }

    public function index()
    {
        if ($this->u2 == 'group') {
            if ($this->u3 == 'add') {
                $this->form_validation->set_rules('nama', 'Nama Group', 'required');
                if ($this->form_validation->run() == false) {
                    $this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
                    redirect('admin/group', 'refresh');
                } else {
                    $data = [
                        'name'          => $this->input->post('nama')
                    ];
                    $insert = $this->universal->insert($data, 'groups');
                    if ($insert) {
                        $this->notifikasi->success('Data berhasil ditambah');
                    }

                    redirect('admin/group', 'refresh');
                }
            } elseif ($this->u3 == 'getOne') {
                $id = dekrip($this->u4);
                $data = $this->universal->getOne(['id' => $id], 'groups');
                echo json_encode($data);
            } elseif ($this->u3 == 'edit') {
                $this->form_validation->set_rules('nama', 'Nama Group', 'required');

                if ($this->form_validation->run() == false) {
                    $this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
                    redirect('admin/group', 'refresh');
                } else {
                    $id = dekrip($this->input->post('id'));
                    $data = [
                        'name'              => $this->input->post('nama')
                    ];

                    $update = $this->universal->update($data, ['id' => $id], 'groups');

                    if ($update) {
                        $this->notifikasi->success('Data berhasil diupdate');
                    }
                    redirect('admin/group', 'refresh');
                }
            } elseif ($this->u3 == 'delete') {
                $id = dekrip($this->u4);

                $delete = $this->universal->delete(['id' => $id], 'groups');
                if ($delete) {
                    $this->notifikasi->success('Data berhasil dihapus');
                }

                redirect('admin/group', 'refresh');
            } else {
                $params = [
                    'title'         => 'User Group',
                    'group'         => $this->universal->getMulti('', 'groups')
                ];

                $this->load->view('group', $params);
            }
        } elseif ($this->u2 == 'user') { {
                if ($this->u3 == 'add') {
                    $this->form_validation->set_rules('nama', 'Nama', 'required');
                    $this->form_validation->set_rules('username', 'Username', 'required');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                    $this->form_validation->set_rules('level', 'Level', 'required');
                    $this->_getLevel(dekrip($this->input->post('level')));
                    if ($this->form_validation->run() == false) {
                        $this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    } else {
                        $data = [
                            'nama'          => $this->input->post('nama'),
                            'username'      => $this->input->post('username'),
                            'email'         => $this->input->post('email'),
                            'password'      => password_hash('onlinetest123', PASSWORD_BCRYPT, ['const' => 14]),
                            'level'         => dekrip($this->input->post('level'))
                        ];

                        $insert = $this->universal->insert($data, 'users');
                        if ($insert) {
                            $this->notifikasi->success('Data berhasil ditambah');
                        }
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    }
                } elseif ($this->u3 == 'getOne') {
                    $id = dekrip($this->u4);
                    $data = $this->universal->getOne(['id' => $id], 'users');

                    echo json_encode($data);
                } elseif ($this->u3 == 'edit') {
                    $this->form_validation->set_rules('nama', 'Nama', 'required');
                    $this->form_validation->set_rules('username', 'Username', 'required');
                    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                    $this->form_validation->set_rules('level', 'Level', 'required');

                    $this->_getLevel(dekrip($this->input->post('level')));

                    if ($this->form_validation->run() == false) {
                        $this->notifikasi->error(str_replace("\r\n", "", json_encode(strip_tags(validation_errors()))));
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    } else {
                        $id = dekrip($this->input->post('id'));
                        $data = [
                            'nama'          => $this->input->post('nama'),
                            'username'      => $this->input->post('username'),
                            'email'         => $this->input->post('email'),
                            'level'         => dekrip($this->input->post('level'))
                        ];

                        $update = $this->universal->update($data, ['id' => $id], 'users');
                        if ($update) {
                            $this->notifikasi->success('Data berhasil diupdate');
                        }
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    }
                } elseif ($this->u3 == 'delete') {
                    $id = dekrip($this->u4);
                    $getFoto = $this->universal->getOneSelect('foto', ['id' => $id], 'users')->foto;

                    $delete = $this->universal->delete(['id' => $id], 'users');
                    if ($delete) {
                        $path = FCPATH . 'upload/admin/';

                        if ($getFoto != 'default.jpg') {
                            unlink($path . $getFoto);
                        }

                        $this->notifikasi->success('Data berhasil dihapus');
                    }

                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                } elseif ($this->u3 == 'reset') {
                    $id = dekrip($this->u4);
                    $data = [
                        'password'  => password_hash('onlinetest123', PASSWORD_BCRYPT, ['const' => 14])
                    ];
                    $update = $this->universal->update($data, ['id' => $id], 'users');
                    if ($update) {
                        $this->notifikasi->success('Reset password sukses');
                    }

                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                } else {
                    $level = dekrip($this->u3);

                    if (!$level) {
                        $level = $this->universal->getOneSelect('id', '', 'groups')->id;
                    }

                    $params = [
                        'title'         => 'Users',
                        'user'          => $this->admin->getUser(['users.level' => $level]),
                        'group'         => $this->universal->getMulti('', 'groups'),
                        'level'         => $level
                    ];

                    $this->load->view('user', $params);
                }
            }
        }
    }

    private function _getLevel($id_level)
    {
        $group = $this->universal->getOne(['id' => $id_level], 'groups');

        if ($group->name == 'Prodi') {
            $this->form_validation->set_rules('kd_prodi', 'Prodi', 'required');
            $this->prodi = dekrip($this->input->post('kd_prodi'));
        } else {
            $this->prodi = null;
        }
    }
}

/* End of file User.php */
