<html>
	<head>
		<?php $url = URL::to(""); ?>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $url ?>/css/admin-style.css">
        <link rel="stylesheet" href="<?php echo $url ?>/css/jquery.bootstrap-touchspin.css">
        <style>
            body {
                margin-top: 2%;
            }
        </style>
        <title>Welcome To Rin Thai Dessert Store</title>
	</head>
	<body>
		
		<!-- Main Content -->
		<div class="col-md-6 col-md-offset-3">
			<div class="page-header">
				<h1>รายการขนมหวาน</h1>
			</div>

			<?php $desserts = DB::table('dessert')->get(); ?>
			<?php foreach($desserts as $dessert): ?>
			<div class="panel panel-default">
			  <div class="panel-body">
			    <div class="col-md-4">
			    	<img src="<?php echo $dessert->image_url ?>" alt="<?php echo $dessert->name ?>" class="img-circle preview-thumb">
			    </div>
			    <div class="col-md-7 col-md-offset-1">
			    	<b>ชื่อ : </b><?php echo $dessert->name; ?>
			    	<br>
			    	<b>รายละเอียด : </b><?php echo $dessert->description; ?>
			    	<br>
			    	<b>ราคา : </b><?php echo $dessert->price; ?> บาท
			    	<br><br>
			    	<div class="form-group">
			    		<label for="item<?php echo $dessert->id ?>" class="control-label col-md-2">จำนวน</label>
			    		<div class="col-md-7">
			    			<input type="number" class="number-item form-control" name="item<?php echo $dessert->id; ?>">
			    		</div>
			    		<button class="btn btn-yellow col-md-3" onclick="addToCart(<?php echo $dessert->id ?>, '<?php echo $dessert->name ?>');">ใส่ตะกร้า</button>
			    	</div>
			    </div>
			  </div>
			</div>
			<?php endforeach; ?>
		</div>
		<!-- Sidebar OR Cart -->
		<div class="col-md-3">
			<div class="btn btn-yellow pop-cart" data-placement="bottom" data-toggle="popover">
				<span class="glyphicon glyphicon-shopping-cart"></span>
			</div>
			<div class="btn btn-yellow">
				<a href="<?php echo $url ?>/search-order" style="text-decoration:none; color:black" class="glyphicon glyphicon-search"></a>
			</div>
		</div>

		<!-- Information Modal -->
		<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
		      </div>
		      <div class="modal-body">
		        ...
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">ตกลง</button>
		      </div>
		    </div>
		  </div>
		</div>
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="<?php echo $url ?>/js/jquery.bootstrap-touchspin.js"></script>
	<script src="<?php echo $url ?>/js/shopping.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</html>