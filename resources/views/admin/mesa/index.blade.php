@extends('admin.layouts.app')
@section('style') 
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">  
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
                            <form class="row" action="{{route('mesa.create')}}" method="POST"  enctype="multipart/form-data"> 
                                @csrf
                                <input type="hidden" name="id" id="id">  
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="input-group input-group-sm mb-3"> <span class="input-group-text" for="name">NOMBRES:</span>
                                            <input type="text" name="nombre" id="nombre" class="form-control" required aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
    
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">MESAS </div>
        <div class="ps-3"> 
        </div>
        <div class="ms-auto">
            <div class="btn-group"> 
                <a class="btn btn-success form-control" onclick="Nuevo();" ><i class="fa fa-plus"></i>AGREGAR</a>
            </div>
        </div>
    </div> 
    <hr/>
    <div class="card"> 
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-border table-hover"  cellspacing="0" width="100%">
                    <thead>
                        <tr> 
                            <th style="width: 10%">ID</th>   
                            <th style="width: 25%">NOMBRE</th>     
                            <th style="width: 20%">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($data as $row)
                            <tr>
                                <td>{{$row->id}}</td> 
                                <td>{{$row->nombre}}</td>  
                                <td>
                                    <a onclick="Editar({{$row->id}},'{{$row->nombre}}','{{$row->telefono}}')" data-bs-toggle="modal" data-bs-target="#modaluser" class="btn btn-success">Editar</a>
                                    <a href="{{route('mesa.delete',$row->id)}}" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>  
                </table>
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
            $('#id').val(0);
            $('#nombre').val('');
            $('#telefono').val(''); 
            $('#modaluser').modal('show');
        }
        function Editar(id,nombre,telefono) { 
            $('#id').val(id);
            $('#nombre').val(nombre);
            $('#telefono').val(telefono); 
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
        table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)' ); 
 
    } );
    </script> 
@endsection

