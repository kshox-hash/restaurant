@extends('admin.layouts.app')

@section('style') 
 <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
 <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    
<style>
.tb:hover{
    background-color:#e8e8f7;
}
</style>
@endsection 
@section('content') 
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reportar Insidencia</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Reportar Insidencia</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">  
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalcateg" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="asunto">CUENTA EN  </h5>
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
                    <p>Plataforma: <span id="plataforma"></span></p>
                    <p id="contenido">Hola mi cliente me comenta que le aparece mensaje falta de pago, deje el correo y clave:</p>
                    <div class="mb-3" id="archivo" style="display: none">
                        <label for="descripcion"> Archivo adjunto</label>  <br> 
                        <div class=“button-container”>
                            <img src="" id="archivoarjunto"   alt="" style="width: 20%">
                            <br>
                            <a id="descargar" class="btn btn-primary  "style="width: 20%" href=" "  >Descargar</a>
                        </div>
                    </div>
                    <hr>  
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-3">
                        <label for="descripcion">Respuesta</label>
                        <pre id="respuesta">

                        </pre>
                        {{-- <textarea name="respuesta" id="respuesta" class="form-control" cols="30" rows="8"></textarea> --}}
                    </div>
                </div> 
                <div class="modal-footer">  
                    <button type="submit" class="btn btn-primary mb-1"  data-bs-dismiss="modal" id="reset-btn"> Finalizar</button>
                </div>  
            </div>
        </div>
    </div>  
     
    <div class="modal fade" id="reportar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" >
            <div class="modal-content p-1"> 
                
                <form  action="{{route('reportes.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">  
                        <div class="d-flex justify-content-between"> 
                            <h5 class="color-primary">CREAR INSIDENCIA</h5> 
                            <button type="button" class="btn-close float-regth" data-bs-dismiss="modal" id="reset-btn" aria-label="Close"></button>
                        </div>
                        <p>Por favor llene todos los campo para una agil y apropiada respuesta por parte de nuestra área de backoffice.</p> 
                        <div class="form-group mb-3">
                            <label for="">Asunto</label>
                            <input type="text" class="form-control" name="asunto" id="asunto" required placeholder="Ingrese el motivo de la insidencia">
                        </div> 
                        <div class="form-group mb-3">
                            <label for="descripcion">Describa la insidencia</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="8" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Adjuntar Archivo</label>
                            <div class="input-group file-browser px-0">
                                <input type="text" class="form-control border-right-0 browse-file"  id="nomimg" placeholder="Subir Archivo" autocomplete="off"  >
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                    Seleccionar <input type="file" name="img" id="img" style="display: none;" onchange="Imagen();">
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div> 
                    <div class="modal-footer">  
                        <button type="submit" class="btn btn-primary mb-1"> Reportar Insidencia</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-3">
            <div class="card radius-10">
                <div class="card-header">
                    <a href="" data-bs-toggle="modal"  data-bs-target="#reportar"  class="btn btn-primary w-100"> <i class="fa-solid fa-paper-plane"></i> Reportar Insidencia</a>
                </div>
                <div class="card-body">   
                    <a class="d-flex justify-content-between " style="cursor: pointer;" onclick="Todo()" >
                        <i class="fa-solid fa-envelope  float-left  h5" style="opacity: .20 !important;"></i>  <p class="text-dark">Insidencias reportadas</p> <span class="badge bg-secondary "  style="height: 22px">{{count($report)}}</span>
                    </a> 
                </div> 
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card radius-10">
                <div class="card-body"> 
                     <div class="table-responsive">
                    <table id="example2" class="table ">
                        <thead>
                            <tr>
                                <th><i class="fa fa-circle"></i> </th>
                                <th>ASUNTO</th> 
                                <th>USUARIO</th>
                                <th>Descripcion</th>
                                <th>FECHA</th> 
                            </tr>
                        </thead> 
                        <tbody id="tblbody" >
                            @foreach ($report as $row)
                                <tr style="cursor: pointer;"  class="tb" onclick="View(this,{{$row->id}});" >
                                    <td>
                                    @if ($row->estado==1) 
                                    <i class="fa fa-circle text-success"></i>  <span class="text-success">Respondida</span> 
                                    @else
                                    <i class="fa fa-circle text-warning"></i>  <span class="text-warning">Respuesta pendiente</span> 
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
    </div> 
     
</div>
@endsection
@section('script')  
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
   <script>
    function Imagen() {  
        $('#nomimg').val($('#img').val()); 
    }
    function Todo() {
        location.reload();
    }
    function View(tr,id) { 
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
                    $('#plataforma').html(row.id_producto);
                    $('#user').html(row.user);
                    $('#contenido').html(row.descripcion);
                    $('#fecha').html(row.created_at);
                    if (row.respuesta==null) { 
                        $('#respuesta').html('Sin respuesta');
                    }else{ 
                        $('#respuesta').html(row.respuesta);
                    }
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
     
    $(document).ready(function() {    
        $('#example2').DataTable({
            select: true,"ordering": false,
            "pageLength": 10,
            lengthMenu: [
                [10, 15, 50, -1],
                [10, 15, 50, 'Todos']
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            }
        }); 
    });
   </script>
@endsection