@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('msg'))
        <v-alert type="success">
            {{session('msg')}}
        </v-alert>
    @endif

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ $compras->links() }}

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Forma de pago
                                    </th>
                                    <th>
                                        Estado de envio
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compras as $c)
                                    <tr>
                                        <td>
                                            {{$c->created_at}}
                                        </td>
                                        <td>
                                            @if ($c->tipo_pago == 'efectivo')
                                                <button class="btn btn-info">
                                                    Orden de pago en efectivo generada
                                                </button>
                                            @else
                                                <button class="btn btn-secondary">
                                                    Tarjeta de credito
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($c->enviado)
                                                <button class="btn btn-success">
                                                    Pedido ya fue enviado
                                                </button>
                                            @else
                                                <button class="btn btn-warning">
                                                    El pedido aun no fue enviado
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/compra'.'/'.$c->id)}}" class="btn btn-dark">
                                                Detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $compras->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
