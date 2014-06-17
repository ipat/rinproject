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
		<?php $dessert = DB::table('dessert')->where('id', $id)->first(); ?>
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
						<li class="active"><a href="<?php echo $url . "/admin/managedessert" ?>">จัดการขนมหวาน</a></li>
						<li><a href="<?php echo $url . "/admin/manageorder" ?>">จัดการ Order</a></li>
					</ul>
				</div>
				<!-- ====== Content ====== -->
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

					<div class="page-header">
						<h1>แก้ไขขนมหวาน | <?php echo $dessert->name ?></h1>
						<div class="pull-right">
							<div class="btn btn-yellow float-right"><a class="white" href="<?php echo $url . '/admin/managedessert' ?>"><i class="fa fa-angle-left"></i> กลับหน้าหลัก</a></div>
						</div>						
					</div>
					<?php if($errors->has()): ?>
						<?php foreach($errors->all() as $error): ?>
						<div class="bg-danger alert"><?php echo $error ?></div>
						<?php endforeach; ?>
					<?php endif; ?>
					
					<div>
						<form method="POST" action="" class="form-horizontal"  enctype="multipart/form-data">

							<div class="form-group">
								<label for="name" class="control-label col-md-2">แก้ไขชื่อสินค้า<sup class="red">*</sup></label>
								<div class="col-md-10">
									<input type="text" name="name" id="name" placeholder="ใส่ชื่อสินค้า" class="form-control" value="<?php echo $dessert->name; ?>">
								</div>
								
							</div>
							
							<div class="form-group">
								<label for="description" class="control-label col-md-2">แก้ไขรายละเอียดสินค้า</label>
								<div class="col-md-10">
									<textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="ใส่รายละเอียดสินค้า"><?php echo $dessert->description ?></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="price" class="control-label col-md-2">แก้ไขราคาสินค้า<sup class="red">*</sup></label>
								<div class="col-md-9">
									<input type="number" name="price" id="price" placeholder="ใส่ราคาสินค้า" class="form-control"  value="<?php echo $dessert->price ?>">
								</div>
								<label for="price" class="control-label col-md-1">บาท</label>
							</div>
							
							<div class="form-group">
								<label for="picture" class="control-label col-md-2">เปลี่ยนรูปสินค้า <small class="gray">(เว้นไว้หากไม่ต้องการเปลี่ยน)</small></label>
								<div class="col-md-10">
									<img src="<?php echo $dessert->image_url ?>" alt="<?php echo $dessert->name ?>" class="img-thumbnail preview-thumb">
									<input type="file" name="picture" id="picture"class="form-control" >
								</div>
							</div>

							<div class="col-md-offset-2">
								<input type="submit" accept="image/*" class="btn btn-yellow white">
							</div>
  
						</form>
						

					</div>
					
				</div>
			</div>
		</div>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		
	</body>
</html>