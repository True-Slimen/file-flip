<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    public function showUploadPage(){


        return view('/dashboard/fileUpload/fileUpload');
    }

    public function postFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,txt|max:8092' 
        ]);  
        $user = Auth::user();
        $user_id = $user->id;
        $fileName = $request->file->getClientOriginalName();
        $exist = File::where('filename', $fileName)->exists();
        if( $exist == true)
            return back()
            ->with('error','The file name already exist. You should change it please.');

        $type = $request->file->extension();  
        $request->file->move(public_path('uploads'), $fileName);
        $file = new File();
        $file->user_id = $user_id;
        $file->type =  $type;
        $file->filename =  $fileName;
        $file->filepath =  public_path('uploads');
        $file->save();
        
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
    }
}
