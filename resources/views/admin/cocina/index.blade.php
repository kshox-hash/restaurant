@extends('admin.layouts.app')
@section('style') 
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}"> 
 
    <style>
        .file-select {
        position: relative;
        display: inline-block;
        }

        .file-select::before {
        background-color: #5678EF;
        color: white; 
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 3px;
        content: 'Seleccionar'; /* testo por defecto */
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0; 
        }

        .file-select input[type="file"] {
        opacity: 0;
        width: 30%;
        height: 32px;
        display: inline-block; 
        }

        #img::before {
        content: 'Selecciona perfil';
        } 
        .dataTables_filter {
        display: none;
    }
    </style>
@endsection
@section('content') 
<div class="page-content">  
    <div class="modal fade" id="modaluser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DETALLE DEL MESAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="reset-btn" aria-label="Close"></button>
                </div> 
                <div class="modal-body"> 
                    <div class="card">
                        <div class="card-body">  
                            <form class="row" action="{{route('venta.update')}}" method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                <input type="hidden" name="id" id="id">  
                                <input type="hidden" name="estado" value="3">  
                                <div class="row"> 
                                    <div class="col-md-6 mb-3">   
                                        <div class="input-group "> <span class="input-group-text" id="inputGroup-sizing-sm">Tipo Pago:</span>  
                                            <select class="form-control" name="tipo_pago" id="tipo_pago" required>  
                                                <option value="1">EFECTIVO</option> 
                                                <option value="2">TARJETA</option>  
                                            </select>  
                                        </div> 
                                    </div>  
                                    <div class="col-md-6 mb-3">   
                                        <div class="input-group "> <span class="input-group-text" id="inputGroup-sizing-sm">El 10%:</span>  
                                            <select class="form-control" name="colaboracion" id="colaboracion" required>  
                                                <option value="0">Sin 10%</option>  
                                                <option value="1">Con 10%</option> 
                                            </select>  
                                        </div> 
                                    </div>  
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
    <div class="modal fade" id="modaladditems" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AGREGAR PEDIDOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="reset-btn" aria-label="Close"></button>
                </div> 
                <div class="modal-body"> 
                    <div class="card">
                        <div class="card-body pt-0">  
                            <div class="table-responsive">
                                <table id="example2" class="table table-border table-hover"  cellspacing="0" width="100%">
                                    <thead>
                                        <tr> 
                                            <th style="width: 10%">ID</th>   
                                            <th style="width: 25%">MENU</th>  
                                            <th style="width: 25%">NOMBRE</th>  
                                            <th style="width: 20%">PRECIO</th>   
                                            <th style="width: 5%">STOCK</th>   
                                            <th style="width: 15%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($menuitem as $row)
                                            <tr>
                                                <td>{{$row->id}}</td>
                                                <td>{{$row->menu}} </td>
                                                <td>{{$row->nombre}}</td> 
                                                <td>{{number_format($row->precio, 0, ',', '.')}}</td> 
                                                <td>{{$row->stock}}</td> 
                                                <td>
                                                    <a onclick="onCreate({{$row->id}},'{{$row->nombre}}',{{$row->precio}});"><i class="fa fa-plus btn btn-success"></i> </a>  
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>  
                                    <tfoot>
                                        <tr>  
                                            <th style="width: 10%">ID</th>   
                                            <th style="width: 25%">MENU</th>  
                                            <th style="width: 25%">NOMBRE</th>  
                                            <th style="width: 20%">PRECIO</th>   
                                            <th style="width: 20%">ACCIONES</th> 
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row mt-3 mb-2">   
                                <div class="col-md-4">  
                                    <input type="hidden"  id="id_venta" >
                                    <input type="text" value="" class="form-control" id="valtotal" disabled>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-primary " onclick="Generarorden()">ACTUALIZAR VENTA</a> 
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="example4" class="table table-border table-hover"  cellspacing="0" width="100%">
                                    <thead>
                                        <tr> 
                                            <th style="width: 5%">ID</th>   
                                            <th style="width: 10%">Nombre</th>  
                                            <th style="width: 15%">Precio</th>  
                                            <th style="width: 5%">Cantidad</th>   
                                            <th style="width: 10%">Total</th>   
                                            <th style="width: 30%">Descripcion</th>   
                                            <th style="width: 10%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_"> 
                                        
                                    </tbody>   
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>  
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">MENU</div>
        <div class="ps-3"> 
        </div> 
    </div>  
    <hr/>
    <div class="row"> 
        <div class="col-sm-12 col-xl-12 "> 
            <div class="card">  
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-border table-hover"  cellspacing="0" width="100%">
                            <thead>
                                <tr> 
                                    <th style="width: 5%" class="text-center">N° ORDEN</th>   
                                    <th style="width: 5%" class="text-center">CANT</th>    
                                    <th style="width: 10%">N° MESA</th>    
                                    <th style="width: 30%">NOMBRE</th>    
                                    <th style="width: 10%">DESCRIPCION</th>    
                                    <th style="width: 5%">ESTADO</th>    
                                    <th style="width: 45%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach ($ventas as $row)
                                    <tr>
                                        <td class="text-center">#{{$row['id']}}</td> 
                                        <td class="text-center">
                                            @foreach ($row['items'] as $item) 
                                                <p> {{$item->cantidad}}</p>  
                                            @endforeach 
                                        </td> 
                                        <td> 
                                            <p> {{$row['mesa']}}</p>  
                                        </td>  
                                        <td>
                                            @foreach ($row['items'] as $item) 
                                                <p> {{$item->nombre}}</p>  
                                            @endforeach 
                                        </td> 
                                        <td>
                                            @foreach ($row['items'] as $item) 
                                                <p> {{$item->descripcion}}</p>  
                                            @endforeach 
                                        </td> 
                                        <td>
                                            @if ($row['estado']==0)
                                                Espera
                                            @elseif($row['estado']==1)
                                                preparando 
                                            @elseif($row['estado']==2)
                                                cancelado
                                            @else
                                                listo
                                            @endif  
                                        </td> 
                                        <td>   
                                            <a  href="{{route('ordenedit','code='.$row['id'])}}"  class="btn btn-info">Editar </a> 
                                            @if ($row['estado']==0) 
                                                <a onclick="Add({{$row['id']}});" class="btn btn-success">  Agregar item </a> 
                                                <a href="{{route('cocina.preparando',$row['id'] )}}" class="btn btn-primary">Preparando </a>  
                                                <a href="{{route('cocina.cancelar',$row['id'])}}" class="btn btn-danger">Cancelar</a>  
                                            @else
                                                <a onclick="Listo({{$row['id']}});"  class="btn btn-success">Listo </a> 
                                                <a href="{{route('cocina.cancelar',$row['id'])}}" class="btn btn-danger">Cancelar</a>   
                                            @endif  
                                        </td> 
                                    </tr> 
                                @endforeach
                            </tbody>  
                        </table>
                        
                    </div>
                </div>
            </div>  
        </div>  
    </div>  
   
    <div class="modal fade" id="exampleModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    @if(session('mensaje'))
                        <p> {{ session('mensaje') }}</p> 
                    @endif 
                    @if(session('lowStockItems')) 
                        <p>Items por agotar</p>
                        <ul>
                            @foreach(session('lowStockItems') as $item)
                                <li>{{ $item['nombre'] }} - Stock: {{ $item['stock'] }}</li>
                            @endforeach
                        </ul>
                    @endif  
                </div>
            </div>
        </div>
    </div> 
    @if(session('lowStockItems'))
        <script>
            $(document).ready(function(){ 
                $('#exampleModals').modal('show');
            })
        </script>
    @endif 
