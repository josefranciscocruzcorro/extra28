<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Pedido;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function misCompras()
    {
        $datos = [
            'compras' =>Compra::where('user_id',Auth::user()->id)->paginate(10)
        ];

        return view('miscompras',$datos);
    }

    public function compra($id)
    {
        $datos = [
            'compra' => Compra::find($id),
            'productos' => Pedido::where('compra_id',$id)->get()
        ];

        $datos['usuario'] = User::find($datos['compra']->user_id);
        
        return view('compra',$datos);
    }

    public function verificar($id)
    {
        # code...
        $c = Compra::find($id);

        $c->efectivo = true;

        $c->save();

        return back()->with('msg','Pago en efectivo verificado');
    }

    public function enviar($id)
    {
        # code...
        $c = Compra::find($id);

        $c->enviado = true;

        $c->save();

        return back()->with('msg','Pedido enviado');
    }

    
    public function comprassc()
    {
        $datos = [
            'compras' =>Compra::where('efectivo',false)->where('tipo_pago','efectivo')->paginate(10)
        ];

        return view('miscompras',$datos);
    }
    
    public function compraspe()
    {
        $datos = [
            'compras' =>Compra::where('enviado',false)->paginate(10)
        ];

        return view('miscompras',$datos);
    }
    
    public function comprase()
    {
        $datos = [
            'compras' =>Compra::where('enviado',true)->paginate(10)
        ];

        return view('miscompras',$datos);
    }
}
