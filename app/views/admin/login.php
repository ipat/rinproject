<html>
	<head>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <?php $url = URL::to(""); ?>
		<link rel="stylesheet" href="<?php echo $url ?>/css/admin-style.css">
        <style>
            body {
                margin-top: 5%;
            }
        </style>
        <title>Login Administration System | Rin Website</title>
	</head>
	<body>
		<div class="col-md-4 col-md-offset-4">
			<?php if($errors->has()): ?>
				<?php foreach($errors->all() as $error): ?>
				<div class="bg-danger alert"><?php echo $error ?></div>
				<?php endforeach; ?>
			<?php endif; ?>

			<h1><i class="fa fa-lock"></i> Login</h1>

			<div class="panel panel-default">
				<?php echo Form::open(array('method' => 'post', 'class' => "panel-body")) ?>
				<!-- <form url="" method="POST" role="form" class="panel-body"> -->
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" placeholder="Username" name="username" class="form-control">
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" placeholder="Password" name="password" class="form-control">
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Login">
					</div>
				<!-- </form> -->
				<?php echo Form::close(); ?>
			</div>
			
		</div>

		
		
	</body>
</html>