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
						<li><a href="<?php echo $url . "/admin/dashboard" ?>">หน้าหลัก</a></li>
						<li><a href="<?php echo $url . "/admin/managedessert" ?>">จัดการขนมหวาน</a></li>
						<li class="active"><a href="<?php echo $url . "/admin/manageorder" ?>">จัดการ Order</a></li>
					</ul>
				</div>
				<!-- ====== Content ====== -->
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<div class="page-header">
						<h1>จัดการ Order</h1>
						<div class="pull-right">
							<div class="btn btn-yellow float-right"><a class="white" href="<?php echo $url . '/admin/adddessert' ?>"><i class="fa fa-plus"></i> เพิ่มขนมหวาน</a></div>
						</div>						
					</div>
					<?php if($errors->has()): ?>
						<?php foreach($errors->all() as $error): ?>
						<div class="bg-danger alert"><?php echo $error ?></div>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if(Session::has('message')): ?>
						<div class="bg-success alert"><?php echo Session::get('message') ?></div>
					<?php endif; ?>


					<table class="table table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>รูปภาพ</th>
								<th>ชื่อสินค้า</th>
								<th>รายละเอียดสินค้า</th>
								<th>ราคา</th>
								<th>แก้ไข</th>
								<th>ลบ</th>
							</tr>
							
						</thead>
						<tbody>
							<?php $desserts = DB::table('dessert')->get(); $emptyDessert = sizeof($desserts) == 0?>
							<?php foreach($desserts as $dessert): ?>
								<tr>
									<td><?php echo $dessert->id ?></td>
									<td><img src="<?php echo $dessert->image_url ?>" alt="<?php echo $dessert->name ?>" class="img-thumbnail preview-thumb"></td>
									<td><?php echo $dessert->name ?></td>
									<td><?php echo $dessert->description ?></td>
									<td><?php echo $dessert->price ?> บาท</td>
									<td><a href="<?php echo $url . '/admin/editdessert/' . $dessert->id  ?>" >แก้ไข</a></td>
									<td><a data-href="<?php echo $url . '/admin/earsedessert/' . $dessert->id  ?>" data-dessertName="<?php echo $dessert->name ?>" data-toggle="modal" data-target="#myModal" href="#">ลบ</a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<?php if($emptyDessert): ?>
						<h3 class="text-center">ยังไม่มีขนมหวานเลยอะคับ</h3>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">ลบข้อมูล</h4>
		      </div>
		      <div class="modal-body">
		        ท่านแน่ใจที่จะลบข้อมูลขนมนี้หรือไม่?
		      </div>
		      <div class="modal-footer">
		        <a type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
		        <a type="button" class="btn btn-danger danger">ลบ</a>
		      </div>
		    </div>
		  </div>
		</div>
		
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#myModal').on('show.bs.modal', function(e) {
			    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
			});
		});
		
	</script>
	
</html>