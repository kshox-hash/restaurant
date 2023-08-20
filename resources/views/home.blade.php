@extends('admin.layouts.app')
@section('style')
   	<link href="{{asset('assets/css/owl.carousel.min.css')}}" rel="stylesheet" />
   	<link href="{{asset('assets/css/owl.theme.default.min.css')}}" rel="stylesheet" />
 <style>
        .swal2-html-container {
            z-index: 1;
            justify-content: center;
            /* margin: 1em 1.6em 0.3em; */
            padding: 0;
            overflow: auto;
            color: inherit;
            font-size: 1.125em;
            font-weight: normal;
            line-height: normal;
            text-align: center;
            word-wrap: break-word;
            word-break: break-word;
        }
        .owl-carousel .owl-item {
        position: relative;
        cursor: url("{{asset('img/cursor.png')}}"),move;
        overflow: hidden;
        }
        .owl-theme:after {
            content: '';
            display: block;
            right: 0;
            background: linear-gradient(to right,transparent 0%,#eaedf7 100%);
            bottom: 0;
            position: absolute;
            width: 100px;
            height: 100%;
            z-index: 1;
        }
        .owl-theme:before {
            content: '';
            display: block;
            left: 0;
            background: linear-gradient(to left,transparent 0%,#eaedf7 100%);
            bottom: 0;
            position: absolute;
            width: 100px;
            height: 100%;
            z-index: 1;
        } 
    </style>
@endsection
@section('content')
<div class="page-content">  
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 pt-1 h1">INICIO </div>
        <div class="ps-3">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0"> 
                    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
                </ol>
            </nav>
        </div> 
    </div> 
    <hr/>
    <div class="row"> 
        <div class="col-sm-12 col-lg-12 col-xl-8 mb-3"> 
            <div class="card">
                <div class="p-1">  
                    <div id="carouselExampleFade" class="carousel slide carousel-fade rounded-4" data-bs-ride="carousel">
                        <div class="carousel-inner"> 
                            <div class="carousel-item active">
                                <img src="{{asset('/img/s1.jpg')}}" height="450px" class="d-block w-100 rounded-4" alt="...">
                            </div>
                            <div class="carousel-item ">
                                <img src="{{asset('/img/s2.jpg')}}" height="450px" class="d-block w-100 rounded-4" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('/img/s3.jpg')}}" height="450px" class="d-block w-100 rounded-4" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev border-0 bg-transparent" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev"> 
                            <i class="fa fa-angle-left text-dark" aria-hidden="true" style="font-size: 40px; font-weight: bold;"></i>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next border-0 bg-transparent" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next"> 
                            <i class="fa fa-angle-right text-dark"aria-hidden="true" style="font-size: 40px; font-weight: bold;"></i>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>   
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-12 col-xl-4"> 
                <div class="card custom-card rounded-6">
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-8">
                                <div class="card-item-title">
                                    <label class="main-content-label tx-13 font-weight-bold mb-2">TOTAL DE COMPRAS</label>
                                    <span class="d-block tx-12 mb-0 text-muted">compras segun el tipo de pago</span>
                                </div>
                                @foreach ($tipo_pago as $item)
                                 @if ($item->tipo_pago==1) 
                                    <div class="row">  
                                        <div class="col-lg-6"> 
                                            <p class="mb-0 tx-24 mt-2">Efectivo:</p>  
                                        </div>
                                        <div class="col-lg-6"> 
                                            <p class="mb-0 tx-24 mt-2"><b class="text-primary"># {{$item->total}}</b></p> 
                                        </div>
                                    </div>
                                @else 
                                    <div class="row"> 
                                        <div class="col-lg-6"> 
                                            <p class="mb-0 tx-24">Tarjeta:</p>  
                                        </div>
                                        <div class="col-lg-6"> 
                                            <p class="mb-0 tx-24"><b class="text-primary"># {{$item->total}}</b></p> 
                                        </div> 
                                    </div>
                                 @endif
                                @endforeach
                            </div> 
                            <div class="col-4">
                                <img src="{{asset('img/work.png')}}" width="100" alt="image" class="best-emp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card custom-card rounded-6">
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-12">
                                <div class="card-item-title">
                                    <label class="main-content-label tx-13 font-weight-bold mb-2">TOTAL DE EGRESOS E INGRESOS</label>
                                    {{-- <span class="d-block tx-12 mb-0 text-muted">compras segun el tipo de pago</span> --}}
                                </div>
                                @foreach ($tipo_pago as $item)
                                 @if ($item->tipo_pago==1) 
                                    <div class="row">  
                                        <div class="col-lg-4"> 
                                            <p class="mb-0 tx-24">Egresos:</p>  
                                        </div>
                                        <div class="col-lg-8"> 
                                            <p class="mb-0 tx-24 mt-2"><b class="text-secondary"> $ {{$gastos}}</b></p> 
                                        </div>
                                    </div>
                                    @else 
                                    <div class="row"> 
                                        <div class="col-lg-4"> 
                                            <p class="mb-0 tx-24 ">Ingreso:</p>  
                                        </div>
                                        <div class="col-lg-8"> 
                                            <p class="mb-0 tx-24"><b class="text-secondary">$ {{$ingresos}}</b></p> 
                                        </div> 
                                    </div>
                                 @endif
                                @endforeach
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="card custom-card pb-0">
                    <div class="card-body"> 
                        <label class="main-content-label mb-2 pt-1">Clientes Frecuentes</label>
                        <span class="d-block tx-12 mb-2 text-muted">Los 5 clientes mas frecuentes</span>
                        <table class="table table-hover m-b-0 transcations mt-2">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Telefono</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($topclient as $row) 
                                <tr>
                                    <td class="wd-5p">
                                        <div class="d-flex align-middle ml-3">
                                            <div class="d-inline-block">
                                                <h6 class="mb-1">{{$row->nombre}}</h6> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end ml-3">
                                            <div class="d-inline-block ">
                                                <p class="mb-0 tx-11 text-muted">{{$row->telefono}} </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="d-inline-block float-star"> 
                                            <p class="mb-0 tx-11 text-muted">{{$row->total}} <i class="fas fa-level-up-alt ml-2 text-success m-l-10"></i></p>
                                        </div>
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
@endsection
@section('script')  
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>  
 
@endsection


