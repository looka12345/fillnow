<section class="content-body" role="main">
					<header class="page-header">
						<h2>Edit Admin Page</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="<?php echo site_url("catalog/pagemanage"); ?>"> Admin Page Manegement</a></span></li>
								<li><span>Edit Admin Page</span></li>
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

									<h2 class="panel-title">Edit Admin Page</h2>
								</header>
								<div class="panel-body">
							
									<form action="<?php echo site_url('catalog/pagemanage/updatedata'); ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
									<input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page Name</label>
											<div class="col-md-6">
												<input type="text" name="page_name" id="inputDefault" class="form-control" value="<?php echo $edit_data[0]->admin_page; ?>" required>
											</div>
										</div>

										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page Link</label>
											<div class="col-md-6">
												<input type="text" name="page_link" id="inputDefault" class="form-control" value="<?php echo $edit_data[0]->page_url; ?>" required>
											</div>
										</div>
									
									
									<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Icon Class</label>
											<div class="col-md-6">
												<input type="text" name="icon_class" id="inputDefault" class="form-control" value="<?php echo $edit_data[0]->icon_class; ?>"  >
											</div>
										</div>
                                        
                                        <div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Taxonomy Category/Post</label>
											<div class="col-md-6">
												<input type="text" name="taxonomy" id="inputDefault" class="form-control" value="<?php echo $edit_data[0]->taxonomy; ?>"  >
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Parent</label>
											<div class="col-md-6">
											<select name="parent_id"><option value="0">Parent</option><?php foreach($menup as $value){ ?>
											<?php if($value->admin_page_id==$edit_data[0]->admin_parent_id) { ?>
											<option value="<?php echo $value->admin_page_id ?>" selected="selected"><?php echo $value->admin_page ?></option>
											<?php } else { ?>
											<option value="<?php echo $value->admin_page_id ?>"><?php echo $value->admin_page ?></option>
											<?php } } ?>
											</select>
												
											</div>
										</div>

									
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