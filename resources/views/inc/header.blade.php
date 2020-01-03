<style>
    .modal.left .modal-dialog {
        position:fixed;
        top:0;
        left:0;
        margin: 0;
        width: 80% !important;
        height: 100%;
        padding: 0 !important;

        z-index: 1000;

    }


    .modal.left .modal-content {
        height: 100%; !important;
        border:0; !important;
        border-radius: 0;
        transform: translateX(-100%);
        -webkit-transform: translateX(-100%);
    }

    .modal-header {
        height: 60px;
        width: 100%;
        border-radius: 0;
        background: lightblue;

    }

    .slide-in {
        animation: slide-in 0.5s forwards;
        -webkit-animation: slide-in 0.5s forwards;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 5px;
        border-radius: 15px;
        background-color: white;

        z-index: 1000;
    }

    @keyframes slide-in {
        100% { transform: translateX(0%); }
    }

    @-webkit-keyframes slide-in {
        100% { -webkit-transform: translateX(0%); }
    }


    #my-header {
        z-index: 50 !important;
    }

    #my-searchbar input{
        background-color: rgba(173, 216, 230, 0.41);
        border-color: rgba(173, 216, 230, 0.6);
    }

</style>

<header id="my-header" class="container-fluid bg-light pb-2 mx-0 px-0 sticky-top shadow-sm">
    <!-- navbar -->
    <nav id="my-navbar" class="navbar navbar-expand-lg navbar-light bg-light container-fluid p-0 m-0 align-items-center">

        <!-- Logo -->
        <div class="navbar pl-0 ml-2 justify-content-start pull-left">
            <button class="btn border-0 mx-0 navbar-toggler"  onclick="document.getElementById('sidebar-left').style.display='block'">
                <i id="nav-toggle" class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand ml-0 ml-md-2 text-monospace" href="/"><b>Thriftly</b></a>

            <!-- sidebar -->
            <div id="sidebar-left" class="modal left mr-0 pt-0">
                <div class="modal-dialog">
                    <div class="modal-content slide-in">
                        <div class="modal-header mx-0 p-0 align-items-center">
                            <h5 class="container-fluid d-flex justify-content-center modal-title">
                                @guest
                                    <b>Hi</b>, please<a href="/login" class="text-dark text-monospace mx-1"><b> Log In </b></a>
                                    or<a href="register" class="text-dark text-monospace mx-1"><b> Register </b></a>
                                @else
                                    <b>Hi</b>, <b class="text-dark text-monospace mx-1">Enjoy shopping here</b>
                                @endauth
                            </h5>
                        </div>

                        <div class="modal-body">
                            <!-- Products -->
                            <nav class="navbar my-0 py-0">
                                <a class="navbar-brand">Product Categories</a>
                                <button data-toggle="collapse" data-target="#sidebar-product" class="btn p-0 m-0 mb-1">
                                    <i class="fas fa-sort-down fa-2x"></i>
                                </button>

                                <div class="collapse navbar-collapse" id="sidebar-product">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item mx-2 mx-lg-3">
                                            <a class="nav-link" href="/list/All Items">
                                                All Items
                                            </a>
                                        </li>
                                        @foreach(\App\Category::all() as $category)
                                            <li class="nav-item mx-2 mx-lg-3">
                                                <a class="nav-link" href="/list/{{ $category->category_name }}" id={{ $category->id }}>
                                                    {{ $category->category_name }}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </nav>
                            <!-- /Products -->

                            <hr>

                            <!-- Account -->
                            <nav class="navbar my-0 py-0">
                                <a class="navbar-brand">My Account</a>
                                <button data-toggle="collapse" data-target="#sidebar-account" class="btn p-0 m-0 mb-1">
                                    <i class="fas fa-sort-down fa-2x"></i>
                                </button>
                                <div class="collapse navbar-collapse" id="sidebar-account">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item mx-2 mx-lg-3">
                                            <a class="nav-link" href="/profiles">
                                                My Profile
                                            </a>
                                        </li>
                                        <li class="nav-item mx-2 mx-lg-3">
                                        @auth
                                            <a class="nav-link" href="/profiles/{{ auth()->user()->id }}/edit">Edit Profile</a>
                                        @endauth
                                        </li>
                                        <li class="nav-item mx-2 mx-lg-3">
                                            <a class="nav-link" href="/like">
                                                My Likes
                                            </a>
                                        </li>
                                        <li class="nav-item mx-2 mx-lg-3">
                                            <a class="nav-link" href="/items/create">
                                                Upload Items for sell
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- /Account -->

                            <hr>

                            <!-- Admin -->
                            @auth
                                @if(App\User::where('id', auth()->user()->id)->first()->is_admin == true)
                                <nav class="navbar my-0 py-0">
                                    <a class="navbar-brand">Management</a>
                                    <button data-toggle="collapse" data-target="#sidebar-admin" class="btn p-0 m-0 mb-1">
                                        <i class="fas fa-sort-down fa-2x"></i>
                                    </button>

                                    <div class="collapse navbar-collapse" id="sidebar-admin">
                                        <ul class="navbar-nav mr-auto">

                                            <li class="nav-item mx-2 mx-lg-3">
                                                <a class="nav-link" href="/admin/promotion">Promotions</a>
                                            </li>
                                            <li class="nav-item mx-2 mx-lg-3">
                                                <a class="nav-link" href="#">Option2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            @endif
                            @endauth

                        </div>
                    </div>
                </div>
                <div onclick="document.getElementById('sidebar-left').style.display='none'"
                     class="close btn-circle d-flex justify-content-center align-items-center mt-2" >&times;</div>
            </div>
            <!-- /sidebar -->
        </div>
        <!-- /Logo -->

        <!-- Categories -->
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2 mx-lg-3">
                    <a class="nav-link" href="/list/All Items">
                        All Items
                    </a>
                </li>

                @foreach(\App\Category::all() as $category)
                    <li class="nav-item mx-2 mx-lg-3">
                        <a class="nav-link" href="/list/{{ $category->category_name }}" id={{ $category->id }}>
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
        <!-- /Categories -->

        <!-- User Buttons-->
        <div class="navbar navbar-expand pr-0 mr-2 pull-right">
            <ul class="navbar-nav mr-auto align-items-center">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if(App\User::where('id', auth()->user()->id)->first()->is_admin == true)
                        <li class="nav-item dropdown d-none d-lg-inline">
                            <div class="nav-link dropdown-toggle" id="management-dropdown" data-toggle="dropdown">
                                <i class="fas fa-users-cog fa-2x"></i></div>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="management-dropdown">
                                <li><a class="dropdown-item" href="/admin/promotion">Promotions</a></li>
                                <li><a class="dropdown-item" href="#">Option2</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link dropdown-toggle p-0" href="#" id="profile-dropdown" role="button" data-toggle="dropdown">
                            <i class="far fa-user-circle fa-2x"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="profile-dropdown">
                            <li><a class="dropdown-item" href="/profiles">My profile</a></li>
                            <li><a class="dropdown-item" href="/profiles/{{ auth()->user()->id }}/edit">Edit profile</a></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="/like"><i class="far fa-heart fa-2x p-0 m-0"></i></a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="/items/create"><i class="fas fa-plus-square fa-2x"></i></a>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- /User Buttons-->
    </nav>
    <!-- /navbar -->

    <!-- search bar -->
    <div id="my-searchbar" class="navbar container-fluid py-0 px-3 m-0">
        <form method="POST" action="/search" class="input-group">
            @csrf
            <input id="search-input" name="keywords" class="form-control rounded-left" type="text" placeholder="Search for ...">
            <div class="input-group-append">
                <button id="search-btn" class="btn btn-primary" type="submit" style="background-color: lightblue; border-color: lightblue"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- /search bar -->

</header>

<script>
    var modal = document.getElementById('sidebar-left');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
