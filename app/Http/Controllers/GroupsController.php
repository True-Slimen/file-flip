<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use App\Member;
use Illuminate\Http\Request;

class GroupsController extends Controller{
    public function showGroupPage(){

        $groups = Group::all();
        //$groupId = Group::();
        $users = User::all();
        $members = Member::all();

        $arrayGroup = [];

        

        $grouptests = Member::find(1)->user;

        

        return view('/dashboard/group/group', [
            'groups' => $groups, 'users' => $users, 'members' => $members, 'grouptests' => $grouptests
        ]);
    }

    public function createGroup(){

        request()->validate([
            'groupname' => 'required | min:4 | unique:groups,name'
        ]);

        $groupname = request('groupname');

        $group = new Group();
        $group->name = $groupname;
        $group->save();


        return back();
    }
    
    public function assignMembre(){

        request()->validate([
            'username' => 'required',
            'groupname' => 'required',
        ]);

        $groupid = request('groupname');
        $userid = request('username');

        $group = new Member();
        $group->group_id = $groupid;
        $group->user_id = $userid;
        $group->save();


        return back();
    }
}
