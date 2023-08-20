@extends('admin.layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <style>
        .tb:hover {
            background-color: #e8e8f7;
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
        <div class="row mb-3">
            <form action="{{ url('/reportrepartidor') }}">
                <div class="d-flex">
                    <div>
                        <select class="form-control" name="id" id="">
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input class="form-control"type="date" name="fecha">
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>por mesa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mesa</th> 
                                        <th style="text-align: right;">total</th>
                                    </tr>
                                </thead>
                                <tbody id="tblbody">
                                    @php $Total=0;$subtotal=0; $condiez=0;$sindiez=0;@endphp
                                    @foreach ($datamesa as $row)
                                        @if ($row->colaboracion==1)
                                        @php
                                            $subtotal=$row->total +($row->total*0.1);
                                            // $condiez+=$subtotal; 
                                            $condiez+= ($row->total*0.1);
                                        @endphp 
                                        @else
                                            @php $subtotal=$row->total; $sindiez+=$subtotal;  @endphp 
                                        @endif
                                        @php   $Total+=$subtotal;  @endphp
                                        <tr style="cursor: pointer;" class="tb" onclick="View(this,{{ $row->id }});">
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->mesa }}</td> 
                                            <td style="text-align: right;"> {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total(10%): </th>
                                        <th style="text-align: right;">{{ number_format($condiez, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total(0%): </th>
                                        <th style="text-align: right;">{{ number_format($sindiez, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total: </th>
                                        <th style="text-align: right;">{{ number_format($Total, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="card">
                    <div class="card-header">
                        <h4>con tarjeta</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mesa</th> 
                                        <th style="text-align: right;">total</th>
                                    </tr>
                                </thead>
                                <tbody id="tblbody">
                                    @php $Total=0;$subtotal=0; $condiez=0;$sindiez=0;@endphp
                                    @foreach ($tarjeta as $row)
                                        @if ($row->colaboracion==1)
                                        @php $subtotal=$row->total +($row->total*0.1);  $condiez+= ($row->total*0.1);  @endphp 
                                        @else
                                            @php $subtotal=$row->total; $sindiez+=$subtotal;  @endphp 
                                        @endif
                                        @php   $Total+=$subtotal;  @endphp
                                        <tr style="cursor: pointer;" class="tb" onclick="View(this,{{ $row->id }});">
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->mesa }}</td> 
                                            <td style="text-align: right;"> {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total(10%): </th>
                                        <th style="text-align: right;">{{ number_format($condiez, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total(0%): </th>
                                        <th style="text-align: right;">{{ number_format($sindiez, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total: </th>
                                        <th style="text-align: right;">{{ number_format($Total, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="card">
                    <div class="card-header">
                        <h4>con efectivo</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mesa</th> 
                                        <th style="text-align: right;">total</th>
                                    </tr>
                                </thead>
                                <tbody id="tblbody">
                                    @php $Total=0;$subtotal=0; $condiez=0;$sindiez=0;@endphp
                                    @foreach ($efectivo as $row)
                                        @if ($row->colaboracion==1)
                                        @php $subtotal=$row->total +($row->total*0.1);  $condiez+= ($row->total*0.1);  @endphp 
                                        @else
                                            @php $subtotal=$row->total; $sindiez+=$subtotal;  @endphp 
                                        @endif
                                        @php   $Total+=$subtotal;  @endphp
                                        <tr style="cursor: pointer;" class="tb" onclick="View(this,{{ $row->id }});">
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->mesa }}</td> 
                                            <td style="text-align: right;"> {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total(10%): </th>
                                        <th style="text-align: right;">{{ number_format($condiez, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total(0%): </th>
                                        <th style="text-align: right;">{{ number_format($sindiez, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th> </th> 
                                        <th style="text-align: right;">Total: </th>
                                        <th style="text-align: right;">{{ number_format($Total, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>producto</th>
                                        <th style="text-align: right;">cantidad</th>
                                        <th style="text-align: right;">total</th>
                                    </tr>
                                </thead>
                                <tbody id="tblbody">
                                    @php $Total=0; @endphp
                                    @foreach ($venta as $row)
                                        @php   $Total+=$row->total;  @endphp
                                        <tr style="cursor: pointer;" class="tb"
                                            onclick="View(this,{{ $row->id }});">
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->producto }}</td>
                                            <td style="text-align: right;">{{ $row->cantidad }}</td>
                                            <td style="text-align: right;"> {{ number_format($row->total, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> </th>
                                        <th> </th>
                                        <th style="text-align: right;">Total: </th>
                                        <th style="text-align: right;">{{ number_format($Total, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
@endsection
