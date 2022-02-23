<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;

class VideoUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }


    public function storeUploads(Request $request)
    {
            $resizedVideo = cloudinary()->uploadVideo($request->file('video')->getRealPath(), [
                    'folder' => 'uploads',
                    'transformation' => [
                            'fetch_format' => auto,
                    ]
        ])->getSecurePath();

            dd($resizedVideo);
    }
}
