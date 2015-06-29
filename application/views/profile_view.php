<h1><?= $pageTitle ?></h1>
<div>
	<?= $user[0]['username'] ?>
	<br>
	<?= $user[0]['email'] ?>
	<br>
	<br>
	<br>
	<h1>Created Articles</h1>
	<br>
	<?php foreach ($users_articles as $key => $value): ?>
		<div class="blog-post">
			<h3 class="blog-post-title"><a href="<?= base_url().'news/'. $value['id'] ?>"><?= $value['title'] ?></a></h3>
			<p class="blog-post-meta"><?= date('\o\n l jS F Y', strtotime($value['date'])); ?>
		</div>
	<?php endforeach ?>
</div>