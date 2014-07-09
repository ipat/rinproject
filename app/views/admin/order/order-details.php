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
						<h3><a href="<?php echo URL::previous(); ?>"><< กลับไปหน้าก่อนหน้า</a></h3>
						<h1>จัดการ Order - <?php echo $order_code ?></h1>
					</div>
					<?php if($errors->has()): ?>
						<?php foreach($errors->all() as $error): ?>
						<div class="bg-danger alert"><?php echo $error ?></div>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if(Session::has('message')): ?>
						<div class="bg-success alert"><?php echo Session::get('message') ?></div>
					<?php endif; ?>

					<?php $order = DB::table('order')->where('order_code', $order_code)->first(); ?>
					
					<!-- Check that is that order avaliable -->
					<?php if(!is_null($order)) :  ?>
					<div class="slide-data col-md-12">
						<dl class="dl-horizontal col-md-offset-3"  style="font-size:120%">
							<dt>รหัส Order</dt>
							<dd class="order-id"><?php echo $order->order_code ?></dd>

							<dt>ชื่อผู้สั่ง</dt>
							<dd class="name"><?php echo $order->name ?></dd>

							<dt>ที่อยู่ที่จัดส่ง</dt>
							<dd class="address"><?php echo $order->address ?></dd>

							<dt>เบอร์โทรศัพท์</dt>
							<dd class="phone"><?php echo $order->phone ?></dd>
						
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
		                    <?php $order_lists = json_decode($order->order); ?>
		                    <?php foreach ($order_lists as $index => $item): ?>
								<tr>
									<th><?php echo $item->name; ?></th>
									<th><?php echo $item->amount ?></th>
									<th><?php echo $item->price ?> บาท</th>
									<th><?php echo ($item->amount * $item->price) ?> บาท</th>
								</tr>
		                	<?php endforeach; ?>
		                	<tr class="warning">
		                		<th colspan="3">รวมเป็นเงิน</th>
		                		<th><?php echo $order->total_price ?> บาท</th>
		                	</tr>
		                </table>

						<?php if($order->transfer == 1 && $order->confirm != 1) : ?>
							<div class="alert alert-warning"><h3 class="text-center">Order นี้รอการตรวจสอบการยืนยันการโอนเงิน และยืนยันการจัดส่ง</h3></div>
							<!-- Here show transfer transaction -->
							<div class="container-fluid">
								<!-- QUERY USER CONFIRMATION -->
								<div class="col-md-3 text-left">
									<?php $confirm = DB::table('confirm-transfer')->where('order_id', $order->id)->first(); ?>
									<?php if($confirm->picture_url == ''): ?>
										<a href="<?php echo $url; ?>/upload/noimage.jpg" target="_blank"><img src="<?php echo $url; ?>/upload/noimage.jpg" class="img-thumbnail preview-thumb"></a>
									<?php else : ?>
										<a href="<?php echo $confirm->picture_url; ?>" target="_blank"><img src="<?php echo $confirm->picture_url; ?>" class="img-thumbnail preview-thumb"></a>
									<?php endif; ?>
								</div>
								<div class="col-md-9">
									<dl style="font-size:120%">
										<dt>โอนไปยังบัญชี</dt>
										<dd>
											<?php $sent_to = DB::table('bank-account')->where('id',$confirm->sent_to)->first();
												echo $sent_to->bank_name . " - " . $sent_to->bank_id; ?>
										</dd>

										<dt>เป็นจำนวนเงิน</dt>
										<dd><?php echo $confirm->amount ?> บาท</dd>

										<dt>โอนจากธนาคาร</dt>
										<dd><?php echo DB::table('bank')->where('id',$confirm->sent_from)->first()->bank_name; ?></dd>

										<dt>วันที่และเวลา</dt>
										<dd><?php echo $confirm->date . ' ' . $confirm->time ?></dd>
									
									</dl>
								</div>

							</div>


							<div class="row">
								<a href="<?php echo $url . '/admin/toggleconfirm/' . $order->id ?>" class="col-md-6 btn btn-success"><h3>ยืนยันการจัดส่ง</h3></a>
								<a data-href="<?php echo $url . '/admin/eraseorder/' . $order->id  ?>"  data-toggle="modal" data-target="#myModal" href="#" class="col-md-6 btn btn-danger"><h3>ลบ Order นี้</h3></a>	
							</div>
						<?php elseif($order->confirm): ?>
							<div class="alert alert-success"><h3 class="text-center">Order นี้ยืนยันการจัดส่งแล้ว</h3></div>
							
							<div class="row">
								<a href="<?php echo $url . '/admin/toggleconfirm/' . $order->id ?>" class="col-md-6 btn btn-warning"><h3>ยกเลิกการยืนยันการจัดส่ง</h3></a>
								<a data-href="<?php echo $url . '/admin/eraseorder/' . $order->id  ?>"  data-toggle="modal" data-target="#myModal" href="#" class="col-md-6 btn btn-danger"><h3>ลบ Order นี้</h3></a>	
							</div>
							
						<?php else: ?>
							<div class="alert alert-warning"><h3 class="text-center">Order รอการยืนยันการโอนเงินจากผู้สั่งซื้อ</h3></div>
							<a data-href="<?php echo $url . '/admin/eraseorder/' . $order->id  ?>"  data-toggle="modal" data-target="#myModal" href="#" class="col-md-12 btn btn-danger"><h3>ลบ Order นี้</h3></a>	
						<?php endif; ?>

					</div>
					

					<?php else : ?>
						<div class="col-md-12">
							<h2 class="text-center">ไม่พบ Order นี้</h2>
						</div>
					<?php endif; ?>  <!-- End for checking that order avaliable or not -->
					
					

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
		        ท่านแน่ใจที่จะลบ Order นี้หรือไม่?
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