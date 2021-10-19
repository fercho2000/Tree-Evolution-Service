<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
        | ERTreeServices
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- global css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animated-masonry-gallery.css')}}" />

    <!-- datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/bootstrap.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/responsive.bootstrap4.min.css')}}">


    {{-- Links modal --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/hover/css/hover-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/advanced_modals.css')}}">

    {{-- Links select 2 --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}">


    <!-- sweet alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert2/css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/sweet_alert2.css')}}">

    <!--end of page level css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animated-masonry-gallery.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/gridforms/css/gridforms.css')}}">

    <!-- Links input File -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-fileinput/css/fileinput.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">


    {{-- Links Buttons --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/buttons_sass1.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/advbuttons.css')}}">

    <!-- toastr notifications -->
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <script type="text/javascript" src="{{asset('assets/js/custom_js/advanced_modals.js')}}"></script>

    <!-- icono de pestaña -->
    <link rel="shortcut icon" href="{{asset('assets/img/login/logoArbolERTreeServices.png')}}" />

    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <!--[endif]-->



    <!-- Iconos -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/fontawesome/css/all.min.css')}}" />

    <!-- jquery link -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">

    {{-- data picker fechas --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/daterangepicker/css/daterangepicker.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datedropper/datedropper.css')}}">
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/timedropper/css/timedropper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/jquerydaterangepicker/css/daterangepicker.min.css')}}">
    <!--clock face css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/clockpicker/css/bootstrap-clockpicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datepicker.css')}}">
    <!--end of page level css-->

    @yield('header_styles')
    <!-- end of global css -->
</head>

<body class="skin-coreplus">
    <div class="preloader">
        <div class="loader_img"><img src="{{asset('assets/img/loading/carga1.gif')}}" alt="loading..." height="200" width="200"></div>
    </div>
    <!-- header logo: style can be found in header-->
    <header class="header">
        <nav class="navbar navbar-expand-md navbar-static-top">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa fa-fw fa-bars"></i> </a>
            </div>


            <div class="navbar-collapse " id="navbarNav">
                <div class="navbar-right ml-auto">
                    <ul class="nav navbar-nav ">
                        {{-- <li class="nav-item dropdown messages-menu">
                    <a href="#" class="nav-link dropdown-toggle"> <i
                                class="fa fa-fw fa-envelope-o black"></i>
                        <span class="label bg-success">2</span>
                    </a> --}}
                        {{-- <ul class="dropdown-menu dropdown-messages table-striped">
                        <li class="dropdown-title">New Messages</li>
                        <li class="msg-set message striped-col">
                            <a href="" class="">
                                <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar7.jpg')}}"
                        alt="avatar-image"> --}}

                        {{-- <div class="message-body"><strong>Ernest Kerry</strong>
                                    <br>
                                    Can we Meet?
                                    <br>
                                    <small>Just Now</small>
                                    <span class="label bg-success label-mini msg-lable">New</span>
                                </div> --}}
                        {{-- </a>
                        </li> --}}
                        {{-- <li class="msg-set message">
                            <a href="" class="">
                                <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar6.jpg')}}"
                        alt="avatar-image">

                        <div class="message-body"><strong>John</strong>
                            <br>
                            Dont forgot to call...
                            <br>
                            <small>5 minutes ago</small>
                            <span class="label bg-success label-mini msg-lable">New</span>
                        </div>
                        </a>
                        </li> --}}
                        {{-- <li class="msg-set message striped-col">
                            <a href="" class="">
                                <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar5.jpg')}}"
                        alt="avatar-image">

                        <div class="message-body">
                            <strong>Wilton Zeph</strong>
                            <br>
                            If there is anything else &hellip;
                            <br>
                            <small>14/10/2014 1:31 pm</small>
                        </div>

                        </a>
                        </li> --}}
                        {{-- <li class="msg-set message">
                            <a href="" class="">
                                <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar1.jpg')}}"
                        alt="avatar-image">
                        <div class="message-body">
                            <strong>Jenny Kerry</strong>
                            <br>
                            Let me know when you free
                            <br>
                            <small>5 days ago</small>
                        </div>
                        </a>
                        </li> --}}
                        {{-- <li class="msg-set message striped-col">
                            <a href="" class="">
                                <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar.jpg')}}"
                        alt="avatar-image">
                        <div class="message-body">
                            <strong>Tony</strong>
                            <br>
                            Let me know when you free
                            <br>
                            <small>5 days ago</small>
                        </div>
                        </a>
                        </li> --}}
                        {{-- <li class="dropdown-footer"><a href="#">View All messages</a></li> --}}
                        {{-- </ul> --}}

                        </li>

                        <!-- Notifications: style can be found in dropdown-->
                        <li class="nav-item dropdown notifications-menu">
                            <a href="#" class="nav-link dropdown-toggle">
                                <i class="fa fa-bells" style="color:aliceblue;"></i>

                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="dropdown-title">You have 8 notifications</li>

                                <li class="message striped-col">
                                    <a href="" class=" icon-not">
                                        <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar3.jpg')}}" alt="avatar-image">

                                        <div class="message-body">
                                            <strong>John Doe</strong>
                                            <br>
                                            5 members joined today
                                            <br>
                                            <span class="noti-date">Just now</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="message">
                                    <a href="" class=" icon-not">
                                        <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar.jpg')}}" alt="avatar-image">
                                        <div class="message-body">
                                            <strong>Tony</strong>
                                            <br>
                                            likes a photo of you
                                            <br>
                                            <span class="noti-date">5 min</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="message striped-col">
                                    <a href="" class=" icon-not">
                                        <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar6.jpg')}}" alt="avatar-image">

                                        <div class="message-body">
                                            <strong>John</strong>
                                            <br>
                                            Dont forgot to call...
                                            <br>
                                            <span class="noti-date">11 min</span>

                                        </div>
                                    </a>
                                </li>
                                <li class="message">
                                    <a href="" class=" icon-not">
                                        <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar1.jpg')}}" alt="avatar-image">
                                        <div class="message-body">
                                            <strong>Jenny Kerry</strong>
                                            <br>
                                            Very long description here...
                                            <br>
                                            <span class="noti-date">1 Hour</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="message striped-col">
                                    <a href="" class=" icon-not ">
                                        <img class="message-image rounded-circle" src="{{asset('assets/img/authors/avatar7.jpg')}}" alt="avatar-image">

                                        <div class="message-body">
                                            <strong>Ernest Kerry</strong>
                                            <br>
                                            2 members joined today
                                            <br>
                                            <span class="noti-date">3 Days</span>

                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-footer"><a href="#"> View All Notifications</a></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown-->
                        <li class="nav-item dropdown user user-menu">
                            <a href="#" class="nav-link dropdown-toggle padding-user pt-3">
                                <img src="{{asset('assets/img/authors/avatar1.jpg')}}" width="35" class="rounded-circle img-fluid pull-left" height="35" alt="User Image">
                                <div class="riot">
                                    <div>
                                        {{ Auth::user()->name }}
                                        <span>
                                            <i class="fa fa-caret-down"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{asset('assets/img/authors/avatar1.jpg')}}" class="rounded-circle" alt="User Image">
                                    <p> {{ Auth::user()->name }}</p>
                                </li>
                                <!-- Menu Body -->
                                <li class="p-t-3 nav-item"><a href="{{Url('/user_profile')}}" class="nav-link">
                                        <i class="fa fa-fw fa-user"></i>
                                        My Profile </a>
                                </li>
                                <li role="presentation "></li>
                                <li class="nav-item"><a href="{{ route('config.index') }}" class="nav-link"> <span><i class="fa fa-fw fa-gear"></i> Account Settings</span>
                                    </a></li>
                                <li role="presentation" class="dropdown-divider"></li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    {{-- <div class="pull-left">
                                <a href="{{ URL :: to('lockscreen') }} ">
                                    <i class="fa fa-fw fa-lock"></i>
                                    Lock
                                    </a>
                </div> --}}
                <div class="pull-right">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-sign-out"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                </li>
                </ul>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <!-- For horizontal menu -->
    @yield('horizontal_header')
    <!-- horizontal menu ends -->
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar-->
            <section class="sidebar">
                <div id="menu" role="navigation">
                    <div class="nav_profile">
                        <div class="media profile-left">
                            <a class="pull-left profile-thumb" href="#">
                                <img src="{{asset('assets/img/authors/avatar1.jpg')}}" class="rounded-circle" alt="User Image">
                            </a>
                            <div class="content-profile pl-3">
                                <h4 class="media-heading">
                                    {{ Auth::user()->name }}
                                </h4>
                                <ul class="icon-list list-inline">
                                    <li>
                                        <a href="{{Url('/user_profile')}}">
                                            <i class="fa fa-fw fa-user"></i>
                                        </a>
                                    </li>
                                    <li>                                    
                                        <a href="{{ route('config.index') }} ">
                                            <i class="fa fa-fw fa-gear"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-sign-out"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Comienzo de toda la Navegaciòn --}}
                    <ul class="navigation">

                        <li {!! (Request::is('index2')? 'class="active"' :"") !!}>
                            <a href="{{ URL::to('index2') }} ">
                                <i class="fas fa-home-lg"></i>
                                <span class="mm-text ">Home</span>
                            </a>
                        </li>

                        {{-- Navegacion de usuarios --}}
                        
                        <li {!! (Request::is('users')|| Request::is('roles')? 'class="active"' :"")!!}>
                            <a href="#"> <i class="fas fa-users"></i>
                                <span>Manage Users</span>
                                <span class="fa arrow">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('users')? 'class="active"' :"") !!}>
                                    <a href="{{route('users.index')}} ">
                                        <i class="fas fa-users-medical"></i> Users
                                    </a>
                                </li>
                                <li {!! (Request::is('roles')? 'class="active"' :"") !!}>
                                    <a href="{{route('roles.index')}} ">
                                        <i class="fa fa-fw fa-database"></i> Roles
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Navegacion de empleados --}}
                        <li {!! ( Request::is('empleado') || Request::is('cargo') || Request::is('ciudad') ? 'class="active"' :"") !!}>
                            <a href="#">
                                <i class="fa fa-fw fa-briefcase"></i>
                                <span>Employees</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('empleado') ? 'class="active"' : '' ) !!}>
                                    <a href="{{ URL::to('empleado') }}">
                                        <i class="fas fa-user-hard-hat"></i>
                                        Employees
                                    </a>
                                </li>
                                <li {!! (Request::is('cargo') ? 'class="active"' : '' ) !!}>
                                    <a href="{{ URL::to('cargo') }}">
                                        <i class="far fa-user-tag"></i>
                                        Charges
                                    </a>
                                </li>

                                <li {!! (Request::is('ciudad') ? 'class="active"' : '' ) !!}>
                                    <a href="{{ URL::to('ciudad') }}">
                                        <i class="far fa-city"></i>
                                        Cities
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Navegacion de implementos --}}
                        <li {!! (Request::is('implemento') || Request::is('categoria') || Request::is('novedadimplemento') || Request::is('kit') ? 'class="active"' :"") !!}>
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span class="mm-text ">Work Tools</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('implemento') ? 'class="active"' : '' ) !!}>
                                    <a href="{{route('implemento')}}">
                                        <i class="fas fa-tools"></i> Implements
                                    </a>
                                </li>
                                <li {!! (Request::is('categoria') ? 'class="active"' : '' ) !!}>
                                    <a href="{{ route('categoria')}}">
                                        <i class="fa fa-fw fa-list-ul"></i> Categories
                                    </a>
                                </li>
                                <li {!! (Request::is('novedadimplemento') ? 'class="active"' : '' ) !!}>
                                    <a href="{{ route('novedadimplemento')}}">
                                        <i class="fas fa-comment-alt-exclamation"></i> 
                                        News Attachments
                                    </a>
                                </li>
                                <li {!! (Request::is('kit') ? 'class="active"' : '' ) !!}>
                                    <a href="{{ route('kit')}}">
                                        <i class="fas fa-box-full"></i> Kits
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li {!! (Request::is('ordenservicio/crear') || Request::is('ordenservicio') || Request::is('programacion') || Request::is('tiposervicio') || Request::is('servicio') || Request::is('estados') || Request::is('clientes') || Request::is('visita') ? 'class="active"' :"") !!}>
                            <a href="#">
                                <i class="fas fa-trees"></i>
                                {{-- Parte modulo de todos los formulario --}}
                                <span>Service Orders</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                        <li {!! (Request::is('ordenservicio') ? 'class="active"' : '' ) !!}>
                            <a href="{{ URL('/ordenservicio') }}">
                                <i class="fa fa-shovel"></i> Service orders
                            </a>
                        </li>
                        {{-- programacion route --}}
                        <li {!! (Request::is('programacion') ? 'class="active"' : '' ) !!}>
                            <a href="{{ URL('/programacion') }}">
                                <i class="fa fa-table"></i> Programming
                            </a>
                        </li>
                        <li {!! (Request::is('tiposervicio') ? 'class="active"' : '' ) !!}>
                            <a href="{{ URL('/tiposervicio') }}">
                                <i class="fa fa-fw fa-fire"></i> Type of service
                            </a>
                        </li>
                        {{-- <li {!! (Request::is('form_editors') ? 'class="active"' : '') !!}> --}}
                        <li {!! (Request::is('servicio') ? 'class="active"' : '' ) !!}>
                            <a href="{{ URL('/servicio') }}">
                                <i class="far fa-concierge-bell"></i> Services
                            </a>
                        </li>
                        <li {!! (Request::is('clientes') ? 'class="active"' : '' ) !!}>
                            <a href="{{ URL('/clientes') }}">
                                <i class="fa fa-users"></i> Customers
                            </a>
                        </li>
                        <li {!! (Request::is('visita') ? 'class="active"' : '' ) !!}>
                            <a href="{{route('visita')}}">
                                <i class="fa fa-fw fa-calendar"></i>Visits
                            </a>
                        </li>

                    </ul>
                    </li>

                </div>
                <!-- menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        <aside class="right-side">
            <!-- Content -->
            @yield('content')
        </aside>

    </div>

    <!-- global js -->
    <script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>

    <script type="text/javascript" src="{{asset('assets/js/jquery.isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/animated-masonry-gallery.js')}}"></script>
    <!-- datatables -->
    <!-- <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery-3.3.1.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/funcion.js')}}"></script>



    {{-- Scripts file inputs --}}
    <script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/theme.js')}}"> </script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/form_elements.js')}}"></script>

    <!-- toast -->
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- sweet alert -->
    <script type="text/javascript" src="{{asset('assets/vendors/sweetalert2/js/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/sweetalert.js')}}"></script>

    <!-- select2 -->
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/selectize/js/standalone/selectize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/selectric/js/jquery.selectric.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/custom_elements.js')}}"></script>
    <!-- script inputs -->
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/theme.js')}}"> </script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/form_elements.js')}}"></script>

    {{-- Scripts para fechas  --}}
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datedropper/datedropper.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/timedropper/js/timedropper.js')}}"></script>
    <!-- bootstrap time picker -->
    <script type="text/javascript" src="{{asset('assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/jquerydaterangepicker/js/jquery.daterangepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/datepickers.js')}}"></script>



    <!-- begining of page level js -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>--}}





    {{-- Script de  fechas se deja aca por inconvenientes --}}
    <script type="text/javascript" src="{{asset('assets/js/custom_js/datepickers.js')}}"></script>

    @yield('footer_scripts')
    @yield('script')

</body>

</html>