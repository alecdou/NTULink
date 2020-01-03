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
                                <img src="/{{ App\Image::where('item_id', $item->id)->first()->image_path }}" alt="Item Image" class="img-fluid">
                            </a>
                            <div class="card-body justify-content-center mt-0 pt-0">
                                <h5 class="card-title d-flex justify-content-center">{{ $item->name }}</h5>
                                <h5 class="card-title d-flex justify-content-center">{{ $item->price }}</h5>
                                <small class="card-text d-flex justify-content-center">{{ $item->description }}</small>
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
