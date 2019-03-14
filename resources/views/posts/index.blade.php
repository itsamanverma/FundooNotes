@extends('layouts.app')

@section('content')
<h1>Posts</h1>  

@if(count($posts) > 0)
     @foreach ($posts as $post)
         <div class ="well">
         <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
              <small>Written on {{$post->created_at}}</small>
         </div>
     @endforeach
     {{$posts->links()}}
@else
    <p> No posts Found</p>
@endif

@endsection

