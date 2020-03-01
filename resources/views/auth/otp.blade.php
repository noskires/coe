@extends('layouts.app')

@section('content')
<!-- login area start -->
<div class="login-area login-bg">
    <div class="container">
        <div class="login-box ptb--100" ng-controller="OtpCtrl as otpCtrl">
            <form class="form-horizontal" method="POST" action="auth1">
                {{ csrf_field() }}
                    
                    <div class="login-form-head">
                        <h4>One Time Passcode</h4>
                        <p>Please enter the One Time Pin (OTP) sent to your email by Payroll and Benefits Servicest</p>
                    </div> 
                    <br> 
                    <div class="login-form-body">
                    <h3 style="text-align:center; color:red;">
                        <timer ng-if="otpCtrl.remaining_time>0" countdown='otpCtrl.remaining_time' interval="1000" 
                        finish-callback="otpCtrl.myCallbackFunction()">
                        <span ng-bind="minutes"> </span> minute<span ng-bind="minutesS"></span> 
                        <span ng-bind="seconds"> </span> second<span ng-bind="secondsS"></span> 
                        </timer> 
                    </h3>
                   <br>
                   <br>

                    <div class="form-gp">
                        <label for="otp">One Time Passcode</label>
                        <input id="otp" type="text" class="form-control" name="otp" required>
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>

                    <br>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">VERIFY OTP <i class="ti-arrow-right"></i></button>
                    </div>
                  </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
