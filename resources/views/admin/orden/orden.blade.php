@extends('admin.layouts.app')
@section('style') 
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> 
  
@endsection
@section('content')
<div class="page-content"> 
    <div class="modal fade" id="modaluser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DETALLE DEL MENU Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="reset-btn" aria-label="Close"></button>
                </div> 
                <div class="modal-body"> 
                    <div class="card">
                        <div class="card-body">  
                            <form class="row" action="{{route('menuitem.create')}}" method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                <input type="hidden" name="id" id="id_item">  
                                <div class="row">  
                                    <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">NOMBRE:</span>
                                            <input type="text" name="nombre" id="id_nombre" class="form-control" required aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div> 
                                    </div>   
                                    <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">PRECIO:</span>
                                            <input type="number" step="0.01" min="0" name="precio" id="precio" class="form-control" required aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div> 
                                    </div>   
                                    <br>
                                    <div class="row  justify-content-center" >
                                        <div class="col-md-4"> 
                                            <button type="submit" class="btn btn-primary form-control">Guardar</button>
                                        </div>
                                    </div> 
                                </div>  
                            </form> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>   
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">MENU </div>
        <div class="ps-3"> 
        </div> 
    </div> 
    <hr/>
    <div class="row">
        <div class="col-sm-12 col-xl-6 "> 
            <div class="card">  
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listmenu" class="table table-border table-hover"  cellspacing="0" width="100%">
                            <thead>
                                <tr> 
                                    <th style="width: 10%">ID</th>   
                                    <th style="width: 20%">MENU</th>  
                                    <th style="width: 25%">NOMBRE</th>  
                                    <th style="width: 10%">STOCK</th>   
                                    <th style="width: 20%">PRECIO</th>   
                                    <th style="width: 15%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($menuitem as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->menu}} </td>
                                        <td style="white-space: pre-wrap;"> {{$row->nombre}}</td>  
                                        <td> <span class="@if ($row->stock>5) text-success @else text-danger @endif">{{$row->stock}}</span> </td> 
                                        <td>{{number_format($row->precio, 0, ',', '.')}}</td> 
                                        <td>
                                            @if ($row->stock>0)
                                            <a onclick="onCreate({{$row->id}},'{{$row->nombre}}',{{$row->precio}});"><i class="fa fa-plus btn btn-success"></i> </a>  
                                            @else
                                            <a ><i class="fa fa-plus btn btn-danger"></i> </a>  
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>  
                            <tfoot>
                                <tr>  
                                    <th style="width: 10%">ID</th>   
                                    <th style="width: 25%">MENU</th>  
                                    <th style="width: 20%">NOMBRE</th>  
                                    <th style="width: 10%">STOCK</th>   
                                    <th style="width: 20%">PRECIO</th>   
                                    <th style="width: 15%">ACCIONES</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>   
        </div>   
        <div class="col-sm-12 col-xl-6 "> 
            <div class="card"> 
                <div class="card-header">  
                    <div class="d-flex flex-column flex-sm-row justify-content-between">
                        <div class="mx-1 mb-2">
                          <input type="hidden" id="id_mesa" value="{{$mesa->id}}">
                          <input type="text" class="form-control" readonly  value="{{$mesa->nombre}}">
                        </div>
                        <div class="mx-1 mb-2">
                          <input type="text" value="" class="form-control" id="valtotal" disabled>
                        </div>
                        <div class="mx-1 mb-2">
                          <input type="button" class="btn btn-primary" onclick="Generarorden()" value="GENERAR VENTA">
                        </div>
                    </div> 
                </div> 
                <div class="card-body"> 
                    <div class="table-responsive">
                        <div style="overflow-x: auto;">  
                            <table   class="table table-border table-hover"   width="100%">
                                <thead>
                                    <tr>   
                                        <th style="width: 15%">Nombre</th>  
                                        <th class="text-end" style="width: 10%">Precio</th>  
                                        <th style="width: 5%">Cantidad</th>   
                                        <th class="text-end"  style="width: 10%">Total</th>   
                                        <th style="width: 30%">Descripcion</th>   
                                        <th style="width: 10%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">  
                                </tbody>   
                            </table>
                        </div>
                    </div>
                </div>
            </div>   
        </div>  
    </div>  
