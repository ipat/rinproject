<html>
	<head>
		<?php $url = URL::to(""); ?>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $url ?>/css/admin-style.css">
        <style>
            body {
                margin-top: 2%;
            }
        </style>
        <title>Welcome <?php echo Auth::user()->first_name . ' ' . Auth::user()->last_name ?> | Rin Website</title>
	</head>
	<body>

		<div class="navbar navbar-default navbar-fixed-top nav-style">
			<div class="container-fluid">
				<div class="navbar-header">
					<h3 class="white"><i class="fa fa-thumbs-o-up" ></i> Welcome <?php echo Auth::user()->first_name . ' ' . Auth::user()->last_name ?> | Dashboard</h3>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li ><a class="white" href="<?php echo $url . "/admin/logout" ?>"><i class="fa fa-key"></i> Logout</a></li>
					</ul>
				</div>
			</div>			
			
		</div>

		
		<div class="container-fluid">
			<div class="row">
				<!-- ====== Sidebar ====== -->
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li class="active"><a href="<?php echo $url . "/admin/dashboard" ?>">หน้าหลัก</a></li>
						<li><a href="<?php echo $url . "/admin/managedessert" ?>">จัดการขนมหวาน</a></li>
						<li><a href="<?php echo $url . "/admin/manageorder" ?>">จัดการ Order</a></li>
					</ul>
				</div>
				<!-- ====== Content ====== -->
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">รอก่อนนะ เดี๋ยวมา :)</h1>
				</div>
			</div>
		</div>

		
		
	</body>
</html>