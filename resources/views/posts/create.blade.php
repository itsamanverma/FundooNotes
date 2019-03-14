@extends('layouts.app')

@section('content')
<h1>Create post</h1> 
{!! Form::open(['action' => 'PostsController@store','method' => 'POST']) !!}
    <div class = "from-group">
        {{Form::label('title','TItle')}}
        {{Form::text('title','',['class'=> 'from-control','placeholder'=>'Title'])}}
    </div>
{!! Form::close() !!} 
@endsection

