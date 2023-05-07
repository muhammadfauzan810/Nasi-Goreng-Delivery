<?php

namespace App\Controllers;

use Config\Services;
use App\Models\MenuModel;
use CodeIgniter\HTTP\Request;
use App\Controllers\BaseController;

class Menu extends BaseController
{
    protected $helpers = ['form'];
    protected $session, $menuModel;

    public function __construct()
    {
        $this->session = session();
        $this->menuModel = model(MenuModel::class);
    }

    public function index()
    {
        $menus = $this->menuModel->findAll();

        return view("admin/menu", [
            "menus" => $menus,
        ]);
    }

    public function create()
    {
        return view("admin/create");

    }

    public function store()
    {
        $validation = Services::Validation();

        $validation->setRules([
            'gambar' => 'is_image[gambar]',
            'menu' => 'required|string',
            'harga' => "required|integer"

        ]);

        if ($validation->withRequest($this->request)->run()) {
            $imageFile = $this->request->getFile('gambar');
            $imageFile->move(ROOTPATH . "public/uploads/", $imageFile->getRandomName());
            $data = [
                'kd_menu' => md5($this->request->getVar("menu") . random_int(0, 1000) . $imageFile->getFilename()),
                'nm_menu' => $this->request->getVar("menu"),
                "harga" => $this->request->getVar("harga"),
                "gambar" => $imageFile->getName()
            ];

            $this->menuModel->insert($data);
            $this->session->setFlashdata('success', 'Item telah ditambah.');
            return redirect("admin/menu");
        }

        // not validated
        $data['validation'] = $validation->getErrors();
        return view("admin/create", $data);

    }

    public function edit($id)
    {
        $data = $this->menuModel->find($id);

        return view("admin/edit", $data);
    }

    public function update($id)
    {
        $this->request->withMethod("put");

        $menu = $this->menuModel->find($id);
        $validation = Services::Validation();

        $validation->setRules([
            'menu' => 'required|string',
            'harga' => "required|integer"

        ]);

        if ($validation->withRequest($this->request)->run()) {

            $data = [
                'gambar' => $menu["gambar"],
                'nm_menu' => $this->request->getVar("menu"),
                "harga" => $this->request->getVar("harga"),
            ];

            $imageFile = $this->request->getFile('gambar');

            if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                if (file_exists(ROOTPATH . "public/uploads/" . $menu["gambar"])) {
                    unlink(ROOTPATH . "public/uploads/" . $menu["gambar"]);
                }

                $imageFile->move(ROOTPATH . "public/uploads/", $imageFile->getRandomName());
                $data["gambar"] = $imageFile->getName();
            }

            $this->menuModel->update($id, $data);
            $this->session->setFlashdata('success', 'Item telah diupdate.');
            return redirect("admin/menu");
        }

        // not validated
        $data['validation'] = $validation->getErrors();
        return view("admin/create", $data);
    }

    public function delete($id)
    {
        $this->request->withMethod("delete");
        $menu = $this->menuModel->find($id);
        unlink(ROOTPATH . "public/uploads/" . $menu["gambar"]);
        $this->menuModel->delete($id);
        $this->session->setFlashdata('success', 'Item telah dihapus.');
        return redirect("admin/menu");
    }
}