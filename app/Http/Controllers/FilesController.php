<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function showUploadPage(){


        return view('/dashboard/fileUpload/fileUpload');
    }

    public function postFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,txt|max:8092',
        ]);
  
        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
   
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
   
    }
}
