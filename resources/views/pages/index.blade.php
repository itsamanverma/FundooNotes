
    @extends('layouts.app')
    
    @section('content')
        <div class ="jumbotron text-center">
        <h1 style ="text-align:center">{{$title}}</h1>
        <p style ="text-align:center">this is the laravel application from the "Laravel from scratch"</p>
        <p><a class ="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class ="btn btn-success brtn-lg" href="/register" role="button">Register</a></p>
        </div>
    @endsection

    {{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
         <h1 style="text-align:center">Welecome to Laravel</h1>
        <p style ="text-align:center">this is the laravel application from the "Laravel from scratch"</p>
    </body>
</html> --}}
        