<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UI Online Clearance System</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            margin: 0;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-image: url({{asset('image/uniibadan.jpg')}})
        }
    </style>
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{asset('image/ui-brand.jpg')}}" alt="University of Ibadan" style="height: 50px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth('admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="nav-bar-prospects-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-th-list theme-color"></i> Prospects <sup class="badge badge-secondary">{{\App\Prospect::all()->count()}}</sup>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="nav-bar-categories-dropdown" >
                                <a class="dropdown-item theme-color" href="{{ route('admin.prospects.import.initiate') }}"><i class="fa fa-plus"></i> Import prospects</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item theme-color" href="{{ route('admin.prospects') }}"><i class="fa fa-plus"></i> All prospects</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="nav-bar-prospects-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-th-list theme-color"></i> Clearance stages <sup class="badge badge-secondary">{{\App\ClearanceStage::all()->count()}}</sup>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="nav-bar-categories-dropdown" >
                                <a class="dropdown-item theme-color" href="{{ route('admin.clearance.stage.create') }}"><i class="fa fa-plus"></i> New clearance stage</a>
                                <div class="dropdown-divider"></div>
                                @foreach (\App\ClearanceStage::all() as $stage)
                                    <div class="dropdown-item theme-color" >
                                        <a href="{{ route('clearance.stage.show', $stage->id) }}">{{$stage->name}}</a>
                                       <div>
                                           <small>{{$stage->requirements->count()}} requirements</small>
                                       </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                                <a class="dropdown-item theme-color" href="{{ route('admin.clearance.stages') }}"><i class="fa fa-plus"></i> All clearance stages</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="nav-bar-prospects-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-th-list theme-color"></i> Forms <sup class="badge badge-secondary">{{\App\Form::all()->count()}}</sup>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="nav-bar-categories-dropdown" >
                                <a class="dropdown-item theme-color" href="{{ route('admin.form.create') }}"><i class="fa fa-plus"></i> New form</a>
                                <div class="dropdown-divider"></div>
                                @foreach (\App\Form::all() as $form)
                                    <div class="dropdown-item theme-color" >
                                        <a href="{{ route('form.show', $form->id) }}">{{$form->name}}</a>
                                       <div>
                                           <small>{{$form->form_fields->count()}} fields</small>
                                       </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                                <a class="dropdown-item theme-color" href="{{ route('admin.forms') }}"><i class="fa fa-plus"></i> All forms</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.clearances') }}">Clearances</a>
                        </li>

                        @endauth

                        @auth('web')

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth('web')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{Auth::guard('web')->user()->avatar}}" alt="{{Auth::guard('web')->user()->matric}}'s passport" style="width: 40px; height: 40px; border-radius: 50%"> {{ Auth::guard('web')->user()->matric }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('student.index')}}">My clearance</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Clearance login</a>
                            </li>
                        @endauth

                        @auth('admin')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>

        <main style="padding-top: 80px">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/image-preview.js')}}"></script>
    @yield('bottom-scripts')
        
</body>
</html>
