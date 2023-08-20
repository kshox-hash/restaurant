<?php

namespace App\Http\Controllers;

use App\Models\Reportar;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $topclient = DB::table('cliente')
            ->join('venta', 'cliente.id', '=', 'venta.id_cliente')
            ->where('cliente.anonimo',0)
            ->select('cliente.nombre', 'cliente.telefono', DB::raw('count(*) as total'))
            ->groupBy('cliente.nombre', 'cliente.telefono')
            ->orderByDesc('total')
            ->limit(5)->get();
        $tipo_pago = DB::table('venta')  
            ->select('venta.tipo_pago', DB::raw('count(*) as total'))
            ->groupBy('venta.tipo_pago')
            ->orderByDesc('total')
            ->get();
        $gastos=  DB::table('gastos')->sum('costo');
        $ingresos= DB::table('venta')->sum('total');
        return view('home',compact('topclient', 'tipo_pago','gastos','ingresos'));
    }
    public function reportar(Request $request)
    { 
        $reportrespondida = Reportar::where('id_user', Auth::user()->id)->where('estado', true)->count();
        $report = DB::table('reportar')
        ->join('users', 'reportar.id_user', '=', 'users.id')
        ->select('users.name as usuario',  'reportar.*')
        ->where('id_user', Auth::user()->id)
        ->orderByDesc('reportar.id')
        ->get();
        return view('admin.insidencias.reportar', compact('report', 'reportrespondida'));
    }
    public function create(Request $request)
    {
        $id_user = Auth::user()->id;
        $url = '';
        if ($request->file('img')) {
            $archivo = $request->file('img');
            $url = 're_' . Str::random(10) . '.png';
            $path = public_path() . '/report';
            $archivo->move($path, $url);
        }
        if ($request->id > 0) {
            $producto =  Reportar::find($request->id);
            $producto->respuesta = $request->respuesta;
            $producto->estado = true;
            $producto->save();
        } else {
            $producto = new Reportar();
            $producto->id_user = $id_user;
            $producto->asunto = $request->asunto; 
            $producto->descripcion = $request->descripcion;
            $producto->img = $url;
            $producto->estado = false;
            $producto->save();
        }
        return redirect()->back();
    }
    public function vieadmin()
    {
        $report = DB::table('reportar')
        ->join('users', 'reportar.id_user', '=', 'users.id')
        ->select('users.name as usuario',  'reportar.*') 
        ->orderBy('reportar.estado')
        ->orderByDesc('reportar.id')
        ->get();
        return view('admin.insidencias.index', compact('report'));
    }
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $report = DB::table('reportar')
            ->join('users', 'reportar.id_user', '=', 'users.id')
            ->select('users.name as user', 'users.img as perfil',  'reportar.*')
            ->where('reportar.id', $request->id)
                ->get();
            return response()->json($report);
        }
    }
    public function reportrepartidor(Request $request)
    {
        $user = User::wherein('rol',[1,3])->get();
        $datamesa=DB::table('venta')
                ->join('mesa', 'venta.id_cliente', '=', 'mesa.id') 
                ->select('mesa.nombre as mesa', 'venta.*')
                ->where('venta.id_user', $request->id)
                ->where('venta.estado', 3)
                ->where('venta.created_at', 'LIKE', $request->fecha . '%')
                ->orderBy('venta.colaboracion')
                ->get();

        $tarjeta=DB::table('venta')
                ->join('mesa', 'venta.id_cliente', '=', 'mesa.id') 
                ->select('mesa.nombre as mesa', 'venta.*')
                ->where('venta.id_user', $request->id)
                ->where('venta.tipo_pago',2)
                ->where('venta.estado', 3)
                ->where('venta.created_at', 'LIKE', $request->fecha . '%')
                ->orderBy('venta.colaboracion')
                ->get(); 

        $efectivo=DB::table('venta')
                ->join('mesa', 'venta.id_cliente', '=', 'mesa.id') 
                ->select('mesa.nombre as mesa', 'venta.*')
                ->where('venta.id_user', $request->id)
                ->where('venta.tipo_pago', 1)
                ->where('venta.estado', 3)
                ->where('venta.created_at', 'LIKE', $request->fecha . '%')
                ->orderBy('venta.colaboracion')
                ->get(); 
        $venta = DB::table('venta-detalle')
        ->join('venta', 'venta-detalle.id_venta', '=', 'venta.id')
        ->join('menu_item', 'venta-detalle.id_menu', '=', 'menu_item.id')
        ->select('menu_item.nombre as producto','venta-detalle.*')
        ->where('venta.id_user', $request->id)
        ->where('venta.estado', 3)
        ->where('venta-detalle.created_at', 'LIKE', $request->fecha . '%')
        ->get();
        // $venta= Venta::where('id_user', $request->id)->where('created_at','LIKE', $request->fecha.'%')->get();
        return view('admin.insidencias.reporte', compact('user', 'datamesa', 'tarjeta', 'efectivo','venta'));
    }
}
