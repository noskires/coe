<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RoleHasPermission;

class RolesController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $collection = Role::with('permissions')->get();

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

            $role = Role::findById($fields['admin_type']);
            $permission = Permission::findById($fields['permission_id']);
            $role->givePermissionTo($permission);
            
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
    public function remove(Request $request){

        $fields = Input::post();
        
        $transaction = DB::transaction(function($field) use($fields){
        try{
            
            $role = Role::where('id', $fields['role_id'])->first();
            $permission = Permission::findById($fields['permission_id']); 
            $role->revokePermissionTo($permission);

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
