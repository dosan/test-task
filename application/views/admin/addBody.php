<h2><?= $pageTitle ?></h2>
<?= isset($errors) ? $errors : '' ?>
<form action="<?= base_url() ?>admin/updateOrAdd" method="POST">
	<!-- Session::get('author') -->
	<input type="hidden" name="author_id" value="<?= $this->session->userdata('id') ?>">
	<div class="panel panel-default">
		<div class="panel-heading">Title</div>
		<div class="panel-body">
			<textarea name="title" id="title" ></textarea>
			<?php echo display_ckeditor($title); ?>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Preview</div>
		<div class="panel-body">
			<textarea name="preview" id="preview" ></textarea>
			<?php echo display_ckeditor($preview); ?>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Body</div>
		<div class="panel-body">
			<textarea name="body" id="body" ></textarea>
			<?php echo display_ckeditor($body); ?>
		</div>
	</div>
	<input class="btn btn-success" type="submit" value="Add article">
</form>
<br>
<br>
<br>