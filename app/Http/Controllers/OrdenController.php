<?php

namespace App\Http\Controllers;
 
use App\Models\Mesa;
use App\Models\Venta;
use App\Models\Venta_detalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
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
        $mesa = Mesa::all();  
        return view('admin.orden.index', compact('mesa'));
    } 

    public function orden(Request $request)
    {
        $mesa= Mesa::find($request->code); 
        $menuitem = DB::table('menu_item')
        ->join('menu', 'menu_item.id_menu', '=', 'menu.id')
        ->select('menu_item.*', 'menu.nombre as menu', 'menu.id as id_menu')
        ->orderByDesc('menu_item.id')
        ->orderBy('menu.nombre')
        ->get();
        
        return view('admin.orden.orden', compact( 'menuitem' ,'mesa'));
    } 

    public function ordenedit(Request $request)
    { 
        $id_mesa= Venta::find($request->code)->id_cliente; 
        $mesa= Mesa::find($id_mesa);  
        $menuitem = DB::table('menu_item')
        ->join('menu', 'menu_item.id_menu', '=', 'menu.id')
        ->select('menu_item.*', 'menu.nombre as menu', 'menu.id as id_menu')
        ->orderByDesc('menu_item.id')
        ->orderBy('menu.nombre')
        ->get();
        $items = DB::table('venta-detalle')
        ->join('menu_item', 'venta-detalle.id_menu', '=', 'menu_item.id')
        ->select('venta-detalle.*', 'menu_item.nombre as nombre' )
        ->where('venta-detalle.id_venta',$request->code)
        ->get();  
        $id_venta =$request->code;
        return view('admin.orden.edit', compact( 'menuitem' ,'mesa', 'items','id_venta' ));
    } 

    public function listo()
    {  
        $fechaactuual=  date('Y-m-d H:i:s');  
        $fecha_hora = Carbon::parse($fechaactuual);
        $fecha_hora->subMinute(10);  
        $ventas = DB::table('venta')
        ->join('cliente', 'venta.id_cliente', '=', 'cliente.id')
        ->select('venta.*', 'cliente.nombre as cliente' ) 
        ->where('venta.estado',3)
        ->whereBetween('venta.updated_at', [$fecha_hora->format('Y-m-d H:i:s'), $fechaactuual]) 
        ->get();   
        return view('admin.orden.listo', compact('ventas'));
    } 
    public function listListo(Request $request)
    {
        $fechaactuual =  date('Y-m-d H:i:s');
        $fecha_hora = Carbon::parse($fechaactuual);
        $fecha_hora->subMinute(10); 
        if ($request->ajax()) {
            $ventas = DB::table('venta')
            ->join('cliente', 'venta.id_cliente', '=', 'cliente.id')
            ->select('venta.*', 'cliente.nombre as cliente')
            ->where('venta.estado', 3)
            ->whereBetween('venta.updated_at', [$fecha_hora->format('Y-m-d H:i:s'), $fechaactuual])
            ->get();  
            return response()->json($ventas);
        }  
    }
    public function listPreparando(Request $request)
    { 
        if ($request->ajax()) {
            $ventas = DB::table('venta')
            ->join('cliente', 'venta.id_cliente', '=', 'cliente.id')
            ->select('venta.*', 'cliente.nombre as cliente')
            ->where('venta.estado', 1)
            ->get();
            return response()->json($ventas);
        }  
    }

    public function preparando()
    {
        $ventas = DB::table('venta')
        ->join('cliente', 'venta.id_cliente', '=', 'cliente.id')
        ->select('venta.*', 'cliente.nombre as cliente')
        ->where('venta.estado', 1)
        ->get();
        // return $ventas;
        return view('admin.orden.preparando', compact('ventas'));
    } 

}
