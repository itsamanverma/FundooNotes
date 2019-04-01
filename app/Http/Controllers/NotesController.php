<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use \App\Notes;

class NotesController extends Controller
{
    public function __construct(){

    }

    /**
     * write the function to create the new notes
     * 
     * @return response
     */
    public function create(Request $req){
       $data = $req->all();
       $data['userid'] = Auth::user()->id;
       $note = Notes::createNewNote($data);
       return response()->json(['message' => 'Note Created','id'=> $note->id],201);
    }
    /**
     * write the function to get all the notes of the user
     * 
     * @return response 
     */
     public function getNotes()
     {

     }  

}
