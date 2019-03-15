@extends('layouts.app')

@section('content')
<a href ="/posts" class="btn btn-default">Go Back</a>
<h1>{{$post->title}}</h1>  
<div>
    {!!$post->body!!}
</div><br>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
<hr>
@if(!Auth::guest())
   @if(Auth::user()->id == $post->user_id)
<a href ="/posts/{{$post->id}}/edit" class ="btn btn-default">Edit</a>
{!!Form::open(['action' => ['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
{!!Form::close()!!}
     @endif
{{-- 
@if(count($posts) > 1)
     @foreach ($posts as $post)
         <div class ="well">
         <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
              <small>Written on {{$post->created_at}}</small>
         </div>
     @endforeach
@else
    <p> No posts Found</p>
@endif --}}
@endif
@endsection

