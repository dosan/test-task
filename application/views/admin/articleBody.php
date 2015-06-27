	<h1><?= $pageTitle ?></h1>
	<article>
		<h3><?php echo $article[0]['title'] ?></h3>
		<p><?php echo $article[0]['body'] ?></p>
		<p>
			<span class="date">
				<?php echo date('\o\n l jS F Y', strtotime($article[0]['date'])); ?>
			</span>
			<span class="label label-default">
				Author: <?php echo $article[0]['user_name'] ?>
			</span>
		</p>
		<a href="<?php echo base_url() ?>admin/update/<?= $article[0]['id'];?>" class="btn btn-warning">Update</a>
		<a href="<?php echo base_url() ?>admin/delete/<?= $article[0]['id'];?>" class="btn btn-danger">Delete</a>
	</article>