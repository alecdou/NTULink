<!-- Add a new item -->

@extends('layouts.app')
@section('content')

    <style>
        .accept-btn {
            color: white !important;
            background: lightblue !important;
            border: none !important;
        }

        .decline-btn {
            color: white !important;
            background: rgba(240, 128, 128, 0.6) !important;
            border: none !important;
        }

        .chat-btn,
        .review-btn {
            color: black !important;
            background: white !important;
            border-width: 1px !important;
            border: black;
            border-style: solid;
        }
    </style>

    <div class="container my-3">

        <!-- Title -->
        <div class="jumbotron">
            <h3>Offer Details</h3>
            <h5 class="text-muted">{{ $data['offer']->status }}</h5>
        </div>
        <!-- /Title -->


        <!-- Information -->
        <div class="container-fluid row px-0 mx-0">


            @if(auth()->user()->id == $data['offer']->seller_id)

                <!-- Information Table for sellers -->
                <div class="table-responsive col-12 col-md-9 col-lg-10">
                    <table class="table" style="width: 1200px;">
                        <thead>
                        <tr>
                            <th style="width: 100px;">Item</th>
                            <th style="width: 200px;">Item Name</th>
                            <th style="width: 100px;">Condition</th>
                            <th style="width: 100px;">Sale Price</th>
                            <th style="width: 200px;">Buyer</th>
                            <th style="width: 100px;">Offered You</th>
                            <th style="width: 200px;">Date Offered</th>
                            <th style="width: 100px;">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th style="width: 100px;">
                                <img src="/{{ \App\image::where('item_id', $data['item']->id)->first()->image_path }}" style="width: 100px; object-fit: contain">
                            </th>
                            <td style="width: 200px;"><a href="/items/{{ $data['item']->id }}">{{ $data['item']->name }}</a></td>
                            <td style="width: 100px;">
                                @if($data['item']->is_new)
                                    New
                                @else
                                    Used
                                @endif
                            </td>
                            <td style="width: 100px;">{{ $data['item']->price }}</td>
                            <td style="width: 200px;">{{ \App\User::where('id', $data['offer']->buyer_id)->first()->name }}</td>
                            <td style="width: 100px;">{{ $data['offer']->offered_price }}</td>
                            <td style="width: 200px;">{{ $data['offer']->date_offered }}</td>
                            <td style="width: 100px;">{{ $data['offer']->status }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /Information Table for sellers -->

                <!-- Buttons for sellers -->
                <div class="d-block col-12 col-md-3 col-lg-2 px-0 pl-md-5 pr-md-1">
                    @if($data['offer']->status == 'pending')
                        <a class="btn accept-btn text-monospace font-weight-bold m-1 mt-0 btn-block py-2" href="/offers/{{ $data['offer']->id }}/accept">Accept</a>
                        <a class="btn decline-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/offers/{{ $data['offer']->id }}/decline">Decline</a>
                    @elseif($data['offer']->status == 'accepted')
                        <a class="btn chat-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/chats/{{ \App\Http\Controllers\ChatsController::find($data['offer']->buyer_id, $data['offer']->seller_id) }}">Chat</a>
                        <a class="btn review-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/reviews/create/{{ $data['offer']->id }}">Comment</a>
                    @elseif(($data['offer']->status == 'declined') || ($data['offer']->status == 'canceled'))
                        <a class="btn chat-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/chats/{{ \App\Http\Controllers\ChatsController::find($data['offer']->buyer_id, $data['offer']->seller_id) }}">Chat</a>
                    @endif
                </div>
                <!-- Buttons for sellers -->


            @else

                <!-- /Information Table for buyers -->
                <div class="table-responsive col-12 col-md-9 col-lg-10">
                    <table class="table" style="width: 1200px;">
                        <thead>
                        <tr>
                            <th style="width: 100px;">Item</th>
                            <th style="width: 200px;">Item Name</th>
                            <th style="width: 100px;">Condition</th>
                            <th style="width: 100px;">Sale Price</th>
                            <th style="width: 200px;">Seller</th>
                            <th style="width: 100px;">You Offered</th>
                            <th style="width: 200px;">Date Offered</th>
                            <th style="width: 100px;">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th style="width: 100px;">
                                <img src="/{{ \App\image::where('item_id', $data['item']->id)->first()->image_path }}" style="width: 100px; object-fit: contain">
                            </th>
                            <td style="width: 200px;"><a href="/items/{{ $data['item']->id }}">{{ $data['item']->name }}</a></td>
                            <td style="width: 100px;">
                                @if($data['item']->is_new)
                                    New
                                @else
                                    Used
                                @endif
                            </td>
                            <td style="width: 100px;">{{ $data['item']->price }}</td>
                            <td style="width: 200px;">{{ \App\User::where('id', $data['item']->user_id)->first()->name }}</td>
                            <td style="width: 100px;">{{ $data['offer']->offered_price }}</td>
                            <td style="width: 200px;">{{ $data['offer']->date_offered }}</td>
                            <td style="width: 100px;">{{ $data['offer']->status }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /Information Table for sellers -->

                <!-- Buttons for sellers -->
                <div class="d-block col-12 col-md-3 col-lg-2 px-0 pl-md-5 pr-md-1">
                    @if($data['offer']->status == 'pending')
                        <a class="btn decline-btn text-monospace font-weight-bold m-1 btn-block py-2"  href="/offers/{{ $data['offer']->id }}/cancel">Cancel</a>
                    @elseif($data['offer']->status == 'accepted')
                        <a class="btn chat-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/chats/{{ \App\Http\Controllers\ChatsController::find($data['offer']->buyer_id, $data['offer']->seller_id) }}">Chat</a>
                        <a class="btn review-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/reviews/create/{{ $data['offer']->id }}">Comment</a>
                    @elseif(($data['offer']->status == 'declined') || ($data['offer']->status == 'canceled'))
                        <a class="btn chat-btn text-monospace font-weight-bold m-1 btn-block py-2" href="/chats/{{ \App\Http\Controllers\ChatsController::find($data['offer']->buyer_id, $data['offer']->seller_id) }}">Chat</a>
                    @endif
                </div>
                <!-- Buttons for sellers -->
            @endif
        </div>
        <!-- /Information -->





    </div>

@endsection
