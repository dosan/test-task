<h2><?= $pageTitle ?></h2>
<?= isset($errors) ? $errors : '' ?>
<form action="<?= base_url() ?>admin/updateOrAdd" method="POST">
	<input type="hidden" name="article_id" value="<?php echo $article[0]['id'] ?>"> 
	<input type="hidden" name="author_id" value="1"> 

	<div class="panel panel-default">
		<div class="panel-heading">Title</div>
		<div class="panel-body">
			<textarea name="title" id="title" ><?php echo $article[0]['title'] ?></textarea>
			<?php echo display_ckeditor($title); ?>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Preview</div>
		<div class="panel-body">
			<textarea name="preview" id="preview" ><?php echo $article[0]['preview'] ?></textarea>
			<?php echo display_ckeditor($preview); ?>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Body</div>
		<div class="panel-body">
			<textarea name="body" id="body" ><?php echo $article[0]['body'] ?></textarea>
			<?php echo display_ckeditor($body); ?>
		</div>
	</div>
	<input class="btn btn-warning" type="submit" value="update">
</form>
<br>
<br>
<br>