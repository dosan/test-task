
<div class="blog-post">
	<h2 class="blog-post-title"><?= $article[0]['title'] ?></h2>
	<p class="blog-post-meta"><?= date('\o\n l jS F Y', strtotime($article[0]['date'])); ?>
	by <a href="<?= base_url() ?>user/<?= $article[0]['user_id'] ?>"><?= $article[0]['user_name']?></a> Views <?= $article[0]['count'] ?></p>
		<p><?= $article[0]['body'] ?></p>
</div>
