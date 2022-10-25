@extends('user_master')
@section('user_content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Register</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                @if (Session::has('register_status'))
                <div class="alert alert-success" style="text-align: center">{{ Session::get('register_status') }}</div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger" style="text-align: center">
                    @foreach ($errors->all() as $err)
                    {{ $err }}
                    <br>
                    @endforeach
                </div>
                @endif
                <div class="register-form">

                    <h2>Register</h2>
                    <form action="{{route('dang-ky')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="group-input">
                            <label for="username">Username *</label>
                            <input class="form-control" name="name" required="true">
                        </div>
                        <div class="group-input">
                            <label for="username">Email address *</label>
                            <input type="email" class="form-control" name="email" required="true">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input type="password" class="form-control" name="password" required="true">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Confirm Password *</label>
                            <input type="password" name="re_password" id="re_password" required="true">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Address *</label>
                            <input id="con-pass" name="address" required="true">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Phone *</label>
                            <input id="con-pass" name="phone" required="true">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Gender *</label>
                        </div>
                        <label class="lbsRadio">
                            <input type="radio" name="rd_gioitinh" value="male" checked> Male</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="lbsRadio">
                            <input type="radio" name="rd_gioitinh" value="female"> Female</label>
                        <button type="submit" class="site-btn register-btn">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="./login" class="or-login">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

@endsection
