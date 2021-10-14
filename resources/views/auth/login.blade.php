<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets/img/login/logoArbolERTreeServices.png')}}"/>
    <!-- Bootstrap -->


    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}"/>

    <!-- styles -->
    <!--page level css -->
    <link href="{{asset('assets/css/lockscreen2.css')}}" rel="stylesheet">
    <!--end page level css-->

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <script>
        function validation(){
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.exec(email)){
                setTimeout(() => {
                    toastr.error('You must write a valid email.','error');
                }, 500);
                return false;
            }else if(password == null || password.length == 0 || /^\s+$/.test(password) ){
                setTimeout(() => {
                    toastr.error('The password field should not be empty or filled only with blank spaces.');
                }, 800);
                return false;
            }                   
        }    
    </script>
</head>

<body class="clase">
<div class="preloader">
    <div class="loader_img"><img src="{{asset('assets/img/loading/carga1.gif')}}" alt="loading..." height="250" width="250"></div>
</div>
<div class="container" style="margin-top: 50px !important;">
    <div class="row">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 mx-auto">
            <div class="lockscreen-container">
                <div class="user-name">
                    <h4 class="text-center"> {{ __('Login') }}</h4>
                </div>
                <div class="logo"></div>
                <div class="form-box">
                    <form method="POST" action="{{ route('login') }}" onsubmit="return validation()">
                    @csrf
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">                            
                            <h4>
                                <label for="email" class="">{{ __('E-Mail Address') }}</label>
                            </h4>
                            <input id="email" type="email" placeholder="Email Address"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            name="email" value="{{ old('email') }}" autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h4>
                                <label for="password" class="">{{ __('Password') }}</label>
                            </h4>
                            <input id="password" type="password" placeholder="Password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                            name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label>
                                <input type="checkbox" name="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>                            
                            
                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">                            
                            <button class="btn btn-outline-info login col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9" style="border-width: 2px; border-radius: 0 0 15px 15px; font-weight: bold;" id="index" type="submit">
                                {{ __('Login') }}
                            </button>
                        </div>                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>


<!-- end of global js -->
<!-- page css -->
<!-- end of page css -->
</body>

</html>