<section class="content-body" role="main">
	<header class="page-header">
		<h2>Edit Testimonial</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url(""); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/testimonialmanage"); ?>">Testimonial Management</a></span></li>
				<li><span>Edit Testimonial</span></li>
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
					<h2 class="panel-title">Edit Testimonial</h2>
				</header>
				
				<div class="panel-body">
					<form action="<?php echo site_url('catalog/testimonialmanage/updatedata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						
						<input type="hidden" name="testimonial_id" value="<?php echo $single_data[0]->testimonial_id;  ?>" />
						
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Client Name:-</label>
							<div class="col-md-9">
								<input type="text" name="name" id="inputDefault" value="<?php echo $single_data[0]->name; ?>" class="form-control" required >
								
							</div>
						</div>
						
							<div class="form-group">
								<label for="inputDefault" class="col-md-3 control-label">Content:-</label>
								<div class="col-md-9">
									<textarea name="description" rows="5" id="inputDefault"  class="form-control" required><?php echo $single_data[0]->description; ?></textarea>
									
									
								</div></div>
								
								<div class="form-group">
									<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
									<div class="col-md-6">
										<input type="submit" name="submit" id="inputDefault" class=" btn btn-primary" value="Update">
									</div>
								</div>
								
							</form>
						</div>
					</section>
					
					
					
				</div>
			</div>
			
			
			
			<!-- end: page -->
		</section>