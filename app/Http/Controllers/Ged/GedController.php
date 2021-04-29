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
        $files = File::all();

        $content = Storage::disk('uploads')->get('example.txt');


        return view('/ged/root',['folderlists'=> $folder, 'files'=> $files]);
    }

    public function createFolder(){


        $foldername = request('foldername');

        $folder = new Folder();
        $folder->foldername = $foldername;
        $folder->owner_id = Auth::user()->id;
        $folder->folderpath = null;
        $folder->save();


        return view('/ged/root');
    }
}
