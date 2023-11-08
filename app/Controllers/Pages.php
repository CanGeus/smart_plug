<?php

namespace App\Controllers;

use App\Models\relayModel;
use App\Models\sensorModel;

class Pages extends BaseController
{
    protected $relayModel, $sensorModel;
    public function __construct()
    {
        $this->relayModel = new relayModel;
        $this->sensorModel = new sensorModel;
    }
    public function index(): string
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d H");
        
        $kwh = $this->sensorModel->orderBy('id', 'DESC')->limit(1)->find();

        foreach ($kwh as $row) {
            $total = $row['watt'];
        }
        
        $daya = $total / 1000;

        $biaya = number_format($daya ,2) * 1500;

        $data = [
            'relay' => $this->relayModel->orderBy('id', 'DESC')->limit(20)->find(),
            'lastRelay' => $this->relayModel->orderBy('id', 'DESC')->limit(1)->find(),
            'kwh' => number_format($daya, 2),
            'biaya' => $biaya,
        ];
        return view('index', $data);
    }

    public function report(): string
    {
        $data = [
            'relay' => $this->relayModel->orderBy('id', 'DESC')->findAll(),
            'sensor' => $this->sensorModel->orderBy('id', 'DESC')->limit(1)->find(),
        ];
        return view('report', $data);
    }
}
