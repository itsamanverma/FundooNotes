@extends('layouts.app')

@section('content')
<h1>Create post</h1> 
{!! Form::open(['action' => 'PostsController@store','method' => 'POST']) !!}
    <div class = "from-group">
        {{Form::label('title','TItle')}}
        {{Form::text('title','',['class'=> 'from-control','placeholder'=>'Title'])}}
    </div><br>
    <div class = "from-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body','',['class'=> 'from-control','placeholder'=>'Body text'])}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!} 
@endsection

