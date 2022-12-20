<section class="content-body" role="main">
	<header class="page-header">
		<h2>Edit Video</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo site_url("catalog"); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span><a href="<?php echo site_url("catalog/video"); ?>">Video Management</a></span></li>
				<li><span>Edit Video</span></li>
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
					<form action="<?php echo site_url('catalog/video/updatedata'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">

						<input type="hidden" name="video_id" value="<?php echo $single_data[0]->video_id;  ?>" />

						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Name:-</label>
							<div class="col-md-9">
								<input type="text" name="name" id="inputDefault" value="<?php echo $single_data[0]->name; ?>" class="form-control" required >

							</div>
						</div>	
						<div class="form-group" style="display: none;">
							<label for="inputDefault" class="col-md-3 control-label">Category</label>
							<div class="col-md-6">
								<select name="category">
									<option value="slide" <?=$single_data[0]->category=='slide'?'selected':''?>>Slide</option>
									<option value="home" <?=$single_data[0]->category=='home'?'selected':''?>>Home Single</option>
								</select>
							</div>
						</div>									
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">Video Filename:-</label>
							<div class="col-md-9">
								<input type="text" name="path" id="inputDefault" value="<?php echo $single_data[0]->path; ?>" class="form-control" required >

							</div>
						</div>
						<div class="form-group">
							<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
							<div class="col-md-9">
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