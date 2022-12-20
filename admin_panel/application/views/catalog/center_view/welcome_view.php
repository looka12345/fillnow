<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $site_data[0]->keyword; ?></h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url(); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><?php echo $site_data[0]->keyword; ?></span></li>
			</ol>
			
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	<!-- start: page -->
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="row">
				<div class="col-lg-4">
					<a href="<?=site_url("catalog/courier"); ?>" style="color: #3F51B5" >
						<h2 style="text-align: center;">
						<i class="fa fa-file-word-o fa-5x"></i>
						<br/>
						Courier Management
						</h2>
						<br/>
					</a>
				</div>
				<div class="col-lg-4">
					<a href="<?=site_url("catalog/usermanage/profile"); ?>" style="color: #00BCD4" >
						<h2 style="text-align: center;">
						<i class="fa fa-cogs fa-5x"></i>
						<br/>
						My Profile
						</h2>
						<br/>
					</a>
				</div>
				<div class="col-lg-4">
					<a href="<?=site_url("admin/admin_logout"); ?>" style="color: #9C27B0" >
						<h2 style="text-align: center;">
						<i class="fa fa-power-off fa-5x"></i>
						<br/>
						Logout
						</h2>
						<br/>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end: page -->
</section>
</div>