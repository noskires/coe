<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 

class PermissionsController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'name'=>$request->input('name'),
            'is_self_service'=>$request->input('is_self_service')
        );

        $collection = Permission::select(
            'permissions.id',
            'permissions.name',
            'permissions.created_by',
            'permissions.changed_by',
            'permissions.created_at',
            'permissions.updated_at',
            'role.name as role_name'
        )
        ->leftjoin('role_has_permissions as role_has_permission','role_has_permission.permission_id','=','permissions.id')
        ->leftjoin('roles as role','role.id','=','role_has_permission.role_id');
        
        if($data['id']){
            $collection = $collection->where('id', $data['id']);
        }

        if($data['name']){
            $collection = $collection->where('name', $data['name']);
        }

        $collection = $collection->get();        

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
                
                Permission::create([
                    'name'=>$fields['name'],
                    'created_by'=>Auth::user()->email,
                    'changed_by'=>Auth::user()->email,
                ]);
 
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
             
            // Permission::where('id', $field['id'])->firstOrFail()->delete();
            $permission = Permission::findById($fields['id']);
            $permission->delete();

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
