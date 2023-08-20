@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mt-0">
            <div class="breadcrumb-title pe-2">MESAS </div>
            <div class="ps-3  pt-3">
                <p>Generar orden</p>
            </div>
        </div>
        <hr />
        <div class="row">
            @foreach ($mesa as $row) 
                @if ($row->estado==0)
                    <div class="col-sm-4 col-md-3 col-lg-2 d-flex justify-content-center align-items-center">
                        <a onmouseout="reinicializarTooltips();" href="{{route('orden','code='.$row->id)}}" class="card rounded-circle" style="height: 120px; width:120px" data-bs-toggle="tooltip" data-bs-placement="top" title="Mesa libre">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <span style="color:rgb(5, 54, 146);  font-weight: bold; font-size: 18px;"> {{$row->nombre}} </span>
                            </div>
                        </a>
                    </div>  
                @else 
                    <div class="col-sm-4 col-md-3 col-lg-2 d-flex justify-content-center align-items-center">
                        <a onmouseout="reinicializarTooltips();"  href="" class="card rounded-circle" style="height: 120px; width:120px; background-color:rgb(255, 72, 0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Mesa ocupado" >
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <span style="color:rgb(255, 255, 255);  font-weight: bold; font-size: 18px;"> {{$row->nombre}} </span>
                            </div>
                        </a>
                    </div> 
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('script')
<script> 
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip(); 
    });
    function reinicializarTooltips() { 
        $('[data-toggle="tooltip"]').tooltip('dispose');  
        $('[data-toggle="tooltip"]').tooltip();  
    } 
</script>
@endsection
