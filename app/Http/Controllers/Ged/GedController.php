<?php

namespace App\Http\Controllers\Ged;

use App\File;
use App\Right;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Stacktrace\File as StacktraceFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class GedController extends Controller{
    
    public function gedRoot(){

        //'Voir', 'Lire', 'Ecrire', 'Supprimer', 'Déplacer', 'Copier'

        $userData = Auth::user();
        $rights = Right::all();

        $isAdmin = Right::where('user_id', $userData->id)
            ->where('type', 10)
            ->get();
        
       

        Storage::disk('uploads')->put('example.txt', 'Contents');
        $folder = Folder::all();
        $file = File::all();

        //$content = Storage::disk('uploads')->get('example.txt');

        return view('/ged/root',['folderlists'=> $folder, 'filelist'=> $file, 'isAdmins'=> $isAdmin, 'rights' => $rights]);
    }

    public function createFolder()
    {
        
        $folder_array = request('parent_folder');
        $jObj = json_decode($folder_array); 

        if($jObj==null)
        {
            $parent_id = 0;
            $parent_deep = 1;
        }
        else{
            $parent_id = $jObj->id;
            $parent_deep = $jObj->position_folder;
        };

        $foldername = request('foldername');
        $user_id = Auth::user()->id ;
        $folder = new Folder();
        $folder->foldername = $foldername;
        $folder->owner_id = $user_id;
        $folder->parent_folder = $parent_id;
        $folder->position_folder = 0;

        if($parent_id == 0)
        {
            $path = public_path('uploads').'\\' . $foldername ;
            $folder->folderpath = $path ;
            $newDirectory = FacadesFile::makeDirectory($path);
        }
        else 
        {
            $parent_folder = Folder::where('id', $parent_id) -> first();
            $same_name = Folder::where('parent_folder', $parent_id) -> where('foldername', $foldername) -> first();
            if($same_name != null)
            {
                return back ()
                ->with('error','Le dossier existe déjà. Veuillez le renommer s\'il vous plait.')
                ->with('folder',$foldername);
            }
            $parent_path = $parent_folder ->folderpath ;
            $folder->folderpath = $parent_path . '\\' . $foldername ;
            $folder->save();
            $newDirectory = FacadesFile::makeDirectory($parent_path . '\\' . $foldername);

        }


        if($newDirectory)
        {
            $folder->save();
            $folder_id = $folder -> id;
            for($i = 1 ; $i <= 6 ; $i++) //assignation de tous les droits sur le dossier à l'utilisateur
            {
                $newRight = new Right();
                $newRight -> user_id = $user_id;
                $newRight ->folder_id = $folder_id;
                $newRight -> type = $i;
                $newRight->save();
            }
            
            return back()
            ->with('success','Dossier créé avec succès !')
            ->with('folder',$foldername);
        }
        else
        {
            return back ()
            ->with('error','Une erreur est survenue. Veuillez recommencer s\'il vous plait.')
            ->with('folder',$foldername);
        }
    }

    public function deleteFolder()
    {
        $folder_id = request('folder_id');
        $deletingFolder = Folder::where('id', $folder_id) -> first();
        $folder_name= $deletingFolder -> foldername;
        $folder_id= $deletingFolder -> id;
        $deletingFiles = File::where('folder_id', $folder_id) -> get();
        $deletingFolders = Folder::where('parent_folder', $folder_id);

        //suppresion des fichiers contenus dans le dossier
        foreach($deletingFiles as $deletingFile)
        {   $file_name = $deletingFile -> filename; 
            Right::where('file_id', $deletingFile->id)->delete();
            File::where('id', $deletingFile->id)->delete();
            //Storage::disk('uploads')->delete($folder_name . '\\' . $file_name);
        }

        foreach($deletingFolders as $deletingFolder)
        {
            Right::where('folder_id', $deletingFolders->id)->delete();
            Folder::where('parent_folder', $deletingFolders -> id)->delete();
        }

        //suppression physique du dossier et de son contenu
        Storage::disk('uploads')->deleteDirectory($folder_name);

        //suppression du dossier en base  
        Right::where('folder_id', $folder_id)->delete();
        Folder::where('id', $folder_id)->delete();

        // Storage::disk('uploads')->delete('')
        
        


        return back();
    }


    public function deleteFile()
    {
        $file_id = request('file_id');
        $fileDelete = File::where('id', $file_id) -> first();
        $file_name = $fileDelete -> filename ;
        $folder_id = $fileDelete -> folder_id;

        //suppresion physique du fichier
        if($folder_id != 0 ) //si le fichier est contenu dans un dossier
        {
            $parent_folder = Folder::where('id', $folder_id) -> first();
            $folder_name = $parent_folder -> foldername ;
            Storage::disk('uploads')->delete($folder_name . '\\' . $file_name);
        }
        else //si le fichier est à la racine
        {
            Storage::disk('uploads')->delete($file_name);
        }

        //supression en base du fichier
        Right::where('file_id', $fileDelete->id)->delete(); 
        File::where('id', $fileDelete->id)->delete();

        return back()
        ->with('success','Fichier ' . $file_name . ' supprimé avec succès !')
        ->with('file',$file_name);
    }

    public function copyFile() {
        $file_id = request('file_id');
        $folder_id = request('parent_folder');
        $copyFile = File::where('id', $file_id) -> first();
        $copyFolder = Folder::where('id', $folder_id) -> first();
        $path = public_path('uploads');


        $file = new File();
        $file->owner_id = $copyFile->owner_id;
        
        $file->type =  $copyFile->type;
        $file->filename =  $copyFile->filename;
        if($copyFolder !== null){
            $file->filepath = $copyFolder->folderpath;
            $file->folder_id = $copyFolder->id;
        }
        else{
            $file->filepath = $path;
        }
        // $file->filepath =  $copyFile -> "";
        $file->save();

        $fileToCopyEndPath = str_replace($path, '', $copyFile->filepath).'\\'.$copyFile->filename;
        $fileCopiedEndPath = str_replace($path, '', $file->filepath).'\\'.$copyFile->filename;

        // Storage::disk('uploads')->put('pathsss.txt', $fileToCopyEndPath.'->>>'.$copyFile->filepath.'-----------'.$fileCopiedEndPath.'-->>>>'.$file->filepath);




        Storage::disk('uploads')->copy($fileToCopyEndPath, $fileCopiedEndPath);

        for($i = 1 ; $i <= 6 ; $i++) //assignation de tous les droits sur le fichier à l'utilisateur
        {
            $newRight = new Right();
            $newRight -> user_id = $copyFile->owner_id;
            $newRight ->file_id = $file->id;
            $newRight -> type = $i;
            $newRight->save();
        }
    }

    public function moveFile() 
    {
        $file_id = request('file_id');
        $moving_file = File::where('id', $file_id) -> first();
        $file_name = $moving_file -> filename;
        $folder_id = $moving_file -> folder_id;

        $folder_to_move_id = request('folder_id'); //id du dossier où l'on souhaite déplacer le fichier
        $folder_to_move = Folder::where('id', $folder_to_move_id) -> first();
        $folder_path = $folder_to_move -> folderpath; //path du dossier où l'on souhaite déplacer le fichier

        $file_path = $moving_file -> filepath; //path initial du fichier à déplacer

        Storage::disk('uploads') -> move($file_path, $folder_path);
        $moving_file -> filepath = $folder_path .'\\'. $file_name; //update path file
        $moving_file->save();
    }

    public function moveFolder() 
    {

    }

    public function renameFile(Request $request)
    {
        $file_id = $request->input('file_id'); //nouveau nom du fichier 
        $file = File::where('id', $file_id) -> first();
        $file_name = $file -> filename;
        //$file = File::find($file_id);
        $type = $file -> type;
        $new_name = $request->input('new_name') . "." . $type;
        $file_path = $file -> filepath . '\\' . $file_name;
        $new_path =  $file -> filepath . '\\' . $new_name . '.' . $type;

        //renomme physiquement le fichier
        Storage::disk('uploads') -> move($file_name, $new_name . "." . $type); 

        //renomme le fichier en base 
        $file -> filepath = $new_path;
        $file -> filename = $new_name;
        $file->save();

        return back()
        ->with('success','Fichier renommé avec succès !');
    }

    public function renameFolder()
    {
        $folder_id = request('folder_id');
        $new_name = request('folder_name'); //nouveau nom du fichier 
        $folder = Folder::find($folder_id);
        $folder_path = $folder -> fodlerpath;
        $folder_name = $folder -> fodlername;
        // $str = substr($str, 0, strpos($str, '-'));
        $new_path = substr($folder_path, 0); // $folder_path - $folder_name

        //renomme physiquement le fichier
        Storage::move($folder_path, $new_path); 

        //renomme le fichier en base 
        $folder -> folderpath = $new_path;
        $folder -> foldername = $folder_name;
        $folder->save();

        return back()
        ->with('success','Dossier renommé avec succès !');
    }

    public function getFileContent()
    {   
        $file_id = request('file_id');
        $file = File::where('id', $file_id);
        $file_name = $file -> filename;
        $file_path = $file -> filepath;
        $content = file_get_contents($file_path);

        return view('/ged/editFile',['content'=> $content]);
    }

    public function edit() 
    {
            
            //file_put_contents();
    }
}
