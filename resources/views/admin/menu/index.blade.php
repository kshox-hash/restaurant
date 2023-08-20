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
                                    <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Menú:</span>
                                           <select class="form-control" name="id_menu" id="id_menu" required>
                                            @foreach ($menu as $item)
                                                <option value="{{$item->id}}">{{$item->nombre}}</option> 
                                            @endforeach
                                           </select>
                                        </div> 
                                    </div>  
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
                                    <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Stock:</span>
                                            <input type="number"   min="0" name="stock" id="stock" class="form-control" required aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
    <div class="modal fade" id="modalitem" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DETALLE DEL MENU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="reset-btn" aria-label="Close"></button>
                </div> 
                <div class="modal-body"> 
                    <div class="card">
                        <div class="card-body">  
                            <form class="row" action="{{route('menu.create')}}" method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                <input type="hidden" name="id" id="id">  
                                <div class="row">   
                                    <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">NOMBRE:</span>
                                            <input type="text" name="nombre" id="nombre" class="form-control" required aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
        <div class="col-sm-12 col-xl-8 "> 
            <div class="card"> 
                <div class="card-header">
                    <a class="btn btn-success  " onclick="Nuevo();" ><i class="fa fa-plus"></i>AGREGAR</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-border table-hover"  cellspacing="0" width="100%">
                            <thead>
                                <tr> 
                                    <th style="width: 10%">ID</th>   
                                    <th style="width: 25%">MENU</th>  
                                    <th style="width: 25%">NOMBRE</th>  
                                    <th style="width: 20%">PRECIO</th>   
                                    <th style="width: 5%">Stock</th>   
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
                                        <td> <span class="@if ($row->stock>5) text-success @else text-danger @endif">{{$row->stock}}</span> </td> 
                                        <td>
                                            <a onclick="Editar({{$row->id}},'{{$row->id_menu}}','{{$row->nombre}}',{{$row->precio}},{{$row->stock}})" data-bs-toggle="modal" data-bs-target="#modaluser" ><i class="fa fa-edit btn text-success"></i></a>
                                            <a href="{{route('menuitem.delete',$row->id)}}" ><i class="fa fa-trash btn  text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>  
                        </table>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="card"> 
                <div class="card-header">
                    <a class="btn btn-primary" onclick="Nuevoitem();" ><i class="fa fa-plus"></i>AGREGAR </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-border table-hover"  cellspacing="0" width="100%">
                            <thead>
                                <tr>   
                                    <th style="width: 80%">NOMBRE</th>   
                                    <th style="width: 20%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($menu as $row)
                                    <tr> 
                                        <td>{{$row->nombre}}</td>  
                                        <td>
                                            <a onclick="Editarmenu({{$row->id}},'{{$row->nombre}}')" data-bs-toggle="modal" data-bs-target="#modalitem" ><i class="fa fa-edit btn text-success"></i></a>
                                            <a href="{{route('menu.delete',$row->id)}}" ><i class="fa fa-trash btn  text-danger"></i></a>
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
    
</div>
@endsection
@section('script')
    <script>
        function Imagen() { 
            $('#nomimg').val($('#imag1').val());
        }
        function Nuevo() { 
            $('#id_item').val(0);
            $('#id_menu').val('');
            $('#id_nombre').val('');
            $('#precio').val('');  
            $('#stock').val('');  
            $('#modaluser').modal('show'); 
        } 
        function Editar(id,id_menu,nombre,precio,stock) {  
            $('#id_item').val(id);
            $('#id_menu').val(id_menu);
            $('#id_nombre').val(nombre);
            $('#precio').val(precio);  
            $('#stock').val(stock);  
        }
        function Nuevoitem() { 
            $('#id').val(0);
            $('#nombre').val(''); 
            $('#modalitem').modal('show'); 
        }
        function Editarmenu(id,nombre){
            $('#id').val(id);
            $('#nombre').val(nombre);
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
            "responsive": true, "lengthChange": false, "ordering": false,   "pageLength": 10,  
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
        table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)' ); 
        var table = $("#example").DataTable({
            "responsive": true, "lengthChange": false, "ordering": false,   "pageLength": 10,  
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
                "sInfo":           "Total _TOTAL_ registros",
                "sInfoEmpty":      "Total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     '<i class="fa fa-forward"></i>',
                    "sPrevious": '<i class="fa-solid fa-backward"></i>'
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
    } );
    </script> 
@endsection

