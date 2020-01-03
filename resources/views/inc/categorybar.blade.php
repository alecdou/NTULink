<!-- Category Bar -->
<nav class="d-none d-md-flex justify-content-between">

    <ul class="col-12 navbar-nav flex-row d-none d-md-flex justify-content-between">
        <li class="nav-item">
            <a class="nav-link" href="/list/All Items">
                All Items
            </a>
        </li>

        @foreach(\App\Category::all() as $category)
            <li class="nav-item">
                <a class="nav-link" href="/list/{{ $category->category_name }}" id={{ $category->id }}>
                    {{ $category->category_name }}
                </a>
            </li>
        @endforeach



{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link dropdown-toggle" href="#" id="categoty-2-dropdown" role="button" data-toggle="dropdown">--}}
{{--                Categoty-2--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu" aria-labelledby="categoty-2-dropdown">--}}
{{--                <a class="dropdown-item" href="#">Action</a>--}}
{{--                <a class="dropdown-item" href="#">Another action</a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a class="dropdown-item" href="#">Something else here</a>--}}
{{--            </div>--}}
{{--        </li>--}}


    </ul>




</nav>
