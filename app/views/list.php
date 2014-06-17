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
        <title>Welcome <?php echo Auth::user()->first_name . ' ' . Auth::user()->last_name ?> | Rin Website</title>
	</head>
	<body>

		<div class="col-md-6 col-md-offset-3">
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
			    		<button class="btn btn-yellow col-md-3">ใส่ตะกร้า</button>
			    	</div>
			    </div>
			  </div>
			</div>
			<?php endforeach; ?>
		</div>

		
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="<?php echo $url ?>/js/jquery.bootstrap-touchspin.js"></script>
	<script src="<?php echo $url ?>/js/shopping.js"></script>
</html>