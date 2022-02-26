<?php

namespace App\Http\Controllers;

use App\Models\prestamo;
use App\Models\sanciones;
use App\Models\User;
use App\Models\libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Nette\Utils\DateTime;


class PrestamoController extends Controller
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
        $user = Auth::user()->id;
        $prestamos = User::query();
        $pre2 = DB::table('prestamos')->pluck('id');
        //$presId = Prestamo::all();
        //$usID = DB::table('users')->pluck('role_id');
        $usr1 = 1;
        //$usr2 = 2;
        //$usuarios = User::with('role')->whereRoleId(1)->findOrFail(auth()->id());


        if ($usr1 == $user){

            $prestamos = $prestamos
                ->join('prestamos', 'prestamos.idUsuario', 'users.id')
                ->join('libros', 'prestamos.codLibro', 'libros.id')
                ->select('prestamos.*', 'prestamos.id as id_prestamo','libros.nombre','users.*')
                ->get();


            //$prestamos2 = prestamo::with('user:id,username','libro')->get();

        }
        else
        {
            $prestamos = $prestamos
                ->join('prestamos', 'prestamos.idUsuario', 'users.id')
                ->join('libros', 'prestamos.codLibro', 'libros.id')
                ->select('prestamos.*', 'prestamos.id as id_prestamo','libros.nombre','users.*')
                ->where('prestamos.idUsuario','=',$user)
                ->get();
            //$prestamos2 = prestamo::with('user:id,username','libro')->get();

        }

        //return $prestamos;
        //return $user;
        return view('prestamo.index',compact('user','prestamos','pre2'));
        //return $usuario;
        /*$prestamos = User::query()
            ->join('prestamos', 'prestamos.idUsuario', 'users.id')
            ->join('libros', 'prestamos.codLibro', 'libros.id')
            ->select('prestamos.*','libros.nombre','users.*')
            ->where('prestamos.idUsuario','=',$usuario->id)
            ->get();*/
        //return $prestamos;
    }
    /*$usuario = Auth::usuario();
        $prestamos = User::query();

        if($usuario->role_id === 1) {
            $prestamos
                ->join('prestamos', 'prestamos.idUsuario', 'users.id')
                ->join('libros', 'prestamos.codLibro', 'libros.id')
                ->select('prestamos.*','libros.nombre','users.*')
                ->get();
            //Or if you have a relation to fetch books for the usuario
            //$query = User::query()->with('books');

        }else{
            $prestamos
                ->join('prestamos', 'prestamos.idUsuario', 'users.id')
                ->join('libros', 'prestamos.codLibro', 'libros.id')
                ->select('prestamos.*','libros.nombre','users.*')
                ->where('prestamos.idUsuario','=',$usuario->id)
                ->get();
            //return $prestamos;
        }
        //return $usuario;
        return view('prestamos',compact('prestamos'));*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $usersPres = User::withCount(['prestamo'=> function(Builder $query){
            $query->whereNull('fechaDevolucion');
        }])->get()->filter(function($item,$key){
            if($item ->prestamo_count<2){
                return $item->name;
            }
        });

        $prestamosAvailable = libro::withCount(['prestamo'=> function(Builder $query){
            $query->whereNull('fechaDevolucion');
        }])->get()->filter(function($item,$key){
            return $item->numEjemplaresDisp > $item ->prestamo_count;
        })->pluck('nombre','id');

        return view('prestamo.create',compact('prestamosAvailable','usersPres'));
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
            'codLibro' => 'required|integer',
            'idUsuario' => 'required|integer',
            'fechaSacado' => 'required|date_format:Y-m-d',
            'fechaEsperada' => 'required|date_format:Y-m-d',
        ]);
        $input = $request->all();

        $UserSanc = sanciones::query();
        $UserSanc = $UserSanc
            ->join('users','sanciones.idusuario','users.id')
            ->select('users.*')
            ->where('sanciones.idusuario', '=', $request->idUsuario)
            ->first();

        if($UserSanc == null){
            prestamo::create($input);
            return redirect()->route('prestamos.index')->with('success','Prestamo añadido correctamente');
        }else{
            return redirect()->route('prestamos.index')->with('failure','Prestamo no añadido, el usuario tiene sancion/es.');
        }

        //$UserSanc = sanciones::where('idusuario', '=', User::get('id'))->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {

        $prestamos = User::query();
        $pre2 = DB::table('prestamos')->pluck('id');
        //$presId = Prestamo::all();
        //$usID = DB::table('users')->pluck('role_id');
        $usr1 = 1;
        //$usr2 = 2;
        //$usuarios = User::with('role')->whereRoleId(1)->findOrFail(auth()->id());

        $prestamos = $prestamos
            ->join('prestamos', 'prestamos.idUsuario',"=", 'users.id')
            //->join('users', 'users.id', 'prestamos.idUsuario')
            ->join('libros', 'prestamos.codLibro',"=", 'libros.id')
            ->select('prestamos.*','libros.nombre as nombre_libro','users.username as nombre_user')
            ->where('prestamos.id',"=",$prestamo->id)
            ->first();

        //return $prestamos;

        return view('prestamo.show',compact('prestamo','prestamos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        return view('prestamo.edit',compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'codLibro' => 'required|integer',
            'idUsuario' => 'required|integer',
            'fechaSacado' => 'required|date_format:Y-m-d',
            'fechaEsperada' => 'required|date_format:Y-m-d',
        ]);
        $input = $request->all();
        $prestamo->update($input);
        return redirect()->route('prestamos.index')->with('success','Prestamo editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        //$x = $prestamo->fechaDevolucion;
        //return $x;
        //$y = $prestamo->fechaEsperada;
        //return $y;
        $now = date('Y-m-d',time());
        //return $prestamo->idUsuario;
        $d1 =strtotime($prestamo->fechaDevolucion);
        $d2 =strtotime($prestamo->fechaEsperada);
        $now2 = date('d',$d1);
        $d3 =(($d1-$d2)/60)/60/24;
        //$d4 = ($d1/60)/60/60/24;
        //return $now;
        //$penal=date("Y-m-d", strtotime($prestamo->fechaDevolucion.'+ '.$d4.' days'));
        $date_expire = '2014-08-06 00:00:00';
        $date = new DateTime($date_expire);
        $now = new DateTime();
        $d4 = new DateTime($prestamo->fechaEsperada);
        $d5 = new DateTime($prestamo->fechaDevolucion);

        $V= $d4->diff($d5)->format("%d día/s.");
        //return $V;
        $post = prestamo::find($prestamo->id);
        if($prestamo->fechaDevolucion == null){
            $post->fechaDevolucion = $now;
            //$post->description = "Updated description";
            //return $post;
            $post->save();
        }else{
            //La fecha no cambia por no ser nula.
        }
        //$user = sanciones::where('idPrestamo', '=', $prestamo->id)->exists();
        $userRecord = sanciones::query();
        $userRecord = $userRecord
            ->join('prestamos', 'sanciones.idPrestamo', 'prestamos.id')
            ->select('sanciones.*')
            ->where('sanciones.idPrestamo','=',$prestamo->id)
            ->first();

        //return $user;
        if(sanciones::where('idPrestamo', '=', $prestamo->id)->exists()){
            return redirect()->route('prestamos.index')
                ->with('failure','Prestamo ya ha sido devuelto anteriormente.');
        }else{
            if($prestamo->fechaDevolucion>$prestamo->fechaEsperada){
                DB::table('sanciones')->insert([
                    'idusuario' => $prestamo->idUsuario,
                    'codLibro'=>$prestamo->codLibro,
                    'idPrestamo'=>$prestamo->id,
                    'finPenalizacion'=>$V,
                    'observacion'=>"Te has pasado ".$d3." día/s.",
                ]);
                //prestamo::where('id',$prestamo->id)->update(['fechaDevolucion'=>$now]);
                /*DB::table('prestamos')->update([
                   'fechaDevolucion' =>$now,
                ]);*/
            }else{
                //No hacer nada en caso contrario.
            }return redirect()->route('prestamos.index')
                ->with('success','Prestamo devuelto correctamente');
        }
        /*$prestamo->delete();*/
    }
}
