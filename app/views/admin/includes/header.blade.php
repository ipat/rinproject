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