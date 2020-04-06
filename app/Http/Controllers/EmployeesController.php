<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

use DB;
use Auth;
use App\Employee;

class EmployeesController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){
        // $employee_code = explode("-", $request->input('employee_code'));
        $data = array(
            'employee_code'=>$request->input('employee_code'),
            'email_address'=>$request->input('email_address'),
            'term'=>$request->input('term'),//select2 default
            'q'=>$request->input('q'),//select2 default
            'type'=>$request->input('type'), //regular employee
            'employment_status'=>$request->input('employment_status') 
        );

       
        // return $employee = Employee::where('email_address',Auth::user()->email)->first();
 
        $collection = DB::table('employees as employee')
            ->select(
            'employee.employee_code',
            'employee.last_name',
            'employee.affix', 
            'employee.first_name', 
            'employee.organization',
            'employee.date_hired',
            'employee.employee_subgroup',
            'employee.email_address',
            'employee.personnel_area',
            'employee.position',
            DB::raw("CAST(employee.salary as decimal(10,2)) as salary"),
            DB::raw("CAST(employee.uslp as decimal(10,2)) as uslp"),
            DB::raw("CAST(employee.mid_year_bon as decimal(10,2)) as mid_year_bon"),
            DB::raw("CAST(employee.longevity_bon as decimal(10,2)) as longevity_bon"),
            DB::raw("CAST(employee.christmas_bon as decimal(10,2)) as christmas_bon"),
            DB::raw("CAST(employee.allowances as decimal(10,2)) as allowances"),
            DB::raw("CAST(employee.other_bon as decimal(10,2)) as other_bon"), 
            DB::raw("CAST(employee.total_bon as decimal(10,2)) as total_bon")
        );
        
        if($data['employee_code']){
            $collection = $collection->where('employee.employee_code', 'like', '%'.$data['employee_code'].'%');
        }

        if($data['employment_status']){
            $collection = $collection->where('employee.employment_status', 'like', '%'.$data['employment_status'].'%');
        }

        $collection = $collection->where('employee.email_address', 'like', '%'.Auth::user()->email.'%');

        $collection = $collection->get();
        // return response()->json($collection);
        return response()->json([
            'status'=>200,
            'data'=>$collection,
            'message'=>''
        ]);

    }


    public function show2(Request $request){ 

        $data = array(
            'employee_code'=>$request->input('employee_code'),
            'email_address'=>$request->input('email_address'),
            'term'=>$request->input('term'),//select2 default
            'q'=>$request->input('q'),//select2 default
            'type'=>$request->input('type'), //regular employee or addressee
            'employment_status'=>$request->input('employment_status') 
        );
        

        $collection = DB::table('employees as employee')
            ->select(
                'employee.employee_code as id',
                DB::raw("CONCAT(rtrim(CONCAT(employee_code,'-',last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,'')) as text"),
                'employee.employee_code',
                'employee.last_name',
                'employee.affix', 
                'employee.first_name', 
                'employee.middle_name'
            ); 
        
        if($data['employee_code']){
            $collection = $collection->where('employee.employee_code', 'like', '%'.$data['employee_code'].'%');
        }

        if($data['employment_status']){
            $collection = $collection->where('employee.employment_status', 'like', '%'.$data['employment_status'].'%');
        }

        if($data['term']){
            $collection = $collection->where(
                DB::raw("CONCAT(rtrim(CONCAT(employee_code,'-',last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,''))"),
             'like', '%'.$data['term'].'%');
        }

        if($data['q']){
            $collection = $collection->where(
                DB::raw("CONCAT(rtrim(CONCAT(employee_code,'-',last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,''))"),
             'like', '%'.$data['q'].'%');
        }

        $collection = $collection->get(); 

        return response()->json([
            'status'=>200,
            'data'=>$collection,
            'items'=>$collection,
            'message'=>''
        ]);

    }

}