</div>
@endsection
@section('script') 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/1.0.3/numeral.min.js" integrity="sha512-sMgx0iqtQVrEwuUPBeRZE42fOPWIRBRb3CLaoK5gilEnzKTkdJpjguVk5HpcmOgjyZlHSGqXXugNlaovRhYLsg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script> 
        // Abra una base de datos llamada "exampleDB" con la versión 3
        const request = indexedDB.open("ordenDB", 3);
        let cnx = null; 
        let totals = 0; 

        // Cree una nueva tienda de objetos llamada "ordenes" en la base de datos
        request.onupgradeneeded = function(event) {
            const db = event.target.result; 
            const objectStore = db.createObjectStore("ordenes", { keyPath: "id" });
            objectStore.createIndex("nombre", "nombre", { unique: false });
        };

        // Manejar errores y éxito al abrir la base de datos.
        request.onerror = function(event) {
            console.log("Error opening database");
        };

        request.onsuccess = function(event) {
            const db = event.target.result;
            cnx = event.target.result; 
            console.log("Base de datos abierta con éxito");  
            Listar(); 
        }; 

        function onCreate(id,nombre,precio) {   
            const transaction = cnx.transaction(["ordenes"], "readwrite");
            const objectStore = transaction.objectStore("ordenes"); 

            const request = objectStore.get(id); 
            request.onsuccess = (event) => {
            const objeto = event.target.result;
                if (objeto) {
                    objeto.cantidad = objeto.cantidad+1; 
                    objeto.total = (objeto.cantidad)*objeto.precio;   
                    const updateRequest = objectStore.put(objeto);

                    updateRequest.onerror = function(event) {
                    console.log('No se pudo actualizar el objeto');
                    }; 
                    updateRequest.onsuccess = function(event) {
                    console.log('Objeto actualizado');
                    }; 
                } else { 
                    const customer = { id: id, nombre: nombre, precio:  precio,cantidad:1, total: precio*1, descripcion: ''};
                    const addRequest = objectStore.add(customer);
                    addRequest.onsuccess = function(event) {
                        console.log("Customer added successfully");
                    }; 
                }  
                Listar();
            };
        } 
        function Editar(id,precio) {  
            const transaction = cnx.transaction(["ordenes"], "readwrite");
            const objectStore = transaction.objectStore("ordenes"); 

            const request = objectStore.get(id); 
            request.onsuccess = (event) => {
                const objeto = event.target.result;  
                objeto.cantidad = $('#cant'+id).val(); 
                objeto.descripcion = $('#desc'+id).val();   
                objeto.total = precio*($('#cant'+id).val()*1);   
                const updateRequest = objectStore.put(objeto);

                updateRequest.onerror = function(event) {
                    console.log('No se pudo actualizar el objeto');
                }; 
                updateRequest.onsuccess = function(event) {
                    console.log('Objeto actualizado');
                };  
                Listar();
            };
        } 
          
        
        function Generarorden(){
            let id_mesa= $('#id_mesa').val();  
            let tipo_pago= 0;  
            let estado= $('#estado').val();  
            let pago= $('#pago').val();  
            let total= totals;   
            const transaction = cnx.transaction(["ordenes"], "readwrite");
            const objectStore = transaction.objectStore("ordenes");  
            let cursorRequest = objectStore.getAll();
             let d = [];
            cursorRequest.onsuccess = function(event) {
                let d = event.target.result;  
                const data = JSON.stringify(d); 
                $.ajax({
                    url:"{{ route('venta.create')}}",
                    method:'GET',
                    data:{id_mesa,tipo_pago,total,estado,pago,data}, 
                    beforeSend :function(xmlHttp){ 
                    xmlHttp.setRequestHeader("If-Modified-Since","0"); 
                    xmlHttp.setRequestHeader("Cache-Control","no-cache");
                    },
                    success:function(data){    
                        Limpiar();
                    }
                });
            };
 
        }
        function onDelete(id){
            const transaction = cnx.transaction(["ordenes"], "readwrite");
            const objectStore = transaction.objectStore("ordenes");   
            var deleteRequest = objectStore.delete(id);
             
            deleteRequest.onsuccess = function(event) {
                console.log('Se ha eliminado el objeto');
            }; 
            Listar();
        }
        function Limpiar() { 
            const transaction = cnx.transaction(["ordenes"], "readwrite");
            const objectStore = transaction.objectStore("ordenes");   
            var deleteRequest = objectStore.clear(); 

            deleteRequest.onsuccess = function(event) {
                console.log('Se han eliminado todos los datos de la tabla.');
            };
            Listar();
        }
        
        function Listar(){
            const transaction = cnx.transaction(["ordenes"], "readwrite");
            const objectStore = transaction.objectStore("ordenes");
            let cursorRequest = objectStore.getAll(); 
            cursorRequest.onsuccess = function(event) {
                let cursor = event.target.result; 
                if (cursor) { 
                    $('#tbody').html(''); 
                    let html= '';
                    totals=0; 
                    for (const rows of cursor) { 
                        totals+=rows.total; 
                        html+=`
                            <tr>  
                                <td  style="white-space: pre-wrap;">${rows.nombre}</td>  
                                <td   style="text-align: right;">${numeral(rows.precio).format('0,0').replace(/,/g, '.') }</td>  
                                <td  ><input type="number" class="form-control" id="cant${rows.id}" value="${rows.cantidad}"></td>  
                                <td   style="text-align: right;">${numeral(rows.total).format('0,0').replace(/,/g, '.')}</td>  
                                <td  ><input type="text" class="form-control" id="desc${rows.id}"  value="${rows.descripcion}"></td>   
                                <td>  
                                    <a onclick="Editar(${rows.id},${rows.precio})"  class="btn btn-primary mx-1" style="padding: 5px;"> <i class="bx bx-rotate-right" style="font-size: 20px; margin:0px"></i> </a>
                                    <a onclick="onDelete(${rows.id})" class="btn btn-danger mx-1" style="padding: 5px;"> <i class="bx bx-trash" style="font-size: 20px; margin:0px"></i> </a>
                                </td> 
                            </tr>
                        `;
                    }
                    $('#tbody').html(html); 
                    $('#valtotal').val('TOTAL: '+  numeral(totals).format('0,0').replace(/,/g, '.') );  
                }
            };
        }
    </script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script> 
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>  
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script> 
   <script> 
    $(document).ready(function() { 
        var table = $("#listmenu").DataTable({
            "responsive": true, "lengthChange": false, "ordering": false,   "pageLength":5,  
            dom: 'lrtip',   
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando del _START_ al _END_ de total _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "aria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                "copy": "Copiar",
                "csv": "CSV",
                "excel": "Excel", 
                "pdf": "PDF",
                "colvis": "Visible columnas", 
                "print": "Imprimir"
                }
            } 
        }); 
         $('#listmenu tfoot tr:eq(0) th').each(function (i) { 
            $(this).html('<input type="text" class="form-control" placeholder="Buscar..">'); 
            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        }); 
        
    } );
    </script> 
@endsection
 

