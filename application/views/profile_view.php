<h1><?php echo $pageTitle ?></h1>
<div>
	<?php echo $user[0]['username'] ?>
	<br>
	<?php echo $user[0]['email'] ?>
	<br>
	<br>
	<br>
	<h1>Created Articles</h1>
	<br>
	<?php foreach ($users_articles as $key => $value): ?>
		<div class="blog-post">
			<h3 class="blog-post-title"><a href="<?php echo base_url().'news/'. $value['id'] ?>"><?php echo $value['title'] ?></a></h3>
			<p class="blog-post-meta"><?php echo date('\o\n l jS F Y', strtotime($value['date'])); ?>
		</div>
	<?php endforeach ?>
</div>