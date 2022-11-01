<?php

namespace App\Http\Controllers\Panel\Administracion\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('can:panel.administracion.categorias.index')->only('index');
        $this->middleware('can:panel.administracion.categorias.show')->only('show');
        $this->middleware('can:panel.administracion.categorias.create')->only('create','store');
        $this->middleware('can:panel.administracion.categorias.edit')->only('edit', 'update');
        $this->middleware('can:panel.administracion.categorias.destroy')->only('destroy');
    }

    public function index()
    {
        $categorias = Categoria::orderByDesc('status')->orderBy('nombre')->get();
        return view('panel.administracion.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('panel.administracion.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
        ]);

        Categoria::create($request->all());

        return redirect()->route('panel.administracion.categorias.index')->with('success', 'Categoría añadida');

    }

    public function show(Categoria $categoria)
    {
        return view('panel.administracion.categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('panel.administracion.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre'=>'required',
        ]);

        $categoria->update($request->all());

        return redirect()->route('panel.administracion.categorias.index')->with('success', 'Categoría editada con éxito');

    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->status == 1) {
            $categoria->update([
                'status'=> 0,
            ]);
            return redirect()->route('panel.administracion.categorias.index')->with('success', 'Categoría anulada.');
        } else {
            $categoria->update([
                'status'=> 1,
            ]);
            return redirect()->route('panel.administracion.categorias.index')->with('success', 'Categoría restablecida.');
        }
        
    }
}
