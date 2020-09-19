<?php

namespace App\Http\Controllers;

use App\Globales;
use Illuminate\Http\Request;

class GlobalesController extends Controller
{
    public function show($posicion,$tipo='general')
    {
        return Globales::where('posicion',$posicion)->where('tipo',$tipo)->where('visible',true)->get();
    }

    public function index()
    {
        $datos = [
            'globales' => Globales::get()
        ];  

        return view('administracion.globales',$datos);
    }

    public function store(Request $request)
    {
        $g = new Globales();

        $g->nombre = $request->nombre;
        $g->icono = $request->icono;
        $g->valor = $request->valor;
        $g->url = $request->url;
        $g->posicion = $request->posicion;

        $g->save();
        

        return back()->with('msg','Parametro creado');
    }

    public function update(Request $request,$id)
    {
        $g = Globales::find($id);

        if ($request->nombre) {
            # code...
            $g->nombre = $request->nombre;
        }
        if ($request->icono) {
            # code...
            $g->icono = $request->icono;
        }
        if ($request->valor) {
            # code...
            $g->valor = $request->valor;
        }
        if ($request->url) {
            # code...
            $g->url = $request->url;
        }
        if ($request->posicion) {
            # code...
            $g->posicion = $request->posicion;
        }

        $g->save();
        

        return back()->with('msg','Parametro actualizado');
    }

    public function delete($id)
    {
        $g = Globales::find($id);

        $g->delete();
        

        return back()->with('msg','Parametro eliminado');
    }

    public function storeban(Request $request)
    {
        if ($request->file('valor')) {
            # code...
            $nombre = time() . $request->file('valor')->getClientOriginalName();

            $request->file('valor')->move(public_path().'/images/banner',$nombre);

            $g = new Globales();

            $g->nombre = $nombre;
            $g->valor = $nombre;
            
            $g->posicion = 'banner';

            $g->save();
            

            return back()->with('msg','Imagen subida');
        }
        return back()->with('msg','Error ocurrido durante la subida');
    }

    public function deleteban($id)
    {
        $g = Globales::find($id);

        @unlink(public_path().'/images/banner/'.$g->valor);

        $g->delete();

        return back()->with('msg','Imagen eliminada');
    }
}
