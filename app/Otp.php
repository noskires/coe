<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DB;

class Otp extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $primaryKey = 'id';
    protected $table = "otp";

    protected $casts = [
        'id' => 'varchar'
    ];

}
