<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Right;
use App\Folder;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function data()
    {
        $user_current_id =  Auth::user();

        $ownGroups = Member::where('user_id', '=', $user_current_id->id)->get();
        
        $members = User::all();

        $roles = Right::where('user_id', '=', $user_current_id->id)->get();

        $files = File::all();
        $folders = Folder::all();

        $right = Right::all();
        $user = Auth::user();
        // $isadmin = Right::whereRaw('user_id=', $user->id);

        $isadmin = Right::where('user_id', $user->id)
            ->where('type', 10)
            ->get();

        $test = gettype($isadmin);

        return view('/dashboard/dashboard', ['user_id' => $user_current_id, 'members' => $members, 'ownGroups' => $ownGroups, 'roles' => $roles, 'files' => $files, 'folders' => $folders, 'users', 'isadmin'=>$isadmin]);
    }

}
