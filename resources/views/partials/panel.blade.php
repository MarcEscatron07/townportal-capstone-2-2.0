<div class="container-shadow mb-4 p-3">
	@hasSection('title')
		<h1 class="mb-3">@yield('title')</h1>
	@endif
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-light m-0 ">
			<li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home mr-2"></i>Home</a> @yield('breadcrumb')</li>
		</ol>
	</nav>				
</div>