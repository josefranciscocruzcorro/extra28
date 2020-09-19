<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Subcategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        # code...
        $datos = [
            'categorias' => Categoria::get(),
            'subcategorias' => Subcategoria::get(),
        ];

        return view('administracion.categorico',$datos);
    }

    public function store(Request $request)
    {
        $c = new Categoria();

        $c->nombre = $request->nombre;

        $c->save();

        return back()->with('msg','Categoria creada');
    }

    public function delete($id)
    {
        $c = Categoria::find($id);

        Subcategoria::where('categoria', $c->nombre)->delete();

        $c->delete();

        return back()->with('msg','Categoria eliminada');
    }
}
