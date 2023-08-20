<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	 
	<!-- loader-->  
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">  
	<!-- Theme Style CSS --> 
	@yield('style')
	<title>Titulo - Inicio</title>
	<style>
    ::-webkit-scrollbar{ 
       width: 0px;
       border-radius: 50%;
    }  
  </style>
</head>

<body > 
    <div class="card">
        <div class="card-header">  
            <div class="d-flex justify-content-between"> 
                <h5 class="modal-title"> LISTADOS DE PEDIDOS LISTOS </h5>
                <a class="btn-close" href="{{url('/home')}}"></a> 
            </div>
        </div>
        <div class="card-body vh-100"> 
            <table class="table table-sm text-center"> 
                <thead>
                    <tr style="font-size: 22px;">
                        <th style="width: 20%"># ORDEN</th>
                        <th style="width: 55%">NOMBRE CLIENTE</th>
                        <th style="width: 25%">ESTADO</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($ventas as $item) 
                    <tr style="font-family: Lucida Console, Monaco, monospace;font-size: 20px;">
                        <td > {{$item->id}}</td>
                        <td> {{$item->cliente}}</td>
                        <td> Listo</td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div> 
    </div> 
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script> 
	@yield('script')
	<script >
		$(document).ready(function() {    
			  
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
			})    
            setInterval(() => {
                $.ajax({
                    url:"{{ route('listo.list')}}",
                    method:'GET', 
                    dataType:'json',
                    beforeSend :function(xmlHttp){ 
                    xmlHttp.setRequestHeader("If-Modified-Since","0"); 
                    xmlHttp.setRequestHeader("Cache-Control","no-cache");
                    },
                    success:function(data){   
                        let htmldata= '';
                        data.forEach(item => { 
                            htmldata+=`
                                <tr style="font-family: Lucida Console, Monaco, monospace;font-size: 20px;">
                                    <td> ${item.id}</td>
                                    <td> ${item.cliente}</td>
                                    <td> Listo </td>
                                </tr>  
                            `;
                        });  
                        $('#tbody').html(htmldata); 
                    }
                });
            }, 2000);
		});  
		 
	</script> 
</body>

</html>