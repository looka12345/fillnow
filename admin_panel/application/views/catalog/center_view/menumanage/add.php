<section class="content-body" role="main">
					<header class="page-header">
						<h2>Add Menu Item</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="<?php echo site_url("catalog/menumanage"); ?>">Menu Management</a></span></li>
								<li><span>Add Menu Item</span></li>
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
									<h2 class="panel-title">Add Menu Item</h2>
								</header>
								
								<div class="panel-body">
									<form action="<?php echo site_url('catalog/menumanage/insertMenu'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<div class="form-group" style="display:none">
											<label for="inputDefault" class="col-md-3 control-label">Page Type: </label>
											<div class="col-md-6">
										<?php foreach($page_type_arr as $value){ 
										if($value->page_type_id=="3")
											{
											  $checked ='checked="checked" ';
											}
											else
											{
											  $checked = '';
											}
										?>
									
													<label>
														<input type="radio"   id="page_type_<?php echo $value->page_type_id ?>" value="3" name="page_type" onclick="show_page_type(this.value)" <?php echo $checked; ?>><?php echo $value->title ?></label>
												 <?php } ?>
												
											</div>
										</div>
										<div class="form-group" style="display:none">
											<label for="inputDefault" class="col-md-3 control-label">Page Type: </label>
											<div class="col-md-6">
												<label>
												<input type="radio" name="url_type" id="url_type_0" value="0" checked />
												Inner Page
												</label>
												<label>
												<input type="radio" name="url_type" id="url_type_1" value="1" />
												Outer Page
												</label>
											</div>
										</div>
										<div class="form-group" id="page_type_page" style="display:none;">
											<label for="inputDefault" class="col-md-3 control-label">Select Page:-</label>
											<div class="col-md-6">
									<select name="type_page_id"  ><option value="">Select Page</option>
										<?php foreach($pages_arr as $value){ ?>
										<option value="<?php echo $value->content_page_id ?>"><?php echo $value->title ?></option>
										<?php } ?>
									</select>
										
												
											</div>
										</div>
									<div class="form-group" id="page_type_category" style="display:none;">
											<label for="inputDefault" class="col-md-3 control-label">Select Category:-</label>
											<div class="col-md-6">
									<select name="type_category_id"  ><option value="">Select Category</option>
										<?php foreach($cat_arr as $value){ ?>
										<option value="<?php echo $value->content_category_id ?>"><?php echo $value->title ?></option>
										<?php } ?>
									</select>
										
												
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Page Name: </label>
											<div class="col-md-6">
										<input type="text" name="menu_title" id="inputDefault" class="form-control" required >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Path: </label>
											<div class="col-md-6">
										<input type="text" name="menu_link" id="inputDefault" class="form-control" required >
												
											</div>
										</div>
										
										
										<div class="form-group" style="display:none">
											<label for="inputDefault" class="col-md-3 control-label">Select Layout:-</label>
											<div class="col-md-6">
									<select name="catalog_layout"  ><option value="">Select Layout</option>
										<?php foreach($catalog_layout_arr as $value){ ?>
										<option value="<?php echo $value->catalog_layout_id ?>"><?php echo $value->catalog_layout_title ?></option>
										<?php } ?>
									</select>
										
												
											</div>
										</div>
										<div class="form-group" style="display:none">
											<label for="inputDefault" class="col-md-3 control-label">Module Type:-</label>
											<div class="col-md-6">
									<select name="module_type" id="state_id" ><option value="">Select  Module Type</option>
										 <?php 
							if(isset($module_type_arr) && !empty($module_type_arr))
	 						{ 
							foreach ($module_type_arr as $value)
			 				 {
							  ?>
                              <option value="<?php echo $value->module_type_id ?>"?>
							  <?php echo $value->module_name ?> </option>
                              <?php
							 }
	 						}
							 ?>
									</select>
										
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Parent</label>
											<div class="col-md-6">
									<select name="parent_id" id="parent_id" ><option value="">Select Parent</option>
										 <?php
                            if(!empty($pairent_menu))
								{ 
									 foreach ($pairent_menu as $value)
									 {
									  ?>
									 	 <option value="<?php echo $value->menu_id?>" > <?php echo $value->menu_title?> </option>
									  <?php
									 }
								}
							 ?>
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
<script type="text/javascript">
	function show_page_type(value)
		{
			if(value==1)
				{
					document.getElementById("page_type_page").style.display="none";
					document.getElementById("page_type_category").style.display="block";
					
				}
			else if(value==2)
				{
				document.getElementById("page_type_category").style.display="none";
					document.getElementById("page_type_page").style.display="block";
				}
			else if(value==3)
				{
				document.getElementById("page_type_category").style.display="none";
					document.getElementById("page_type_page").style.display="none";
				}
			return true;
		}
</script>