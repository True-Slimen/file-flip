<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Group;
use App\Right;
use App\Folder;
use App\Member;
use Illuminate\Http\Request;

class RightsController extends Controller
{
    public function showRightPage(){

        $files = File::all();
        $folders = Folder::all();
        $users = User::all();

        $rightslist = [
            'Voir', 'Lire', 'Ecrire', 'Supprimer', 'Déplacer', 'Copier'
        ];

        return view('/dashboard/right/right', [
            'users' => $users, 'rights' => $rightslist, 'files' => $files, 'folders' => $folders
        ]);
    }


    public function showRolePage(){

        $groups = Group::all();
        $users = User::all();
        $rolesList = Right::all();
        $rolesName = [
            'Admin', 'Membre'
        ];

        return view('/dashboard/right/role', [
            'users' => $users, 'roles' => $rolesName, 'groups' => $groups, 'roleslist' => $rolesList
        ]);
    }

    public function assignRole(){
        
        request()->validate([
            'username' => 'required',
            'rolename' => 'required',
        ]);

        $rightid = request('rolename');
        $rightid = $rightid + 10;
        $userid = request('username');

        $right = new Right();
        $right->type = $rightid;
        $right->user_id = $userid;
        $right->save();

        return back();
    }
    
    public function assignRightFile(){
        $rightslist = [
            'Voir', 'Lire', 'Ecrire', 'Supprimer', 'Déplacer', 'Copier'
        ];

        request()->validate([
            'username' => 'required',
            'rightname' => 'required',
            'filename' => 'required',
        ]);

        $rightid = request('rightname');
        $rightid = $rightid + 1;
        $userid = request('username');
        $fileid = request('filename');

        // $username = User::where('id', '=', $userid)->get();

        // $filename = File::where('id', '=', $fileid)->get();
        //$filename = $filename->filename;

        $existRight = Right::where('user_id', '=', $userid)
        ->where('file_id', '=', $fileid)
        ->where('type', '=', $rightid)
        ->get();

        if(count($existRight) < 1){
            $right = new Right();
            $right->type = $rightid;
            $right->user_id = $userid;
            $right->file_id = $fileid;
            $right->save();
    
    
            return back()
            ->with('success', 'Le droit à bien été ajouté');
        }

        return back()
        ->with('error', 'Le droit existe déjà');
       
    }

    public function assignRightFolder(){

        $files = File::all();
        $folders = Folder::all();
        $users = User::all();

        $rightslist = [
            'Voir', 'Lire', 'Ecrire', 'Supprimer', 'Déplacer', 'Copier'
        ];



        request()->validate([
            'username' => 'required',
            'rightname' => 'required',
            'foldername' => 'required',
        ]);

        $test = "teeeest";


        $rightid = request('rightname');
        $rightid = $rightid + 1;
        $userid = request('username');
        $folderid = request('foldername');

        $existRight = Right::where('user_id', '=', $userid)
        ->where('folder_id', '=', $folderid)
        ->where('type', '=', $rightid)
        ->get();

        if(count($existRight) < 1){

            $right = new Right();
            $right->type = $rightid;
            $right->user_id = $userid;
            $right->folder_id = $folderid;
            $right->save();

            return back()
            ->with('success', 'Le droit à bien été ajouté');
        }
        return back()
        ->with('error', 'Le droit existe déjà');
    }
}
