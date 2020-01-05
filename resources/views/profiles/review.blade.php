@extends('layouts.profile')

@section('inner-content')
    <div class="container-fluid my-3 mx-0 px-0">
        @if(count($reviews) > 0)
            <h1 class="d-flex justify-content-center pt-3">Reviews</h1>

            <div class="table-responsive d-lg-flex justify-content-center">
                <table class="table mx-2" style="width: 1000px;">
                    <thead>
                    <tr>
                        <th style="width: 50px;">Rating</th>
                        <th style="width: 250px;">Comment</th>
                        <th style="width: 150px;">From</th>
                        <th style="width: 150px;">Date</th>
                        <th style="width: 200px;">Event</th>
                        <th style="width: 150px;">More</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <th style="width: 50px;">{{ $review->rating }}</th>
                            <th class="text-truncate" style="width: 250px; display: block">{{ $review->text }}</th>
                            <td class="text-truncate" style="width: 150px;">{{ \App\User::where('id', $review->sender_id)->first()->name }}</td>
                            <td class="text-truncate" style="width: 150px;">{{ $review->created_at }}</td>
                            @if ($review->receiver_role == 'seller')
                                <td class="text-truncate" style="width: 250px;">
                                    You sold {{ \App\Item::where('id', \App\Offer::where('id', $review->offer_id)->first()->item_id)->first()->name }} at S${{ \App\Offer::where('id', $review->offer_id)->first()->offered_price }} to {{ \App\User::where('id', $review->sender_id)->first()->name }}
                                </td>
                            @else
                                <td class="text-truncate" style="width: 250px;">
                                    You bought {{ \App\Item::where('id', \App\Offer::where('id', $review->offer_id)->first()->item_id)->first()->name }} at S${{ \App\Offer::where('id', $review->offer_id)->first()->offered_price }} to {{ \App\User::where('id', $review->sender_id)->first()->name }}
                                </td>
                            @endif
                            <td class="text-truncate" style="width: 150px;"><a href="/offers/{{ $review->offer_id }}">Check Offer</a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        @else
            <div class="jumbotron justify-content-center d-flex">
                <h5 class="d-block">You haven't given or received any reviews yet</h5>
            </div>
        @endif
    </div>
@endsection
