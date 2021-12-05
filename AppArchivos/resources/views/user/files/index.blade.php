@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('MIS archivos') }}</div>

                <div class="card-body">
                 
                <div class="table-responsive">
                     <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del archivo</th>
                            <th scope="col">Ver</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            <th scope="row">{{$file->id}}</th>
                            <td>{{$file->name}}</td>
                            <td>
                                <a target="_blank" 
                                   href="{{route('user.files.show', $file->id)}}" 
                                   class="btn btn-sm btn-outline-secondary">
                                   Ver
                                </a>
                            </td>
                            <td>
                                <form action="{{route('user.files.destroy', $file->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger">
                                    Eliminar
                                </button>
                                </form>
                               
                            
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
