<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<?php $uri = Request::path(); ?>
		<li class="{{ (strpos($uri, 'dashboard')? 'active': '') }}"><a href="<?php echo $url . "/admin/dashboard" ?>">หน้าหลัก</a></li>
		<li class="{{ (strpos($uri, 'dessert')? 'active': '') }}"><a href="<?php echo $url . "/admin/managedessert" ?>">จัดการขนมหวาน</a></li>
		<li class="{{ (strpos($uri, 'order')? 'active': '') }}"><a href="<?php echo $url . "/admin/manageorder" ?>">จัดการ Order</a></li>
	</ul>
</div>