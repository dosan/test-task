<div class="container">
	<nav class="blog-nav">
		<a class="blog-nav-item <?= $navTab == 'home' ? 'active' : ''?>" href="<?= base_url(); ?>" title="Home Page">Home</a>
		<a class="blog-nav-item <?= $navTab == 'user' ? 'active' : ''?>" href="<?= base_url(); ?>user" title="User">User</a>
		<a class="blog-nav-item <?= $navTab == 'admin' ? 'active' : ''?>" href="<?= base_url(); ?>admin" title="Admin">Admin</a>
	</nav>
</div>