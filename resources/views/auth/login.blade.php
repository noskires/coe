@extends('layouts.app')

@section('content')
<!-- login area start -->
<div class="login-area login-bg">
    <div class="container">
        <div class="login-box ptb--100">
            <form class="form-horizontal" method="POST" action="auth1">
                {{ csrf_field() }}
 
                <div class="login-form-head">
                    <h4>Sign In</h4>
                    <p>Hello there, Sign in and start managing <br> your Certificate of Employment</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email address</label> 
                        <input id="email" type="email" class="form-control" name="email" autocomplete="off" value="{{ old('email') }}" required autofocus>
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="row mb-12 rmber-area">
                        @if (session('status')!='')
                            <div class="" style="text-align:center; color:#8655FC;">
                            <h5> {{ session('status') }} </h5>
                            </div>
                        @endif 
                    </div>
                    <br>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
