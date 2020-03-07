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

    public function purpose(){
    	return $this->hasOne('App\Purpose', 'purpose_code', 'coe_purpose');	
    }

    public function type(){
    	return $this->hasOne('App\Type', 'type_code', 'type_code');
    }

    public function scopeDefaultFields($query){

    	$query->select(
            'id',
            'coe_code',
            'employee_code', 
            DB::raw("CONCAT(rtrim(CONCAT(last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,'')) as name"),
            DB::raw("CONCAT(rtrim(CONCAT(last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,'')) as name2"),
            'organization',
            'date_hired',
            'employee_subgroup',
            'personnel_area',
            'position', 
            'coe_type',
            'is_with_logo',
            'is_salary_confidential',
            'gender',
            'employee_group',
            'is_self_service',
            DB::raw("CASE WHEN employee_group = 'PLDT Regular' THEN 'regular' WHEN employee_group = 'PLDT Probationary' THEN 'probationary' ELSE '' END employee_group_type01"),
            DB::raw("CASE WHEN gender = 'Male' THEN 'he' WHEN gender = 'Female' THEN 'she' ELSE 'Unknown' END as gender_type01"),
            DB::raw("CASE WHEN gender = 'Male' THEN 'him' WHEN gender = 'Female' THEN 'her' ELSE 'Unknown' END as gender_type02"),
            DB::raw("CASE WHEN gender = 'Male' THEN 'his' WHEN gender = 'Female' THEN 'her' ELSE 'Unknown' END as gender_type03"),
            DB::raw("CASE WHEN is_salary_confidential = '0' THEN 'SHOW SALARY' ELSE 'CONFIDENTIAL' END as is_salary_confidential01"),
            DB::raw("CAST(salary as decimal(10,2)) as salary"),
            DB::raw("CAST(uslp as decimal(10,2)) as uslp"),
            DB::raw("CAST(mid_year_bon as decimal(10,2)) as mid_year_bon"),
            DB::raw("CAST(longevity_bon as decimal(10,2)) as longevity_bon"),
            DB::raw("CAST(christmas_bon as decimal(10,2)) as christmas_bon"),
            DB::raw("CAST(allowances as decimal(10,2)) as allowances"),
            DB::raw("CAST(other_bon as decimal(10,2)) as other_bon"),
            DB::raw("CAST(total_bon as decimal(10,2)) as total_bon"),
            // 'type.type_desc',
            'coe_purpose',
            'created_by',
            'changed_by',
            'created_at',
            'updated_at'
        );

    }

    public function scopeWhereFields($query, $data){
 

        if($data['coe_code']){
    		$query->where('coe_code', $data['coe_code']);
    	}

    }
}
