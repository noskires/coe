<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DB;

class Coe extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $primaryKey = 'id';
    protected $table = "coe";
    protected $casts = [
        'is_with_logo' => 'int',
        'is_salary_confidential' => 'int',
        'salary' => 'float',
        'uslp' => 'float',
        'mid_year_bon' => 'float',
        'longevity_bon' => 'float',
        'christmas_bon' => 'float',
        'other_bon' => 'float',
        'total_bon' => 'float',
    ];
    
}
