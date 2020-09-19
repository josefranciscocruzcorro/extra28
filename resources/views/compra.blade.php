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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <strong>
                                        Token
                                    </strong>
                                </td>
                                <td>
                                    {{$compra->token}}
                                </td>
                            </tr>
                            @if ($compra->tipo_pago == 'efectivo')
                                <tr>
                                    <td>
                                        <strong>
                                            Orden de pago
                                        </strong>
                                    </td>
                                    <td>
                                        <a href="{{$compra->url_efectivo}}" target="_blank" class="btn btn-info">
                                            Ver
                                        </a>
                                    </td>
                                </tr>

                                @if (Auth::user()->id == 1)
                                    <tr>
                                        <td>
                                            <strong>
                                                Verificacion de pago de Efectivo
                                            </strong>
                                        </td>
                                        <td>
                                            @if ($compra->efectivo)
                                                <button class="btn btn-success">
                                                    Pago verificado
                                                </button>
                                            @else
                                                <a href="{{url('/compra'.'/'.$compra->id.'/verificar')}}" class="btn btn-dark">
                                                    Verificar que el pago esta hecho
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td>
                                        <strong>
                                            Tipo de pago
                                        </strong>
                                    </td>
                                    <td>
                                        Tarjeta de credito
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td>
                                    <strong>
                                        Envio
                                    </strong>
                                </td>
                                <td>
                                    @if ($compra->enviado)
                                        <button class="btn btn-success">
                                            El pedido fue enviado
                                        </button>
                                    @else
                                        @if (Auth::user()->id == 1)
                                            <a href="{{url('/compra'.'/'.$compra->id.'/enviar')}}" class="btn btn-primary">
                                                Enviar pedido
                                            </a>
                                        @else
                                            <button class="btn btn-warning">
                                                El pedido aun no fue enviado
                                            </button>
                                        @endif
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>
                                        Destino del envio
                                    </strong>
                                </td>
                                <td>
                                    {{@$productos[0]->destino}}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <hr>

                    <center>
                        <strong>
                            Detalles del comprador
                        </strong>
                    </center>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <strong>
                                        Nombre
                                    </strong>
                                </td>
                                <td>
                                    {{$usuario->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Apellido
                                    </strong>
                                </td>
                                <td>
                                    {{$usuario->lastname}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Identificacion
                                    </strong>
                                </td>
                                <td>
                                    {{$usuario->documentType}}
                                    {{$usuario->identification}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Email
                                    </strong>
                                </td>
                                <td>
                                    {{$usuario->email}}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <hr>

                    <center>
                        <strong>
                            Detalles de los productos
                        </strong>
                    </center>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Producto
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Precio unitario
                                    </th>
                                    <th>
                                        I.V.A.
                                    </th>
                                    <th>
                                        Subtotal
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $envio = 0;
                                    $subtotal = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($productos as $p)
                                    @php
                                        if($envio < $p->envio){
                                            $envio = $p->envio;
                                        }
                                        $subtotal += $p->precio*$p->cantidad;
                                        $total += $p->precio*$p->cantidad + $p->precio*$p->cantidad*0.12;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ url('/productos').'/'.$p->producto_id }}" target="_blank" rel="noopener noreferrer">
                                                {{$p->nombre}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$p->cantidad}}
                                        </td>
                                        <td>
                                            ${{number_format($p->precio,2)}}
                                        </td>
                                        <td>
                                            ${{number_format($p->precio*0.12,2)}}
                                        </td>
                                        <td>
                                            ${{number_format($p->precio*$p->cantidad,2)}}
                                        </td>
                                        <td>
                                            ${{number_format($p->precio*$p->cantidad  + ($p->precio*$p->cantidad*0.12),2)}}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            <strong>
                                                TOTAL A PAGAR(Sin incluir el envio):
                                            </strong>
                                        </center>
                                    </td>
                                    <td>
                                        <strong>
                                            ${{number_format($subtotal,2)}}    
                                        </strong>   
                                    </td>
                                    <td>
                                        <strong>
                                            ${{number_format($total,2)}}    
                                        </strong>   
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <center>
                                            <strong>
                                                Costo de envio
                                            </strong>
                                        </center>
                                    </td>
                                    <td>
                                        <strong>
                                            ${{number_format($envio,2)}}    
                                        </strong>   
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
