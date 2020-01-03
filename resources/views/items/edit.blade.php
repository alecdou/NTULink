<!-- edit details of an item -->
@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h1>Create Post</h1>
    {!! Form::open(['action' => ['ItemsController@update', $item->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} <!-- When submiting a file, we need to add 'enctype' => 'multipart/form-data' -->


        <!-- admin operations -->
        @if(\App\User::find(auth()->user()->id)->is_admin == true)
            <div class="card">
                <div class="card-body">
                    <h5>Admin</h5>
                    <div class="form-group">
                        {{Form::label('is_promoted', 'Promoted')}}
                        {{Form::radio('is_promoted', 'true' , $item->is_promoted) }}
                        {{Form::label('is_promoted', 'Not Promoted')}}
                        {{Form::radio('is_promoted', 'false' , !($item->is_promoted)) }}
                    </div>

                </div>
            </div>
        @endif


        <!-- user operations -->

        <div class="form-group">
            {{Form::label('name', '*Item Name')}}
            {{Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'Name (<40 characters)'])}}
        </div>

        <div class="form-group">
            {{Form::label('price', '*Price')}}
            {{Form::number('price', $item->price, ['class' => 'form-control', 'placeholder' => 'SGD'])}}
        </div>

        <hr>

        <div class="form-group">
            {{Form::label('new_old', '*Status of Item')}}
            <br>
            {{Form::label('is_new', 'This is a new item')}}
            {{ Form::radio('is_new', 'true' , $item->is_new) }}
            <br>
            {{Form::label('is_new', 'This is a used item')}}
            {{ Form::radio('is_new', 'false' , !($item->is_new)) }}
        </div>

        <hr>

        <div class="form-group">
            {{Form::label('category', '*Category')}}
            <?php
            $categories = \App\Category::all();
            $arr = array();
            foreach($categories as $category)
                $arr[] = array($category['id'] => $category['category_name']);
            ?>
            {{Form::select('category', [1 => 'Fashion', 2 => 'Dorm & Living', 3 => "Electronics", 4 => 'Books'], $item->category_id, ['class' => 'form-control', 'placeholder' => 'Pick a category'])}}
        </div>

        <hr>

        <div class="form-group">
            {{Form::label('image', '*Item Image')}}
            <br>
            {{Form::file('cover_image')}}
        </div>

        <hr>


        <div class="form-group">
            {{Form::label('description', 'Brief Description')}}
            {{Form::text('description', $item->description, ['class' => 'form-control', 'placeholder' => 'Description (<80 characters)'])}}
        </div>

        <div class="form-group">
            {{Form::label('details', 'Details')}}
            {{Form::textarea('details', $item->details, ['class' => 'form-control', 'placeholder' => 'Item Details'])}}
        </div>


        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {{Form::hidden('_method', 'PUT')}}
        {!! Form::close() !!}
    </div>

@endsection
