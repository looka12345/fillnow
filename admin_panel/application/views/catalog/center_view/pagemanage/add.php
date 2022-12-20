<section class="content-body" role="main">
					<header class="page-header">
						<h2>Add Admin Page</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="<?php echo site_url("catalog/pagemanage"); ?>"> Admin Page Manegement</a></span></li>
								<li><span>Add Admin Page</span></li>
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

									<h2 class="panel-title">Add Admin Page</h2>
								</header>
								<div class="panel-body">
									<form action="<?php echo site_url('catalog/pagemanage/adddata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page Name</label>
											<div class="col-md-6">
												<input type="text" name="page_name" id="inputDefault" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page Link</label>
											<div class="col-md-6">
												<input type="text" name="page_link" id="inputDefault" class="form-control" required >
											</div>
										</div>
									
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Icon Class</label>
											<div class="col-md-6">
												<input type="text" name="icon_class" id="inputDefault" class="form-control"  >
											</div>
										</div>
                                        
                                        	<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Taxonomy Category/Post</label>
											<div class="col-md-6">
												<input type="text" name="taxonomy" id="inputDefault" class="form-control"  >
											</div>
										</div>

										
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Parent</label>
											<div class="col-md-6">
											<select class="form-control" name="parent_id" required><option value="0">Parent</option><?php foreach($menup as $value){ ?>
											<option value="<?php echo $value->admin_page_id ?>"><?php echo $value->admin_page ?></option>
											<?php } ?>
											</select>
												
											</div>
										</div>

									
							<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
											<div class="col-md-6">
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