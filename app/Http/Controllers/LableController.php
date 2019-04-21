<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\validation\Rule;
use App\Lable;
use Facades\App\Notes;


class LableController extends Controller
{
    /**
     * Function to make a new label for the user in the data base
     */
     public function createLabel(Request $req)
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
            return response()->json(['message' => 'error'], 210);
        }


        //create a new label
        $label['label'] = $req->get('label');
        $label['userid'] = Auth::user()->id;
        $ll = Labels::create($label);
        return response()->json(['message' => 'created', 'label' => $ll], 200);
    }

}

