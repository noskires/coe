<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DB;

class Type extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $primaryKey = 'id';
    protected $table = "coe_types";

    public function scopeDefaultFields($query){
        
    	$query->select(
            'id',
            'type_code',
            'type_desc',
            'created_by',
            'changed_by',
            'created_at',
            'updated_at'
        );
    }
}
