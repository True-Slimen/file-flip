<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function member(){
        return $this->hasMany('App\Member');
    }

    public function right(){
        return $this->hasMany('App\Right');
    }
}
