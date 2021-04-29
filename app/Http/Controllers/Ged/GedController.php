<?php

namespace App\Http\Controllers\Ged;

use App\File;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GedController extends Controller{
    
    public function gedRoot(){
        $files = File::all();
        $folders = Folder::all();
        return view('/ged/root', [
            'files' => $files, "folders" => $folders
        ]);
    }


}
