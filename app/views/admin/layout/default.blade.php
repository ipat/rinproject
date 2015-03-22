<!doctype html>
<html>
<head>
	@include('admin.includes.head')
</head>
<body>
<div class="container">

	<header class="row">
		@include('admin.includes.header')
	</header>
	<div class="container-fluid">
		<div class="row">
			<!-- ====== Sidebar ====== -->
			@include('admin.includes.sidebar')	
			<!-- ====== Content ====== -->
			@yield('content')
		</div>
	</div>

	<footer class="row">
		@include('admin.includes.footer')
	</footer>

</div>
</body>
</html>