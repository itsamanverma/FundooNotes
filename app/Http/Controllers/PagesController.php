<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        // return 'INDEX';
        $title = 'Welcome To Laravel!';
        //this the first way of passing the value
        // return view('pages.index',compact('title'));

        //second way of passing the values
        return view('pages.index')->with('title',$title);

    }

     public function about(){
         $title = 'About Us';
         return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design','Programming','SEO']
        );
         return view('pages.services')->with($data);
    }
    
}
