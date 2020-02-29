<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use DB;

class Employee extends Model
{  
    protected $primaryKey = '';
    protected $table = "employees";
    // protected $casts = [
    //     'employee_code' => 'varchar'
    // ];

}
