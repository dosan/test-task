
	<?php foreach ($articles as $key => $value): ?>
		<div class="blog-post">
			<h2 class="blog-post-title"><a href="<?= base_url().'news/'. $value['id'] ?>"><?= $value['title'] ?></a></h2>
			<p class="blog-post-meta">Created <?= date('\o\n l jS F Y', strtotime($value['date'])); ?>
			by <a href="<?= base_url().'user/'.$value['user_id'] ?>"><?= $value['user_name'] ?> </a> Views <?= $value['count'] ?></p>
				<p><?= $value['preview'] ?></p>
		</div>
	<?php endforeach ?>
