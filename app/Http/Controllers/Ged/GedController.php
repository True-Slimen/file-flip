<?php

namespace App\Http\Controllers\Ged;

use App\File;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GedController extends Controller{
    
    public function gedRoot(){

        Storage::disk('uploads')->put('example.txt', 'Contents');
        $folder = Folder::all();
        $file = File::all();

        $content = Storage::disk('uploads')->get('example.txt');


        return view('/ged/root',['folderlists'=> $folder, 'filelist'=> $file]);
    }

    public function createFolder(){

        $folderlist = Folder::all();


        $foldername = request('foldername');
        $folder_array = request('parent_folder');
        $jObj = json_decode($folder_array);
        $parent_id = $jObj->id;
        $parent_deep = $jObj->parent_folder;

        // if($parent_deep == null)
        // {
        //     $parent_deep = 1;
        // }
        // else{
        //      $parent_deep= $parent_deep+1;
        // };
        
        $folder = new Folder();
        $folder->foldername = $foldername;
        $folder->owner_id = Auth::user()->id;
        $folder->folderpath = null;
        $folder->parent_folder = $parent_id;
        $folder->position_folder = $parent_deep;
        $folder->save();


        return view('/ged/root',['folder' => $foldername, 'folderlists'=>$folderlist, 'vartest' => $jObj]);
    }
}
