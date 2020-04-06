<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\User; 
use App\Otp; 
use App\Coe; 
use App\Employee; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Adldap;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Str;
use Config;
use Session;

//Traits
use App\Traits\MailTrait;

class LoginController extends Controller {

    use MailTrait;

    public function login(Request $request){
        
        if(Config::get('defaults.default.is_local')==1){

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...  
                Session::put('key', Crypt::encrypt($request->password));
                return redirect('self-service/'.Crypt::encrypt(Auth::user()->email));
            }else{ 
                return redirect('login')->with('status', 'Incorrect username or password!');
            }

        }else{

            $ad = new \Adldap\Adldap();

            // Create a configuration array.
            $config = [  
            // An array of your LDAP hosts. You can use either
            // the host name or the IP address of your host.
            'hosts'    => ['10.30.16.109'],
            

            // The base distinguished name of your domain to perform searches upon.
            // 'base_dn'  => 'OU=administrators,DC=pldtgroup,DC=pldt,DC=net,DC=ph',
            'base_dn'  => '',

            // The account to use for querying / modifying LDAP records. This
            // does not need to be an admin account. This can also
            // be a full distinguished name of the user account.
            'username' => $request->email,
            'password' => $request->password,
            ];

            // Add a connection provider to Adldap.
            $ad->addProvider($config);

            try {
 
                //  If a successful connection is made to your server, the provider will be returned.
                $provider   = $ad->connect();
                Session::put('key', Crypt::encrypt($request->password));
                $user       = User::where('email', $request->email)->first();
                if(count($user)>0){
                    Auth::login($user);

                    // return Auth::user()->id;

                    // return User::all();

                    $this->setOtp($request->email);
                    return redirect('otp/'.Crypt::encrypt(Auth::user()->email));
                }
                else{
                    return redirect('login')->with('status', 'Access denied!');
                }
            } catch (\Adldap\Auth\BindException $e) {
                // echo "Invalid account";
                return redirect('login')->with('status', 'Login failed; Invalid email or password.');
                // There was an issue binding / connecting to the server.
            }
        }
    }

    public function logout(Request $request){
        return redirect('login')->with(Auth::logout());
    }

    public function setOtp($email){

        $fields['email'] = $email;

        $transaction = DB::transaction(function($field) use($fields){
        try{

                // $user = User::where('email', $fields['email'])->first();
                // $user->otp                  = Str::random(6);
                // $user->is_authenticated     = 0;
                // $user->changed_by           = Auth::user()->email;
                // $user->updated_at           = Carbon::now();
                // $user->save();

                // $this->sendOTP($user->otp);

                // return response()->json([
                //     'status' => 200,
                //     'data' => null,
                //     'message' => 'Successfully saved.'
                // ]);
                
                $is_exist = Otp::where('id', Auth::user()->id)->count();
                
                if($is_exist>0){
                    $Otp = Otp::where('id', Auth::user()->id)->first();
                }
                else{
                    $Otp = new Otp;
                    $Otp->id                   = Auth::user()->id;
                }

                $Otp->otp                  = Str::random(6);
                $Otp->is_authenticated     = 0;
                $Otp->changed_by           = Auth::user()->email;
                $Otp->updated_at           = Carbon::now(); 
                $Otp->save();

                $this->sendOTP($Otp->otp);

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
 
}
