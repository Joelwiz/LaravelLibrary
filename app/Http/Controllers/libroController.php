<?php

namespace App\Http\Controllers;

use App\Models\libro;
use App\Models\categoria;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class libroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //$libros = libro::paginate(4);
        Paginator::useBootstrap();


        $tableUsers = libro::join('categorias', 'categorias.id', '=', 'libros.categoriaId')
            ->select('libros.*', 'categorias.nombre as categoria_rol')
            ->paginate(4);
        //return $tableUsers;

        return view('libro.index',compact('user','tableUsers'));
    }

    public function __construct(){
        $this->middleware('RoleAuth')->only('create');
        $this->middleware('RoleAuth')->only('edit','update');
        $this->middleware('RoleAuth')->only('destroy');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libro.create');
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
            'ISBN' => 'required|min:9|max:9',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|min:3|max:255',
            'autor' => 'required|min:10|max:4096',
            'editorial' => 'required|min:3|max:255',
            'numEjemplaresDisp' => 'required|min:1|max:25',
            'categoriaId' => 'required|min:1|max:3',
        ]);
        $input = $request->except('_token');
        if ($image = $request->file('imagen')) {
            $imageDestinationPath = 'storage/images';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['imagen'] = $postImage;
            //return $input['imagen'];
        }
        //dd($input);
        libro::create($input);
        return redirect()->route('libros.index')->with('success','Libro añadido correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(libro $libro)
    {
        $cat = categoria::where('id',$libro->categoriaId)->select('nombre')->firstOrFail();
        $libro['categoriaId']=$cat['nombre'];
        //return $libro;
        return view('libro.show',compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(libro $libro)
    {
        return view('libro.edit',compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, libro $libro)
    {
        $request->validate([
            'ISBN' => 'required|min:9|max:9',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|min:3|max:255',
            'autor' => 'required|min:10|max:4096',
            'editorial' => 'required|min:3|max:255',
            'numEjemplaresDisp' => 'required|min:1|max:25',
            'categoriaId' => 'required|min:1|max:2',
        ]);
        $input = $request->all();
        if ($image = $request->file('imagen')) {
            $imageDestinationPath = 'storage/images';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['imagen'] = "$postImage";
        } else {
            unset($input['imagen ']);
        }
        $libro->update($input);
        return redirect()->route('libros.index')->with('success','Libro añadido correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')
            ->with('success','Libro borrado correctamente');
    }

    public function relatLibCat($categoriaId)
    {
        $libros = libro::query()->where('categoriaId', "=",$categoriaId)->get();
        return view('categoria.show', compact('libros'));
    }

    public function searchBooks(Request $request){

        $InputTexto = trim($request->get('InputTexto'));
        if(!empty($InputTexto)){
            $libros = Libro::where('nombre','like','%'.$InputTexto.'%')->paginate(4);
            Paginator::useBootstrap();
        }
        return view('libro.index',compact("libros"));
    }
}
