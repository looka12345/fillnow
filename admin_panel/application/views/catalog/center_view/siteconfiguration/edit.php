<section class="content-body" role="main">

					<header class="page-header">

						<h2><?php echo $page_title; ?></h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="<?php echo site_url("catalog"); ?>">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span><a href="<?php echo site_url("catalog"); ?>"><?php echo $page_title; ?></a></span></li>

								<li><span><?php echo $sub_page_title; ?></span></li>

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



									<h2 class="panel-title"><?php echo $sub_page_title; ?></h2>

								</header>

								<div class="panel-body">

									<form action="<?php echo site_url('catalog/siteconfiguration/update'); ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_title; ?></label>

											<div class="col-md-6">

												<input type="text" name="title" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->title; ?>">

											</div>

										</div>



										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_web_url; ?></label>

											<div class="col-md-6">

												<input type="text" name="weburl" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->weburl; ?>">

											</div>

										</div>

										<div class="form-group">

											<label class="col-md-3 control-label"><?php echo $form_logo; ?></label>

											<div class="col-md-6">

												<input type="file" name="image" id="inputDefault" class="form-control" >

											<?php if(isset($site_data[0]->logo) && !empty($site_data[0]->logo)) { ?>

											<img src="<?php echo $this->config->item("SITE_ROOT_IMAGE")."siteconfig/".$site_data[0]->logo; ?>" />

											<?php } ?></div>

											

										</div>

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_keyword; ?></label>

											<div class="col-md-6">

												<input type="text" name="keyword" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->keyword; ?>">

											</div>

										</div>



										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_email; ?></label>

											<div class="col-md-6">

												<input type="text" name="site_email" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->site_email; ?>">

											</div>

										</div>

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_facebook; ?></label>

											<div class="col-md-6">

												<input type="text" name="facebook" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->facebook; ?>">

											</div>

										</div>



										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_twitter; ?></label>

											<div class="col-md-6">

												<input type="text" name="twitter" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->twitter; ?>">

											</div>

										</div>

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_google; ?></label>

											<div class="col-md-6">

												<input type="text" name="google" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->google; ?>">

											</div>

										</div>

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_site_description; ?></label>

											<div class="col-md-6">

											<textarea name="site_description" id="inputDefault" class="form-control" ><?php echo $site_data[0]->site_description; ?></textarea>	

											</div>

										</div>

						

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label"><?php echo $form_site_address; ?></label>

											<div class="col-md-6">

																	<input type="text" name="site_address" id="inputDefault" class="form-control" value="<?php echo $site_data[0]->site_address; ?>">

						</div>

										</div>

									

										<div class="form-group">

											<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>

											<div class="col-md-6">

																	<input type="submit" name="submit" id="inputDefault" class=" btn btn-primary" value="<?php echo $button_update; ?>">

						</div>

										</div>



										

									</form>

								</div>

							</section>



							

							



							



						</div>

					</div>



					



					



					

					<!-- end: page -->

				</section>