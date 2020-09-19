@extends('layouts.page')

@section('content')


<v-container fluid>
    <v-row align="center">
        <v-col align="center">
            {{ $productos->links() }}
        </v-col>
    </v-row>

    <v-row align="center" no-gutters>
        @if (@$productos)
            @foreach ($productos as $producto)
                <v-col align="center" cols="12" sm="6" md="4" lg="3">
                    <v-card class="mx-auto">
                        <v-img height="200px" src="{{url('/images/productos').'/'.$producto->portada}}">
                        </v-img>

                        <v-card-actions>
                            <v-btn href="{{ url('/productos').'/'.$producto->id }}" link x-small>
                                Ver
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            @endforeach
        @endif
    </v-row>

    <v-row align="center">
        <v-col align="center">
            {{ $productos->links() }}
        </v-col>
    </v-row>
</v-container>

@endsection