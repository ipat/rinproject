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
        <title>Order Details | Rin Website</title>
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
			<form action="" method="POST" class="form-horizontal">
				<div class="form-group row">
					<label for="order-id" class="col-md-2 control-label">รหัส Order</label>
					<div class="col-md-6">
						<input type="text" id="order-id" name="order_code" class="form-control" value="<?php echo isset($id)? $id: ''; ?>" placeholder="RINXXXX">	
					</div>
					<div class="check-order"></div>
				</div>
				<div class="slide-data col-md-12">
					<dl class="dl-horizontal col-md-offset-3">
						<dt>รหัส Order</dt>
						<dd class="order-id"></dd>

						<dt>ชื่อผู้สั่ง</dt>
						<dd class="name"></dd>

						<dt>ที่อยู่ที่จัดส่ง</dt>
						<dd class="address"></dd>

						<dt>เบอร์โทรศัพท์</dt>
						<dd class="phone"></dd>
					
					</dl>
					<table class="order-list table table-striped">
	                    <thead>
	                        <tr>
	                            <th class="col-md-6">ชื่อสินค้า</th>
	                            <th class="col-md-2">จำนวน</th>
	                            <th class="col-md-2">ราคา/ชิ้น</th>
	                            <th class="col-md-2">เป็นเงิน</th>
	                        </tr>
	                    </thead>
	                </table>

					<input type="hidden" class="order" name="order">
					<div class="status"></div>
				</div>

				<div class="slide-form col-md-6 col-md-offset-3" name="slide-form">
					<div class="page-header"><h2>ยืนยันการโอนเงิน</h2></div>

					<!-- Input - Transfer to	 -->
					<div class="form-group">
						<label for="send-to-bank">โอนไปยังบัญชี <sup class="red">*</sup></label>
						<select name="send-to-bank" id="send-to-bank" class="form-control">							
						</select>
					</div>
					<!-- Input - Amount -->
					<div class="form-group">
						<label for="amount">จำนวนเงิน <sup class="red">*</sup></label>
						<div class="input-group">					      
					      	<input class="form-control" type="number" name="amount" id="amount" step="any" placeholder="XXX.XX">
					      	<div class="input-group-addon">บาท</div>
					    </div>
					</div>
					<!-- Input - Transfer from -->
					<div class="form-group">
						<label for="send-from-bank">โอนจากธนาคาร <sup class="red">*</sup></label>
						<select name="send-from-bank" id="send-from-bank" class="form-control">							
						</select>
					</div>
					<!-- Input - Date of Transfer -->
					<div class="form-group">
						<label for="date">วันที่โอน <sup class="red">*</sup></label>
						<div class="input-group">
							<div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
							<input type="date" name="date" id="date" class="form-control">
						</div>
					</div>
					<!-- Input - Time of Transfer -->
					<div class="form-group">
						<label for="time">เวลาที่โอน <sup class="red">*</sup></label>
						<div class="input-group">
							<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
							<input type="time" name="time" id="time" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="picture">หลักฐานการโอน (ถ้ามี)</label>
						<input type="file" name="picture" id="picture" class="form-control">
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btn btn-yellow" value="ยืนยันการโอนเงิน">
					</div>
				</div>				
				
			</form>


		</div>

		
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>/js/query-order.js"></script>

</html>