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
                            Productos
                        </strong>
                    </h5>
                    
                    <form class="row" action="{{url('/producto')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        
                        <div class="form-group col-12 col-sm-6">
                            Nombre
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Precio unitario
                            <input type="number" step="0.01" class="form-control" name="precio" value="0">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Costo de envio
                            <input type="number" step="0.01" class="form-control" name="envio" value="0">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Categoría
                            <select name="categoria" class="form-control" required>
                                @foreach ($categorias as $c)
                                    <option>
                                        {{$c->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Subcategoría
                            <select name="subcategoria" class="form-control">
                                @foreach ($subcategorias as $c)
                                    <option value="{{$c->nombre}}">
                                        {{$c->categoria}} - {{$c->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        
                        <div class="form-group col-12 col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="oferta" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Es una oferta?
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group col-12 col-sm-6">
                            <v-file-input label="Imagen de portada" name="portada" accept="image/png, image/jpeg, image/bmp" prepend-icon="mdi-camera" placeholder="Selecciona una imagen"></v-file-input>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <v-file-input label="Imagen de Oferta" name="imagen_oferta" accept="image/png, image/jpeg, image/bmp" prepend-icon="mdi-camera" placeholder="Selecciona una imagen"></v-file-input>
                        </div>

                        <div class="form-group col-12">
                            Descripción
                            <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group col-12">
                            <caracteristicasinput name="caracteristicas"></caracteristicasinput>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Publicar 
                            </button>
                        </div>
                    </form>

                    <hr>

                    {{ $productos->links() }}

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>
                                    Producto
                                </th>
                                <th>
                                    Descripción
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody>
                                @foreach ($productos as $p)
                                    <tr>
                                        <td>
                                            {{$p->nombre}}
                                        </td>
                                        <td>
                                            {{$p->descripcion}}
                                        </td>
                                        <td>
                                            <a href="{{url('/producto').'/'.$p->id.'/edit'}}" class="btn btn-primary m-1">
                                                <v-icon>
                                                    mdi-pencil
                                                </v-icon>
                                                Editar
                                            </a>
                                            <a href="{{url('/producto').'/'.$p->id.'/galeria'}}" class="btn btn-dark m-1">
                                                <v-icon>
                                                    mdi-camera
                                                </v-icon>
                                                Imágenes
                                            </a>
                                            <a href="{{url('/producto').'/'.$p->id}}" class="btn btn-danger m-1">
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
