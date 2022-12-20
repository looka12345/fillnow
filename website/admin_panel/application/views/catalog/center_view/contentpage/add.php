<section class="content-body" role="main">
					<header class="page-header">
						<h2>Add Content Page</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="<?php echo site_url("catalog/contentpage"); ?>">Content Page</a></span></li>
								<li><span>Add Page</span></li>
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

									<h2 class="panel-title">Add Content Page</h2>
								</header>
								
								<div class="panel-body">
									<form action="<?php echo site_url('catalog/contentpage/adddata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page url:-</label>
											<div class="col-md-6">
												<input type="text" name="taxonomy" id="inputDefault" class="form-control" required >
											</div>
										</div>

										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Title:-</label>
											<div class="col-md-6">
										<input type="text" name="title" id="inputDefault" class="form-control" required >
												
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Meta Key:-</label>
											<div class="col-md-6">
										<input type="text" name="meta_key" id="inputDefault" class="form-control" >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Meta Tag:-</label>
											<div class="col-md-6">
										<input type="text" name="meta_des" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Previous:-</label>
											<div class="col-md-6">
										<input type="text" name="previous" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Canonical:-</label>
											<div class="col-md-6">
										<input type="text" name="canonical" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Meta Description:-</label>
											<div class="col-md-6">
										<input type="text" name="meta_description" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
										<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Next:-</label>
											<div class="col-md-6">
										<input type="text" name="next" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
										<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Target Link</label>
											<div class="col-md-6">
									
													<label>
														<input type="radio" name="front_content"  checked="checked" id="optionsRadios1"  value="1">
													</label>
												
													<label>
														<input type="radio" name="front_content"  id="optionsRadios1"  value="0">
													</label>
											
												
											</div>
										</div>
										<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Slider:-</label>
											<div class="col-md-6">
										<input type="text" name="slider" id="inputDefault" class="form-control" >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Contant Title:-</label>
											<div class="col-md-6">
										<input type="text" name="contant_title" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Image:-</label>
											<div class="col-md-6">
										<input type="file" name="image" id="inputDefault" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Test on image</label>
											<div class="col-md-6">
											<textarea class="input-block-level form-control" name="top_content" ></textarea> 
												
											</div>
										</div>
											<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Content:-</label>
											<div class="col-md-9">
											<textarea class="input-block-level" id="summernote" name="content" >
</textarea> 
												
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
