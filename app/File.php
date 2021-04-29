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
        'user_id', 'type', 'filename', 'filepath'
    ];

    public function member(){
        return $this->hasMany('App\Right');
    }
}
