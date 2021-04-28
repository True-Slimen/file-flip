<?php

namespace App\Http\Controllers;

use App\User;
use App\Member;
use App\Right;
use Illuminate\Http\Request;

class RightsController extends Controller
{
    public function showRightPage(){

        //$groupId = Group::();
        $users = User::all();
        $rightslist = [
            'Admin', 'Voir', 'Lire', 'Ecrire', 'Supprimer', 'Déplacer', 'Copier'
        ];
        

        return view('/dashboard/right/right', [
            'users' => $users, 'rights' => $rightslist
        ]);
    }

    public function assignRight(){

        request()->validate([
            'username' => 'required',
            'rightname' => 'required',
        ]);

        $rightid = request('rightname');
        $userid = request('username');

        $right = new Right();
        $right->id = $rightid;
        $right->user_id = $userid;
        $right->save();


        return back();
    }
    
}
