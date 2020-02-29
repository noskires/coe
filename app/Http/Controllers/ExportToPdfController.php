<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
use DB;
use Auth;
use App\Coe;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;
use Response;

class ExportToPdfController extends Controller {

    public function export($coeCode){

        try {
            $data['coe'] = $this->coe($coeCode);
        } catch (DecryptException $e) {
            return "You are not allowed to do that. You are being monitored!";
        }
        
        if($data['coe']){
            if($data['coe']->type_desc == "CERTIFICATE OF EMPLOYMENT AND COMPENSATION"){
               
                $pdf = PDF::loadView('coe.cec_print', $data)->setPaper('Letter');
                $pdf->setEncryption('erikson');
                return $pdf->stream('coe.cec_print.pdf');
            }elseif($data['coe']->type_desc == "CERTIFICATE OF EMPLOYMENT"){
                $pdf = PDF::loadView('coe.coe_print', $data)->setPaper('Letter');
                $pdf->setEncryption('erikson');
                return $pdf->stream('coe.coe_print.pdf');
            }else{
                return "COE Type is not defined.";
            }
        }else{
            return "Oopsss! You are not allowed to do that!";
        }
	}

    public function coe($coeCode){

        $coeCode = Crypt::decrypt($coeCode);

        $collection = Coe::select(
            'coe.coe_code',
            'coe.employee_code',
            DB::raw("CONCAT(rtrim(CONCAT(coe.last_name,' ',COALESCE(coe.affix,''))),', ', COALESCE(coe.first_name,''),' ', COALESCE(coe.middle_name,'')) as name"),
            DB::raw("CONCAT(COALESCE(coe.first_name,''),' ', COALESCE(coe.middle_name,''),' ',rtrim(CONCAT(coe.last_name,' ',COALESCE(coe.affix,'')))) as name2"),
            'coe.organization',
            'coe.date_hired',
            'coe.employee_subgroup',
            'coe.personnel_area',
            'coe.position',
            'coe.salary',
            'coe.coe_type',
            'coe.is_with_logo',
            'coe.is_with_signature',
            'coe.gender',
            'coe.employee_group',
            'coe.sss_no',
            'coe.tin',
            'coe.philhealth_no',
            'coe.hdmf_no',
            DB::raw("CASE WHEN coe.employee_group = 'PLDT Regular' THEN 'regular' WHEN coe.employee_group = 'PLDT Probationary' THEN 'probationary' ELSE '' END employee_group_type01"),
            DB::raw("CASE WHEN coe.gender = 'Male' THEN 'he' WHEN coe.gender = 'Female' THEN 'she' ELSE 'Unknown' END as gender_type01"),
            DB::raw("CASE WHEN coe.gender = 'Male' THEN 'him' WHEN coe.gender = 'Female' THEN 'her' ELSE 'Unknown' END as gender_type02"),
            DB::raw("CASE WHEN coe.gender = 'Male' THEN 'his' WHEN coe.gender = 'Female' THEN 'her' ELSE 'Unknown' END as gender_type03"),    
            DB::raw("CAST(coe.salary as decimal(10,2)) as salary"),
            DB::raw("CAST(coe.uslp as decimal(10,2)) as uslp"),
            DB::raw("CAST(coe.mid_year_bon as decimal(10,2)) as mid_year_bon"),
            DB::raw("CAST(coe.longevity_bon as decimal(10,2)) as longevity_bon"),
            DB::raw("CAST(coe.christmas_bon as decimal(10,2)) as christmas_bon"),
            DB::raw("CAST(coe.allowances as decimal(10,2)) as allowances"),
            DB::raw("CAST(coe.other_bon as decimal(10,2)) as other_bon"), 
            DB::raw("CAST(coe.total_bon as decimal(10,2)) as total_bon"),
            'type.type_desc',
            'coe.created_by',
            'coe.created_at',
            'purpose.purpose_desc'
        );
        
        if(Auth::user()->is_admin==0){
            $collection = $collection->where('coe.created_by',Auth::user()->email);
        }
        
        $collection = $collection->where('coe.coe_code', $coeCode)
        ->leftjoin('purposes as purpose','purpose.purpose_code','=','coe.coe_purpose')
        ->leftjoin('coe_types as type','type.type_code','=','purpose.type_code')
        ->first();

        return $collection;
    }
}