<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type', 'user_id', 'group_id', 'folder_id','file_id'
    ];
    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function file(){
        return $this->belongsTo('App\File');
    }

    public function folder(){
        return $this->belongsTo('App\Folder');
    }
}
