<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('storage/app/public/user/'.Auth::user()->image)}}">{{ Auth::user()->name }}<span class="fa fa-chevron-down"></span>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile') }}"> @lang('home.profile')</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('reset.password') }}"> @lang('home.password') @lang('home.change')</a>
                        <div class="dropdown-divider"></div>
                        <!--  <a class="dropdown-item" href="javascript:;">Help</a> -->
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out pull-right"></i> @lang('home.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>
               <!--  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Language<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('locale/en')}}">English</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/ar')}}">Arebic</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/ru')}}">Russian</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/fr')}}">French</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/es')}}">Spanish</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/de')}}">German</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/it')}}">Italian</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/pt')}}">Portuguese</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/tr')}}">Turkish</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/he')}}">Hebrew</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/zh')}}">Chinese</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/ja')}}">Japanese</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/ko')}}">Korean</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/id')}}">Indonesian</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/fa')}}">Persian (Farsi)</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/bn')}}">Bangla</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/hi')}}">Hindi</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/ur')}}">Urdu</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/pa')}}">Punjabi</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ url('locale/te')}}">Telugu</a></li>
                       
                      
                    </ul>
                </li> -->
                <li class="nav-item" style="padding-left: 15px;">
                    <input type="text" class="form-control" value="@lang('home.date'):{{ date('d-m-Y h:i:s') }}" disabled style="background-color: transparent;">
                </li>
            </ul>
        </nav>
    </div>
</div>