<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Right;
use App\Folder;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller{

    public function data(){
        $user_current_id =  Auth::user();

        $members = Member::where('user_id', '=', $user_current_id->id)->get();

        $roles = Right::where('user_id', '=', $user_current_id->id)->get();

        $files = File::all();
        $folders = Folder::all();
        return view('/dashboard/dashboard', [
            'files' => $files, 'folders' => $folders, 'users']);

        return view('/dashboard/dashboard', ['user_id' => $user_current_id, 'members' => $members, 'roles' => $roles]);
    }

    /**
     * Creer des users dans la base, à jouer une seul fois depuis le *
     * dashboard.
     * password = motdepasse
     * 
     * A supprimer avant rendu
     * 
     * @return void
     */
    public function createMassUsers(){

        $user = new User();
        $user->firstname = 'Lulu';
        $user->lastname = 'Pineau';
        $user->email = 'pineau@gmail.com';
        $user->password = '$10$hi7N7wGgt/hgWBRxCQWqGeeI9HQJuszdam/R7OopREbZbJg3PIds2';
        $user->save();

        $user = new User();
        $user->firstname = 'Bob';
        $user->lastname = 'Patral';
        $user->email = 'patral@gmail.com';
        $user->password = '$10$hi7N7wGgt/hgWBRxCQWqGeeI9HQJuszdam/R7OopREbZbJg3PIds2';
        $user->save();

        $user = new User();
        $user->firstname = 'Igor';
        $user->lastname = 'Mishkanov';
        $user->email = 'mishkanov@gmail.com';
        $user->password = '$10$hi7N7wGgt/hgWBRxCQWqGeeI9HQJuszdam/R7OopREbZbJg3PIds2';
        $user->save();
        
        $user = new User();
        $user->firstname = 'Adelaïde';
        $user->lastname = 'Menya';
        $user->email = 'menya@gmail.com';
        $user->password = '$10$hi7N7wGgt/hgWBRxCQWqGeeI9HQJuszdam/R7OopREbZbJg3PIds2';
        $user->save();

        return view('/dashboard/dashboard');

    }

    
}
