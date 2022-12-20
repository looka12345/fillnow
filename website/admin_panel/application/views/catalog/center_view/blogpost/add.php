<section class="content-body" role="main">
	<header class="page-header">
		<h2>Add Blog</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url("catalog"); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/blogpost"); ?>">Blog Management</a></span></li>
				<li><span>Add Blog</span></li>
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
					<h2 class="panel-title">Add Blog</h2>
				</header>
				
				<div class="panel-body">
					<form action="<?php echo site_url('catalog/blogpost/adddata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Name:-</label>
							<div class="col-md-9">
								<input type="text" name="name" id="inputDefault" class="form-control" required >
								
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Image:-</label>
							<div class="col-md-9">
								<input type="file" name="image" id="inputDefault" class="form-control" required >
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Short Description:-</label>
							<div class="col-md-9">
								<textarea class="form-control" rows="4" name="s_desc" ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Description:-</label>
							<div class="col-md-9">
								<textarea class="form-control" id="summernote" name="description" ></textarea>
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
</section>