@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <v-alert type="success">
            {!!session('msg')!!}
        </v-alert>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Carrito de compras
                    </strong>
                </div>

                <div class="card-body">
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
                                    <th>

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
                                        <td>
                                            <a href="{{ url('/carrito').'/'.$p->id }}" class="btn btn-danger">
                                                Eliminar
                                            </a>
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
                                    <td>

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
                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    @if ($total > 0)
                        <b-button v-b-modal.modal-pagar block>Finalizar compra</b-button>

                        <b-modal id="modal-pagar" hide-footer title="Finalizar compra" size=xl>
                            <form action="{{url('/pagar')}}" method="post">
                                @csrf
                                <pago terminos="" privacidad="" name="{{Auth::user()->name}}" lastname="{{Auth::user()->lastname}}" 
                                    identification="{{Auth::user()->identification}}" documentype="{{Auth::user()->documentType}}" 
                                email="{{Auth::user()->email}}" total="{{$total}}" envio="{{number_format($envio,2)}}" 
                                subtotal="{{number_format($subtotal,2)}}"></pago>
                            </form>
                        </b-modal>                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
