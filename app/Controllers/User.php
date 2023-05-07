<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UserModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $helpers = ['form'];
    protected $session, $userModel;
    public function __construct()
    {
        $this->session = session();
        $this->userModel = model(UserModel::class);
    }
    public function login()
    {
        return view('admin/login');
    }

    public function auth()
    {
        $validation = Services::Validation();
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");

        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $user = $this->userModel->where(["username" => $username])->first();

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session()->set([
                        'username' => $user["username"],
                        'nama' => $user["nama_admin"],
                        'islogin' => TRUE
                    ]);
                    return redirect("admin/menu");
                }
            }
        }
        $data = [
            "username" => $username,
            "validation" => $validation->getErrors()
        ];

        return view("admin/login", $data);
    }

    public function register()
    {
        return view('admin/register');
    }

    public function store()
    {
        $validation = Services::Validation();

        $validation->setRules([
            'username' => 'required|is_unique[admin.username]',
            'password' => 'required',
            "nama" => "required",
            "telp" => "required|integer",
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $this->userModel->insert([
                "kd_admin" => md5($this->request->getVar("nama") . $this->request->getVar("username") . random_int(0, 100)),
                "username" => $this->request->getVar("username"),
                "nama_admin" => $this->request->getVar("nama"),
                "no_telp" => $this->request->getVar("telp"),
                "password" => password_hash($this->request->getVar("password"), PASSWORD_BCRYPT),
            ]);

            return redirect("login");
        }

        // not validated
        $data = [
            "username" => $this->request->getVar("username"),
            "nama_admin" => $this->request->getVar("nama"),
            "no_telp" => $this->request->getVar("telp"),
            "validation" => $validation->getErrors()
        ];
        return view("admin/register", $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("login");
    }
}