<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB;
use App\Location;

class AuditsController extends Controller
{
    public function index(){
        return view('layout.index');
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

}
