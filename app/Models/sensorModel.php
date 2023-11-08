<?php

namespace App\Models;

use CodeIgniter\Model;

class sensorModel extends Model
{

    protected $table      = 'daya';
    protected $primaryKey = 'id';

    protected $allowedFields = ['watt', 'date'];
}
