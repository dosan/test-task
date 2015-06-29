<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=us-ascii">
		<link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" title="default">
		<link rel="stylesheet" href="<?= base_url() ?>public/css/admin.css" rel="stylesheet" type="text/css" media="screen" title="default">
		<script type="text/javascript" src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
		<script language="javascript" type="text/javascript" src="<?= base_url() ?>includes/scripts/jquery-1.2.6.min.js"></script>
		<title><?= $pageTitle ?></title>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<?= $content_navigation; ?>
			</nav>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
					<?= $content_body ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>