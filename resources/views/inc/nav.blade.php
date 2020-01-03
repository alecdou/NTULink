<nav class="navbar navbar-expand navbar-light bg-light justify-content-between p-0 mb-1">
    <a class="navbar-brand" href="/">Thriftly</a>
    <ul class="navbar-nav align-items-center mt-1">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="management-dropdown" role="button" data-toggle="dropdown">Management</a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="management-dropdown">
                        <li><a class="dropdown-item" href="/admin/promotion">Promotions</a></li>
                        <li><a class="dropdown-item" href="#">Option2</a></li>

                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profile-dropdown" role="button" data-toggle="dropdown">User</a>
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
            <li class="nav-item">
                <a class="nav-link" href="/like">Like</a>
            </li><li class="nav-item nav-link py-0"><a class="btn btn-primary py-1 px-4" href="/items/create"><b>Sell</b></a></li>
        @endguest
    </ul>
</nav>
