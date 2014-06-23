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
        <title>Order : <?php echo $id ?> | Rin Website</title>
        <?php $order = DB::table('order')->where('order_code', $id)->first(); ?>
	</head>
	<body>

		<div class="col-md-8 col-md-offset-2">
			<a href="<?php echo $url; ?>/list"><h4><i class="fa fa-angle-left"></i> กลับไปซื้อสินค้า</h4></a>
			<div class="page-header"><h1>รายละเอียด Order</h1></div>
			<?php if($errors->has()): ?>
				<?php foreach($errors->all() as $error): ?>
				<div class="bg-danger alert"><?php echo $error ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
			<!-- For show message -->
			<?php if(Session::has('message')): ?>
				<div class="bg-success alert"><?php echo Session::get('message') ?></div>
			<?php endif; ?>
			<!-- Show Order Details -->
			<?php if(!is_null($order)) : ?>
				<dl class="dl-horizontal">
					<dt>รหัส Order</dt>
					<dd><?php echo $order->order_code ?></dd>

					<dt>ชื่อผู้สั่ง</dt>
					<dd><?php echo $order->name ?></dd>

					<dt>ที่อยู่ที่จัดส่ง</dt>
					<dd><?php echo $order->address ?></dd>

					<dt>เบอร์โทรศัพท์</dt>
					<dd><?php echo $order->phone; ?></dd>

				</dl>
				<h3>รายการสินค้าที่สั่งซื้อ</h3>

				<table class="table table-striped">
					<thead>
						<tr>
							<th class="col-md-6">ชื่อสินค้า</th>
							<th class="col-md-2">จำนวน</th>
							<th class="col-md-2">ราคา/ชิ้น</th>
							<th class="col-md-2">เป็นเงิน</th>
						</tr>
					</thead>
					<?php foreach(json_decode($order->order) as $index => $item): ?>
						<tr>
							<td><?php echo $item->name ?></td>
							<td><?php echo $item->amount ?> ชิ้น</td>
							<td><?php echo $item->price ?> บาท</td>
							<td><?php echo  ($item->amount) * ($item->price);?> บาท</td>
						</tr>
					<?php endforeach; ?>
						<tr class="warning">
							<th colspan="3">รวมเป็นเงิน</th>
							<th><?php echo $order->total_price ?> บาท</th>
						</tr>
				</table>

				<h3>สถานะการสั่งซื้อ</h3>
				<?php if(!$order->report) : ?>
					<div class="alert alert-warning">
						รอการยืนยันการโอนเงินจากผู้สั่งสินค้า
						<hr>
						<a class="btn btn-yellow black" href="<?php echo $url ?>/confirm-transfer">ยืนยันการโอนเงิน</a>
					</div>
				<?php elseif($order->report && !$order->confirm) : ?>
					<div class="alert alert-warning">กำลังตรวจสอบความถูกต้องของการโอนเงิน</div>
				<?php elseif($order->report && $order->confirm) : ?>
					<div class="alert alert-success">การสั่งซื้อเสร็จสิ้น รอรับสินค้าได้เลย</div>
				<?php endif; ?>



			<?php else : ?>
				<h3>ไม่พบ Order นี้</h3>
			<?php endif; ?>


		</div>

		
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</html>