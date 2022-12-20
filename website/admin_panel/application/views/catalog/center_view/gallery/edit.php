<section class="content-body" role="main">
	<header class="page-header">
		<h2>Edit Gallery</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url("catalog"); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/gallery"); ?>">Gallery Management</a></span></li>
				<li><span>Edit Gallery</span></li>
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
					<form action="<?php echo site_url('catalog/gallery/updatedata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<input type="hidden" name="gallery_id" value="<?php echo $single_data[0]->gallery_id;  ?>" />
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Name:-</label>
							<div class="col-md-6">
								<input type="text" name="name" id="inputDefault" value="<?php echo $single_data[0]->name; ?>" class="form-control" required >
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Package:-</label>
							<div class="col-md-9">
								<select name="packageid" required>
								<option value="">Select Package</option>
								<?php
								foreach ($pack_list as $cat_id => $category) {?>
								  <option value="<?=$category->products_id?>" <?=$category->products_id==$single_data[0]->packageid?'selected':''?>><?=$category->name?></option>
								  <?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Youtube Video Id:-</label>
							<div class="col-md-6">
								<input type="text" name="path" id="inputDefault" value="<?php echo $single_data[0]->path; ?>" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Image:-</label>
							<div class="col-md-6">
								<input type="file" name="image" id="inputDefault" value="<?php echo $single_data[0]->image; ?>" class="form-control">  <?php if(isset($single_data[0]->image) && !empty($single_data[0]->image)){ ?> <br/><img src="<?php echo site_url("../assets/sitesfile/image/gallery")."/".$single_data[0]->image; ?>" height="100" width="100" /><?php } ?>
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