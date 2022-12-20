<section class="content-body" role="main">
	<header class="page-header">
		<h2>Edit Team</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url("catalog"); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/teammanage"); ?>">Team Management</a></span></li>
				<li><span>Edit Team</span></li>
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

					<h2 class="panel-title">Edit Team</h2>
				</header>

				<div class="panel-body">
					<form action="<?php echo site_url('catalog/teammanage/updatedata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">

						<input type="hidden" name="team_id" value="<?php echo $single_data[0]->team_id;  ?>" />


						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Name:-</label>
							<div class="col-md-9">
								<input type="text" name="name" id="inputDefault" value="<?php echo $single_data[0]->name; ?>" class="form-control" required >

							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Designation:-</label>
							<div class="col-md-9">
								<input type="text" name="designation" id="inputDefault" value="<?php echo $single_data[0]->designation; ?>" class="form-control" required >

							</div>
						</div>
														
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Image:-</label>
							<div class="col-md-9">
								<input type="file" name="image" id="inputDefault" value="<?php echo $single_data[0]->image; ?>" class="form-control" <?php if(!isset($single_data[0]->image) && empty($single_data[0]->image)){ echo "required";} ?> >  <?php if(isset($single_data[0]->image) && !empty($single_data[0]->image)){ ?> <br/><img src="<?php echo site_url("../assets/sitesfile/image/team")."/".$single_data[0]->image; ?>" height="100" width="100" /><?php } ?>

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Description:-</label>
							<div class="col-md-9"> 
								<textarea class="form-control" name="description" id="summernote" ><?=$single_data[0]->description?></textarea>
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