<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\User; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Adldap;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Str;


class OtpController extends Controller {

    public function samp(){
        return view('auth.otp');
    }
 
    public function index(Request $request, $id){
        
        try {
            if(Crypt::decrypt($id)!=Auth::user()->email){
                return "You are not authorized to view this!";
            }else{
                return view('auth.otp');
            }
        } catch (DecryptException $e) {
            return "You are not allowed to do asdfthat. You are being monitored!";
        }
    }

    public function verify(Request $request){
         
        $user = User::where('email', Auth::user()->email)
        ->where('otp', $request->otp)->first();
        

        if(count($user)>0){
            $user->is_authenticated = 1;
            $user->save();
            return redirect('self-service/'.Crypt::encrypt(Auth::user()->email));
        }else{
            return redirect('otp/'.Crypt::encrypt(Auth::user()->email))->with('status', 'INCORRECT ONE TIME PASSCODE!');
        }

    }

    public function sampleRandom(){
        return Str::random(6);
    }
 
}
