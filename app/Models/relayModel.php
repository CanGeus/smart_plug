<?php

namespace App\Models;

use CodeIgniter\Model;

class relayModel extends Model
{

    protected $table      = 'relay';
    protected $primaryKey = 'id';

    protected $allowedFields = ['status', 'date'];
}
