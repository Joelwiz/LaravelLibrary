<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
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
        $role_id = Auth::user()->id;
        $usuarios = User::query();
        //$usID = DB::table('users')->pluck('role_id');
        $usr1 = 1;
        //$usr2 = 2;
        //$usuarios = User::with('role')->whereRoleId(1)->findOrFail(auth()->id());


        if ($usr1 == $role_id){

            $usuarios = User::query();

        }
        else
        {
            $usuarios = $usuarios
                ->where('users.id','=',$role_id);
        }
        $usuarios = $usuarios
            ->join('role', 'role.id', 'users.role_id')
            ->select('role.name as role_name','users.*')
            ->get();
        return view('usuario.index',compact('usuarios', 'role_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
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
            'username' => 'required|min:2|max:250',
            'name' => 'required|min:2|max:250',
            'email' => 'required|min:3|max:255',
            'password' => 'required|min:8|max:250',
        ]);
        //return $request->username;
        $user = User::where('username', '=', $request->username)->first();
        if ($user === null) {
            User::create([
                'username'=>$request['username'],
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => 2,
            ]);
            return redirect()->route('usuarios.index')->with('success','User creado correctamente');
        }else{
            return redirect()->route('usuarios.index')->with('failure','User ya existe en la BD.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //return $usuario;
        return view('usuario.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $roles = role::all();
        $role_id = Auth::user()->id;
        //return $roles;
        //return $usuario;
        return view('usuario.edit',compact('usuario', 'roles','role_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $idUser = Auth::user()->id;

        if($idUser == 1){
            $request->validate([
                'username' => 'required|min:2|max:250',
                'name' => 'required|min:2|max:250',
                'email' => 'required|min:3|max:255',
                'password' => 'required|min:8|max:250',
            ]);
            $usuario->update([
                'username'=>$request['username'],
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => $request['role'],
            ]);
        } else if ($idUser == 2){
            $request->validate([
                'username' => 'required|min:2|max:250',
                'name' => 'required|min:2|max:250',
                'email' => 'required|min:3|max:255',
                'password' => 'required|min:8|max:250',
            ]);
            $usuario->update([
                'username'=>$request['username'],
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
        }

        //return $usuario;
        return redirect()->route('usuarios.index')->with('success','User modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success','User borrado correctamente');
    }
}
