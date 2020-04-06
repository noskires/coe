<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB;
use DataTables;
use App\Audit;
use App\Location;

class AuditsController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id')
        );

        $collection = DB::table('audits as audit')
            ->select(
            'audit.id',
            'audit.user_type',
            'audit.user_id',
            'audit.event',
            'audit.auditable_id',
            'audit.auditable_type',
            'audit.url',
            'audit.user_agent',
            'audit.tags',
            'audit.old_values',
            'audit.new_values',
            'audit.ip_address',
            'audit.created_at',
            'user.email'

            )
            ->leftjoin('users as user','user.id','=','audit.user_id');
        
        if($data['id']){
            $collection = $collection->where('id', $data['id']);
        }
        
        $collection = $collection->get();        

        return response()-> json([
            'status'=>200,
            'data'=>$collection,
            'message'=>''
        ]);

    }

    public function show_dtables(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'coe_code'=>$request->input('coe_code'),
            'request_type'=>$request->input('request_type'),
            'is_fulfiller'=>$request->input('is_fulfiller'),
            'is_all_request'=>$request->input('is_all_request'),
            'is_encrypted'=>$request->input('is_encrypted'),
        );
 
        $collection = Audit::all();
        return DataTables::of($collection)->make(true);

    }

}
