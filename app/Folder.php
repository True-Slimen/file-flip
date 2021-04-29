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
        'user_id', 'foldername', 'folderpath'
    ];

    public function member(){
        return $this->hasMany('App\Right');
    }
}
