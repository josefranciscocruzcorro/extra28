@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <v-alert type="success">
            {{session('msg')}}
        </v-alert>
    @endif

    <div class="row">
        
        <div class="col-12 my-1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Galeria de imagenes de 
                        <strong>
                            "{{$producto->nombre}}"
                        </strong>
                    </h5>

                    <form action="{{url('/imagen-p').'/'.$producto->id}}" enctype="multipart/form-data" method="post">
                        @csrf
                        
                        <v-file-input label="Imagen" name="imagen" accept="image/png, image/jpeg, image/bmp" prepend-icon="mdi-camera" placeholder="Selecciona una imagen"></v-file-input>
                        
                        <button type="submit" class="btn btn-success">
                            Subir imagen 
                        </button>
                    </form>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Imagen
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imagenes as $i)
                                    <tr>
                                        <td>
                                            <img src="{{url('/images/productos').'/'.$i->imagen}}" height="200">
                                        </td>
                                        <td>
                                            <a href="{{url('/imagen-p').'/'.$i->id}}" class="btn btn-danger">
                                                <v-icon>
                                                    mdi-trash-can
                                                </v-icon>
                                                Eliminar
                                            </a>
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
