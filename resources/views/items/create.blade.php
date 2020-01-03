<!-- Add a new item -->

@extends('layouts.app')
@section('content')
    <div class="container my-3">
        <h3 class="jumbotron">Upload Item</h3>

    {!! Form::open(['action' => 'ItemsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} <!-- When submiting a file, we need to add 'enctype' => 'multipart/form-data' -->

        <div class="form-group">
            {{Form::label('name', '*Item Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name (<40 characters)'])}}
        </div>

        <div class="form-group">
            {{Form::label('price', '*Price')}}
            {{Form::number('price', '', ['class' => 'form-control', 'placeholder' => 'SGD'])}}
        </div>

        <hr>

        <div class="form-group">
            {{Form::label('new_old', '*Status of Item')}}
            <br>
            {{Form::label('is_new', 'This is a new item')}}
            {{ Form::radio('is_new', 'true' , true) }}
            <br>
            {{Form::label('is_new', 'This is a used item')}}
            {{ Form::radio('is_new', 'false' , false) }}
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
            {{Form::select('category', [1 => 'Fashion', 2 => 'Dorm & Living', 3 => "Electronics", 4 => 'Books'], null, ['class' => 'form-control', 'placeholder' => 'Pick a category'])}}
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
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description (<80 characters)'])}}
        </div>

        <div class="form-group">
            {{Form::label('details', 'Details')}}
            {{Form::textarea('details', '', ['class' => 'form-control', 'placeholder' => 'Item Details'])}}
        </div>




        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>

@endsection
