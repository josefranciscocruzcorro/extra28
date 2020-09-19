<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Galeria;
use App\Producto;
use App\Subcategoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $datos = [
            'categorias' => Categoria::get(),
            'subcategorias' => Subcategoria::get(),
            'productos' => Producto::paginate(20)
        ];

        return view('administracion.productos',$datos);
    }

    public function store(Request $request)
    {
        $p = new Producto();

        $p->nombre = $request->nombre;
        $p->descripcion = $request->descripcion;
        $p->caracteristicas = $request->caracteristicas;
        $p->precio = $request->precio;
        $p->envio = $request->envio;
        if ($request->oferta) {
            # code...
            $p->oferta = true;
        }
        $p->categoria = $request->categoria;
        $p->subcategoria = $request->subcategoria;
        
        if ($request->file('portada')) {
            # code...
            $nport = time() . $request->file('portada')->getClientOriginalName();

            $request->file('portada')->move(public_path().'/images/productos',$nport);

            $p->portada = $nport;
        }
        
        if ($request->file('imagen_oferta')) {
            # code...
            $nport = time() . $request->file('imagen_oferta')->getClientOriginalName();

            $request->file('imagen_oferta')->move(public_path().'/images/productos',$nport);

            $p->imagen_oferta = $nport;
        }

        $p->save();

        return back()->with('msg','Producto creado');
    }

    public function delete($id)
    {
        $p = Producto::find($id);

        $g = Galeria::where('producto_id',$id)->get();

        foreach ($g as $gg) {
            # code...
            @unlink(public_path().'/images/productos/'.$gg->imagen);
        }

        $p->delete();

        return back()->with('msg','Producto eliminado');
    }
    
    public function edit($id)
    {
        $datos = [
            'categorias' => Categoria::get(),
            'subcategorias' => Subcategoria::get(),
            'producto' => Producto::find($id)
        ];

        return view('administracion.editarproducto',$datos);
    }

    public function update(Request $request,$id)
    {
        $p = Producto::find($id);

        $p->nombre = $request->nombre;
        $p->descripcion = $request->descripcion;
        $p->caracteristicas = $request->caracteristicas;
        $p->precio = $request->precio;
        $p->envio = $request->envio;
        if ($request->oferta) {
            # code...
            $p->oferta = true;
        }
        $p->categoria = $request->categoria;
        $p->subcategoria = $request->subcategoria;
        
        if ($request->file('portada')) {
            # code...
            $nport = time() . $request->file('portada')->getClientOriginalName();

            $request->file('portada')->move(public_path().'/images/productos',$nport);

            $p->portada = $nport;
        }
        
        if ($request->file('imagen_oferta')) {
            # code...
            $nport = time() . $request->file('imagen_oferta')->getClientOriginalName();

            $request->file('imagen_oferta')->move(public_path().'/images/productos',$nport);

            $p->imagen_oferta = $nport;
        }

        $p->save();

        return back()->with('msg','Producto actualizado');
    }
}
