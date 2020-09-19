<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Pedido;
use App\Producto;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        # code...
        $producto = Producto::find($id);

        $pedido = new Pedido();

        $pedido->nombre = $producto->nombre;
        $pedido->descripcion = $producto->descripcion;
        $pedido->caracteristicas = $producto->caracteristicas;
        $pedido->precio = $producto->precio;
        $pedido->iva = $producto->iva;
        $pedido->envio = $producto->envio;
        $pedido->oferta = $producto->oferta;
        $pedido->portada = $producto->portada;
        $pedido->imagen_oferta = $producto->imagen_oferta;
        $pedido->categoria = $producto->categoria;
        $pedido->subcategoria = $producto->subcategoria;
        $pedido->marca = $producto->marca;

        $pedido->cantidad = $request->cantidad;

        $pedido->producto_id = $producto->id;

        $pedido->user_id = Auth::user()->id;

        $pedido->save();

        return back()->with('msg','Pedido añadido al carrito.');
    }

    public function carrito()
    {
        $datos = [
            'productos' => Pedido::where('pagado',false)->where('user_id',Auth::user()->id)->get()
        ];

        return view('carrito',$datos);
    }

    public function delete($id)
    {
        $p = Pedido::find($id);

        $p->delete();

        return back()->with('msg','Producto removido de su carrito de compras.');
    }

    ///PAGAR
    public function pagar(Request $request)
    {
        if ($request->tipo == 'efectivo') {
            $url = "https://api-uat.kushkipagos.com/cash/v1/tokens";

            $data = array(
                "name" => Auth::user()->name,
                "lastName" => Auth::user()->lastname,
                "email" => Auth::user()->email,
                "identification" => Auth::user()->identification,
                "totalAmount" => floatval($request->total),
                "currency" => $request->currency,
                "documentType" => Auth::user()->documentType,
            );

            if ($request->destino) {
                $data['totalAmount'] = floatval($request->envio);
            }

            $client = new Client([
                'base_uri' => $url,
            ]);

            $options = [
                'headers' => [
                    'Public-Merchant-Id' => env('KUSHKI_PUBLIC'),
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($data)
            ];

            
            try {
                //code...
                $response = $client->request('POST', '',$options);
                $token = json_decode((string)$response->getBody());

                
                if(@$token->token){
                    $url_2 = "https://api-uat.kushkipagos.com/cash/v1/charges/init";

                    $data_2 = [
                        'token' => $token->token,
                        'amount' => [
                            'subtotalIva' => 0,
                            'subtotalIva0' => $data['totalAmount'],
                            'iva' => 0
                        ]
                    ];

                    $client_2 = new Client([
                        'base_uri' => $url_2,
                    ]);
        
                    $options_2 = [
                        'headers' => [
                            'Private-Merchant-Id' => env('KUSHKI_PRIVATE'),
                            'Content-Type' => 'application/json'
                        ],
                        'body' => json_encode($data_2)
                    ];

                    $response_2 = $client_2->request('POST', '',$options_2);
                    $r_2 = json_decode((string)$response_2->getBody(),true);

                    if (@$r_2['pdf']) {
                        # code...
                        $compra = new Compra();

                        $compra->token = $token->token;
                        $compra->user_id = Auth::user()->id;
                        $compra->url_efectivo = $r_2['pdf'][0];
                        $compra->tipo_pago = 'efectivo';

                        $compra->save();

                        $pedidos = Pedido::where('pagado',false)->where('user_id',Auth::user()->id)->get();

                        foreach ($pedidos as $p) {
                            $p->pagado = true;
                            $p->destino = $request->destino;
                            $p->tipo_pago = $request->tipo;
                            $p->compra_id = $compra->id;
                            
                            $p->save();
                        }

                        return back()->with('msg','Orden de pago en efectivo generada. Descarguela ya <a href="'.$r_2['pdf'][0].'" target="_blank" class="btn btn-success">Descargar</a>');
                    } else {
                        # code...
                        return back()->with('msg','No fue posible procesar la solicitud.');
                    }
                                        
                }else{
                    return back()->with('msg','No fue posible procesar la solicitud.');
                }
            } catch (\Throwable $th) {
                //throw $th;
                return back()->with('msg','No fue posible procesar la solicitud.');
            }

        }

        
        if ($request->tipo == 'tarjeta') {
            $url = "https://api-uat.kushkipagos.com/card/v1/tokens";

            $data = [
                "card" => [
                    "name" => $request->name,
                    "number" => $request->number,
                    "expiryMonth" => $request->expiryMonth,
                    "expiryYear" => $request->expiryYear,
                    "cvv" => $request->cvv
                ],


                "totalAmount" => floatval($request->total),
                "currency" => $request->currency,
            ];

            if ($request->destino) {
                $data['totalAmount'] = floatval($request->envio);
            }

            $client = new Client([
                'base_uri' => $url,
            ]);

            $options = [
                'headers' => [
                    'Public-Merchant-Id' => env('KUSHKI_PUBLIC'),
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($data)
            ];

            
            try {
                //code...
                $response = $client->request('POST', '',$options);
                $token = json_decode((string)$response->getBody());

                
                if(@$token->token){
                    $url_2 = "https://api-uat.kushkipagos.com/card/v1/charges";

                    $data_2 = [
                        'fullResponse' => true,
                        'token' => $token->token,
                        'amount' => [
                            'subtotalIva' => 0,
                            'subtotalIva0' => $data['totalAmount'],
                            'iva' => 0
                        ]
                    ];

                    $client_2 = new Client([
                        'base_uri' => $url_2,
                    ]);
        
                    $options_2 = [
                        'headers' => [
                            'Private-Merchant-Id' => env('KUSHKI_PRIVATE'),
                            'Content-Type' => 'application/json'
                        ],
                        'body' => json_encode($data_2)
                    ];

                    $response_2 = $client_2->request('POST', '',$options_2);
                    $r_2 = json_decode((string)$response_2->getBody(),true);

                    if (@$r_2['details']['transactionStatus'] == 'APPROVAL') {
                        # code...
                        $compra = new Compra();

                        $compra->token = $token->token;
                        $compra->user_id = Auth::user()->id;

                        $compra->save();

                        $pedidos = Pedido::where('pagado',false)->where('user_id',Auth::user()->id)->get();

                        foreach ($pedidos as $p) {
                            $p->pagado = true;
                            $p->destino = $request->destino;
                            $p->tipo_pago = $request->tipo;
                            $p->compra_id = $compra->id;
                            
                            $p->save();
                        }
                        return back()->with('msg','Pago realizado exitosamente.');
                    } else {
                        # code...
                        return back()->with('msg','No fue posible procesar la solicitud.');
                    }
                                        
                }else{
                    return back()->with('msg','No fue posible procesar la solicitud.');
                }
            } catch (\Throwable $th) {
                //throw $th;
                return back()->with('msg','No fue posible procesar la solicitud.');
            }

        }
    }
}
