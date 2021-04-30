<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id', 'foldername', 'folderpath', 'parent_folder', 'position_folder'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function right(){
        return $this->hasMany('App\Right');
    }

    public function file(){
        return $this->hasMany('App\File');
    }
}