<!-- user proofile -->
@extends('layouts.app')

@section('content')

    <style>
        #id-bar {
            background-color: lightblue;
        }
    </style>

    <!-- Info - on the top of the page -->
    <div id="id-bar" class="jumbotron jumbotron-fluid py-3">
        <div id="profile-picture" class="d-flex justify-content-center">
            <i class="fas fa-user-circle fa-5x d-flex justify-content-center"></i>
        </div>

        <h3 class="d-flex justify-content-center">{{ \App\User::find(auth()->user()->id)->name }}</h3>

        <div class="p-0 d-flex justify-content-center container">
            @if(\App\User::find(auth()->user()->id)->rating == 0)
                <h5 class="d-block p-0 m-0 mt-2">
                    <div class="d-flex justify-content-center"><b>No Rating</b></div>
                    <div class="d-flex justify-content-center"><small>You haven't received any comments</small></div>
                </h5>
            @else
                <a class="d-flex justify-content-center nav-link p-0 m-0" href="#">
                    <h5 class="d-block p-0 m-0 mt-2">
                        <div class="d-flex justify-content-center">
                            <b>{{ \App\User::find(auth()->user()->id)->rating }}</b>
                        </div>
                        <div class="d-flex justify-content-center small">
                            @for ($i = 0; $i < \App\User::find(auth()->user()->id)->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </h5>
                </a>
            @endif
        </div>
    </div>

    <!-- my listing, deal & review -->
    <div class="container-fluid mt-2">
        <!-- Page toggle -->
        <nav class="d-flex justify-content-center" aria-label="...">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="/profiles/item">My Items</a></li>
                <li class="page-item"><a class="page-link" href="/profiles/offer">Offers</a></li>
                <li class="page-item"><a class="page-link" href="/profiles/review">Reviews</a></li>
            </ul>
        </nav>

        <!-- Contents -->
        @yield('inner-content')


    </div>
@endsection
