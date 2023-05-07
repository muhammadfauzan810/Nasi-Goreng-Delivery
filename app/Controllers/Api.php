<?php

namespace App\Controllers;

class Api extends BaseController
{

    public function tambahPesanan()
    {
        $data = $this->request->getVar("data");
        $res = [
            "status" => "200",
            "error" => null,
            "message" => [
                "uid" => md5($data),
            ],
        ];

        return response($res);
    }
}