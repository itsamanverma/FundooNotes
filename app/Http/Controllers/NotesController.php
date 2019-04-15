<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Facades\App\Notes;

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
     * Function to getb all the notes of the user
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
        // $noteee = Cache::get('notes'.Auth::user()->id);
        // $ss = $noteee->where('id',24);
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
       // $note = Notes::with('labels')->where('id', $req->get('id'));
        $note->update(
            [
                'id' => $req->get('id'),
                'title' => $req->get('title'),
                'body' => $req->get('body'),
                'reminder' => $req->get('reminder'),
                'color' => $req->get('color'),
                'userid' => $req->get('userid'),
                'pinned' => $req->get('pinned'),
                'archived' => $req->get('archived'),
                'deleted' => $req->get('deleted'),
 
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
     *  @return Response
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
 
   //  /**
   //   * function to add a image to the note 
   //   */
   //  public function addNotePic(Request $req)
   //  {
   //      $rere = $req->get('noteid');
   //      //we check if request has a file 
   //      if ($req->hasFile('notePic')) {
   //          //filename
   //          $origImage = $req->file('notePic');
   //          $ext = $req->file('notePic')->getClientOriginalExtension();
           
   //          //getting the path of image in temp folder
   //          $path = $req->file('notePic')->getRealPath();
 
 
 
 
   //          Cloudder::upload($path, null);
 
   //          list($width, $height) = getimagesize($path);
 
   //          $url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height]);
   //          $url="https://res.cloudinary.com/fundoonotes/image/fetch/".$url;
   //          list($width, $height) = getimagesize($path);
   //          $input['noteid'] = $req->get('noteid');
   //          $input['pic'] = $url;
 
   //          NoteImages::create($input);
   //          return response()->json(['message' => 'Picture Added', 'note' => Notes::with('labels')->where('id', $req->get('noteid'))->get()], 200);
   //      }
 
   //      return response()->json(['meassage' => 'Picture Note Found'], 200);
   //  }
 
    /**
     * function to delete a note image by id
     */
   //  public function deleteNotePic(Request $req)
   //  {
   //        // we delete a note and check if no of items deleted is greater than 1
   //      if (NoteImages::destroy($req->get('imageid')) > 0) {
   //          Cache::forget('notes' . Auth::user()->id);
   //          //
   //          return response()->json(['message' => 'image Deleted', 'note' => Notes::with('labels')->where('id', $req->get('noteid'))->get()], 200);
   //      } else {
   //          //return the not found message 
   //          return response()->json(['message' => 'image note found'], 204);
   //      }
   //  }
 
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
 
}