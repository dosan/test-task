<h2><?= $pageTitle ?></h2>
<div class="panel panel-default">
	<div class="panel-body">
		<?php foreach ($articles as $key => $value): ?>
			<article>
				<h3><a href="<?php echo base_url().'admin/article/'. $value['id'] ?>"><?php echo $value['title'] ?></a></h3>
				<p><?php echo $value['preview'] ?></p>
			</article>
			<p>
				<a href="<?php echo base_url() ?>admin/article/<?= $value['id'];?>" class="btn-sm btn-primary" role="button">Read more</a>
				<a href="<?php echo base_url() ?>admin/update/<?= $value['id'];?>" class="btn-sm btn-warning">Update</a>
				<a href="<?php echo base_url() ?>admin/delete/<?= $value['id'];?>" class="btn-sm btn-danger">Delete</a>
				<span class="date">
					<?php echo date('\o\n l jS F Y', strtotime($value['date'])); ?>
				</span>
				<span class="label label-default">
					Author: <?php echo $value['user_name'] ?>
				</span>
			</p>
		<?php endforeach ?>
	</div>
</div>