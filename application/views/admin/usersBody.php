<br>
<br>
<div class="col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading">Users</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>N</th>
							<th>Username</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($users as $key => $value): ?>
						<tr>
							<td><?= $i++ ?></td>
							<td><a href="<?= base_url().'admin/user/'.$value['id'] ?>"><?= $value['username'] ?></a></td>
							<td><?= $value['email'] ?></td>
							<td><a href="<?= base_url().'admin/sendmailto/'.$value['id'] ?>">Send Mail</a></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>