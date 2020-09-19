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
                        Producto 
                        <strong>
                            "{{$producto->nombre}}"
                        </strong>
                    </h5>
                    
                    <form class="row" action="{{url('/producto').'/'.$producto->id}}" enctype="multipart/form-data" method="post">
                        @csrf
                        
                        <div class="form-group col-12 col-sm-6">
                            Nombre
                            <input type="text" class="form-control" name="nombre" required value="{{$producto->nombre}}">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Precio unitario
                            <input type="number" step="0.01" class="form-control" name="precio" value="{{$producto->precio}}">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Costo de envio
                            <input type="number" step="0.01" class="form-control" name="envio" value="{{$producto->envio}}">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            Categoría
                            <select name="categoria" class="form-control" required>
                                @if ($producto->categoria)
                                    <option>
                                        {{$producto->categoria}}
                                    </option>                                    
                                @endif
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
                                @if ($producto->subcategoria)
                                    <option>
                                        {{$producto->subcategoria}}
                                    </option>                                    
                                @endif
                                @foreach ($subcategorias as $c)
                                    <option value="{{$c->nombre}}">
                                        {{$c->categoria}} - {{$c->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        
                        <div class="form-group col-12 col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  name="oferta" id="defaultCheck1" 
                                @if ($producto->oferta)
                                    checked
                                @endif
                                >
                                <label class="form-check-label" for="defaultCheck1">
                                    Es una oferta?
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-6">
                            @if ($producto->portada)
                                <v-img src="{{url('/images/productos').'/'.$producto->portada}}"></v-img>
                            @endif
                            <v-file-input label="Imagen de portada" name="portada" accept="image/png, image/jpeg, image/bmp" prepend-icon="mdi-camera" placeholder="Selecciona una imagen"></v-file-input>
                        </div>
                        <div class="col-12 col-sm-6">
                            @if ($producto->imagen_oferta)
                                <v-img src="{{url('/images/productos').'/'.$producto->imagen_oferta}}"></v-img>
                            @endif
                            <v-file-input label="Imagen de Oferta" name="imagen_oferta" accept="image/png, image/jpeg, image/bmp" prepend-icon="mdi-camera" placeholder="Selecciona una imagen"></v-file-input>
                        </div>

                        <div class="form-group col-12">
                            Descripción
                            <textarea name="descripcion" class="form-control" rows="4" required>{{$producto->descripcion}}</textarea>
                        </div>

                        <div class="form-group col-12">
                            <caracteristicasinput name="caracteristicas" value="{{$producto->caracteristicas}}"></caracteristicasinput>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Guardar 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
