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
                        <strong>
                            Parámetros
                        </strong>
                    </h5>

                    <form class="row" action="{{url('/parametros-globales')}}" method="post">
                        @csrf

                        <div class="form-group col-12 col-sm-6 col-md-4">
                            Nombre:
                            <input type="text" class="form-control" name="nombre" required>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-md-4">
                            Posición:
                            <select class="form-control" name="posicion">
                                <option value="cabecera">
                                    Cabecera
                                </option>
                                <option value="pie">
                                    Pie de página
                                </option>
                                <!--<option value="flotante">
                                    Boton flotante
                                </option>-->
                            </select>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-md-4">
                            Ícono:
                            <select class="form-control" name="icono">
                                <option value="">
                                    NINGUNO
                                </option>
                                <option value="mdi-phone">
                                    Teléfono
                                </option>
                                <option value="mdi-car">
                                    Vehículo
                                </option>
                                <option value="mdi-home">
                                    Casa
                                </option>
                                <option value="mdi-webcam">
                                    Cámara
                                </option>
                                <option value="mdi-email">
                                    Correo
                                </option>
                                <option value="mdi-whatsapp">
                                    WhatsApp
                                </option>
                                <option value="mdi-facebook">
                                    Facebook
                                </option>
                                <option value="mdi-youtube">
                                    YouTube
                                </option>
                                <option value="mdi-instagram">
                                    Instagram
                                </option>
                                <option value="mdi-google">
                                    Google
                                </option>
                                <option value="mdi-gmail">
                                    Gmail
                                </option>
                                <option value="mdi-microsoft">
                                    Microsoft
                                </option>
                            </select>
                        </div>

                        
                        <div class="form-group col-12 col-sm-6">
                            Direccion url:
                            <input type="text" class="form-control" name="url">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Valor:
                            <input type="text" class="form-control" name="valor">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Crear
                            </button>
                        </div>
                    </form>      

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Parámetro
                                    </th>
                                    <th>
                                        Posición
                                    </th>
                                    <th>
                                        Ícono
                                    </th>
                                    <th>
                                        URL
                                    </th>
                                    <th>
                                        Valor
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($globales as $g)
                                    @if ($g->posicion != 'banner' && $g->tipo == 'general')
                                        <tr>
                                            <td>
                                                <form action="{{url('/parametros-globales').'/'.$g->id}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        Nombre:
                                                        <input type="text" class="form-control" name="nombre" value="{{$g->nombre}}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <v-icon>
                                                            mdi-content-save
                                                        </v-icon>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{url('/parametros-globales').'/'.$g->id}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        Posición:
                                                        <select class="form-control" name="posicion">
                                                            <option value="{{$g->posicion}}">
                                                                {{$g->posicion}}
                                                            </option>
                                                            <option value="cabecera">
                                                                Cabecera
                                                            </option>
                                                            <option value="pie">
                                                                Pie de página
                                                            </option>
                                                            <!--<option value="flotante">
                                                                Boton flotante
                                                            </option>-->
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">
                                                        <v-icon>
                                                            mdi-content-save
                                                        </v-icon>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{url('/parametros-globales').'/'.$g->id}}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        Ícono: <v-icon>{{$g->icono}}</v-icon>
                                                        <select class="form-control" name="icono">
                                                            @if ($g->icono)
                                                                <option value="{{$g->icono}}">
                                                                    {{$g->icono}}
                                                                </option>
                                                            @endif
                                                            <option value="">
                                                                NINGUNO
                                                            </option>
                                                            <option value="mdi-phone">
                                                                Teléfono
                                                            </option>
                                                            <option value="mdi-car">
                                                                Vehículo
                                                            </option>
                                                            <option value="mdi-home">
                                                                Casa
                                                            </option>
                                                            <option value="mdi-webcam">
                                                                Cámara
                                                            </option>
                                                            <option value="mdi-email">
                                                                Correo
                                                            </option>
                                                            <option value="mdi-whatsapp">
                                                                WhatsApp
                                                            </option>
                                                            <option value="mdi-facebook">
                                                                Facebook
                                                            </option>
                                                            <option value="mdi-youtube">
                                                                YouTube
                                                            </option>
                                                            <option value="mdi-instagram">
                                                                Instagram
                                                            </option>
                                                            <option value="mdi-google">
                                                                Google
                                                            </option>
                                                            <option value="mdi-gmail">
                                                                Gmail
                                                            </option>
                                                            <option value="mdi-microsoft">
                                                                Microsoft
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">
                                                        <v-icon>
                                                            mdi-content-save
                                                        </v-icon>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{url('/parametros-globales').'/'.$g->id}}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        Direccion url:
                                                        <input type="text" class="form-control" name="url" value="{{$g->url}}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">
                                                        <v-icon>
                                                            mdi-content-save
                                                        </v-icon>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{url('/parametros-globales').'/'.$g->id}}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        Valor:
                                                        <input type="text" class="form-control" name="valor" value="{{$g->valor}}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">
                                                        <v-icon>
                                                            mdi-content-save
                                                        </v-icon>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{url('/parametros-globales').'/'.$g->id}}" class="btn btn-danger">
                                                    <v-icon>
                                                        mdi-trash-can
                                                    </v-icon>
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 my-1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <strong>
                            Imágenes del banner
                        </strong>
                    </h5>
                    
                    <form action="{{url('/banner')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        
                        <v-file-input label="Seleccionar imagen" name="valor" accept="image/png, image/jpeg, image/bmp" prepend-icon="mdi-camera" placeholder="Selecciona una imagen"></v-file-input>

                        <button type="submit" class="btn btn-success">
                            Subir imagen
                        </button>
                    </form>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>
                                    Imagen
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody>
                                @foreach ($globales as $g)
                                    @if ($g->posicion == 'banner' && $g->tipo == 'general')
                                        <tr>
                                            <td>
                                                <img src="{{url('/images/banner').'/'.$g->valor}}" height="100">
                                            </td>
                                            <td>
                                                <a href="{{url('/banner').'/'.$g->id}}" class="btn btn-danger">
                                                    <v-icon>
                                                        mdi-trash-can
                                                    </v-icon>
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
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
