<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=us-ascii">
		<meta name="description" content="<?= $meta_description ?>">
		<meta name="keywords" content="<?= $meta_keywords ?>">
		<meta http-equiv="expires" content="0" />
		<meta name="classification" content="<?= $meta_classification ?>" />
		<meta name="Robots" content="index,follow">
		<meta name="revisit-after" content="2 Days">
		<meta name="language" content="en-us">

		<link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" title="default">
		<link rel="stylesheet" href="<?= base_url() ?>public/css/main.css" rel="stylesheet" type="text/css" media="screen" title="default">
		<link rel="stylesheet" href="<?= base_url() ?>public/css/user.css" rel="stylesheet" type="text/css" media="screen" title="default">
		<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
		<script language="javascript" type="text/javascript" src="<?= base_url() ?>includes/scripts/jquery-1.2.6.min.js"></script>

		<title><?= $pageTitle ?></title>
	</head>
	<body>
		<div class="blog-masthead">
			<?= $content_navigation; ?>
		</div>
		<div class="container">
			<div class="row">
			<div class="blog-header">
				<h1 class="blog-title">Some title here</h1>
				<p class="lead blog-description"><?= isset($pageSlogan) ? $pageSlogan : 'Some slogan here'  ?></p>
				</div>
				<div class="col-sm-8 blog-main">
					<?= $content_body ?>
				</div>
				<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module sidebar-module-inset">
					<h4>About</h4>
					<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
					</div>
					<div class="sidebar-module">
					<h4>User Box</h4>
					<?= isset($message_login) ? $message_login : ''  ?>
					<?php if ($this->session->userdata('logged_in') == TRUE): ?>
						<a href="/user"><?= $this->session->userdata('username') ?></a>
						<br>
						<?php echo anchor(base_url().'user/logout', 'Logout'); ?>
					<?php else: ?>
					<?php echo form_open(base_url()."user/login"); ?>
						<label for="user_email">Email:</label>
						<input type="text" id="user_email" name="user_email" value="" />
						<label for="user_password">Password:</label>
						<input type="password" id="user_password" name="user_password" value="" />
						<input type="submit" class="" value="Sign in" />
					<?php echo form_close(); ?>
					<li><a href="/user">Sign Up</a></li>
					<?php endif ?>
					</div>
				</div><!-- /.blog-sidebar -->
			</div><!-- /.row -->
		</div><!-- /.container -->
		<footer class="blog-footer">
			<p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
			<p>
				<a href="#">Back to top</a>
			</p>
		</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../../dist/js/bootstrap.min.js"></script>
	<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>