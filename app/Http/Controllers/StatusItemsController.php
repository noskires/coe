<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use DB;
use Crypt;

use App\StatusItem;
use App\Coe;
use App\Employee;
use App\Type;
use App\Purpose; 
use App\Status; 


//Traits
use App\Traits\TimerTrait;
use App\Traits\MailTrait;

class StatusItemsController extends Controller
{

    use TimerTrait;
    use MailTrait;

    public function index(){
        return view('layouts.index');
    }

    public function show(Request $request){

        $data = array(
            'id'=>$request->input('id'),
            'status_item_code'=>$request->input('status_item_code'),
            'coe_code'=>Crypt::decrypt($request->input('coe_code')),
            'user_type'=>$request->input('user_type'),
            'user_type_id'=>$request->input('user_type_id')
        );
  
        $collection = DB::table('status_items as status_item')
            ->select(
                DB::raw("row_number() OVER (ORDER BY status_item.created_at DESC) as sorter"),
                'status_item.id',
                'status_item.status_item_code',
                'status_item.status_code',
                'status_item.user_type',
                'status_item.user_type_id',
                'status_item.remarks',
                'status_item.created_by',
                'status_item.changed_by',
                'status_item.created_at',
                'status_item.updated_at',
                'status.short_desc',
                'status.long_desc'
            )
            ->leftjoin('statuses as status','status.status_code','=','status_item.status_code')
            ->where('coe_code', $data['coe_code'])->orderBy('status_item.id', 'DESC');
        
        if($data['status_item_code']){
            $collection = $collection->where('status_item.status_item_code', $data['status_item_code']);
        }

        if($data['user_type']){
            $collection = $collection->where('status_item.user_type', $data['user_type']);
        }

        if($data['user_type_id']){
            $collection = $collection->where('status_item.user_type_id', $data['user_type_id']);
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
        // try{

            if(Auth::user()->is_admin==1){
            
                $status_item = new StatusItem;
                
                $status_item->coe_code                 = $fields['coe_code'];
                $status_item->status_code              = $fields['status_code'];
                $status_item->user_type                = $fields['user_type'];
                $status_item->user_type_id             = Auth::user()->email;
                $status_item->remarks                  = $fields['remarks'];
                $status_item->created_by               = Auth::user()->email;
                $status_item->changed_by               = Auth::user()->email;
                $status_item->save(); 

                $coe                = Coe::where('coe_code', $status_item->coe_code)->first();

                $employee           = Employee::select(DB::raw("CONCAT(rtrim(CONCAT(last_name,' ',COALESCE(affix,''))),', ', COALESCE(first_name,''),' ', COALESCE(middle_name,'')) as name"))
                                    ->where('employee_code', $coe->employee_code)->first();

                $type               = Type::select('type_desc')->where('type_code', $coe->coe_type)->first();
                $purpose            = Purpose::select('purpose_desc')->where('purpose_code', $coe->coe_purpose)->first();

                $status                = Status::where('status_code', $fields['status_code'])->first();

                $otherDetails['name']           = $employee->name;
                $otherDetails['type_desc']      = $type->type_desc;
                $otherDetails['purpose_desc']   = $purpose->purpose_desc;
                $otherDetails['remarks']        = $fields['remarks'];
                $otherDetails['updated_at']     = Carbon::now();
                $otherDetails['request_status'] = $status->short_desc;

                $this->sendReplyLink($coe, $otherDetails);

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

 
  
}
