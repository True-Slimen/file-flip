<?php

namespace App\Http\Controllers\Ged;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GedController extends Controller{
    
    public function gedRoot(){

        Storage::disk('uploads')->put('example.txt', 'Contents');
        $folder = Folder::all();

        $content = Storage::disk('uploads')->get('example.txt');


        return view('/ged/root',['folderlists'=> $folder]);
    }

    public function createFolder(){

        $folderlist = Folder::all();


        $foldername = request('foldername');
        $parent_id = request('parent_folder');
        $parent_deep = request('folderdeep');

        if($parent_deep == null)
        {
            $parent_deep = 1;
        }
        else{
             $parent_deep= $parent_deep+1;
        };
        
        $folder = new Folder();
        $folder->foldername = $foldername;
        $folder->owner_id = Auth::user()->id;
        $folder->folderpath = null;
        $folder->parent_folder = $parent_id;
        $folder->deep = $parent_deep;
        $folder->save();


        return view('/ged/root',['folder' => $foldername, 'folderlists'=>$folderlist]);
    }
}
