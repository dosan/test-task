<div class="navbar-header">
	<a class="navbar-brand" href="<?= base_url() ?>">Home</a>
</div>
<!-- <ul class="nav navbar-top-links navbar-right">
	<li class="blog-nav-item <?= $navTab == 'home' ? 'active' : ''?>">
		<a href="#" title="User Page">User</a>
	</li>
	<li class="blog-nav-item">
		<a href="" title="Log Out">Log Out</a>
	</li>
</ul> -->
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
<!-- 			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<i class="fa fa-search">search</i>
					</button>
				</span>
				</div>
			</li> -->
			<li>
				<a <?= $navTab == 'index' ? "class='active'" : '';?> href="<?= base_url() ?>admin/index"> List of Articles</a>
			</li>
			<li>
				<a <?= $navTab == 'add' ? "class='active'" : '';?> href="<?= base_url() ?>admin/add"> Add Article</a>
			</li>
			<li>
				<a <?= $navTab == 'users' ? "class='active'" : '';?> href="<?= base_url() ?>admin/users">Users</a>
			</li>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
