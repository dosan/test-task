<h2><?= $pageTitle ?></h2>
<div class="panel panel-default">
	<div class="panel-body">
		<?php foreach ($articles as $key => $value): ?>
			<article>
				<h3><a href="<?= base_url().'admin/article/'. $value['id'] ?>"><?= $value['title'] ?></a></h3>
				<p><?= $value['preview'] ?></p>
			</article>
			<p>
				<a href="<?= base_url() ?>admin/article/<?= $value['id'];?>" class="btn-sm btn-primary" role="button">Read more</a>
				<a href="<?= base_url() ?>admin/update/<?= $value['id'];?>" class="btn-sm btn-warning">Update</a>
				<a href="<?= base_url() ?>admin/delete/<?= $value['id'];?>" class="btn-sm btn-danger">Delete</a>
				<span class="date">
					<?= date('\o\n l jS F Y', strtotime($value['date'])); ?>
				</span>
				<span class="label label-default">
					Author: <?= $value['user_name'] ?>
				</span>
			</p>
		<?php endforeach ?>
	</div>
</div>