@extends('layouts.page')

@section('content')


<v-container fluid>
    @if (session('msg'))
        <v-alert type="success">
            {{session('msg')}}
        </v-alert>
    @endif

    <v-row align="center" no-gutters>

        <v-col align="center" cols="12" sm="6">
            <v-carousel>
                @if (@$producto->portada)
                    <v-carousel-item
                        src="{{url('/images/productos').'/'.$producto->portada}}"
                        reverse-transition="fade-transition"
                        transition="fade-transition"
                    ></v-carousel-item>                    
                @endif
                
                @if (@$producto->imagen_oferta)
                    <v-carousel-item
                        src="{{url('/images/productos').'/'.$producto->imagen_oferta}}"
                        reverse-transition="fade-transition"
                        transition="fade-transition"
                    ></v-carousel-item>                    
                @endif
                
                @if (@$galeria)
                    @foreach (@$galeria as $g)
                        <v-carousel-item
                            src="{{url('/images/productos').'/'.$g->imagen}}"
                            reverse-transition="fade-transition"
                            transition="fade-transition"
                        ></v-carousel-item>
                    @endforeach
                @endif
            </v-carousel>
        </v-col>
        
        <v-col align="center" cols="12" sm="6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Precio:</strong>
                            </td>
                            <td>
                                ${{$producto->precio}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Costo de envío:</strong>
                            </td>
                            <td>
                                @if ($producto->envio > 0)
                                    ${{$producto->envio}}
                                @else
                                    GRATIS
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <v-divider></v-divider>
            <form action="{{url('/pedido').'/'.$producto->id}}" method="post" autocomplete="off">
                @csrf

                <div class="form-group">
                    Cantidad
                    <input type="number" name="cantidad" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark">
                    Añadir al carrito
                </button>
            </form>
        </v-col>

    </v-row>

    <!-- ACA FALTA LA GALERIA Y AGREGAR AL CARRO -->

    <v-row align="center">
        <v-col align="center">
            <h1>
                <strong>
                    {{ @$producto->nombre }}
                </strong>
            </h1>
        </v-col>
    </v-row>

    <v-row align="center">
        <v-col align="center">
            <caracteristicas caracteristicas="{{ @$producto->caracteristicas }}"></caracteristicas>
        </v-col>
    </v-row>

    <v-row align="center">
        <v-col align="center">
            <h3>
                <strong>
                    Descripción
                </strong>
            </h3>
            <br>
            <p class="text-justify">
                {{ @$producto->descripcion }}
            </p>
        </v-col>
    </v-row>
</v-container>

@endsection