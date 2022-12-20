<section class="content-body" role="main">
	<header class="page-header">
		<h2>New Video</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url("catalog"); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/video"); ?>">Video Management</a></span></li>
				<li><span>New Video</span></li>
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
				</header>
				
				<div class="panel-body">
					<form action="<?php echo site_url('catalog/video/adddata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Name:-</label>
							<div class="col-md-6">
								<input type="text" name="name" id="inputDefault" class="form-control" required >
								
							</div>
						</div>
						<div class="form-group" style="display: none;">
							<label for="inputDefault" class="col-md-3 control-label">Category</label>
							<div class="col-md-6"  >
								<select name="category">
									<option value="slide" selected>slide</option>
									<option value="home">Home Single</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Video Filename:-</label>
							<div class="col-md-6">
								<input type="text" name="path" id="inputDefault" class="form-control" required >
								
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
							<div class="col-md-9">
								<input type="submit" name="submit" id="inputDefault" class=" btn btn-primary" value="Submit">
							</div>
						</div>
						
					</form>
				</div>
			</section>
			
			
			
		</div>
	</div>
	
	
	
	<!-- end: page -->
</section>