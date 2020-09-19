@extends('layouts.page')

@section('content')
    
<banner base="{{url('/')}}"></banner>

<v-container fluid>

    <v-row align="center">
        <v-col align="center">
            <h2>
                <center>
                    <strong>
                        OFERTAS
                    </strong>
                </center>
            </h2>
        </v-col>
    </v-row>

    <v-divider></v-divider>

    <v-row align="center" no-gutters>
        @if (@$ofertas)
            @foreach ($ofertas as $oferta)
                <v-col align="center" cols="12" sm="6" md="4" lg="3">
                    <v-card class="mx-auto">
                        <v-img height="200px" src="{{url('/images/productos').'/'.$oferta->imagen_oferta}}">
                        </v-img>

                        <v-card-actions>
                            <v-btn href="{{ url('/productos').'/'.$oferta->id }}" link x-small>
                                Ver
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            @endforeach
        @endif
    </v-row>

</v-container>
 
@endsection