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
    </style>
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
                                    {{-- <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Menú:</span>
                                           <select class="form-control" name="id_menu" id="id_menu" required>
                                            @foreach ($menu as $item)
                                                <option value="{{$item->id}}">{{$item->nombre}}</option> 
                                            @endforeach
                                           </select>
                                        </div> 
                                    </div>   --}}
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
                        <table id="example2" class="table table-border table-hover"  cellspacing="0" width="100%">
                            <thead>
                                <tr> 
                                    <th style="width: 10%">ID</th>   
                                    <th style="width: 25%">MENU</th>  
                                    <th style="width: 25%">NOMBRE</th>  
                                    <th style="width: 20%">PRECIO</th>   
                                    <th style="width: 20%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($menuitem as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->menu}} </td>
                                        <td>{{$row->nombre}}</td> 
                                        <td>{{$row->precio}}</td> 
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
                </div>
            </div>   
        </div>  
        <div class="col-sm-12 col-xl-12 "> 
            <div class="card"> 
                <div class="card-header"> 
                    <div class="d-flex justify-content-center "> 
                        <div class="mx-1">   
                            <div class="input-group "> <span class="input-group-text" id="inputGroup-sizing-sm">Cliente:</span>
                                <select class="form-control" name="id_client" id="id_client" required>  
                                    @foreach ($client as $row) 
                                        <option value="{{$row->id}}">{{$row->nombre}} </option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="mx-1">  
                            <input type="text" value="" class="form-control" id="valtotal" disabled>
                        </div>
                        <div class="mx-1">
                            <a class="btn btn-primary " onclick="Generarorden()">GENERAR VENTA</a> 
                        </div>
                    </div>
                </div> 
                <div class="card-body">
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
                            <tbody id="tbody"> 
                                
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>   
        </div>  
    </div>
     
    
</div>
@endsection
@section('script')
    <script>
        let db= this.db = window.openDatabase('dborden', '', 'base de datos de orden de Ordenes', 2 * 1024 * 1024); 
        let totals=0;
        $(document).ready(function() {  
            this.db.transaction(tx => {
            tx.executeSql("CREATE TABLE IF NOT EXISTS Orden (id INTEGER primary key, nombre TEXT, precio DECIMAL,cantidad INTEGER,total DECIMAL, descripcion TEXT )");
            });
            // this.listar(); 
        }); 
        this.Listar();
        
        
        function Editar(id,precio) { 
            let cant= $('#cant'+id).val();
            let desc= $('#desc'+id).val(); 
            let total= precio*(cant*1); 
            this.db.transaction(function (tx) {
                tx.executeSql(`UPDATE Orden SET cantidad=${cant},descripcion='${desc}', total=${total} WHERE id=${id}`);
            });
            this.Listar();
        }
        function onDelete(id){
            this.db.transaction(function (tx) {
                tx.executeSql("DELETE FROM Orden WHERE id ="+id);
            }); 
            this.Listar();
        }

        function Listar() {
            let total;
            this.db.transaction(function (tx) {
                tx.executeSql("SELECT * FROM Orden", [], function (tx, result) {
                    total = result.rows.length;
                    const data = result.rows;  
                    let html= '';
                    totals=0;
                    for (const rows of data) { 
                        totals+=rows.total;
                        html+=`
                            <tr> 
                                <td  >${rows.id}</td>  
                                <td  >${rows.nombre}</td>  
                                <td  >${rows.precio}</td>  
                                <td  ><input type="number" class="form-control" id="cant${rows.id}" value="${rows.cantidad}"></td>  
                                <td  >${rows.total}</td>  
                                <td  ><input type="text" class="form-control" id="desc${rows.id}"  value="${rows.descripcion}"></td>   
                                <td>  
                                    <a onclick="Editar(${rows.id},${rows.precio})"  class="btn btn-primary mx-1" style="padding: 5px;"> <i class="bx bx-rotate-right" style="font-size: 20px; margin:0px"></i> </a>
                                    <a onclick="onDelete(${rows.id})" class="btn btn-danger mx-1" style="padding: 5px;"> <i class="bx bx-trash" style="font-size: 20px; margin:0px"></i> </a>
                                </td> 
                            </tr>
                        `;
                    }
                    $('#tbody').html(html); 
                    $('#valtotal').val('TOTAL: '+totals); 
                });
            });
        }
        function Limpiar(){
            this.db.transaction(function (tx) {
                tx.executeSql("DELETE FROM Orden");
            }); 
            this.Listar();
        }
        function onCreate(id,nombre,precio){  
            this.db.transaction(function (tx) {
                tx.executeSql("SELECT * FROM Orden WHERE id="+id, [], function (tx, result) { 
                    if (result.rows.length > 0) {
                        let cant = result.rows[0].cantidad + 1; 
                        let total= cant*result.rows[0].precio;
                        this.db.transaction(function (tx) {
                        tx.executeSql(`UPDATE Orden SET cantidad = ${cant}, total=${total} WHERE id=${result.rows[0].id}`);
                        });   
                    } else { 
                        this.db.transaction(function (tx) {
                            tx.executeSql("INSERT INTO Orden (id,nombre,precio,cantidad,total, descripcion) VALUES (?,?,?,?,?,?)", [id,nombre, precio,1,precio*1,'']);
                        }); 
                    } 
                    this.Listar();
                }); 
            });
              
        }
        function Generarorden(){
            let id_client= $('#id_client').val();
            let total= totals;  
            this.db.transaction(function (tx) {
                tx.executeSql("SELECT * FROM Orden", [], function (tx, result) { 
                    const data = JSON.stringify(result.rows);  
                    $.ajax({
                        url:"{{ route('venta.create')}}",
                        method:'GET',
                        data:{id_client,total,data}, 
                        beforeSend :function(xmlHttp){ 
                        xmlHttp.setRequestHeader("If-Modified-Since","0"); 
                        xmlHttp.setRequestHeader("Cache-Control","no-cache");
                        },
                        success:function(data){  
                            // console.log(data);
                            Limpiar();
                        }
                    });
                });
            }); 
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
        var table = $("#example2").DataTable({
            "responsive": true, "lengthChange": false, "ordering": false,   "pageLength":5,  
            "buttons": [
                'pageLength',
                'copyHtml5',    
                {
                    extend: 'excelHtml5',
                    title: 'Cuentas Bajo Pedido'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Cuentas Bajo Pedido',
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

