<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request; 

class ClienteController extends Controller
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
        $usuarios = Cliente::where('anonimo', 0)->get();
        return view('admin.cliente.index', compact('usuarios'));
    } 
    public function deudas()
    { 
        $usuarios = Cliente::where('anonimo',0)
        ->orderByDesc('deuda')
        ->get();
        return view('admin.cliente.deudas', compact('usuarios'));
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if ($request->id>0) {
            Cliente::findOrFail($request->id)->update($request->all());
        }else{ 
            Cliente::create($request->all());
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
        $client=Cliente::find($request->id);
        $abonos= $client->abono + $request->abono;
        $deuda= $client->deuda;
      
        if ($abonos>0) {
            if($deuda>$abonos){
                $deuda= $deuda-$abonos;
                $abonos=0;
            }else{
                $abonos=$abonos-$deuda;
                $deuda= 0; 
            }
        } 
        Cliente::findOrFail($request->id)->update(['abono'=>  round($abonos, 2),'deuda'=> round($deuda, 2) ]);
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
        Cliente::destroy($id);
        return redirect()->back(); 
    }
}
