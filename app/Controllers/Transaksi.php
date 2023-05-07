<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $transaksiModel = model(TransaksiModel::class);
        $data = $transaksiModel->findAll();

        return view("admin/transaksi", [
            "transaksi" => $data,
        ]);
    }
}