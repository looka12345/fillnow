<section class="content-body" role="main">
	<header class="page-header">
		<h2>Edit About Us</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url(""); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/aboutusmanagement"); ?>">About Us Management</a></span></li>
				<li><span>Edit About Us</span></li>
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

					<h2 class="panel-title">Edit About Us</h2>
				</header>

				<div class="panel-body">
					<form action="<?php echo site_url('catalog/aboutusmanagement/updatedata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">

						<input type="hidden" name="aboutusmanagement_id" value="<?php echo $single_data[0]->aboutusmanagement_id;  ?>" />


						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">About 1:-</label>
							<div class="col-md-9">
								<textarea type="text" name="about1" id="summernote" class="form-control"><?=$single_data[0]->about1?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">About 2:-</label>
							<div class="col-md-9">
								<textarea type="text" name="about2" id="summernote1" class="form-control"><?=$single_data[0]->about2?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">About 3:-</label>
							<div class="col-md-9">
								<textarea type="text" name="about3" id="summernote2" class="form-control"><?=$single_data[0]->about3?></textarea>
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