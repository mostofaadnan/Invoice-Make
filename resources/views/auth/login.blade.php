<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yinka Enoch Adedokun">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .main-content {
            width: 50%;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            margin: 5em auto;
            display: flex;
        }

        .company__info {
            background-color: #008080;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }

        .fa-android {
            font-size: 3em;
        }

        @media screen and (max-width: 640px) {
            .main-content {
                width: 90%;
            }

            .company__info {
                display: none;
            }

            .login_form {
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
            }
        }

        @media screen and (min-width: 642px) and (max-width:800px) {
            .main-content {
                width: 70%;
            }
        }

        .container-fluid>h2 {
            color: #008080;

        }

        .login_form {
            background-color: #fff;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            /*   border-top: 1px solid #ccc; */
            border-right: 1px solid #ccc;
        }

        form {
            padding: 0 2em;
        }

        .form__input {
            width: 100%;
            border: 0px solid transparent;
            border-radius: 0;
            border-bottom: 1px solid #aaa;
            padding: 1em .5em .5em;
            padding-left: 2em;
            outline: none;
            margin: 1.5em auto;
            transition: all .5s ease;
        }

        .form__input:focus {
            border-bottom-color: #008080;
            box-shadow: 0 0 5px rgba(0, 80, 80, .4);
            border-radius: 4px;
        }

        .btn {
            margin: auto;
            transition: all .5s ease;
            width: 70%;
            border-radius: 30px;
            color: #008080;
            font-weight: 600;
            background-color: #fff;
            border: 1px solid #008080;

        }

        .btn:hover,
        .btn:focus {
            background-color: #008080;
            color: #fff;
        }

        .form-group {
            width: 100%;

        }

        .remember-box {
            margin-top: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <h2>Invoice Make</h2>
                </span>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <h2>@lang('home.login')</h2>
                    <div class="row">
                        <form class="form-group" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <input id="email" type="email" class="form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="@lang('home.email')" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <input id="password" type="password" class="form__input @error('password') is-invalid @enderror" name="password" required placeholder="@lang('home.password')" autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                           @lang('home.remember')
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <button type="submit" class="btn btn-primary">
                                @lang('home.login')
                                </button>
                            </div>
                            <div class="row">
                                @if (Route::has('password.request'))
                                <a class="btn-link" href="{{ route('password.request') }}">
                                   @lang('home.Forgot_Your_Password')
                                </a>
                                @endif
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>