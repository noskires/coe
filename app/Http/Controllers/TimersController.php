<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB; 
use App\Type;

class TimersController extends Controller
{
    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'type_code'=>$request->input('type_code')
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
        // try{
            
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
        try{

            $type = Type::where('id', $fields['id'])->first();
            $type->type_desc            = $fields['type_desc'];
            $type->changed_by           = Auth::user()->email;
            $type->save();
            
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
  
        $field = Input::post();

        $transaction = DB::transaction(function($field) use($field){
        try{

            Type::where('id', $field['id'])->firstOrFail()->delete();

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

    public function checkActive(){
        // echo Auth::check();

        if (preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B) && $B['v'] <= 8) {
            // Browsers IE 8 and below
            echo "ie below";
        } else {
            echo "good";
            // All other browsers
        }
    }
  
}
