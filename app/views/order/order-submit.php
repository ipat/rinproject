<html>
	<head>
		<?php $url = URL::to(""); ?>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $url ?>/css/admin-style.css">
        <link rel="stylesheet" href="<?php echo $url ?>/css/jquery.bootstrap-touchspin.css">
        <?php $cart = isset($_COOKIE['cart'])? $_COOKIE['cart']:null; ?>
        <style>
            body {
                margin-top: 2%;
            }
        </style>
        <title>Welcome To Rin Thai Dessert Store</title>
	</head>
	<body>
		
		<!-- Main Content -->
		<div class="col-md-8 col-md-offset-2">
			<a href="<?php echo $url; ?>/list"><h4><i class="fa fa-angle-left"></i> กลับไปซื้อสินค้า</h4></a>
			<div class="page-header">
				<h1>ยืนยันการสั่งซื้อ</h1>
			</div>
			<?php if($errors->has()): ?>
				<?php foreach($errors->all() as $error): ?>
				<div class="bg-danger alert"><?php echo $error ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if(isset($cart) && $cart !== 'null'): ?>
				<?php $desserts = DB::table('dessert')->get();  $cart = json_decode($cart); ?>
				<?php
				// FIND PRODUCT IN CART FROM DB
					$productsInCart = array();
					foreach ($cart as $key => $value) {
						foreach ($desserts as $keyD => $valueD) {
						 	if($value->id == $valueD->id){
						 		$valueD->amount = $value->amount;						 		
						 		array_push($productsInCart, $valueD);
						 		break;
						 	}
						} 	
					} 
					$totalPrice = 0;

				 ?>
				<h3>รายการสั่งซื้อมีดังนี้</h3>
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="col-md-6">ชื่อสินค้า</th>
							<th class="col-md-2">จำนวน</th>
							<th class="col-md-2">ราคา/ชิ้น</th>
							<th class="col-md-2">เป็นเงิน</th>
						</tr>
					</thead>
					<?php foreach($productsInCart as $index => $item): ?>
						<tr>
							<td><?php echo $item->name ?></td>
							<td><?php echo $item->amount ?> ชิ้น</td>
							<td><?php echo $item->price ?> บาท</td>
							<td><?php $totalPrice += ($item->amount) * ($item->price); echo  ($item->amount) * ($item->price);?> บาท</td>
						</tr>
					<?php endforeach; ?>
						<tr class="warning">
							<th colspan="3">รวมเป็นเงิน</th>
							<th><?php echo $totalPrice ?> บาท</th>
						</tr>
				</table>
				<h3>กรอกรายละเอียดการสั่งซื้อ</h3>
				<div class="container-fluid">
					<form class="form-horizontal" action="" method="POST">
						<div class="form-group">
							<label for="name" class="col-md-2">ชื่อ-นามสกุล<sup class="red">*</sup></label>
							<div class="col-md-10">
								<input type="text" id="name" class="form-control" name="name" placeholder="ชื่อ-นามสกุล" value="<?php echo Input::old('name'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="address" class="col-md-2">ที่อยู่<sup class="red">*</sup></label>
							<div class="col-md-10">
								<textarea name="address" id="address" cols="30" rows="5" placeholder="ที่อยู่ในการจัดส่ง"  class="form-control"><?php echo Input::old('address') ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-md-2">เบอร์โทรศัพท์<sup class="red">*</sup></label>
							<div class="col-md-10">
								<input type="text" id="phone" class="form-control" name="phone" placeholder="0XX-XXXXXXX" value="<?php echo Input::old('phone') ?>">
							</div>
						</div>
						<div class="form-group">
							<small class="col-md-12"><span class="red">หมายเหตุ</span> ร้านรินขนมหวาน ขอสงวนสิทธิ์ในการติดต่อกลับกรณีที่ข้อมูลที่กรอกมานั้นไม่สามารถนำจัดส่งหรือสามารถติดต่อกลับได้</small>
							<input type="hidden" name="cart" value="<?php echo htmlspecialchars(json_encode($productsInCart), ENT_QUOTES); ?>">
							<input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
						</div>
						<input type="submit" class="btn btn-yellow" value="ยืนยัน">
					</form>
				</div>

			<?php else : ?>
				<h3>ยังไม่มีสินค้าในตะกร้า</h3>
			<?php endif; ?>
			
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