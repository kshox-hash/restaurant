<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios= User::all();
        return view('admin.usuario.index',compact('usuarios'));
    }
    
    public function prestamos()
    {
        $usuarios= User::where('rol','!=',1)
        // ->groupBy('rol')
        ->orderBy('adelanto', 'desc')
        ->get();
        return view('admin.usuario.prestamos',compact('usuarios'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = '';
        if ($request->file('img')) {
            $archivo = $request->file('img');
            $url = 'user_' . Str::random(10) . '.png';
            $path = public_path() . '/usuario';
            $archivo->move($path, $url);
        }
        if ($request->id > 0) {
            $user = User::find($request->id);
            if ($user->email != $request->email) {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }
            $user->name = $request->name;
            ($request->rol != null) ? $user->rol = $request->rol : null;
            $user->email = $request->email;  
            ($request->password == null) ? null : $user->password = Hash::make($request->password);
            ($url == "") ? null : $user->img = $url;
            $user->estado = $request->estado;
            $user->save();
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->rol = $request->rol;
            $user->email = $request->email; 
            $user->password = Hash::make($request->password);
            ($url == "") ? null : $user->img = $url;
            $user->estado = $request->estado;
            $user->save();
        }
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        User::findOrFail($request->id)->update($request->all());
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back(); 
    }
}
