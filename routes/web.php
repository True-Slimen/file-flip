<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');

Route::view('/manuel', 'manuel');

Route::view('/wiki', 'wiki');

Route::view('/help', 'help');

Route::view('/contact', 'contact');

Route::view('/sign-in', '/sign-in/index');

Route::view('/sign-up', '/sign-up/index');



Auth::routes();

Route::middleware('auth')->group(function () {

    
    
    Route::get('/dashboard','DashboardController@data');

    Route::get('/edit-group','GroupsController@showGroupPage');

    Route::get('/edit-right','RightsController@showRightPage');

    Route::get('/edit-role','RightsController@showRolePage');

    Route::get('/upload-file','FilesController@showUploadPage');


    Route::get('/ged/root','Ged\GedController@gedRoot');

    Route::get('/ged/folder/{id}','Ged\FolderController@gedFolder');
    
    Route::get('/ged/edit-file/{file_id}','Ged\GedController@getFileContent');

    Route::post('/ged/edit/{file_id}','Ged\GedController@edit');

    Route::post('/create-folder','Ged\GedController@createFolder');

    Route::post('/delete-folder','Ged\GedController@deleteFolder');

    Route::post('/delete-file','Ged\GedController@deleteFile');

    Route::post('/copy-file','Ged\GedController@copyFile');

    Route::post('/move-folder','Ged\GedController@moveFolder');

    Route::post('/move-file','Ged\GedController@moveFile');
    
    Route::post('/rename-file','Ged\GedController@renameFile');
    
    Route::post('/rename-folder','Ged\GedController@renameFolder');


    Route::post('/send-new-user','Admin\UsersController@createUserByAdmin');

    Route::view('/create-user','/dashboard/user/user');


    Route::post('/edit-group','GroupsController@createGroup');

    Route::post('/assign-membre','GroupsController@assignMembre');


    Route::post('/assign-right-file','RightsController@assignRightFile');

    Route::post('/assign-right-folder','RightsController@assignRightFolder');
    
    


    Route::post('/assign-role','RightsController@assignRole');

    Route::post('/upload-file','FilesController@postFile')-> name('post.file');
    
    
    // FIXTURES A LANCE DEPUIS LE DASHBOARD POUR PEUPLER LA BASE
    // NE JOUER QU'UNE FOIS
    // PASSWORD : motdepasse
    Route::get('/dashboard/createfixtures','DashboardController@createMassUsers');


});

Route::get('/home', 'HomeController@index')->name('home');