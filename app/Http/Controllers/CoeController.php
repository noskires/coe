<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Crypt;
// use Auth;
use DB;
// use App\Coe;
// use App\Employee;
// use App\Type;
// use App\Purpose;
// use App\StatusItem;

//Traits
use App\Traits\TimerTrait;
use App\Traits\MailTrait;

class CoeController extends Controller
{
    use TimerTrait;
    use MailTrait;

    public function index2(){
        return view('layout.index');
    }

    public function index($id){

        try {
            if(Crypt::decrypt($id)!=Auth::user()->email){
                return "You are not authorized to view this!";
            }else{
                if(Auth::user()->is_authenticated==1){
                    return view('layouts.index');
                }else{
                    return redirect('otp/'.Crypt::encrypt(Auth::user()->email));
                }
            }
        } catch (DecryptException $e) {
            return "You are not allowed to do that. You are being monitored!";
        }

    }

    public function coe_details($id){

        try {
            $data['coe_code'] = Crypt::decrypt($id);
            return view('layout.index', $data); 

        } catch (DecryptException $e) {
            return redirect('self-service/'.Crypt::encrypt(Auth::user()->email)); 
        }

    }

    public function coe_details_admin($id){

        try {

            $decrypted = decrypt($id);

            if(Auth::user()->is_admin==1){
                $data['coe_code'] = Crypt::decrypt($id);
                return view('layout.index', $data); 
            }else{
                return redirect('coe-details/'.$id); 
            }

        } catch (DecryptException $e) {
            return redirect('self-service/'.Crypt::encrypt(Auth::user()->email)); 
        }

    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'coe_code'=>$request->input('coe_code'),
            'request_type'=>$request->input('request_type'),
            'is_fulfiller'=>$request->input('is_fulfiller'),
            'is_all_request'=>$request->input('is_all_request'),
            'is_encrypted'=>$request->input('is_encrypted'),
        );
 
            $collection = Coe::select(
                DB::raw("row_number() OVER (ORDER BY coe.created_at DESC) as v_id"),
                'coe.coe_code',
                'coe.employee_code', 
                DB::raw("CONCAT(rtrim(CONCAT(coe.last_name,' ',COALESCE(coe.affix,''))),', ', COALESCE(coe.first_name,''),' ', COALESCE(coe.middle_name,'')) as name"),
                DB::raw("CONCAT(rtrim(CONCAT(coe.last_name,' ',COALESCE(coe.affix,''))),', ', COALESCE(coe.first_name,''),' ', COALESCE(coe.middle_name,'')) as name2"),
                'coe.organization',
                'coe.date_hired',
                'coe.employee_subgroup', 
                'coe.personnel_area',
                'coe.position',
                'coe.salary',
                'coe.coe_type',
                'coe.is_with_logo',
                'coe.is_salary_confidential',
                'coe.gender',
                'coe.employee_group',
                'coe.is_self_service',
                DB::raw("CASE WHEN coe.employee_group = 'PLDT Regular' THEN 'regular' WHEN coe.employee_group = 'PLDT Probationary' THEN 'probationary' ELSE '' END employee_group_type01"),
                DB::raw("CASE WHEN coe.gender = 'Male' THEN 'he' WHEN coe.gender = 'Female' THEN 'she' ELSE 'Unknown' END as gender_type01"),
                DB::raw("CASE WHEN coe.gender = 'Male' THEN 'him' WHEN coe.gender = 'Female' THEN 'her' ELSE 'Unknown' END as gender_type02"),
                DB::raw("CASE WHEN coe.gender = 'Male' THEN 'his' WHEN coe.gender = 'Female' THEN 'her' ELSE 'Unknown' END as gender_type03"),
                DB::raw("CASE WHEN coe.is_salary_confidential = '0' THEN 'SHOW SALARY' ELSE 'CONFIDENTIAL' END as is_salary_confidential01"),
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
                'coe.changed_by',
                'coe.created_at',
                'coe.updated_at',
                'purpose.purpose_desc'
                // DB::raw("SELECT TOP 1  ")    
            )
            
            ->leftjoin('purposes as purpose','purpose.purpose_code','=','coe.coe_purpose')
            ->leftjoin('coe_types as type','type.type_code','=','purpose.type_code');

        // if(Auth::user()->is_admin==1){
            if($data['coe_code']){
                if($data['is_encrypted']=="YES"){
                    $collection = $collection->where('coe_code', Crypt::decrypt($data['coe_code']));
                }else{
                    $collection = $collection->where('coe_code', $data['coe_code']);
                }
            }
        // }else{
        //     $collection = $collection->where('coe_code', Crypt::decrypt($data['coe_code']));
        // }

        if($data['request_type']=="ORIGINAL SIGNATURE"){
            $collection = $collection->where('is_self_service', 0);
        }

        if($data['request_type']=="SELF SERVICE"){
            $collection = $collection->where('is_self_service', 1);
        }

