<?php $company = \App\Models\Company::where('id', 1)->first(); ?>
<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="{{app()->getLocale()}}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This Is First Project with Laravel">
    <title>{{ $company->name }} </title>
    @include('partials.styles')
    @include('partials.scripts')
</head>

<body class="nav-md">
    <div class="container-box body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a class="navbar-brand" href="{{route('home')}}"><span class="header-title-A"><b>Invoice Make</b></a>
                        <!--   <a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('images/logo/logo.png') }}" width="170" height="50" alt=""></a> -->
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{asset('storage/app/public/user/'.Auth::user()->image)}}" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>@lang('home.welcome'),</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    @include('partials.sidebar')
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    @include('partials.footerbutton')
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            @include('partials.TopNavigation')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main" style="background-color:#fff;">

                <div class="clearfix"></div>
                <!--   @include('partials.shortcutMenu') -->
                @yield('content')

            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                @include('partials.footer')
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script src="{{asset('assets/js/custom/custom.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
</body>

</html>