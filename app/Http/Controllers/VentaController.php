<?php

namespace App\Http\Controllers;
 
use App\Models\MenuItem;
use App\Models\Mesa;
use App\Models\Venta;
use App\Models\Venta_detalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
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
    public function create(Request $request)
    {  
        Mesa::find($request->id_mesa)->update(['estado' => 1]);
        $venta = new  Venta();
        $venta->id_user = Auth::user()->id;
        $venta->id_cliente = $request->id_mesa;
        $venta->total = $request->total;
        $venta->tipo_pago = $request->tipo_pago; 
        $venta->save();  
        $items = json_decode($request->data);
        foreach ($items as $row) {
            $detalle = new Venta_detalle();
            $detalle->id_venta = $venta->id;
            $detalle->id_menu = $row->id;
            $detalle->precio = $row->precio;
            $detalle->cantidad = $row->cantidad;
            $detalle->total = $row->total;
            $detalle->descripcion = $row->descripcion;
            $detalle->save();
        } 
        return response()->json(intval($request->id_client));
    }
    public function update(Request $request)
    {
        $id_mesa= Venta::find($request->id)->id_cliente;
        Mesa::find($id_mesa)->update(['estado' => 0]);
        Venta::find($request->id)->update($request->all());
        return  redirect()->back();
    }
    public function edit(Request $request)
    {
        // jugo=8
        //cena=9
        // naranhja=44
        if ($request->ajax()) {
            $venta=Venta::find($request->id_venta);
            $venta->total=(int)$request->total;
            $venta->save();
            if ($venta->estado==1) { 
                $items = Venta_detalle::where('id_venta', $request->id_venta)->get(); 
                foreach ($items as $row) {
                    MenuItem::find($row->id_menu)->update(['stock' => DB::raw('stock + ' . $row->cantidad)]); 
                }   
                Venta_detalle::where('id_venta',$request->id_venta)->delete();
                $data = json_decode($request->data);
                foreach ($data as $row) {
                    $detalle = new Venta_detalle();
                    $detalle->id_venta = $request->id_venta;
                    $detalle->id_menu = $row->id;
                    $detalle->precio = $row->precio;
                    $detalle->cantidad = $row->cantidad;
                    $detalle->total = $row->total;
                    $detalle->descripcion = $row->descripcion;
                    $detalle->save();
                } 
                $v =Venta_detalle::where('id_venta',$request->id_venta)->get();
                foreach ($v as $row) {
                    $menu= MenuItem::find($row->id_menu);
                    $menu->stock-=$row->cantidad;
                    $menu->save();
                } 
                
            }else{ 
                Venta_detalle::where('id_venta',$request->id_venta)->delete();
                $items = json_decode($request->data);
                foreach ($items as $row) {
                    $detalle = new Venta_detalle();
                    $detalle->id_venta = $venta->id;
                    $detalle->id_menu = $row->id;
                    $detalle->precio = $row->precio;
                    $detalle->cantidad = $row->cantidad;
                    $detalle->total = $row->total;
                    $detalle->descripcion = $row->descripcion;
                    $detalle->save();
                } 
            }
            return response()->json(['url'=>url('/cocina')]);
        }
    }
    public function updated(Request $request)
    {
        if ($request->ajax()) {
            $v=Venta::find($request->id_venta);
            $v->total= $v->total+$request->total;
            $v->save();
            $items = json_decode($request->data);
            foreach ($items as $row) {
                $detalle=Venta_detalle::where('id_venta',$request->id_venta)->where('id_menu',$row->id)->get();
                if(count($detalle)>0){ 
                    foreach ($detalle as $fila) {
                        $fila->cantidad += $row->cantidad;
                        $fila->total += $row->total;
                        $fila->save();
                    } 
                }else {
                    $d = new Venta_detalle();
                    $d->id_venta = $request->id_venta;
                    $d->id_menu = $row->id;
                    $d->precio = $row->precio;
                    $d->cantidad = $row->cantidad;
                    $d->total = $row->total;
                    $d->descripcion = $row->descripcion; 
                    $d->save(); 
                } 
            } 
            return response()->json($request);
        }
    }
}
