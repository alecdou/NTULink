@extends('layouts.profile')

@section('inner-content')
    <div class="container-fluid my-3 mx-0 px-0">
        @if(count($items) > 0)
            <h1 class="d-flex justify-content-center pt-3">My Items</h1>
            <div class="row mx-1">
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
        @else
            <div class="jumbotron justify-content-center d-flex">
                <h5 class="d-block">You haven't given or received any reviews yet</h5>
            </div>
        @endif
    </div>
@endsection
