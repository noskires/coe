<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB;
use App\Purpose;

class PurposesController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'purpose_code'=>$request->input('purpose_code'),
            'type_code'=>$request->input('type_code'),
            'self_service'=>$request->input('self_service'),
            'original_signature'=>$request->input('original_signature'),
            'request_type'=>$request->input('request_type')
        );

        $collection = DB::table('purposes as purpose')
            ->select(
                'purpose.id',
                'purpose.purpose_code',
                'purpose.purpose_desc',
                'purpose.type_code',
                'purpose.self_service',
                'purpose.original_signature',
                'purpose.created_by',
                'purpose.changed_by',
                'purpose.created_at',
                'purpose.updated_at',
                'type.type_desc'
            )
            ->leftjoin('coe_types as type','type.type_code','=','purpose.type_code');
        
        if($data['purpose_code']){
            $collection = $collection->where('purpose.purpose_code', $data['purpose_code']);
        }

        if($data['type_code']){
            $collection = $collection->where('purpose.type_code', $data['type_code']);
        }

        if($data['request_type']=="SELF SERVICE"){
            $collection = $collection->where('purpose.self_service', 1);
        }

        if($data['request_type']=="ORIGINAL SIGNATURE"){
            $collection = $collection->where('purpose.original_signature', 1);
        }

        // if($data['original_signature']){
        //     $collection = $collection->where('purpose.original_signature', 1);
        // }
        
        $collection = $collection->orderBy('purpose_desc', 'ASC');

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
        // try{

            if(Auth::user()->is_admin==1){

                $purpose = new Purpose;
                $purpose->purpose_desc            = $fields['purpose_desc'];
                $purpose->type_code               = $fields['type_code'];
                $purpose->self_service            = $fields['self_service'];
                $purpose->original_signature      = $fields['original_signature'];
                $purpose->created_by              = Auth::user()->email;
                $purpose->changed_by              = Auth::user()->email;
                $purpose->save();

                $type = Purpose::where('id', $purpose->id)->first();
                $purposeCode                      = (str_pad(($purpose->id), 4, "0", STR_PAD_LEFT));
                $purpose->purpose_code            = "PUR-".$purposeCode;
                $purpose->save();

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

    public function update(Request $request){

        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
        // try{

            // if(Auth::user()->is_admin==1){

                $purpose = Purpose::where('id', $fields['id'])->first();
                $purpose->purpose_desc            = $fields['purpose_desc'];
                $purpose->self_service            = $fields['self_service'];
                $purpose->original_signature      = $fields['original_signature'];
                $purpose->changed_by              = Auth::user()->email;
                $purpose->save();
                
                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'Successfully saved.'
                ]);

            // }else{
                        
            //     return response()->json([
            //         'status' => 200,
            //         'data' => null,
            //         'message' => 'You are not authorized to update records!.'
            //     ]);
            // }

        //   }
        //   catch (\Exception $e) 
        //   {
        //     return response()->json([
        //       'status' => 500,
        //       'data' => null,
        //       'message' => 'Error, please try again!'
        //     ]);
        //   }
        });

        return $transaction;
  
    }

    public function remove(Request $request){
  
        $field = Input::post();

        $transaction = DB::transaction(function($field) use($field){
        try{

            if(Auth::user()->is_admin==1){

                Purpose::where('id', $field['id'])->firstOrFail()->delete();

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
  
}
