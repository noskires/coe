<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'admin_code'=>$request->input('admin_code'),
        );

        $collection = User::whereHas("roles", function($q){ $q->where("name", "admin")->orWhere("name", "fulfiller"); })
        ->with(['roles' => function ($q) use ($data) {
            $q->where("name", "admin")->orWhere("name", "fulfiller");
        }])->get();
        
        // $collection = User::select(
        //     'users.id',
        //     DB::raw("CONCAT(rtrim(CONCAT(last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,'')) as name"),
        //     'role.name as role'
        // )
        // ->leftjoin('model_has_roles as model_has_role','model_has_role.model_id','=','users.id')
        // ->leftjoin('roles as role','role.id','=','model_has_role.role_id')->get();
        
        return response()-> json([
            'status'=>200,
            'data'=>$collection,
            'message'=>''
        ]);
        
    }

    public function store(Request $request){

        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
        try{

            $employee_code = explode("-", $fields['employee_code']);  
            $user = User::where('id', $employee_code[0])->first();
            $role = Role::findById($fields['admin_type']);
            $user->assignRole($role);

            return response()->json([
                'status' => 200,
                'data' => null,
                'message' => 'Successfully saved.'
            ]);
        }
        catch (\Exception $e) 
        {
            return response()->json([
                'status' => 500,
                'data' => null,
                'message' => 'Error, please try again!'
            ]);
        }
    });

    return $transaction;
    }

    public function remove(Request $request){
  
        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
        try{

            $user = User::where('id', $fields['id'])->first();
            $user->removeRole($fields['role']);
            
            return response()->json([
                'status' => 200,
                'data' => 'null',
                'message' => 'Successfully deleted.'
            ]);

          }
          catch (\Exception $e) 
          {
            return response()->json([
                'status' => 500,
                'data' => 'null',
                'message' => 'Error, please try again!'
            ]);
          }
        });

        return $transaction;
    }
  
}
