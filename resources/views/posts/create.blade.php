@extends('layouts.app')

@section('content')
<h1>Create post</h1> 
     {!! Form::open(['action' => 'PostsController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class = "from-group">
        {{Form::label('title','TItle')}}
        {{Form::text('title','',['class'=> 'from-control','placeholder'=>'Title'])}}
    </div><br>
    <div class = "from-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body','',['id' =>'article-ckeditor','class'=> 'from-control','placeholder'=>'Body text'])}}
    </div>
    <div class="from-group">
        {{form::file('cover_image')}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!} 
@endsection

