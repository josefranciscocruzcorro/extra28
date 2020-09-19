<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Galeria;
use App\Globales;
use App\Producto;
use App\Subcategoria;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $datos = [
            'ofertas' => Producto::where('oferta',true)->where('visible',true)->inRandomOrder()->limit(12)->get() 
        ];

        return view('welcome',$datos);
    }

    public function buscar($buscar='')
    {
        $datos = [
            'productos' => Producto::where('visible',true)
        ];

        if ($buscar != '') {
            $busqueda = explode('|',$buscar);

            if (count($busqueda) > 0) {
                # code...
                $datos['productos'] =  $datos['productos']->where('nombre','like','%'.$busqueda[0].'%');
            }
            if (count($busqueda) > 1) {
                # code...
                $datos['productos'] =  $datos['productos']->where('categoria','like','%'.$busqueda[1].'%');
            }
            if (count($busqueda) > 2) {
                # code...
                $datos['productos'] =  $datos['productos']->where('subcategoria','like','%'.$busqueda[2].'%');
            }
        }

        $datos['productos'] =  $datos['productos']->paginate(12);

        return view('buscar',$datos);
    }

    public function apinombreproducto()
    {
        return Producto::where('visible',true)->select('nombre')->get();
    }

    public function apicategorias()
    {
        $datos = [
            'categorias' => Categoria::get(),
            'subcategorias' => Subcategoria::get(),
        ];

        return $datos;
    }

    public function producto($id)
    {
        $datos = [
            'producto' => Producto::find($id),
            'galeria' => Galeria::where('producto_id',$id)->get()
        ];

        return view('producto',$datos);
    }

    public function anexo($nombre)
    {
        $datos = [
            'pagina' => Globales::where('tipo','pagina')->where('nombre',$nombre)->first()
        ];

        return view('anexo',$datos);
    }

    public function password(Request $request)
    {
        $u = User::find(Auth::user()->id);

        $u->password = bcrypt($request->password);

        $u->save();

        return back()->with('msg','Contraseña actualizada');
    }
}
