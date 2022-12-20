<section class="content-body" role="main">
	<header class="page-header">
		<h2>Social Media Management</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url("catalog"); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/socialmediamanage"); ?>">Social Media Management</a></span></li>
				<li><span>Edit Social Media</span></li>
			</ol>
			
			<a data-open="sidebar-right" class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a class="fa fa-caret-down" href="#"></a>
					</div>
					<h2 class="panel-title">Edit Social Media</h2>
				</header>
				<div class="panel-body">
					<form action="<?php echo site_url('catalog/socialmediamanage/update'); ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Email1</label>
							<div class="col-md-6">
								<input type="text" name="email1" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->email1; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Email2</label>
							<div class="col-md-6">
								<input type="text" name="email2" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->email2; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Email3</label>
							<div class="col-md-6">
								<input type="text" name="email3" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->email3; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Phone1</label>
							<div class="col-md-6">
								<input type="text" name="phone1" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->phone1; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Phone2</label>
							<div class="col-md-6">
								<input type="text" name="phone2" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->phone2; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Phone3</label>
							<div class="col-md-6">
								<input type="text" name="phone3" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->phone3; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Facebook</label>
							<div class="col-md-6">
								<input type="text" name="facebook" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->facebook; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Twitter</label>
							<div class="col-md-6">
								<input type="text" name="twitter" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->twitter; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Linkedin</label>
							<div class="col-md-6">
								<input type="text" name="linkedin" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->linkedin; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Google+</label>
							<div class="col-md-6">
								<input type="text" name="google" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->google; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Skype</label>
							<div class="col-md-6">
								<input type="text" name="skype" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->skype; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Youtube</label>
							<div class="col-md-6">
								<input type="text" name="youtube" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->youtube; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Instagram</label>
							<div class="col-md-6">
								<input type="text" name="instagram" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->instagram; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Flicker</label>
							<div class="col-md-6">
								<input type="text" name="flicker" id="inputDefault" class="form-control" value="<?php echo $site_edit_data[0]->flicker; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
							<div class="col-md-6">
								<input type="submit" name="submit" id="inputDefault" class=" btn btn-primary" value="<?php echo $button_update; ?>">
							</div>
						</div>
						
					</form>
				</div>
			</section>
			
			
			
		</div>
	</div>
	
	
	
	<!-- end: page -->
</section>