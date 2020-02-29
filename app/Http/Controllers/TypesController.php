<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB; 
use App\Type;

class TypesController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'type_code'=>$request->input('type_code'),
            'is_self_service'=>$request->input('is_self_service')
        );

        $collection = DB::table('coe_types as type')
            ->select(
                'type.id',
                'type.type_code',
                'type.type_desc',
                'type.created_by',
                'type.changed_by',
                'type.created_at',
                'type.updated_at'
            );
        
        if($data['type_code']){
            $collection = $collection->where('type_code', $data['type_code']);
        }

        if($data['is_self_service']=="YES"){
            $collection = $collection->where('type_desc', '<>', "CERTIFICATE OF EMPLOYMENT AND COMPENSATION ( WITH NOTARY )");
        }
        
        // $collection = $collection->orderBy('type_desc', 'ASC');

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

            if(Auth::user()->is_admin==1){
            
                $type = new Type;
                ($type->count() > 0) ? $counter=$type->latest()->first()->id+1 : $counter = 1;
                
                $type->type_desc                = $fields['type_desc'];
                $type->created_by               = Auth::user()->email;
                $type->changed_by               = Auth::user()->email;
                $type->save(); 

                $type = Type::where('id', $type->id)->first();
                $typeCode                       = (str_pad(($type->id), 3, "0", STR_PAD_LEFT));
                $type->type_code                = "TYP-".$typeCode;
                $type->save();

                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'Successfully saved.'
                ]);

            }else{
                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'You are not authorized to add new records!.'
                ]);
            }

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

    public function update(Request $request){

        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
        try{

            if(Auth::user()->is_admin==1){

                $type = Type::where('id', $fields['id'])->first();
                $type->type_desc            = $fields['type_desc'];
                $type->changed_by           = Auth::user()->email;
                $type->save();
                
                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'Successfully saved.'
                ]);

            }else{
                    
                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'You are not authorized to update records!.'
                ]);
            }

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
  
        $field = Input::post();

        $transaction = DB::transaction(function($field) use($field){
        try{
            
            if(Auth::user()->is_admin==1){

                Type::where('id', $field['id'])->firstOrFail()->delete();

                return response()->json([
                    'status' => 200,
                    'data' => 'null',
                    'message' => 'Successfully deleted.'
                ]);

            }else{
                        
                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'You are not authorized to delete records!.'
                ]);
            }

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

    public function checkActive(){
        // echo Auth::check();
        // if (preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B) && $B['v'] <= 8) {
        // if (preg_match('/(?i)msie [1-8]\./', @$_SERVER['HTTP_USER_AGENT'], $B) <= 8) {
        //     // Browsers IE 8 and below
        //     echo "ie below";
        // } else {
        //     echo "good";
        //     // All other browsers
        // }

        // $u = $_SERVER['HTTP_USER_AGENT'];

        // $isIE7  = (bool)preg_match('/msie 7./i', $u );
        // $isIE8  = (bool)preg_match('/msie 8./i', $u );
        // $isIE9  = (bool)preg_match('/msie 9./i', $u );
        // $isIE10 = (bool)preg_match('/msie 10./i', $u );
        // $isIE11 = (bool)preg_match('/msie 11./i', $u );

        // // if ($isIE7) {
        // //     //do ie9 stuff
        // //     echo "ie 7";
        // // }

        // if ($isIE8) {
        //     //do ie9 stuff
        //     echo "ie 8";
        // }

        // if ($isIE9) {
        //     //do ie9 stuff
        //     echo "ie 9";
        // }

        // if ($isIE10) {
        //     //do ie9 stuff
        //     echo "ie 10";
        // }

        // if ($isIE11) {
        //     //do ie9 stuff
        //     echo "ie 11";
        // }

        echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';

        $isIE = preg_match("/MSIE ([0-9]{1,}[\.0-9]{0,})/",$_SERVER['HTTP_USER_AGENT'],$version);
        if($isIE){
            return $version[1];
        }
        return $isIE;
      


        // $u_agent = $_SERVER['HTTP_USER_AGENT'];
        // $ub = '';
        // if(preg_match('/MSIE/i',$u_agen, $B))
        // {
        //     $ub = "ie = ".$B['v'];
        // }
        // elseif(preg_match('/Firefox/i',$u_agent))
        // {
        //     $ub = "firefox";
        // }
        // elseif(preg_match('/Safari/i',$u_agent))
        // {
        //     $ub = "safari";
        // }
        // elseif(preg_match('/Chrome/i',$u_agent))
        // {
        //     $ub = "chrome";
        // }
        // elseif(preg_match('/Flock/i',$u_agent))
        // {
        //     $ub = "flock";
        // }
        // elseif(preg_match('/Opera/i',$u_agent))
        // {
        //     $ub = "opera";
        // }
    
        // return $ub;
    }
  
}
