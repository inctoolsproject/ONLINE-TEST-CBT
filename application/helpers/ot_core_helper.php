<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('global_init')) {
    function global_init()
    {
        $CI = &get_instance();
        $CI->logout   = base_url('logout');
        $CI->u2        = $CI->uri->segment(2);
        $CI->u3        = $CI->uri->segment(3);
        $CI->u4        = $CI->uri->segment(4);
        $CI->u5        = $CI->uri->segment(5);
        $CI->u6        = $CI->uri->segment(6);
        $CI->u7        = $CI->uri->segment(7);
        $CI->u8        = $CI->uri->segment(8);
        $CI->u9        = $CI->uri->segment(9);
    }
}

if (!function_exists('sessions_init')) {
    function sessions_init($username)
    {
        $CI = &get_instance();
        $data = [
            'username' => $username,
            'user_agent' => $CI->input->user_agent(),
        ];
        $CI->universal->update($data, ['id' => $CI->input->cookie('ot_sess')], '_sessions');
    }
}

if (!function_exists('enkrip')) {
    function enkrip($string)
    {
        $bumbu = md5(str_replace("=", "", base64_encode("online-test.com")));
        $katakata = false;
        $metodeenkrip = "AES-256-CBC";
        $kunci = hash('sha256', $bumbu);
        $kodeiv = substr(hash('sha256', $bumbu), 0, 16);

        $katakata = str_replace("=", "", openssl_encrypt($string, $metodeenkrip, $kunci, 0, $kodeiv));
        $katakata = str_replace("=", "", base64_encode($katakata));

        return $katakata;
    }
}

if (!function_exists('dekrip')) {
    function dekrip($string)
    {
        $bumbu = md5(str_replace("=", "", base64_encode("online-test.com")));
        $katakata = false;
        $metodeenkrip = "AES-256-CBC";
        $kunci = hash('sha256', $bumbu);
        $kodeiv = substr(hash('sha256', $bumbu), 0, 16);

        $katakata = openssl_decrypt(base64_decode($string), $metodeenkrip, $kunci, 0, $kodeiv);
        return $katakata;
    }
}

if (!function_exists('admin_init')) {
    function admin_init()
    {
        $CI = &get_instance();

        if (empty($CI->session->userdata('log_super'))) {
            $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu!!');
            redirect('login', 'refresh');
        } else {
            $CI->login            = $CI->session->userdata('log_super')['is_logged_in'];
            $CI->id_user          = $CI->session->userdata('log_super')['id'];
        }

        global_init();

        sessions_init($CI->session->userdata('log_super')['username']);

        $CI->load->model('M_Admin', 'admin');
        $CI->user = $CI->admin->getUser(['users.id' => $CI->id_user]);
    }
}

if (!function_exists('guru_init')) {
    function guru_init()
    {
        $CI = &get_instance();

        if (empty($CI->session->userdata('log_guru'))) {
            $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu!!');
            redirect('login', 'refresh');
        } else {
            $CI->login            = $CI->session->userdata('log_guru')['is_logged_in'];
            $CI->id_user          = $CI->session->userdata('log_guru')['id'];
        }

        global_init();

        sessions_init($CI->session->userdata('log_guru')['username']);

        $CI->load->model('M_Guru', 'guru');
        $CI->user = $CI->guru->getUser(['users.id' => $CI->id_user]);
    }
}

if (!function_exists('img_resize')) {
    function img_resize($newWidth, $targetFile, $originalFile)
    {
        $info = getimagesize($originalFile);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;

            default:
                throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        if ($width > $height) {
            $y = 0;
            $x = ($width - $height) / 2;
            $smallestSide = $height;
        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $smallestSide = $width;
        }

        //$newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newWidth);
        imagecopyresampled($tmp, $img, 0, 0, $x, $y, $newWidth, $newWidth, $smallestSide, $smallestSide);

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }

        $image_save_func($tmp, "$targetFile");
    }
}

if (!function_exists('nameGroup')) {
    function nameGroup($level)
    {
        $CI = &get_instance();

        return $CI->universal->getOneSelect('name', ['id' => $level], 'groups')->name;
    }
}


if (!function_exists('jenisUjian_menu')) {
    function jenisUjian_menu($url)
    {
        $CI = &get_instance();
        $data = $CI->universal->getOrderBy(['id_user' => $CI->id_user], 'jenis_ujian', 'nama_ujian', 'asc', '');
        $jenis_ujian = [];
        foreach ($data as $hasil) {
            array_push($jenis_ujian, [
                'name'      => $hasil->nama_ujian,
                'url'       => $url . enkrip($hasil->id)
            ]);
        }
        return $jenis_ujian;
    }
}
