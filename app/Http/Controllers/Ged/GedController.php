<?php

namespace App\Http\Controllers\Ged;

use App\File;
use App\Right;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GedController extends Controller{
    
    public function gedRoot(){

        //'Voir', 'Lire', 'Ecrire', 'Supprimer', 'Déplacer', 'Copier'

        $userData = Auth::user();
        $rights = Right::all();

        $isAdmin = Right::where('user_id', $userData->id)
            ->where('type', 4)
            ->get();

        Storage::disk('uploads')->put('example.txt', 'Contents');
        $folder = Folder::all();
        $file = File::all();

        $content = Storage::disk('uploads')->get('example.txt');


        return view('/ged/root',['folderlists'=> $folder, 'filelist'=> $file, 'isAdmins'=> $isAdmin]);
    }

    public function createFolder(){

        $folderlist = Folder::all();


        $foldername = request('foldername');
        $folder_array = request('parent_folder');
        $jObj = json_decode($folder_array);
        
        if($jObj==null)
        {
            $parent_id = 0;
            $parent_deep = 1;
        }
        else{
            $parent_id = $jObj->id;
            $parent_deep = $jObj->position_folder;
        };
        
        $folder = new Folder();
        $folder->foldername = $foldername;
        $folder->owner_id = Auth::user()->id;
        $folder->folderpath = 'null';
        $folder->parent_folder = $parent_id;
        $folder->position_folder = $parent_deep;
        $folder->save();
        

        return back();
    }

    public function DeleteFolder(){
        $userData = Auth::user();
        $rights = Right::all();
        $isAdmin = Right::where('user_id', $userData->id)
            ->where('type', 4)
            ->get();

        $folderlist = Folder::all();
        $filelist = File::all();
        $folder = Folder::all();
        $file = File::all();

        $folder_id = request('folder_id');

        $fileDeletes = File::where('folder_id', $folder_id)
            ->get();

        

        foreach($fileDeletes as $fileDelete){
            
                Right::where('file_id', $fileDelete->id)->delete();
                File::where('id', $fileDelete->id)->delete();
        }
    

        
        Right::where('folder_id', $folder_id)->delete();

        Folder::where('id', $folder_id)->delete();


        
        


        return view('/ged/root',['folder_id' => $folder_id, 'folderlists'=> $folder, 'filelist'=> $file, 'isAdmins'=> $isAdmin]);
    }
}
