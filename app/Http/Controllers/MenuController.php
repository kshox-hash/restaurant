<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
class MenuController extends Controller
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
        $menu = Menu::all();
        $menuitem = DB::table('menu_item')
        ->join('menu', 'menu_item.id_menu', '=', 'menu.id') 
        ->select('menu_item.*', 'menu.nombre as menu', 'menu.id as id_menu')  
        ->orderByDesc('menu_item.id')
        ->orderBy('menu.nombre')
        ->get();
        return view('admin.menu.index', compact('menu', 'menuitem'));

        // Conectar con la impresora (cambiar el nombre de la impresora según corresponda)
        // $connector = new WindowsPrintConnector("smb://NOMBRE_IMPRESORA");
        // $connector = new WindowsPrintConnector("smb://POS-58");

        // // Crear una instancia de Printer
        // $printer = new Printer($connector);

        // // Imprimir el encabezado del ticket
        // $printer->setJustification(Printer::JUSTIFY_CENTER);
        // $printer->text("Mi Tienda\n");
        // $printer->text("Dirección de la Tienda\n");
        // $printer->text("Teléfono de la Tienda\n");
        // $printer->text("\n");

        // // Imprimir los productos vendidos
        // $printer->setJustification(Printer::JUSTIFY_LEFT);
        // $printer->text("Cantidad  Descripción     Precio\n");
        // $printer->text("--------------------------------\n");
        // $printer->text("1         Producto 1      $10.00\n");
        // $printer->text("2         Producto 2      $15.00\n");
        // $printer->text("1         Producto 3      $20.00\n");
        // $printer->text("\n");

        // // Imprimir el total de la venta
        // $printer->setJustification(Printer::JUSTIFY_RIGHT);
        // $printer->text("Total: $45.00\n");
        // $printer->text("\n");

        // // Cortar el papel y abrir el cajón de efectivo
        // $printer->cut();
        // $printer->pulse();

        // // Cerrar la conexión con la impresora
        // $printer->close();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id > 0) {
            Menu::findOrFail($request->id)->update($request->all());
        } else {
            Menu::create($request->all());
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect()->back(); 
    }
}
