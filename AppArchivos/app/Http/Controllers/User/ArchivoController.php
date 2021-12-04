<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Archivo;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class ArchivoController extends Controller
{
    
    public function index()
    {
      $files = Archivo::where('user_id', Auth::id())->latest()->get();
      return view('user.files.index', compact('files'));
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $max_size = (int)ini_get('upload_max_filesize') * 10240;
        $files = $request->file('files');
        $user_id = Auth::id();

        if($request->hasFile('files')){
            foreach($files as $file){
                if(Storage::putFileAs('/public/'. $user_id . '/', $file, $file->getClientOriginalName())){
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
