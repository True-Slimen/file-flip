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
        'owner_id', 'type', 'foldername', 'folderpath'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function right(){
        return $this->hasMany('App\Right');
    }
}
