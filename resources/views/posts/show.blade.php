@extends('layouts.app')

@section('content')
<a href ="/posts" class="btn btn-default">Go Back</a>
<h1>{{$post->title}}</h1>  
<div>
    {{$post->body}}
</div><br>
<small>Written on {{$post->created_at}}</small>


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

@endsection

