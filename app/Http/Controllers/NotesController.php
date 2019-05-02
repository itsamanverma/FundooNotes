<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Facades\App\Notes;
use Illuminate\Support\Collection;


//use App\Notes;
  
class NotesController extends Controller
{
 
    public function __construct()
    {}
 
    /**
     * Function to create new note
     * 
     * @return response
     */
     public function create(Request $req)
    {
        $data = $req->all();
        $data['userid'] = Auth::user()->id;
        $note = Notes::createNewNote($data);
        return response()->json(['message' => 'Note Created', 'id' => $note->id], 201);
    } 
    
    /**
     * Function to get all the notes of the user
     * 
     * @return response
     */
    public function getNotes()
    {
         Cache::forget('notes' . Auth::user()->id);
         $notes = Cache::remember('notes' . Auth::user()->id, (30), function () {
         $nn = Notes::with('labels')->where('userid', Auth::user()->id)->get();
            return $nn;
        }); 
        // $notes = Cache::get('notes'.Auth::user()->id);
        // $notes = $notes->where('id',2);
        // $notes = Notes::where('userid','=',Auth::user()->id)->get(); 
        return response()->json(['message' => $notes], 200);
    }
 
    /**
     * Function to edit notes
     * 
     *  @return Response
     */
    public function editNotes(Request $req)
    {   
        $data = $req->all();
        $notes = Cache::get('notes' . Auth::user()->id);
        $note = Notes::with('labels')->where('id', $req->get('id'));
        $notes->update(
            [
                'id' => $req->get('id'),
                'title' => $req->get('title'),
                'body' => $req->get('body'),
                'reminder' => $req->get('reminder'),
                'color' => $req->get('color'),
                'userid' => $req->get('userid'),
                'ispinned' => $req->get('ispinned'),
                'isarchived' => $req->get('isarchived'),
                'istrash' => $req->get('istrash'),
 
            ]
        );
        Cache::forget('notes' . Auth::user()->id);
 
        // $note->id = $req->get('id');
        // $note->title = $req->get('title');          
        // $note->body = $req->get('body');
        // $note->reminder = $req->get('reminder');
        // $note->color = $req->get('color');
        // $note->userid = $req->get('userid');
        // $note->pinned = $req->get('pinned');
        // $note->save();
        return response()->json(['message' => Notes::with('labels')->where('id', $req->get('id'))->get()], 200);
 
    }
 
    /**
     * function to delete a note of the user
     * 
     * @return Response
     */
    public function deleteNote(Request $req)
    {
        $data = $req->all();
        //destroy the model with the given id and return the no of models deleted
        if (Notes::destroy($req->get('id')) > 0) {
            $notes = Notes::where('userid', Auth::user()->id)->get();
            foreach ($notes as $note) {
                if ($note->index > $data['index']) {
                    $note->index -= 1;
                    $note->save();
                }
            }
            Cache::forget('notes' . Auth::user()->id);
            return response()->json(['message' => 'note deleted'], 200);
        } else {
            return response()->json(['message' => 'note not found'], 204);
        }
    }
 
    /**
     * function to save the  indexes of the note in the backend
     * 
     * @var Request
     * @return Response 
     */
    public function saveIndex(Request $req)
    {
        $dragIndex = $req->get('dragIndex');
        $dropIndex = $req->get('dropIndex');
        if ($dragIndex === $dropIndex) {
            return response()->json(["message" => "success"], 200);
        }
 
        $notes = Notes::where('userid', Auth::user()->id)->get();
 
        if ($dropIndex > $dragIndex) {
            foreach ($notes as $note) {
                if ($note->index > $dragIndex && $note->index <= $dropIndex) {
                    $note->index -= 1;
                    $note->save();
                } elseif ($note->index === $dragIndex) {
                    $note->index = $dropIndex;
                    $note->save();
                } 
                // elseif ($note->index === $dropIndex) {
                //     $note->index = $dragIndex;
                //     $note->save();
                // }
            }
            return response()->json(["message" => "success"], 200);
 
        } else {
            foreach ($notes as $note) {
                if ($note->index >= $dropIndex && $note->index < $dragIndex) {
                    $note->index += 1;
                    $note->save();
 
                } elseif ($note->index === $dragIndex) {
                    $note->index = $dropIndex;
                    $note->save();
                }
            }
            return response()->json(["message" => "success"], 200);
        }
    }

 
    /**
     * Use the where method to find data that matches a given
     * criteria.
     *
     * Chain the methods for fine-tuned criteria
     * @param Request
     * @return required node based on title,body & label & get the userid
     */
    public function searchNotes(Request $req)
    {   
        $notes = Notes::all();
        $filter = $collection->filter(Function($value,$title){
            return collect($notes->toArray())->$value('LIKE','%')
            ->only(['id','title','body','reminder','color','userid','ispinned','isarchived','istrash','index'])
            ->all();
        });
    }
}