</div>
@endsection
@section('script') 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/1.0.3/numeral.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <script>  
        const request = indexedDB.open("cocinaDB", 3);
        let cnx = null; 
        let totals = 0; 

        // Cree una nueva tienda de objetos llamada "actualizar" en la base de datos
        request.onupgradeneeded = function(event) {
            const db = event.target.result; 
            const objectStore = db.createObjectStore("actualizar", { keyPath: "id" });
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
            const transaction = cnx.transaction(["actualizar"], "readwrite");
            const objectStore = transaction.objectStore("actualizar"); 

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
            const transaction = cnx.transaction(["actualizar"], "readwrite");
            const objectStore = transaction.objectStore("actualizar"); 

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
            let id_venta= $('#id_venta').val();  
            let total= totals;   
            const transaction = cnx.transaction(["actualizar"], "readwrite");
            const objectStore = transaction.objectStore("actualizar");  
            let cursorRequest = objectStore.getAll();
            let d = [];
            cursorRequest.onsuccess = function(event) {
                let d = event.target.result;  
                const data = JSON.stringify(d); 
                $.ajax({
                    url:"{{ route('venta.updated')}}",
                    method:'GET',
                    data:{id_venta, total, data}, 
                    beforeSend :function(xmlHttp){ 
                    xmlHttp.setRequestHeader("If-Modified-Since","0"); 
                    xmlHttp.setRequestHeader("Cache-Control","no-cache");
                    },
                    success:function(data){    
                        $('#id_venta').val('');
                        Limpiar();
                        location.reload();
                    }
                });
            };

        }
        function onDelete(id){
            const transaction = cnx.transaction(["actualizar"], "readwrite");
            const objectStore = transaction.objectStore("actualizar");   
            var deleteRequest = objectStore.delete(id);
            
            deleteRequest.onsuccess = function(event) {
                console.log('Se ha eliminado el objeto');
            }; 
            Listar();
        }
        function Limpiar() { 
            const transaction = cnx.transaction(["actualizar"], "readwrite");
            const objectStore = transaction.objectStore("actualizar");   
            var deleteRequest = objectStore.clear(); 

            deleteRequest.onsuccess = function(event) {
                console.log('Se han eliminado todos los datos de la tabla.');
            };
            Listar();
        }
        
        function Listar(){
            const transaction = cnx.transaction(["actualizar"], "readwrite");
            const objectStore = transaction.objectStore("actualizar");
            let cursorRequest = objectStore.getAll(); 
            console.log(cursorRequest);
            cursorRequest.onsuccess = function(event) {
                let cursor = event.target.result; 
                if (cursor) { 
                    $('#tbody_').html(''); 
                    let html= '';
                    totals=0; 
                    for (const rows of cursor) { 
                        totals+=rows.total; 
                        html+=`
                            <tr> 
                                <td  >${rows.id}</td>  
                                <td  >${rows.nombre }</td>  
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
                    $('#tbody_').html(html); 
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
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script> 
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script> 
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
   <script> 
    $(document).ready(function() {  
        $("#example").DataTable();
        var table = $("#example2").DataTable({
            "responsive": true, "lengthChange": false, "ordering": false,   "pageLength":5,  
            // "searching": false,
            "buttons": [
                'pageLength',
                'copyHtml5',    
                {
                    extend: 'excelHtml5',
                    title: 'DATOS'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'DATOS',
                    orientation: 'landscape'
                } 
            ],
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
        $('#example2 tfoot tr:eq(0) th').each(function (i) { 
            $(this).html('<input type="text" class="form-control" placeholder="Buscar..">'); 
            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table.column(i)
                    .search(this.value)
                    .draw();
                }
            });
        }); 
        
    } );
    function Listo(id) { 
        $('#id').val(id); 
        $('#modaluser').modal('show');
    }
    function Add(id_venta) {
        $('#id_venta').val(id_venta); 
        $('#modaladditems').modal('show');
    }
    </script> 
@endsection

