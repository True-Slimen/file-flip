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
        'owner_id', 'foldername', 'folderpath', 'parent_folder', 'deep'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function right(){
        return $this->hasMany('App\Right');
    }
}
