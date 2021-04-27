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
        $rights = Right::all();
        

        return view('/dashboard/right/right', [
            'users' => $users, 'rights' => $rights
        ]);
    }
    
}
