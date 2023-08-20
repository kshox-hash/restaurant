@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}"> 
    
    <style>
         .btn-secondary {
            color: #6c757d;
            background-color: #f0f0ff;
            border: 0px;
        }
        .tb:hover{
            background-color:#e8e8f7;
        }
        .button-container{
            display:inline-block;
            position:relative;
        }

        .button-container a{
            position: absolute;
            top: 1rem; 
            background-color:#8F0005;
            border-radius:1.5em;
            color:white;
            text-transform:uppercase;
            padding:1em 1.5em;
        }
         
     </style>
@endsection

@section('content')
<div class="page-content"> 
    <div class="modal fade" id="modalcateg" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="asunto">CUENTA EN PAUSA (NETFLIX)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="reset-btn" aria-label="Close"></button>
                </div> 
                <div class="modal-body"> 
                    <div class="user-box dropdown mb-2">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret show" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <img id="perfil" src="" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0" id="user">Alfred lucas</p> 
                                <p class="user-name mb-0" id="fecha">Alfred lucas</p> 
                            </div>
                        </a> 
                    </div>
                    <hr> 
                    <p id="contenido">Hola mi client :</p>
                    <div class="mb-3" id="archivo" style="display: none">
                        <label for="descripcion"> Archivo adjunto</label>  <br> 
                        <div class=“button-container”>
                            <img src="" id="archivoarjunto"  class="w-25" alt="">
                            <br>
                            <a id="descargar" class="btn btn-primary  w-25" href=" "  >Descargar</a>
                        </div>
                    </div>
                    <hr>
                    <form  action="{{route('reportes.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-3">
                        <label for="descripcion">Responder</label>
                        <textarea name="respuesta" id="respuesta" class="form-control" cols="30" rows="8"></textarea>
                    </div>
                </div> 
                <div class="modal-footer">  
                    <button type="submit" class="btn btn-primary mb-1"> Responder</button>
                </div> 
                </form>
            </div>
        </div>
    </div>  
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">COMENTARIOS </div>
        <div class="ps-3"> 
        </div>
        <div class="ms-auto">
            <div class="btn-group"> 
                {{-- <a class="btn btn-success form-control" onclick="Nuevo();" data-bs-toggle="modal" data-bs-target="#modalcateg"><i class="fa fa-plus"></i>AGREGAR</a> --}}
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
                            <th><i class="fa fa-circle"></i> </th>
                            <th>ASUNTO</th>
                            <th>USUARIO</th>
                            <th>DESCRIPCION</th>
                            <th>FECHA</th> 
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach ($report as $row)
                            <tr style="cursor: pointer;"  class="tb" onclick="View({{$row->id}});" >
                                <td>
                                    @if ($row->estado==1) 
                                    <i class="fa fa-circle text-success"></i>  <span class="text-success">Respondida</span> 
                                    @else
                                    <i class="fa fa-circle text-warning"></i>  <span class="text-warning"> Por Responder</span> 
                                    @endif
                                </td>
                                <td>{{$row->asunto}}</td>
                                <td>{{$row->usuario}}</td>
                                <td>{{$row->descripcion}}</td>
                                <td>{{$row->created_at}}</td>
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
    function Nuevo() { 
        $('#id').val(0);
        $('#nombre').val('');
        $('#descripcion').val('');
    }
    function Editar(id,nombre,descripcion) { 
        $('#id').val(id);
        $('#nombre').val(nombre);
        $('#descripcion').val(descripcion);
    }
    function View(id) {
        $.ajax({
            url:"{{ route('reportar.get')}}",
            method:'GET',
            data:{id},
            dataType:'json',
            beforeSend :function(xmlHttp){ 
            xmlHttp.setRequestHeader("If-Modified-Since","0"); 
            xmlHttp.setRequestHeader("Cache-Control","no-cache");
            },
            success:function(data){   
                data.forEach(row => { 
                    let img="{{asset('usuario')}}/"+row.perfil;
                    let ar="{{asset('repot')}}/"+row.img; 
                    $('#id').val(row.id);
                    $('#asunto').html(row.asunto);
                    $('#perfil').attr('src',img);
                    // $('#plataforma').html(row.asunto);
                    $('#user').html(row.user);
                    $('#contenido').html(row.descripcion);
                    $('#fecha').html(row.created_at);
                    if (row.img=="") {
                        $('#archivo').hide(); 
                    }else{
                        $('#archivo').show(); 
                        $('#archivoarjunto').attr('src',ar);  
                        $('#descargar').attr('href',ar);  
                        $('#descargar').attr('download',row.asunto);   
                    }
                });
                $('#modalcateg').modal('show');
            }
        });
    }
    // $('#example2').DataTable({
    //     select: true,"ordering": false,
    //     "pageLength": 10,
    //     lengthMenu: [
    //         [10, 15, 50, -1],
    //         [10, 15, 50, 'Todos']
    //     ],
    //     "language": {
    //         "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
    //     }
    // }); 
     $(document).ready(function() {    
        var table = $('#example2').DataTable( {
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
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    });
</script>
@endsection

