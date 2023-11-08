<?php

namespace App\Controllers;

use App\Models\relayModel;
use App\Models\sensorModel;

class Relay extends BaseController
{
    protected $relayModel, $sensorModel;
    public function __construct()
    {
        $this->relayModel = new relayModel;
        $this->sensorModel = new sensorModel;
    }
    public function insertRelay()
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d H:i:s");

        try {
            $this->relayModel->insert([
                "status" => $this->request->getVar("status"),
                "date" => $date
            ]);

            // Penyisipan berhasil, kembalikan respons dengan kode status 200 OK
            return $this->response->setStatusCode(200);
        } catch (\Exception $e) {
            // Penyisipan gagal, kembalikan respons dengan kode status 400 Bad Request
            return $this->response->setStatusCode(400);
        }
    }
    public function readRelay()
{
    $data = $this->relayModel->orderBy('id', 'DESC')->first(['status']); 
    return $this->response->setJSON($data);
}

}
