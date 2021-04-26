<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function data(){
        return view('/dashboard/dashboard');
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
