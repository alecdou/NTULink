<!-- edit details of an item -->
@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h3 class="jumbotron">Edit Profile</h3>

        {!! Form::open(['action' => ['ProfilesController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <!-- When submiting a file, we need to add 'enctype' => 'multipart/form-data' -->

        <div class="form-group">
            {{Form::label('name', 'Account Name')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'name'])}}
        </div>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {{Form::hidden('_method', 'PUT')}}
        {!! Form::close() !!}
    </div>

@endsection
