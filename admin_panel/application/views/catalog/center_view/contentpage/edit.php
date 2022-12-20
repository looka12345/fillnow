<section class="content-body" role="main">
					<header class="page-header">
						<h2>Edit Content Page</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="<?php echo site_url("catalog/contentpage"); ?>">Content Page</a></span></li>
								<li><span>Edit Page</span></li>
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

									<h2 class="panel-title">Edit Content Page</h2>
								</header>
								
								<div class="panel-body">
									<form action="<?php echo site_url('catalog/contentpage/updatedata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
									<input type="hidden" name="content_page_id" value="<?php echo $single_page_data[0]->content_page_id;  ?>" />
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page url:-</label>
											<div class="col-md-6">
												<input type="text" name="taxonomy" id="inputDefault" value="<?php echo $single_page_data[0]->taxonomy; ?>" class="form-control"  required >
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Title:-</label>
											<div class="col-md-6">
										<input type="text" name="title" id="inputDefault" value="<?php echo $single_page_data[0]->title; ?>" class="form-control"  required >
												
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Meta Key:-</label>
											<div class="col-md-6">
										<input type="text" name="meta_key" id="inputDefault" value="<?php echo $single_page_data[0]->meta_key; ?>" class="form-control" >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Meta Tag:-</label>
											<div class="col-md-6">
										<input type="text" name="meta_des" id="inputDefault" value="<?php echo $single_page_data[0]->	meta_tag ; ?>" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Previous:-</label>
											<div class="col-md-6">
										<input type="text" name="previous" id="inputDefault" value="<?php echo $single_page_data[0]->previous ; ?>" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Canonical:-</label>
											<div class="col-md-6">
										<input type="text" name="canonical" id="inputDefault" value="<?php echo $single_page_data[0]->canonical ; ?>" class="form-control"  >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Meta Description:-</label>
											<div class="col-md-6">
										<input type="text" name="meta_description" id="inputDefault" value="<?php echo $single_page_data[0]->meta_description ; ?>" class="form-control"  >
												
											</div>
										</div>
										<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Link:-</label>
											<div class="col-md-6">
										<input type="text" name="next" id="inputDefault" value="<?php echo $single_page_data[0]->next ; ?>" class="form-control"  >
												
											</div>
										</div>
										<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Have Content?-</label>
											<div class="col-md-6">
										<?php 	if($single_page_data[0]->front_content==1) { ?> 
										
													<label><input type="radio" name="front_content"  id="optionsRadios1"  value="1" checked="checked" />Find A Lawyer</label>
												<label><input type="radio" name="front_content"   id="optionsRadios1"  value="0">Find A CA</label>
												
										<?php } else { ?>
										
													<label><input type="radio" name="front_content"  id="optionsRadios1"  value="1"  />Find A Lawyer</label>
												<label><input type="radio" name="front_content"   id="optionsRadios1"  value="0" checked="checked">Find A CA</label>
												
										<?php } ?>
										
												
											</div>
										</div>
										<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Slider:-</label>
											<div class="col-md-6">
										<input type="text" name="slider" id="inputDefault" value="<?php echo $single_page_data[0]->slider; ?>" class="form-control" >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Contant Title:-</label>
											<div class="col-md-6">
										<input type="text" name="contant_title" id="inputDefault" value="<?php echo $single_page_data[0]->content_title; ?>" class="form-control"  >
												
											</div>
										</div>
											<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Image:-</label>
											<div class="col-md-6">
										<input type="file" name="image" id="inputDefault" class="form-control"  >
										<?php $ext=explode(".",$single_page_data[0]->image);?>
												<?php if(isset($single_page_data[0]->image) && !empty($single_page_data[0]->image) && $ext[1]!='mp4'){ ?>
												<img src="<?php echo site_url("../assets/sitesfile/page_img")."/".$single_page_data[0]->image ?>" height="80" width="100"/>
												<?php } ?>
											</div>
										</div>
											<div class="form-group" style="display: none">
											<label for="inputDefault" class="col-md-3 control-label">Test on image</label>
											<div class="col-md-6">
											<textarea class="input-block-level form-control" name="top_content" ><?php echo $single_page_data[0]->top_content; ?></textarea> 
												
											</div>
										</div>
											<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Content:-</label>
											<div class="col-md-9">
											<textarea class="input-block-level" id="summernote" name="content" ><?php echo $single_page_data[0]->content; ?></textarea> 
												
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
