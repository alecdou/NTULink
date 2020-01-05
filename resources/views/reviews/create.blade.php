
@extends('layouts.app')
@section('content')
    <div class="container my-3">
        <h3 class="jumbotron">Leave Comment</h3>

    {!! Form::open(['action' => 'ReviewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} <!-- When submiting a file, we need to add 'enctype' => 'multipart/form-data' -->
        @csrf

        {!! Form::hidden('offer_id', $offer->id) !!}

        @if(auth()->user()->id == $offer->buyer_id)
            <div class="form-group">
                {{Form::label('rating', '*Rating')}}
                {{Form::select('rating', [5 => 'Perfect', 4 => 'Wonderful', 3 => "Normal", 2 => 'Disappointing', 1 => 'Unacceptable'], null, ['class' => 'form-control', 'placeholder' => 'Rate The Seller'])}}
            </div>
        @else
            <div class="form-group">
                {{Form::label('rating', '*Rating')}}
                {{Form::select('rating', [5 => 'Perfect', 4 => 'Wonderful', 3 => "Normal", 2 => 'Disappointing', 1 => 'Unacceptable'], null, ['class' => 'form-control', 'placeholder' => 'Rate The Buyer'])}}
            </div>
        @endif
        <hr>

        <div class="form-group">
            {{Form::label('comment', 'Comment')}}
            {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Leave a comment here'])}}
        </div>
        <hr>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>

@endsection
