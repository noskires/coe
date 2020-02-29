<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;

trait MailTrait
{

    public function sendOTP($otp){
        // try{

            $fromEmail  = "paybenadmin@pldt.com.ph";
            $email      = [Auth::user()->email] ;
            $subject    = "Online COE - One Time Passcode";
            $messages   = "";
            $otp        = $otp;

            $data = array('email'=>$email,'messages'=>$messages,'fromEmail'=>$fromEmail,'subject'=>$subject,'otp'=>$otp);

            Mail::send('coe.mailer',$data, function ($message) use ($data) {
                
                $message->from($data['fromEmail'],'');
                $message->to($data['email']);
                $message->bcc(["ebsupnet@pldt.com.ph"], '');
                $message->subject($data['subject']);
                $message->replyTo($data['fromEmail'],'');

            });
            
        // }
        // catch (\Exception $e) 
        // {
        //     return "Sending failed!";
        // }
    }

    public function sendRequestLink($coe, $otherDetails){
        
        $fromEmail   = "paybenadmin@pldt.com.ph";
        $email       = [$coe->changed_by];
        $subject     = "Online COE - Request"; 
        $messages    = ""; 

        $data = array('email'=>$email,'messages'=>$messages,
            'fromEmail'=>$fromEmail,'subject'=>$subject,
            'name'=>$otherDetails['name'],
            'type_desc'=>$otherDetails['type_desc'],
            'purpose_desc'=>$otherDetails['purpose_desc'],
            'coe_code'=>$coe->coe_code,
            'created_at'=>$coe->created_at,
            'changed_by'=>$coe->changed_by,
            'changed_by'=>$coe->changed_by,
            'changed_by'=>$coe->changed_by,
            'changed_by'=>$coe->changed_by,
            'remarks'=>$otherDetails['remarks'],
        );
        
        Mail::send('coe.mailer2',$data, function ($message) use ($data) {
            
            $message->from($data['fromEmail'],'');
            $message->to($data['email']);
            $message->cc([Auth::user()->email], '');
            $message->bcc(["ebsupnet@pldt.com.ph"], '');
            $message->subject($data['subject']);
            $message->replyTo($data['fromEmail'], '');

        });
    }

    public function sendReplyLink($coe, $otherDetails){
        
        $fromEmail   = "paybenadmin@pldt.com.ph";
        $email       = [$coe->changed_by];
        $subject     = "Online COE - Request"; 
        $messages    = ""; 

        $data = array(
            'email'=>$email,
            'messages'=>$messages,
            'fromEmail'=>$fromEmail,
            'subject'=>$subject,
            'name'=>$otherDetails['name'],
            'type_desc'=>$otherDetails['type_desc'],
            'purpose_desc'=>$otherDetails['purpose_desc'],
            'coe_code'=>$coe->coe_code,
            'created_by'=>$coe->created_by,
            'created_at'=>$coe->created_at,
            'updated_at'=>$otherDetails['updated_at'],
            'changed_by'=>$coe->changed_by,
            'remarks'=>$otherDetails['remarks'],
            'request_status'=>$otherDetails['request_status'],
        );
        
        Mail::send('coe.mailer3',$data, function ($message) use ($data) {
            
            $message->from($data['fromEmail'],'');
            $message->to($data['created_by']);
            $message->cc([Auth::user()->email], '');
            $message->bcc(["ebsupnet@pldt.com.ph"], '');
            $message->subject($data['subject']);
            $message->replyTo($data['fromEmail'], '');

        });
    }

    public function getFulfiller(){
        $name = ['EBSUPNET@PLDT.COM.PH'];
        // $name = ['EBSUPNET@PLDT.COM.PH', 'FCSISON@PLDT.COM.PH' , 'GHLAURA@PLDT.COM.PH'];
        return $name[array_rand($name)];
    }
}