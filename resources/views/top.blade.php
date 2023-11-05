@php @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Łukasz Jezapkowicz">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?php echo $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::to('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <?php foreach ($links as $link): ?>
    <link href="{{ URL::to('css', $link) }}" rel="stylesheet">
    <?php endforeach; ?>

    <link rel="stylesheet" media="print" href="{{ URL::to('css/print.css') }}"/> <!-- printable -->
    @laravelViewsStyles(laravel-views,livewire)
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div class="no-print" id="wrapper">

    <!-- Sidebar -->
    <ul class="non-printable navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            @guest
                <div class="sidebar-brand-text mx-3">Timeline Manager</div>
            @endguest
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        @auth
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('addEventView') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>New Timeline Event</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('addCategoryView') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>New Category</span></a>
        </li>
        @endauth

        <!-- Divider -->
        <hr class="sidebar-divider">

        @auth
            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                   aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Auth Pages:</h6>
                        <a class="collapse-item" href="{{route('login')}}">Login</a>
                        <a class="collapse-item" href="{{route('register')}}">Register</a>
                        <a class="collapse-item" href="{{route('change')}}">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="{{route('dashboard')}}">Dashboard</a>
                        <a class="collapse-item" href="{{route('profile')}}">Profile</a>
                        <a class="collapse-item" href="{{route('settings')}}">Settings</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                   aria-expanded="true" aria-controls="collapsePages2">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Tables</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('users')}}">Users</a>
                        <a class="collapse-item" href="{{route('categories')}}">Categories</a>
                        <a class="collapse-item" href="{{route('timelineEvents')}}">Timeline Events</a>
                        <a class="collapse-item" href="{{route('timelineEventCategories')}}">Timeline Events
                            Categories</a>
                        <a class="collapse-item" href="{{route('userSettings')}}">User Settings</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        @endauth

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        @guest
            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{ URL::to('images/undraw_rocket.svg') }}" alt="...">
                <p class="text-center mb-2"><strong>Timeline Manager</strong> is packed with premium features,
                    components, and
                    more!</p>
                <a class="btn btn-success btn-sm" href="{{route('login')}}">Sign up!</a>
            </div>
        @endguest
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="non-printable navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <button type="button" class="btn btn-primary <?php if (!$is_dashboard) {
                    echo 'd-none';
                } ?>" data-toggle="modal" data-target="#filterModal">
                    Filter
                </button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <?php $upcomingEvents = \App\Http\Controllers\TimelineEventController::upcomingEventList(); ?>
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter"><?= count($upcomingEvents) ?></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <?php foreach ($upcomingEvents as $key => $event): ?>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div
                                        class="small text-gray-500"><?= date('j F Y', strtotime($event['event']->start_date)) ?></div>
                                    <span class="font-weight-bold whitespace-no-wrap">'<?= $event['event']->title ?>' is releasing soon!. Get your ticket here!</span>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    @auth
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= auth()->user()->name ?></span>
                                <img class="img-profile rounded-circle"
                                     onerror="this.onerror=null; this.src='{{ URL::to('images/undraw_profile.svg') }}'"
                                     src="{{asset('storage/' . $user->avatar)}}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{route('settings')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    @endauth
                    @guest
                        <div class="container">
                            <a class="btn btn-success btn-sm" href="{{route('login')}}">
                                <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Login
                            </a>
                        </div>
                    @endguest

                </ul>

            </nav>
            <!-- End of Topbar -->
