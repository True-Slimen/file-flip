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

        $user = Auth::user();
        $rights = Right::all();

        $isAdmin = Right::where('user_id', $user->id)
            ->where('type', 10)
            ->get();
        
       

        Storage::disk('uploads')->put('example.txt', 'Contents');
        $folder = Folder::all();
        $file = File::all();
        $see_rights = Right::where('user_id', $user->id)->where('type', 1)->get();

        $file_ids = [];
        foreach($see_rights as $see) 
        {
            $file_id = $see->file_id;
            array_push($file_ids, $file_id);
        }

        $files = [];
        foreach($file_ids as $id)
        {
            $filess = File::find($id);
            array_push($files, $filess);

        }
        Storage::disk('uploads')->put('example.txt', $files);
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
            if( is_dir($path))
            {
                return back ()
                ->with('error','Le dossier existe déjà. Veuillez le renommer s\'il vous plait.')
                ->with('folder',$foldername);
            }
            else
            {
                $newDirectory = FacadesFile::makeDirectory($path);
            }
            
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
            
        
        
        Storage::disk('uploads')->copy($fileToCopyEndPath, $fileCopiedEndPath);
        
        for($i = 1 ; $i <= 6 ; $i++) //assignation de tous les droits sur le fichier à l'utilisateur
        {
            $newRight = new Right();
            $newRight -> user_id = $copyFile->owner_id;
            $newRight ->file_id = $file->id;
            $newRight -> type = $i;
            $newRight->save();
        }

        return back()
        ->with('success','Fichier déplacé avec succès !');
    }

    public function moveFile(Request $request) 
    {
        $file_id = $request->input('file_id');
        $moving_file = File::where('id', $file_id) -> first();
        //$moving_folder = Folder::where('id', $folder_id) -> first();
        $file_name = $moving_file -> filename ;
        $folder_id = $moving_file -> folder_id;
        $folder_to_move_id = request('parent_folder'); //id du dossier où l'on souhaite déplacer le fichier
        $folder_initial = Folder::where('id', $folder_id) -> first();
        if($folder_initial != null) {

            $moving_file -> filepath = public_path('uploads') ; //update path file
            $moving_file -> folder_id = null ; //update parent folder
            $moving_file->save();
            Storage::disk('uploads') -> move( '\\'. $folder_initial->foldername . '\\'.$file_name, $file_name);

            return back()
            ->with('success','Fichier ' . $file_name . ' déplacé avec succès !')
            ->with('file',$file_name);
        }
        $folder_to_move = Folder::where('id', $folder_to_move_id) -> first();
        $folder_name = $folder_to_move -> foldername; //path du dossier où l'on souhaite déplacer le fichier
        $folder_path = $folder_to_move -> folderpath; //path du dossier où l'on souhaite déplacer le fichier
        
        $name = "/" . $file_name;
        $names = "/" . $folder_name;
        $file_path = $moving_file -> filepath . '\\'. $file_name; //path initial du fichier à déplacer

        Storage::disk('uploads') -> move( $file_name, $folder_name . '\\'.$file_name);
        $moving_file -> filepath = $folder_path ; //update path file
        $moving_file -> folder_id = $folder_to_move_id ; //update parent folder
        $moving_file->save();
        return back()
        ->with('success','Fichier ' . $file_name . ' déplacé avec succès !')
        ->with('file',$file_name);
    }

    public function moveFolder() //Feature à venir
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
        $new_path =  $file -> filepath . '\\' . $new_name;
        $files = Storage::disk('uploads') -> allFiles('/');
        Storage::disk('uploads')->put('ff.txt', $files);
        //renomme physiquement le fichier
        Storage::disk('uploads') -> move($file_name, $new_name); 

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
        $folder_path = $folder -> folderpath;
        
        $folder_name = $folder -> foldername;
        $folder_parent_id = $folder -> parent_folder;
        $len_folder_root= strlen(public_path('uploads'));
        $path = substr($folder_path, $len_folder_root);
        if($folder_parent_id != 0){
            $len_name =  strlen($folder_name);
            $original_path = substr($folder_path,0, -$len_name);
            //renomme physiquement le fichier
            Storage::disk('uploads')->put('examplqse.txt', [$path, $folder_path, $original_path] );
            $new_path = substr($path, 0, -$len_name) . $new_name ;
            Storage::disk('uploads') -> move($path, $new_path); 
    
            //renomme le fichier en base 
            $folder -> folderpath = $original_path . $new_path;
            $folder -> foldername = $new_name;
            $folder->save();
    
            return back()
            ->with('success','Dossier renommé avec succès !');

        }
        else 
        {
            $len_name =  strlen($folder_name);
            $original_path = substr($folder_path,0, -$len_name);
            $new_path = substr($folder_path, 0, -$len_folder_root); // $folder_path - $fold
            //renomme physiquement le fichier
            Storage::disk('uploads')->put('examplqse.txt', [$path, $folder_path ] );
            Storage::disk('uploads') -> move($path, '\\'.$new_name); 
    
            //renomme le fichier en base 
            $folder -> folderpath = $original_path . $new_name;
            $folder -> foldername = $new_name;
            $folder->save();
    
            return back()
            ->with('success','Dossier renommé avec succès !');
        }
        // $str = substr($str, 0, strpos($str, '-'));
 // $folder_path - $folder_name
  
    }

    public function getFileContent($file_id)    //permet d'afficher le contenu d'un fichier
    {   
        Storage::disk('uploads')->put('examplqse.txt',$file_id );
        $file = File::find($file_id);
        $file_name = $file -> filename;
        $file_path = $file -> filepath;
        $content = file_get_contents($file_path . '\\'. $file_name);

        return view('/ged/editFile',['content'=> $content, 'file_id' =>$file_id]);
    }

    public function edit($file_id) //permet d'éditer le contenu d'un fichier txt
    {
            $file = File::where("id", $file_id) -> first();
            $file_name = $file->filename;
            $name = substr($file_name, 0, -4);
            $today = date("d.m.y"); 
            $file_path = $file -> filepath;
            $content =request('content');
            Storage::disk('uploads') -> move($file_name, '\\versionning\\'.$name. '_'.$today.'.txt'); 
            file_put_contents($file_path . '\\'. $file_name, $content);
            return redirect('/ged/root')
            ->with('success','Fichier '.$file_name.' sauvegardé avec succès !');
    }
}
