@extends('layouts.app')

@section('content')
    @if(count($items) > 0)
        <div class="container-fluid my-0 mx-0 px-0 bg-white" style="min-height: 100vh">
            <div class="jumbotron d-flex justify-content-center align-items-center">
                <h1>You Liked {{count($items)}} @if(count($items) > 1) Items @else Item @endif</h1>
            </div>
            <div class="container-fluid px-0 row mx-1">
                @foreach($items as $item)
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
    @else
        <div class="jumbotron mb-0" style="height: 100vh">
            <div class="d-flex justify-content-center mt-5 mb-3 pt-5">
                <i class="fas fa-shopping-bag fa-7x" style="color: lightblue"></i>
            </div>
            <h5 class="d-flex justify-content-center mt-3"><b>No items found</b></h5>
        </div>
    @endif
@endsection
