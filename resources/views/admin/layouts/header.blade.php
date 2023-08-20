<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">
					{{-- <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span> --}}
					<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
				</div>
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item mobile-search-icon">
						<a class="nav-link" href="#"><i class='bx bx-search'></i>
						</a>
					</li> 
					<li class="nav-item dropdown dropdown-large" style="display: none"> 
						<button type="button" class="btn btn-primary px-3 radius-30" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Saldo actual">
							Saldo: {{Auth::user()->saldo}}
						</button>
					</li>  
					@if (Auth::user()->rol==1) 
					<li class="nav-item dropdown dropdown-large">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span id="id_numero" class="alert-count" style="display: none"></span>
							<i class='bx bx-bell'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">Notificaciones</p>
									<p class="msg-header-clear ms-auto">Recarga de saldo</p>
								</div>
							</a>
							<div id="notificaciones" class="header-notifications-list"> 
								 
							</div> 
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span id="id_numero_" class="alert-count"  style="display: none"></span>
							<i class='bx bx-comment'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">Notificaciones</p>
									<p class="msg-header-clear ms-auto">Link de pago</p>
								</div>
							</a>
							<div id="notificaciones_" class="header-message-list">
								  
							</div> 
						</div>
					</li>
					@else
					<li class="nav-item dropdown dropdown-large" style="display: none">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span   class="alert-count">5</span>
							<i class='bx bx-bell'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">Notifications</p>
									<p class="msg-header-clear ms-auto">Marks all as read</p>
								</div>
							</a>
							<div id="notificaciones" class="header-notifications-list"> 
								<a class="dropdown-item" href="javascript:;">
									<div class="d-flex align-items-center">
										<div class="user-online">
											<img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
										</div>
										<div class="flex-grow-1">
											<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
										ago</span></h6>
											<p class="msg-info">The standard chunk of lorem</p>
										</div>
									</div>
								</a> 
							</div>
							<a href="javascript:;">
								<div class="text-center msg-footer">View All Notifications</div>
							</a>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large" style="display: none">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
							<i class='bx bx-comment'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">Messages</p>
									<p class="msg-header-clear ms-auto">Marks all as read</p>
								</div>
							</a>
							<div class="header-message-list">
								<a class="dropdown-item" href="javascript:;">
									<div class="d-flex align-items-center">
										<div class="user-online">
											<img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
										</div>
										<div class="flex-grow-1">
											<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
										ago</span></h6>
											<p class="msg-info">The standard chunk of lorem</p>
										</div>
									</div>
								</a> 
							</div>
							<a href="javascript:;">
								<div class="text-center msg-footer">View All Messages</div>
							</a>
						</div>
					</li>
					@endif
				</ul>
			</div>
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					@if (Auth::user()->img!=null) 
					<img src="{{asset('usuario').'/'.Auth::user()->img}}" class="user-img" alt="user avatar" >
					@else 
					<img src="{{ asset('img/avatar.png') }}" class="user-img" alt="user avatar" >
					@endif
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{ Auth::user()->name}}</p>
						<p class="designattion mb-0 text-center">
							@if (Auth::user()->rol==1)
								Admin
							@else
								Trabajador
							@endif
						</p>
					</div>
					@if  (Auth::user()->rol==2)  
					<a class="nav-link   position-relative mt-1" href="#" onclick="Alerts();" > <span id="id_numero_c" class="alert-count mx-1" style="display: none;">0</span>
						<i class='bx bx-bell h4 '></i>
					</a>  
					@endif
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="{{url('/mi-perfil')}}"><i class="bx bx-user"></i><span>Mi perfil</span></a>
					</li>
					<!--  
					<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
					</li> 
					-->
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li>
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Cerrar sesión</span></a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>
<script>
	function Alerts() {
		$(".switcher-wrapper").toggleClass("switcher-toggled");
	}
</script>