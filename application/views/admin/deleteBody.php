	<h1><?= $pageTitle ?></h1>
	<form action="<?= base_url() ?>admin/deletefromdatabase" method="POST">
		<input type="hidden" name="idArticleToDelete" value="<?= $article[0]['id'] ?>">
		<input class="btn btn-danger" type="submit" value="Pretty sure!">
		<a class="btn btn-success" href="javascript:window.history.go(-1);">No</a>
	</form>
	<article>
		<h3><?php echo $article[0]['title'] ?></h3>
		<p><?php echo $article[0]['body'] ?></p>
		<p>
			<span class="date">
				<?php echo $article[0]['date']; ?>
			</span>
			<span class="label label-default">
				Author: <?php echo $article[0]['user_name'] ?>
			</span>
		</p>
	</article>