<html>
	<head>
		<?php $url = URL::to(""); ?>
		<!-- HERE IS LISTS PER PAGE -->
		<?php 	$lists_per_page = 5;?>
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
						<h1>จัดการ Order - 
						<!-- ======== We Query Orders by Type Here ========== -->						
						<?php if($sort == 'date') {
								echo "ดู Order ค้างทั้งหมด";
								$orders = DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 0)->skip(($page-1) * $lists_per_page)->take($lists_per_page)->get();
								$number_of_pages = ceil((DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 0)->count()) / $lists_per_page);
								
							} else if($sort == 'today') {
								echo "ดู Order วันนี้";
								$today     = date("Y-m-d H:i:s", time());
								$yesterday = date("Y-m-d H:i:s", strtotime("-1 day", time()));
								$orders = DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 0)->whereBetween('submitted_time', array($yesterday, $today))->skip(($page-1) * $lists_per_page)->take($lists_per_page)->get();
								$number_of_pages = ceil((DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 0)->whereBetween('submitted_time', array($yesterday, $today))->count()) / $lists_per_page);
							} else if($sort == 'confirm_transfer') {
								echo "ดู Order ที่ยืนยันการโอนเงินแล้ว";
								$orders = DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 0)->where('transfer', 1)->skip(($page-1) * $lists_per_page)->take($lists_per_page)->get();
								$number_of_pages = ceil((DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 0)->where('transfer', 1)->count()) / $lists_per_page);
							} else if($sort == 'confirm_approve') {
								echo "ดู Order เก่า (ทางร้านยืนยันจะจัดส่งแล้ว)";
								$orders = DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 1)->skip(($page-1) * $lists_per_page)->take($lists_per_page)->get();
								$number_of_pages = ceil((DB::table('order')->orderBy('submitted_time', 'desc')->where('confirm', 1)->count()) / $lists_per_page);
							}
						?>
						</h1>
						<h3 class="text-right float-right" style="font-size:1.5em">
							หน้า <?php echo $page ?> จาก <?php echo $number_of_pages ?>
						</h3>
					</div>
					<?php if($errors->has()): ?>
						<?php foreach($errors->all() as $error): ?>
						<div class="bg-danger alert"><?php echo $error ?></div>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if(Session::has('message')): ?>
						<div class="bg-success alert"><?php echo Session::get('message') ?></div>
					<?php endif; ?>
					
					<div class="container-fluid">
						<div class="btn-group">
							<a href="<?php echo $url ?>/admin/manageorder/date" class="btn <?php echo ($sort=='date')? 'btn-primary':'btn-default'; ?>">ดู Order ค้างทั้งหมด</a>
							<a href="<?php echo $url ?>/admin/manageorder/today" class="btn <?php echo ($sort=='today')? 'btn-primary':'btn-default'; ?>">ดู Order วันนี้</a>
							<a href="<?php echo $url ?>/admin/manageorder/confirm_transfer" class="btn <?php echo ($sort=='confirm_transfer')? 'btn-primary':'btn-default'; ?>">ดู Order แจ้งการโอนเงินแล้ว</a>
							<a href="<?php echo $url ?>/admin/manageorder/confirm_approve" class="btn <?php echo ($sort=='confirm_approve')? 'btn-primary':'btn-default'; ?>">ดู Order เก่า (ทางร้านยืนยันจะจัดส่งแล้ว)</a>
						</div>
						<div class="text-right" style="float:right">
							แสดง <?php echo $lists_per_page ?> รายการต่อหน้า จากใหม่สุดไปเก่าสุด
						</div>
					</div>
					

					<table class="table">
						<thead>
							<tr>
								<th>No.</th>
								<th>Order Code</th>
								<th>ชื่อผู้สั่งสินค้า</th>
								<th>เบอร์โทร</th>
								<th>ราคารวม</th>
								<th>ที่อยู่</th>
								<th>ดูรายละเอียด</th>
							</tr>
							
						</thead>
						<tbody>
							
							<?php $emptyOrder = sizeof($orders) == 0?>
							<?php foreach($orders as $order): ?>
								<tr class="<?php echo ($order->seen)? '':'row-striped'; ?>">
									<td><?php echo $order->id ?></td>
									<td><?php echo $order->order_code ?></td>
									<td><?php echo $order->name ?></td>
									<td><?php echo $order->phone ?></td>
									<td><?php echo $order->total_price ?> บาท</td>
									<td><?php echo $order->address ?></td>
									<td><a href="<?php echo $url . "/admin/orderdetails/" . $order->order_code; ?>">ดูรายละเอียด</a></td>
								</tr>
								<!-- <tr>
									<td colspan="7">
										<div class="col-md-10 col-md-offset-1">
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
										</div>
									</td>
								</tr> -->
							<?php endforeach ?>
						</tbody>
					</table>
					<?php if($emptyOrder): ?>
						<h3 class="text-center">ยังไม่มี Order ครับ</h3>
					<?php endif; ?>
					<div class="text-center">
						<ul class="pagination">
							<?php if($page > 1) : ?>
								<li><a href="<?php echo $url . '/admin/manageorder/' . $sort . '/1'; ?>">หน้าแรก</a></li>
							<?php endif; ?>
							<?php for ($i=1; $i <= $number_of_pages; $i++) {
								$active = ($page == $i)? 'active':'';
								echo "<li class='" . $active ."'><a href='" . $url . "/admin/manageorder/" . $sort . "/" . ($i) . "'>" . ($i) ."</a></li>"	;
							} ?>
							<?php if($page < $number_of_pages) : ?>
								<li><a href="<?php echo $url . '/admin/manageorder/' . $sort . '/' . ($number_of_pages); ?>">หน้าสุดท้าย</a></li>
							<?php endif; ?>
						</ul>
					</div>

				</div>
			</div>
		</div>

		
		
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
	
</html>