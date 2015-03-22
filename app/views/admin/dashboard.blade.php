<html>
	<head>
		@extends('admin.includes.head')	
		
        <?php $url = URL::to(""); ?>
	</head>
	<body>

		
		@extends('admin.includes.header')	
		
		<div class="container-fluid">
			<div class="row">
				<!-- ====== Sidebar ====== -->
				@extends('admin.includes.sidebar')	
				<!-- ====== Content ====== -->
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">รอก่อนนะ เดี๋ยวมา :)</h1>
				</div>
			</div>
		</div>

		
		
	</body>
</html>