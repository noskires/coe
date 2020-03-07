<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DB;

class Purpose extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $primaryKey = 'id';
    protected $table = "purposes";
    protected $casts = [
        'self_service' => 'int',
        'original_signature' => 'int',
    ];

    public function type(){
    	return $this->hasOne('App\Type', 'type_code', 'type_code');
    }

    public function Coe(){
    	return $this->belongsTo('App\Coe', 'purpose_code', 'purpose_code');
    }

    public function scopeDefaultFields($query){
        
    	$query->select(
            'id',
            'purpose_code',
            'purpose_desc',
            'type_code',
            'self_service',
            'original_signature',
            'created_by',
            'changed_by',
            'created_at',
            'updated_at'
        );
    }
}
