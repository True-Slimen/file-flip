<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    public function showUploadPage(){

        $folders = Folder::all();


        return view('/dashboard/fileUpload/fileUpload', ['folderlists'=>$folders]);
    }

    public function postFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,txt|max:8092' 
        ]);  
        $user = Auth::user();
        $owner_id = $user->id;
        $fileName = $request->file->getClientOriginalName();
        $exist = File::where('filename', $fileName)->exists();
        if( $exist == true)
            return back()
            ->with('error','Ce nom de fichier existe déjà, changez le');

        $type = $request->file->extension();  
        $request->file->move(public_path('uploads'), $fileName);
        $file = new File();
        $file->owner_id = $owner_id;
        $file->type =  $type;
        $file->filename =  $fileName;
        $file->filepath =  public_path('uploads');
        $file->save();
        
        return back()
            ->with('success','Fichier mit en ligne avec succès')
            ->with('file',$fileName);
    }
} 

