<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function __construct()
     {
        $this->middleware('auth',['except' =>['index','show']]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $posts = Post::all();
        // $posts = Post::orderby('title','desc')->get();
        //  $posts = Post::orderby('title', 'asc')->get();
        // return Post::where('title','Post Two')->get();
        // $posts = DB::select('SELECT * FROM posts');
        // $posts = Post::orderby('title', 'desc')->take(1)->get();
        // $posts = Post::orderby('title', 'desc')->paginate(1);
        $posts = Post::orderby('created_at','desc')->paginate(1);
        // $posts = Post::orderby('created_at', 'asc')->paginate(1);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
             'title' =>'required',
             'body'  => 'required'
        ]);
        // return "<h4><i>From Submitted!</i></h4>";
        //create Post

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();
        
        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','unauthorized page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
         ]);
       // return "<h4><i>From Submitted!</i></h4>";
       //create Post

       $post = Post::find($id);
       $post->title = $request->input('title');
       $post->body = $request->input('body');
       $post->save();

       return redirect('/posts')->with('success', 'Post Created');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $post = POST::find($id);

          //check for correct user
        if (auth()->user()->id !== $post->user_id) {
        return redirect('/posts')->with('error', 'unauthorized page');
         }
          $post->delete();
          return redirect('/posts')->with('success'.'Post Remove');
    }
}
