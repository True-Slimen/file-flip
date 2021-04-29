<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id', 'type', 'filename', 'filepath', 'folder_id'
    ];

    public function member(){
        return $this->hasMany('App\Right');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