        if($data['request_type']=="WALK IN"){
            $collection = $collection->where('is_self_service', 2);
        }
        
        if(Auth::user()->is_admin==1){

            if($data['is_all_request']!='YES'){

                if($data['is_fulfiller']==='YES'){
                    $collection = $collection->where('coe.changed_by', Auth::user()->email);
                }else{
                    $collection = $collection->where('coe.created_by', Auth::user()->email);
                }
                
            }
        }else{
            $collection = $collection->where('coe.created_by', Auth::user()->email);
        }
        
        $collection = $collection->get();

        return response()-> json([
            'status'=>200,
            'data'=>$collection,
            'count'=>count($collection),
            'message'=>$data['request_type']
        ]);

    }

    public function store(Request $request){

        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
        // try{

            if($fields['is_self_service']==2){
                $employee_code = explode("-", $fields['employee_code']);
                $employee = Employee::where('employee_code', $employee_code[0])->first();
            }else{
                $employee = Employee::where('email_address',Auth::user()->email)->first();
            }

            //defaults
            $fields['is_with_signature'] = 1;
            $fields['coe_signatory'] = 522861;
            $fields['logo'] = 1;

            if(empty($fields['salary_option'])){
                $fields['salary_option'] = 0;
            }
            
            $toDate = Carbon::now(); 

            $isExist = Coe::where('employee_code', $employee->employee_code)
            ->where('last_name', $employee->last_name)
            ->where('affix', $employee->affix)
            ->where('first_name', $employee->first_name)
            ->where('middle_name', $employee->middle_name)
            ->where('organization', $employee->organization)
            ->where('sss_no', $employee->sss_no)
            ->where('tin', $employee->tin)
            ->where('philhealth_no', $employee->philhealth_no)
            ->where('hdmf_no', $employee->hdmf_no)
            ->where('coe_type', $fields['coe_type'])
            ->where('coe_purpose', $fields['coe_purpose'])
            ->where('is_self_service', $fields['is_self_service'])
            ->where('coe_signatory', $fields['coe_signatory'])
            ->where('is_salary_confidential', $fields['salary_option'])
            ->where('created_by', Auth::user()->email)
            ->whereDate('created_at', $toDate);

            if(empty($employee->salary)){
                $employee->salary = 0;
            }

            if($fields['coe_type'] == "TYP-001"){

                if($fields['salary_option']==1){
                    $isExist = $isExist->where('salary', 0)
                    ->where('uslp', 0)
                    ->where('mid_year_bon', 0)
                    ->where('longevity_bon', 0)
                    ->where('christmas_bon', 0)
                    ->where('allowances', 0)
                    ->where('other_bon', 0)
                    ->where('total_bon', 0);
                }else{
                    $isExist = $isExist->where('salary', $employee->salary)
                    ->where('uslp', $employee->uslp)
                    ->where('mid_year_bon', $employee->mid_year_bon)
                    ->where('longevity_bon', $employee->longevity_bon)
                    ->where('christmas_bon', $employee->christmas_bon)
                    ->where('allowances', $employee->allowances)
                    ->where('other_bon', $employee->other_bon)
                    ->where('total_bon', $employee->total_bon);
                }
            }else{

                $isExist = $isExist->where('salary', $employee->salary)
                ->where('uslp', $employee->uslp)
                ->where('mid_year_bon', $employee->mid_year_bon)
                ->where('longevity_bon', $employee->longevity_bon)
                ->where('christmas_bon', $employee->christmas_bon)
                ->where('allowances', $employee->allowances)
                ->where('other_bon', $employee->other_bon)
                ->where('total_bon', $employee->total_bon);
            }
            
            $isExist = $isExist->count();

            if($isExist>0){
                return response()->json([
                    'status' => 500,
                    'data' => null,
                    'message' => 'Duplicate request.'
                ]);
            }else{

            $coe = new Coe;
            $coe->employee_code           = $employee->employee_code;
            $coe->last_name               = $employee->last_name;
            $coe->affix                   = $employee->affix;
            $coe->first_name              = $employee->first_name;
            $coe->middle_name             = $employee->middle_name;
            $coe->gender                  = $employee->gender;
            $coe->salary                  = $employee->salary;
            $coe->employee_group          = $employee->employee_group;
            $coe->employee_subgroup       = $employee->employee_subgroup;
            $coe->date_hired              = $employee->date_hired;
            $coe->organization            = $employee->organization;
            $coe->personnel_area          = $employee->personnel_area;
            $coe->personnel_subarea       = $employee->personnel_subarea;
            $coe->position                = $employee->position;
            $coe->sss_no                  = $employee->sss_no;
            $coe->tin                     = $employee->tin;
            $coe->philhealth_no           = $employee->philhealth_no;
            $coe->hdmf_no                 = $employee->hdmf_no;
            $coe->coe_type                = $fields['coe_type'];
            $coe->coe_purpose             = $fields['coe_purpose'];
            $coe->coe_signatory           = $fields['coe_signatory'];
            $coe->is_self_service         = $fields['is_self_service'];

            if($fields['is_self_service'] == 1){
                $coe->is_with_logo  = 1;
                $coe->is_with_signature  = 0;
            }elseif($fields['is_self_service'] == 2){
                $coe->is_with_logo  = 0;
                $coe->is_with_signature  = 0;
            }else{

                $coe->is_with_logo  = 0;
                $coe->is_with_signature  = 1;
            }

            if($fields['coe_type'] == "TYP-001"){

                if($fields['salary_option']!=0)
                { 
                    $coe->is_salary_confidential  = 1;
                    $coe->salary                  = 0;
                    $coe->uslp                    = 0;
                    $coe->mid_year_bon            = 0;
                    $coe->longevity_bon           = 0;
                    $coe->christmas_bon           = 0;
                    $coe->allowances              = 0;
                    $coe->other_bon               = 0;
                    $coe->total_bon               = 0;
                }else{ 
                    $coe->is_salary_confidential  = 0;
                    $coe->salary                  = $employee->salary;
                    $coe->uslp                    = $employee->uslp;
                    $coe->mid_year_bon            = $employee->mid_year_bon;
                    $coe->longevity_bon           = $employee->longevity_bon;
                    $coe->christmas_bon           = $employee->christmas_bon;
                    $coe->allowances              = $employee->allowances;
                    $coe->other_bon               = $employee->other_bon;
                    $coe->total_bon               = $employee->total_bon;
                }
                
            }else {
                $coe->is_salary_confidential  = 0;
                $coe->salary                  = $employee->salary;
                $coe->uslp                    = $employee->uslp;
                $coe->mid_year_bon            = $employee->mid_year_bon;
                $coe->longevity_bon           = $employee->longevity_bon;
                $coe->christmas_bon           = $employee->christmas_bon;
                $coe->allowances              = $employee->allowances;
                $coe->other_bon               = $employee->other_bon;
                $coe->total_bon               = $employee->total_bon;
                
            }

            $coe->created_by              = Auth::user()->email;
            
            $coe->save();

            $coe = Coe::where('id', $coe->id)->first();
            // $coeCode                       = (str_pad(($coe->id+10000), 3, "0", STR_PAD_LEFT));
            $coeCode                       = $coe->id+100000;
            $coe->coe_code                 = "eHR-".$toDate->month.$toDate->day."-".substr($toDate->year,-2)."-".$coeCode."-CEC";
            
            if($fields['is_self_service']==1){
                $coe->changed_by              = Auth::user()->email;
            }elseif($fields['is_self_service']==2){
                $coe->changed_by              = Auth::user()->email;
            }else{
                
                $fulfiller          = $this->getFulfiller();
                $coe->changed_by    = $fulfiller;

                $employee           = Employee::select(DB::raw("CONCAT(rtrim(CONCAT(last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,'')) as name"))
                                    ->where('employee_code', $coe->employee_code)->first();

                $type               = Type::select('type_desc')->where('type_code', $coe->coe_type)->first();
                $purpose            = Purpose::select('purpose_desc')->where('purpose_code', $coe->coe_purpose)->first();
                
                $otherDetails['name']           = $employee->name;
                $otherDetails['type_desc']      = $type->type_desc;
                $otherDetails['purpose_desc']   = $purpose->purpose_desc;
                $otherDetails['remarks']        = $fields['remarks'];
                
                $this->sendRequestLink($coe, $otherDetails);

                //for status
                $status_item = new StatusItem;
                $status_item->status_code       = 'STAT0001';
                $status_item->coe_code          = $coe->coe_code;
                $status_item->user_type         = "EMPLOYEE";
                $status_item->user_type_id      = Auth::user()->email;
                $status_item->remarks           = $fields['remarks'];
                $status_item->created_by        = Auth::user()->email;
                $status_item->save();

            }
            
            $coe->save();

            return response()->json([
                'status' => 200,
                'data' => null,
                'message' => 'Successfully saved.',
                'employee' => $employee
            ]);

            }
            
        // }
        // catch (\Exception $e) 
        // {
        //   return response()->json([
        //     'status' => 500,
        //     'data' => null,
        //     'message' => 'Error, please try again!'
        //   ]);
        // }

        });

        return $transaction;
    }

    public function getEncrypted(Request $request){

        $data = array( 
            'coe_code'=>$request->input('coe_code')
        );

        $encrypt =  Crypt::encrypt($data['coe_code']);

        return response()->json([
            'status' => 200,
            'data' => $encrypt,
            'message' => 'Successfully saved.'
        ]);
    }

    public function getRemainingTime(){

        return response()->json([
            'status' => 200,
            'data' => $this->diffInTime(),
            'message' => ''
        ]);

    }
}
