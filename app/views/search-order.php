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
        <title>ค้นหา Order | Rin Website</title>
	</head>
	<body>

		<div class="col-md-8 col-md-offset-2">
			<a href="<?php echo $url; ?>/list"><h4><i class="fa fa-angle-left"></i> กลับไปซื้อสินค้า</h4></a>
			<div class="page-header"><h1>ค้นหา Order</h1></div>

			<form action="" method="POST">
				<label for="search">รหัส Order</label>
				<input type="text" name="search" id="search" class="form-control" placeholder="RINXXXX">
				<br>
				<input type="submit" value="ค้นหา" class="btn btn-yellow">
			</form>


		</div>
		<!-- Sidebar OR Cart -->
		<div class="col-md-2">
			<div class="btn btn-yellow pop-cart" data-placement="bottom" data-toggle="popover">
				<span class="glyphicon glyphicon-shopping-cart"></span>
			</div>
		</div>
		
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="<?php echo $url ?>/js/jquery.bootstrap-touchspin.js"></script>
	<script src="<?php echo $url ?>/js/shopping.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</html>