<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .bkg-animated {
            background: gray url({{ URL::asset('images/capture2.png') }}) repeat 0 0;
            box-sizing: border-box;
            -webkit-animation: slide 20s linear infinite;
        }

        @-webkit-keyframes slide {
            from { background-position: 0 0; }
            to { background-position: -400px 0; }
        }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>inscription</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/jquery.min.js') }}" defer></script> -->
    <script src="{{ asset('js/app.js') }}" ></script>
    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="" >
    <div class="container mt-5">
        <div class="row">                
           <div class="iconmelon">
            	<br><br><br>
              <img src="{{ asset('images/argent2.png' )}}">
            </div>
        </div>
        <div class="row justify-content-center" style= "background-color: transparent;">
            <div class="col-md-8">
                <div class="card" style= "background-color: transparent;">
                    <div class="card-header"><h3 class = "justify-content-center">{{ __('Connexion') }}</h3></div>

                    <div class="card-body" style = "background-color: rgba(2555,255,255,.3);">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>


                                <div class="col-md-6">
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->


                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="particles"></div>
    <script src="{{ asset('js/login.js') }}" ></script>

</body>
</html>
