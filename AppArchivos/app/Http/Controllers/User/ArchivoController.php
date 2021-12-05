<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Archivo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class ArchivoController extends Controller
{
    
    public function index()
    {
      $files = Archivo::where('user_id', Auth::id())->latest()->get();
      return view('user.files.index', compact('files'));
    }

   
    public function show($id)
    {
        $file = Archivo::whereId($id)->firstOrFail();
        $user_id = Auth::id();

        if($file->user_id == $user_id){
            
            return redirect('/storage'.'/'.$user_id.'/'.$file->name);
            
        }else{
            dd('esta entrando aca');
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $max_size = (int)ini_get('upload_max_filesize') * 10240;
        $files = $request->file('files');
        $user_id = Auth::id();

        if($request->hasFile('files')){
            foreach($files as $file){
                #$fileName = Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                if(Storage::putFileAs('/public/'. $user_id . '/',$file,$file->getCLientOriginalName())){
                    Archivo::create([
                        'name' => $file->getClientOriginalName(),
                        
                        'user_id' => $user_id
                    ]);
                }
            }
            Alert::success('My bien!!', 'Se ha subido el archivo');
            return back();

        }else{
            Alert::error('Error!!', 'Debes subir uno mas archivos');
            return back();
        }

       
        
    }

  
    public function destroy(Request $request,$id)
    {
        //obtiene el archivo que queremos eliminar
        $file = Archivo::whereId($id)->firstOrFail();
        //Esta linea borra el archivo del almacenamiento
        unlink(public_path('storage'.'/'.Auth::id().'/'.$file->name));
        //Este otro borra el registro de la base de datos
        $file->delete();
        //informar del borrado
        Alert::info('Eyyy!!', 'Se ha eliminado el archivo');
        return back();

    }
}
