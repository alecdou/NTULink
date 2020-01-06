<!-- home page -->
@extends('layouts.app')
@section('content')
    <style>
        .card a {
            color: #272c31;
            text-decoration: none !important;
        }
    </style>
    <!-- Banner -->
    <div id="banner" class="container-fluid mx-0 px-0">
        <div class="swiper-container swiper-container-banner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{asset('images/promotion1.jpg')}}" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('images/promotion2.jpg')}}" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('images/promotion3.jpg')}}" class="img-fluid">
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-banner"></div>
            <div class="swiper-button-prev swiper-button-next-banner"></div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-banner"></div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Ad Cards -->
    <div class="container-fluid justify-content-center m-0 py-3 px-4 row">
        <div class="row">
            <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                <div class="ad-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Inside Out is a 2015 American 3D computer-animated comedy film produced by Pixar Animation Studios and released by Walt Disney Pictures. The film was directed by Pete Docter and co-directed by Ronnie del Carmen, with a screenplay written by Docter, Meg LeFauve and Josh Cooley, adapted from a story by Docter and del Carmen.</p>
                        <img class="img-fluid" src="https://source.unsplash.com/collection/190727/1400x700" alt="Card image cap">

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                <div class="ad-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Inside Out is a 2015 American 3D computer-animated comedy film produced by Pixar Animation Studios and released by Walt Disney Pictures. The film was directed by Pete Docter and co-directed by Ronnie del Carmen, with a screenplay written by Docter, Meg LeFauve and Josh Cooley, adapted from a story by Docter and del Carmen.</p>
                        <img class="img-fluid" src="https://source.unsplash.com/collection/190727/1400x700" alt="Card image cap">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Ad Cards -->

    <!-- Category List -->
    <div id="category-list" class="container-fluid my-3 d-flex-row d-md-none pb-3">
        <h1 class="d-flex justify-content-center pt-3">Explore by Category</h1>
        <div class="swiper-container swiper-container-category">

            <div class="swiper-wrapper mx-2">
                <div class="swiper-slide category-slider">
                    <div class="card border-0">
                        <a class="card-body mt-3 mb-0 p-0" href="/list/All Items"><i class="fas fa-shopping-bag fa-4x"></i></a>
                        <div class="card-title mt-0 p-0">All Items</div>
                    </div>
                </div>

                <div class="swiper-slide category-slider">
                    <div class="card border-0">
                        <a class="card-body mt-3 mb-0 p-0" href="/list/Fashion"><i class="fas fa-tshirt fa-4x"></i></a>
                        <div class="card-title mt-0 p-0">Fashion</div>
                    </div>
                </div>

                <div class="swiper-slide category-slider">
                    <div class="card border-0">
                        <a class="card-body mt-3 mb-0 p-0" href="/list/Dorm & Living"><i class="fas fa-couch fa-4x"></i></a>
                        <div class="card-title mt-0 p-0">Dorm & Living</div>
                    </div>
                </div>

                <div class="swiper-slide category-slider">
                    <div class="card border-0">
                        <a class="card-body mt-3 mb-0 p-0" href="/list/Electronics"><i class="fas fa-headphones fa-4x"></i></a>
                        <div class="card-title mt-0 p-0">Electronics</div>
                    </div>
                </div>

                <div class="swiper-slide category-slider">
                    <div class="card border-0">
                        <a class="card-body mt-3 mb-0 p-0" href="/list/Books"><i class="fas fa-book fa-4x"></i></a>
                        <div class="card-title mt-0 p-0">Books</div>
                    </div>
                </div>


            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-category swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-prev-category swiper-button-white"></div>
        </div>
    </div>
    <!-- /Category List -->


    <!-- Product Promotion List 1 -->
    <div id="promotion-list" class="container-fluid my-3 pb-3">
        <h1 class="d-flex justify-content-center py-3">Trending</h1>
        <div class="container-fluid swiper-container swiper-container-promotion">
            <div class="swiper-wrapper">
                @foreach($data['promotions'] as $promotion)
                    <div class="swiper-slide promotion-slider">
                        <div class="card product-card border-0 justify-content-center">
                            <a href="/items/{{ $promotion->id }}" class="d-flex justify-content-center my-0 pb-0">
                                <img src="/{{ App\Image::where('item_id', $promotion->id)->first()->image_path }}" alt="Item Image" class="product-img">
                            </a>
                            <div class="card-body justify-content-center mt-1 pt-1">
                                <h5 id="item-name" class="card-title text-truncate mb-0" style="display: block">
                                    {{ $promotion->name }}
                                </h5>
                                <p class="card-text text-truncate mt-0 text-muted" style="display: block">{{ $promotion->description }}</p>
                                <h5 class="text-muted pb-0 mb-0">
                                    @if($promotion->is_new)
                                        New
                                    @else
                                        Used
                                    @endif
                                </h5>
                                <div class="container row justify-content-between mx-0 px-0 pb-0 mb-0 align-items-center">
                                    <h5 id="item-price" class="card-title d-flex justify-content-start mb-0">
                                        <b>S${{ $promotion->price }}</b>
                                    </h5>

                                    <div class="d-flex align-items-center pl-0 ml-0">
                                        <i class="far fa-heart fa-2x py-1"></i>
                                        {{ count(\App\Like::where('item_id', $promotion->id)->get()) }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-promotion"></div>
            <div class="swiper-button-prev swiper-button-prev-promotion"></div>
        </div>
    </div>

    <!-- Item Cards -->
    <div class="container-fluid my-3 mx-0 px-0 bg-white">
        <h1 class="d-flex justify-content-center py-3">Products</h1>
        <div class="container-fluid px-0 row mx-1">
            @foreach($data['items'] as $item)
                <div class="container col-6 col-xl-2 col-md-3 col-sm-4 mb-3 px-1 m-0">
                    <div class="card product-card border-0 justify-content-center">
                        <a href="/items/{{ $item->id }}" class="d-flex justify-content-center my-0 pb-0">
                            <img src="/{{ App\Image::where('item_id', $item->id)->first()->image_path }}" alt="Item Image" class="product-img">
                        </a>
                        <div class="card-body justify-content-center mt-1 pt-1">
                            <h5 id="item-name" class="card-title text-truncate mb-0" style="display: block">
                                {{ $item->name }}
                            </h5>
                            <p class="card-text text-truncate mt-0 text-muted" style="display: block">{{ $item->description }}</p>
                            <h5 class="text-muted pb-0 mb-0">
                                @if($item->is_new)
                                    New
                                @else
                                    Used
                                @endif
                            </h5>
                            <div class="container row justify-content-between mx-0 px-0 pb-0 mb-0 align-items-center">
                                <h5 id="item-price" class="card-title d-flex justify-content-start mb-0">
                                    <b>S${{ $item->price }}</b>
                                </h5>

                                <div class="d-flex align-items-center pl-0 ml-0">
                                    <i class="far fa-heart fa-2x py-1"></i>
                                    {{ count(\App\Like::where('item_id', $item->id)->get()) }}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('extra-js')

    <script>
        var swiper = new Swiper('.swiper-container-banner', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination-promotion',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-banner',
                prevEl: '.swiper-button-prev-banner',
            },
        });

        var swiper1 = new Swiper('.swiper-container-category', {
            slidesPerView: 2,
            spaceBetween: 30,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next-category',
                prevEl: '.swiper-button-prev-category',
            },
        });

        if (window.innerWidth < 960) {
            var swiper2 = new Swiper('.swiper-container-promotion', {
                slidesPerView: 1,
                spaceBetween: 0,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper-button-next-promotion',
                    prevEl: '.swiper-button-prev-promotion',
                },
            });
        } else {
            swiper2 = new Swiper('.swiper-container-promotion', {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper-button-next-promotion',
                    prevEl: '.swiper-button-prev-promotion',
                },
            });
        }
    </script>
@endsection
