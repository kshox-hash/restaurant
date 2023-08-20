<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Mesa;
use App\Models\Venta;
use App\Models\Venta_detalle;
use Illuminate\Support\Facades\DB;

class CocinaController extends Controller
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

    public function index()
    { 
        $v = DB::table('venta') 
            ->join('mesa', 'venta.id_cliente', '=', 'mesa.id')
            ->select('venta.*', 'mesa.nombre as mesa') 
            ->where('venta.estado','!=',3)->where('venta.estado', '!=', 2)->get(); 
        $data = array();
        $ventas = array();
        foreach ($v as $row) {
            $data += ['id' => $row->id];
            $data += ['total' => $row->total]; 
            $data += ['mesa' => $row->mesa]; 
            $menuitem = DB::table('venta-detalle')
            ->join('menu_item', 'venta-detalle.id_menu', '=', 'menu_item.id') 
            ->select('venta-detalle.*', 'menu_item.nombre as nombre' )
            ->where('venta-detalle.id_venta', $row->id)
            ->get();
            $data += ['items' => $menuitem]; 
            $data += ['estado' => $row->estado]; 
            array_push($ventas, $data);
            $data = [];
        } 
        $menuitem = DB::table('menu_item')
        ->join('menu', 'menu_item.id_menu', '=', 'menu.id')
        ->select('menu_item.*', 'menu.nombre as menu', 'menu.id as id_menu')
        ->orderByDesc('menu_item.id')
        ->orderBy('menu.nombre')
        ->get();
          
        return view('admin.cocina.index',compact('ventas','menuitem'));
    }
    public function cPreparando($id)
    {
        Venta::findOrFail($id)->update(['estado'=>1]);
        $v =Venta_detalle::where('id_venta',$id)->get();
        $data = [];
        foreach ($v as $row) {
            $menu= MenuItem::find($row->id_menu);
            $menu->stock-=$row->cantidad;
            $menu->save();
            if ($menu->stock < 6) { 
                $data[] = [
                    'nombre' => $menu->nombre,
                    'stock' => $menu->stock,
                ];
            }
        }   
        return redirect()->back()->with(['mensaje' => 'actualizacion correctamente.', 'lowStockItems' => $data ]);
    }
    public function cListo($id)
    {
        Venta::findOrFail($id)->update(['estado' => 3]);
        return redirect()->back(); 
    }

    public function cCancelar($id)
    { 
        $id_mesa =Venta::findOrFail($id)->id_cliente;
        if(Venta::findOrFail($id)->estado==1){
            $items= Venta_detalle::where('id_venta',$id)->get(); 
            foreach ($items as $row) { 
                MenuItem::find($row->id_menu)->update(['stock' => DB::raw('stock + ' . $row->cantidad)]); 
            }
        } 
        Mesa::findOrFail($id_mesa)->update(['estado' =>0]);
        Venta::findOrFail($id)->update(['estado' => 2]); 
        return redirect()->back(); 
    }
}
