<?php

namespace App\Controllers;

use App\Models\relayModel;
use App\Models\sensorModel;

class Sensor extends BaseController
{
    protected $relayModel, $sensorModel;
    public function __construct()
    {
        $this->relayModel = new relayModel;
        $this->sensorModel = new sensorModel;
    }
    public function insertSensor()
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d H:i:s");

        try {
            $this->sensorModel->insert([
                "watt" => $this->request->getVar("watt"),
                "date" => $date
            ]);

            // Penyisipan berhasil, kembalikan respons dengan kode status 200 OK
            return $this->response->setStatusCode(200);
        } catch (\Exception $e) {
            // Penyisipan gagal, kembalikan respons dengan kode status 400 Bad Request
            return $this->response->setStatusCode(400);
        }
    }
}
