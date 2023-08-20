<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    { 
        $data = Mesa::all();
        return view('admin.mesa.index', compact('data'));
    } 
   
    public function store(Request $request)
    { 
        if ($request->id>0) {
            Mesa::findOrFail($request->id)->update($request->all());
        }else{ 
            Mesa::create($request->all());
        }
        return redirect()->back();
    }
  
    public function update(Request $request)
    {
        $client=Mesa::find($request->id);
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
        Mesa::findOrFail($request->id)->update(['abono'=>  round($abonos, 2),'deuda'=> round($deuda, 2) ]);
        return redirect()->back(); 
    }

     
    public function destroy($id)
    {
        Mesa::destroy($id);
        return redirect()->back(); 
    }
}
