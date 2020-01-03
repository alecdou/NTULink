<!-- display all items or items belonging to a certain category -->
@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-2">
        <div class="container-fluid shadow-sm my-3 pt-3" style="background-color: white;">
            <!-- <h5 class="d-flex justify-content-center my-3">My Items</h5> -->
            <div class="container-fluid">

                <h1>Promoted</h1>
                <div class="container row">
                    @if(count($items['promotions']) > 0)
                        @foreach($items['promotions'] as $item)
                            <div class="col-6 col-md-3 mb-3">
                                <div class="product-card">
                                    <div class="card-body">
                                        <a href="/items/{{ $item->id }}">
                                            <img src="/{{ App\Image::where('item_id', $item->id)->first()->image_path }}" alt="Item Image" class="container-fluid">
                                        </a>
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <h5 class="card-title">{{ $item->price }}</h5>
                                        <p class="card-text">{{ $item->description }}</p>

                                        <!-- Managment Buttons -->

                                        <form action="/admin/promotion/remove" method="post" class="container d-inline p-0 m-0">
                                            @csrf
                                            <input name="item_id" type="hidden" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-warning">Cancle Promotion</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1>No items found</h1>
                    @endif
                </div>

                <h1>Others</h1>
                <div class="container row">
                    @if(count($items['others']) > 0)
                        @foreach($items['others'] as $item)
                            <div class="col-6 col-md-3 mb-3">
                                <div class="product-card">
                                    <div class="card-body">
                                        <a href="/items/{{ $item->id }}">
                                            <img src="/{{ App\Image::where('item_id', $item->id)->first()->image_path }}" alt="Item Image" class="container-fluid">
                                        </a>
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <h5 class="card-title">{{ $item->price }}</h5>
                                        <p class="card-text">{{ $item->description }}</p>

                                        <!-- Managment Buttons -->

                                        <form action="/admin/promotion/add" method="post" class="container d-inline p-0 m-0">
                                            @csrf
                                            <input name="item_id" type="hidden" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-warning">Promote</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1>No items found</h1>
                    @endif
                </div>






            </div>
        </div>




    </div>

@endsection
