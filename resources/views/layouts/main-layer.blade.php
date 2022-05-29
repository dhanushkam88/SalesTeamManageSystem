<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Sales - @yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" >
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    @yield('custom_css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-center">My Team</h3>
            </div>
            <ul class="list-unstyled components">
                @hasrole('admin|manager')
                    <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                    </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        User Management
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ route('user.index') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Create User</a>
                        </li>
                        <li>
                            <a href="{{ route('user.show',['user' => Auth::user()->id]) }}"><i class="fa fa-user-times" aria-hidden="true"></i> Edit / Delete User</a>
                        </li>
                        <li>
                            <a href="{{ route('import-view') }}"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Users</a>
                        </li>
                    </ul>
                </li>
                @endhasrole
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="logout">
                        @csrf
                        <a href="#" type="submit" onclick="document.getElementById('logout').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid d-flex justify-content-end">
                    <button class="btn btn-dark d-inline-block d-lg-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary" data-toggle="dropdown" data-display="static" aria-expanded="false">
                            <img src="https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" width="20" class="circle" /> {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile.show') }}" class="dropdown-item" type="button"> {{ __('Profile') }}</a>
                        </div>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}</span>
            </div>
        </div>
    </footer>
      <!-- End of Footer -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('custom_js')
</body>
</html>
