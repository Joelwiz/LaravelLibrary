<?php

namespace App\Http\Controllers;

use App\Models\libro;
use App\Models\sanciones;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Auth;

class sancionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;

        $sanciones = sanciones::query();
        //$usID = DB::table('users')->pluck('role_id');
        $usr1 = 1;
        //$usr2 = 2;
        //$usuarios = User::with('role')->whereRoleId(1)->findOrFail(auth()->id());


        if ($usr1 == $user){

            $sanciones = $sanciones
                ->join('users', 'sanciones.idUsuario', 'users.id')
                ->join('libros', 'sanciones.codLibro', 'libros.id')
                ->select('sanciones.*','libros.nombre','users.*')
                ->get();

        }
        else
        {
            $sanciones = $sanciones
                ->join('users', 'sanciones.idUsuario', 'users.id')
                ->join('libros', 'sanciones.codLibro', 'libros.id')
                ->select('sanciones.*','libros.nombre','users.*')
                ->where('sanciones.idUsuario','=',$user)
                ->get();
        }


        return view('sanciones',compact('sanciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanciones  $sanciones
     * @return \Illuminate\Http\Response
     */
    public function show(sanciones $sanciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanciones  $sanciones
     * @return \Illuminate\Http\Response
     */
    public function edit(sanciones $sanciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sanciones  $sanciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sanciones $sanciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanciones  $sanciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(sanciones $sanciones)
    {
        //
    }
}
