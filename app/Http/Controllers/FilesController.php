<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use App\Right;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\List_;

class FilesController extends Controller
{
    public function showUploadPage(){

        $folders = Folder::all();


        return view('/dashboard/fileUpload/fileUpload', ['folderlists'=>$folders]);
    }

    public function postFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,txt|max:8092',
            'parent_folder' => 'required' 
        ]);
        
        $folder_id = request('parent_folder');
        $folder = Folder::where('id', $folder_id) -> first(); 
        $path = public_path('uploads');
        $len_folder_root= strlen(public_path('uploads'));
        $fileName = $request->file->getClientOriginalName();
        $file = new File();

        if($folder_id != 0)
        {   
            $folder_path = $folder -> folderpath;
            $folder_name = $folder -> foldername;
            $shortpath = '\\uploads' . substr($folder_path, $len_folder_root) . '\\' . $fileName;
            $file->shortpath = $shortpath;
            $file->filepath = $folder_path ;
            $path = $folder_path;
        }
        else
        {   
            $file->shortpath = "\uploads\\".$fileName ;
            $file->filepath = $path ;
        }
        $user = Auth::user();
        $owner_id = $user->id;
        $exist = File::where('filename', $fileName)->exists();
        if( $exist == true) 
            return back()
            ->with('error','Ce nom de fichier existe déjà, changez le s\'il vous plait.');

        $type = $request->file->extension();
        $request->file->move($path, $fileName); //enregistrement du fichier




        $file->owner_id = $owner_id;
        if($folder_id != 0){

            $file->folder_id = $folder_id;
        }
        $file->type =  $type;
        $file->filename =  $fileName;
        $file->save();
        $file_id = $file -> id;

        for($i = 1 ; $i <= 6 ; $i++) //assignation de tous les droits sur le fichier à l'utilisateur
        {
            $newRight = new Right();
            $newRight -> user_id = $owner_id;
            $newRight ->file_id = $file_id;
            $newRight -> type = $i;
            $newRight->save();
        }
        
        
        
        return back()
            ->with('success','Fichier mis en ligne avec succès !')
            ->with('file',$fileName);
    }
} 

