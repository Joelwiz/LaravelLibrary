<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class categoriaController extends Controller
{
    public function __construct(){
        $this->middleware('RoleAuth')->only('create');
        $this->middleware('RoleAuth')->only('edit','update');
        $this->middleware('RoleAuth')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categorias = categoria::all();
        return view('categoria.index',compact('categorias','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:255',
        ]);
        $input = $request->all();
        categoria::create($input);
        return redirect()->route('categorias.index')->with('success','Categoría añadida correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(categoria $categoria)
    {
        return view('categoria.show',compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(categoria $categoria)
    {
        return view('categoria.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoria $categoria)
    {

        $request->validate([
            'nombre' => 'required|min:3|max:255',
        ]);
        $input = $request->only('nombre');
        //return $input;
        //return $categoria;
        $categoria->nombre = $input['nombre'];
        $categoria->update();
        return redirect()->route('categorias.index')->with('success','Categoría editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')
            ->with('success','Categoría borrada correctamente');
    }
}
