<?php

namespace App\Http\Controllers\Ged;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GedController extends Controller{
    
    public function gedRoot(){

        Storage::disk('uploads')->put('example.txt', 'Contents');

        $content = Storage::disk('uploads')->get('example.txt');


        return view('/ged/root', ['content'=>$content]);
    }

    public function createFolder(){

        request()->validate([
            'foldername' => 'required | min:4 | unique:folder,name'
        ]);

        $foldername = request('foldername');

        $folder = new Folder();
        $folder->name = $foldername;
        $folder->owner_id = Auth::user();
        $folder->folderpath = null;
        $folder->save();


        return back();
    }
}
