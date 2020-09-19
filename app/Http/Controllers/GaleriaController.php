<?php

namespace App\Http\Controllers;

use App\Galeria;
use App\Producto;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index($id)
    {
        $datos = [
            'producto' => Producto::find($id),
            'imagenes' => Galeria::where('producto_id',$id)->get()
        ];

        return view('administracion.galeriaproducto',$datos);
    }

    public function store(Request $request, $id)
    {
        # code...
        if ($request->file('imagen')) {
            $g = new Galeria();
            # code...
            $nport = time() . $request->file('imagen')->getClientOriginalName();

            $request->file('imagen')->move(public_path().'/images/productos',$nport);

            $g->imagen = $nport;
            $g->producto_id = $id;

            $g->save();
            
            return back()->with('msg','Imagen subida');
        }
        return back()->with('msg','Error al intentar subir la imagen.');
    }

    public function delete($id)
    {
        $g = Galeria::find($id);

        @unlink(public_path().'/images/productos/'.$g->imagen);

        $g->delete();

        
        return back()->with('msg','Imagen eliminada');
    }
}
