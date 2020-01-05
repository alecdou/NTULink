@extends('layouts.profile')

@section('inner-content')

    <div class="container-fluid my-3 mx-0 px-0">
        @if(count($items) > 0)
            <h1 class="d-flex justify-content-center pt-3">Offers</h1>
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
                                @if(auth()->user()->id == $item->buyer_id)
                                    <p class="card-text text-truncate mt-0 text-muted" style="display: block">
                                        From {{ \App\User::where('id', $item->seller_id)->first()->name }}
                                    </p>
                                    <h5 id="item-price" class="card-title d-flex justify-content-start mb-0 mt-2 text-truncate text-muted", style="display: block">
                                        You offered S${{ $item->offered_price }}
                                    </h5>
                                @else
                                    <p class="card-text text-truncate mt-0 text-muted" style="display: block">
                                        Requested by {{ \App\User::where('id', $item->buyer_id)->first()->name }}
                                    </p>
                                    <h5 id="item-price" class="card-title d-flex justify-content-start mb-0 mt-2 text-truncate text-muted", style="display: block">
                                        Offered you S${{ $item->offered_price }}
                                    </h5>
                                @endif
                                <p class="text-muted p-0 m-0">
                                    {{ $item->status }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="jumbotron justify-content-center d-flex">
                <h5 class="d-block">You haven't made or received any offers yet</h5>
            </div>
        @endif
    </div>

@endsection
