@extends('layouts.app')

@section('content')
<h1>Edit post</h1> 
{!! Form::open(['action' => ['PostsController@update',$post->id],'method' => 'POST']) !!}
    <div class = "from-group">
        {{Form::label('title','TItle')}}
        {{Form::text('title',$post->title,['class'=> 'from-control','placeholder'=>'Title'])}}
    </div><br>
    <div class = "from-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->body,['id' =>'article-ckeditor','class'=> 'from-control','placeholder'=>'Body text'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!} 
@endsection

