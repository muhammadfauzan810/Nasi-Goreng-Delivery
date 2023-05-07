<?php

namespace App\Controllers;

use Config\Services;
use App\Models\MenuModel;
use App\Models\UserModel;
use App\Models\DetailModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;

class Home extends BaseController
{

    protected $session, $menuModel, $detailModel, $error;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->session = session();
        $this->menuModel = model(MenuModel::class);
        $this->detailModel = model(DetailModel::class);
    }

    public function index()
    {
        $menus = $this->menuModel->findAll();
        $uid = $this->session->get("uid");

        if (empty($uid)) {
            $uid = md5(date_default_timezone_get() . random_int(1, 100) . random_bytes(8));
            $this->session->set("uid", $uid);
        }

        return view('home', [
            "menus" => $menus,
            "keranjang" => $this->detailModel->where(["kd_transaksi" => $uid])->countAllResults(),
        ]);
    }

    public function tambahPesanan()
    {
        $validation = Services::Validation();
        $menu = $this->menuModel->where(["kd_menu" => $this->request->getVar("kd_menu")])->first();
        $cek = $this->detailModel->where(["kd_transaksi" => $this->session->get("uid")])->where(["kd_menu" => $this->request->getVar("kd_menu")])->first();

        $validation->setRules([
            "kd_menu" => "required|string",
            "jumlah" => "required|integer",
        ]);

        // validasi
        if ($validation->withRequest($this->request)->run()) {
            $data = [
                "kd_transaksi" => $this->session->get("uid"),
                "kd_menu" => $this->request->getVar("kd_menu"),
                "harga" => $menu["harga"],
            ];

            // cek same menu in db
            if ($cek) {
                $jumlahPesanan = $cek["jumlah_pesanan"] + $this->request->getVar("jumlah");
                $data["jumlah_pesanan"] = $jumlahPesanan;
                $data["sub_total"] = $jumlahPesanan * $menu["harga"];

                $this->detailModel->update($cek["id"], $data);
            } else {
                $jumlahPesanan = $this->request->getVar("jumlah");
                $data["jumlah_pesanan"] = $jumlahPesanan;
                $data["sub_total"] = $jumlahPesanan * $menu["harga"];

                $this->detailModel->insert($data);
            }
        }
        $errorMsg = $validation->getErrors();

        return redirect()->to("/")->with("error", $errorMsg);
    }

    public function shoopingCart()
    {
        $detailData = $this->detailModel->where("kd_transaksi", $this->session->get("uid"));

        return view("shoopingCart", [
            "keranjang" => $this->detailModel->where("kd_transaksi", $this->session->get("uid"))->countAllResults(),
            "details" => $this->detailModel->where("kd_transaksi", $this->session->get("uid"))->findAll(),
            "total" => $this->detailModel->where("kd_transaksi", $this->session->get("uid"))->selectSum("sub_total")->first()["sub_total"]
        ]);
    }

    public function bayar()
    {
        $this->request->withMethod("post");
        $transaksiModel = model(TransaksiModel::class);
        $userModel = model(UserModel::class);
        $validation = Services::Validation();

        $validation->setRules([
            "nama" => "required|string",
            "alamat" => "required|string",
            "telp" => "required|integer",
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $data = [
                "kd_transaksi" => md5(random_int(0, 100) . random_bytes(8)),
                "tgl_transaksi" => date("d-M-Y"),
                "nama_pembeli" => $this->request->getVar("nama"),
                "alamat" => $this->request->getVar("alamat"),
                "no_telp" => $this->request->getVar("telp"),
                "total_bayar" => $this->detailModel->where("kd_transaksi", $this->session->get("uid"))->selectSum("sub_total")->first()["sub_total"],
                "kd_admin" => $userModel->first()["kd_admin"]
            ];

            $transaksiModel->insert($data);
            $this->session->remove("uid");
            return redirect()->to("/");
        }

        $errorMsg = $validation->getErrors();

        return redirect()->to("bayar")->with("error", $errorMsg);

    }
}