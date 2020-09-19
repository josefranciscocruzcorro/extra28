<?php

namespace App\Http\Controllers;

use App\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    //
    public function store(Request $request)
    {
        $c = new Subcategoria();

        $c->nombre = $request->nombre;
        $c->categoria = $request->categoria;

        $c->save();

        return back()->with('msg','Subcategoria creada');
    }

    public function delete($id)
    {
        $c = Subcategoria::find($id);

        $c->delete();

        return back()->with('msg','Subcategoria eliminada');
    }
}
