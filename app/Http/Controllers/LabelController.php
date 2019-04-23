<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Labels;
use Illuminate\Support\Facades\Auth;
use App\LabelsNotes;
use Validator;
use Illuminate\Validation\Rule;
use Facades\App\Notes;

class LabelController extends Controller
{
   /**
     * Function to make a new label for the user in the data base
     */
    public function makeLabel(Request $req)
    {

        $label['label'] = $req->get('label');
        $label['userid'] = Auth::user()->id;

        $messages = [
            'label.unique' => 'Duplicate label',
        ];

        //validation for duplicate label of the same user
        $validator = Validator::make(
            $label,
            [
                'label' => [
                    'required',
                    Rule::unique('labels')->where(function ($query) use ($label) {
                        return $query->where('label', $label['label'])
                            ->where('userid', $label['userid']);
                    }),
                ],
            ],
            $messages
        );

        //return proper response if duplicate entry is there
        if ($validator->fails()) {
            $err = $validator->errors();
            return response()->json(['message' => 'error: duplicate label'], 210);
        }


        //create a new label
        $label['label'] = $req->get('label');
        $label['userid'] = Auth::user()->id;
        $ll = Labels::create($label);
        return response()->json(['message' => 'created', 'label' => $ll], 200);
    }

    /**
     * function to delete a label from user
     */
    public function deleteLabel(Request $req)
    {
        if (Labels::destroy($req->get('labelid')) > 0) {
            return response()->json(['message' => 'label deleted'], 200);
        } else {
            return response()->json(['message' => 'label not found'], 204);
        }
    }
    /**
     * function to edit the label 
     */
    public function editLabel(Request $req)
    {
        $label = Labels::where('id', $req->get('labelid'))->first();
        if ($label !== null) {
            $label->update(
                [
                    'label' => $req->get('label'),
                ]
            );
            return response()->json(['label' => $label, 'notes' => Notes::getUserNotes()], 200);
        } else {
            return response()->json(['message' => 'Label Not Found', 204]);
        }
    }   
}
