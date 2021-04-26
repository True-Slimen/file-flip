<?php

namespace App\Http\Controllers\Ged;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GedController extends Controller{
    
    public function gedRoot(){
        return view('/ged/root');
    }
}
