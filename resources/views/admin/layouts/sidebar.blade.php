<div class="sidebar-wrapper" data-simplebar="true" style="background-color: #272221f2;">
	<div class="sidebar-header">
		<div>
			<img src="assets/images/logo-icon.png" width="120"  alt="logo icon">
		</div>
		{{-- <div>
			<h6 class="logo-text">Restaurante</h6>
		</div> --}}
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu" >
		<li class="menu-label" >INICIO</li>
		<li>
			<a href="{{ url('/home') }}" class="pt-1 pb-1">
				<div class="parent-icon">
					<i class='bx bx-home-circle'></i>
				</div>
				<div class="menu-title">Inicio</div>
			</a>
		</li>  
        <li class="menu-label pt-1">APLICACIONES</li>
		<li>
			<a href="{{url('/ausuario')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Usuarios</div>
			</a>
		</li> 
		<li>
			<a href="{{url('/mesa')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Mesa</div>
			</a>
		</li> 
		<li>
			<a href="{{url('/menu')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Menu</div>
			</a>
		</li> 
		<li>
			<a href="{{url('/listmesas')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Ordenes</div>
			</a>
		</li>  
		<li class="menu-label pt-1">ECONOMIA</li>
		<li>
			<a href="{{url('/gastos')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Gastos</div>
			</a>
		</li>  
		 
		<li>
			<a href="{{url('/prestamos')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Gestionar Prestamos</div>
			</a>
		</li>  
		<li>
			<a href="{{url('/deudas')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i>
				</div>
				<div class="menu-title">Gestionar Deudas</div>
			</a>
		</li>   
		<li class="menu-label pt-1">CHEF</li>
		<li>
			<a href="{{url('/cocina')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i> <span id="r_juegos_" class="alert-count"  style="display: none;  transform: translate(5px,-3px);" ></span>
				</div>
				<div class="menu-title">Cocina</div>
			</a>
		</li> 
		<li class="menu-label pt-1">REPORTE CUENTAS</li>
		<li>
			<a href="{{url('/reportasCliente')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i> <span id="r_juegos_" class="alert-count"  style="display: none;  transform: translate(5px,-3px);" ></span>
				</div>
				<div class="menu-title">Comentarios</div>
			</a>
		</li> 
		<li>
			<a href="{{url('/reportrepartidor')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i> <span id="r_juegos_" class="alert-count"  style="display: none;  transform: translate(5px,-3px);" ></span>
				</div>
				<div class="menu-title">Reporte Repartidor</div>
			</a>
		</li> 
		<li>
			<a href="{{url('/preparando')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i> <span id="r_juegos_" class="alert-count"  style="display: none;  transform: translate(5px,-3px);" ></span>
				</div>
				<div class="menu-title">pantalla Preparando</div>
			</a>
		</li> 
		<li>
			<a href="{{url('/listo')}}" class="pt-1 pb-1 ">
				<div class="parent-icon">
					<i class='bx bx-collection'></i> <span id="r_juegos_" class="alert-count"  style="display: none;  transform: translate(5px,-3px);" ></span>
				</div>
				<div class="menu-title">pantalla Listo</div>
			</a>
		</li> 
		
	</ul> 
	<br>
	<br>
	<br>
	<li> 
	</li> 
</div>