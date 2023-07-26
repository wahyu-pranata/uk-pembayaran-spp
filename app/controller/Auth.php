<?php

namespace Controllers;

use Core\Controller;

class Auth extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            return redirect('/', ['info', 'Anda sudah masuk!']);
        }
        $data['title'] = "Login";
        $this->view([
            'user/auth'
        ], $data);
    }
    public function login()
    {
        if (isset($_SESSION['user'])) {
            redirect('/', ['info', 'Anda sudah masuk']);
        }
        $user = $this->model('Pengguna')->getSingle("WHERE username = '{$_POST['username']}'");
        if ($user) {
            if (password_verify($_POST['password'], $user['password'])) {
                if ($user['role'] == 'admin' || $user['role'] == 'petugas') {
                    $user = $this->model('Petugas')->getPengguna('WHERE pengguna_id = ' . $user['id'], 'single');
                    $_SESSION['user'] = $user;
                    redirect('/', ['success', 'Anda berhasil masuk!']);
                } elseif ($user['role'] == 'siswa') {
                    $siswa = $this->model('Siswa')->getPengguna('WHERE pengguna_id = ' . $user['id'], 'single');
                    $_SESSION['user'] = $siswa;
                    redirect('/', ['success', 'Anda berhasil masuk!']);
                }
            } else {
                return back(['danger', 'Password salah']);
            }
        } else {
            return redirect('/', ['danger', 'Data yang anda berikan tidak sesuai!']);
        }
    }
    public function logout()
    {
        unset($_SESSION['user']);
        redirect('/auth', ['success', 'Anda berhasil keluar']);
    }
}
