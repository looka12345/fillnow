<section class="content-body" role="main">
					<header class="page-header">
						<h2>User Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php  echo site_url(); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>User Profile</span></li>
							
							</ol>
					
							<a data-open="sidebar-right" class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

					<div class="row">
				  <h2 style="color:green"><?php echo $this->session->flashdata('user_message'); ?></h2>
				
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img alt="John Doe" class="rounded img-responsive" src="<?php echo site_url("assets/images/user")."/".$edit_user_data[0]->image; ?>">
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?php echo ucfirst($this->session->userdata("admin_username")); ?></span>
											<span class="thumb-info-type"><?php echo ucfirst($this->session->userdata("admin_role")); ?></span>
										</div>
									</div>

									

									<hr class="dotted short">
							</div>
							</section>


							

							

						</div>
						<div class="col-md-8 col-lg-9">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a data-toggle="tab" href="#overview">Overview</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#edit">Edit Personal Info</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#editpass">Edit Password</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="overview">
										<h4 class="mb-md">Personal Information</h4>
									
											<fieldset>
												<div class="form-group">
													<label for="profileFirstName" class="col-md-3 control-label">User Name</label>
													<div class="col-md-8">
														<?php echo ucfirst($this->session->userdata("admin_username")); ?>
													</div>
												</div>
												<div class="form-group">
													<label for="profileLastName" class="col-md-3 control-label">Role</label>
													<div class="col-md-8">
														<?php echo  ucfirst($this->session->userdata("admin_role")); ?>
													</div>
												</div>
												<div class="form-group">
													<label for="profileAddress" class="col-md-3 control-label">Email</label>
													<div class="col-md-8">
													<?php echo  ucfirst($this->session->userdata("email_id")); ?>
													</div>
												</div>
												<div class="form-group">
													<label for="profileCompany" class="col-md-3 control-label">Contact Number</label>
													<div class="col-md-8">
														<?php echo $this->session->userdata("phone"); ?>
													</div>
												</div>
											</fieldset>


									</div>
									<div class="tab-pane " id="edit">

										<form method="post" action="<?php echo site_url("catalog/usermanage/updatelogininfo"); ?>" class="form-horizontal" enctype="multipart/form-data">
									<input type="hidden" name="login_user_id" value="<?php echo $edit_user_data[0]->admin_login_id; ?>" />
											<h4 class="mb-xlg">Personal Information</h4>
											<fieldset>
												<div class="form-group">
													<label for="profileFirstName" class="col-md-3 control-label">User Name</label>
													<div class="col-md-8">
														<input type="text" id="profileFirstName" name="user_name" value="<?php echo $edit_user_data[0]->name; ?>" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label for="profileLastName" class="col-md-3 control-label">Phone Number</label>
													<div class="col-md-8">
														<input type="text"  name="phone"  class="form-control" value="<?php  echo $edit_user_data[0]->contact_no; ?>" required>
													</div>
												</div>
												<div class="form-group">
													<label for="profileLastName" class="col-md-3 control-label">Image</label>
													<div class="col-md-8">
														<input type="file"  name="image"  class="form-control"  >
													</div>
												</div>
												<div class="form-group">
													<label for="profileAddress" class="col-md-3 control-label">Designation</label>
													<div class="col-md-8">
<input type="text" id="profileAddress" name="designation" value="<?php echo $edit_user_data[0]->designation; ?>" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label for="profileCompany" class="col-md-3 control-label">Employer Id</label>
													<div class="col-md-8">
	<input type="text" id="profileCompany" name="emp_id" value="<?php echo $edit_user_data[0]->employer_Id; ?>" class="form-control" required>
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button class="btn btn-primary" type="submit">Submit</button>
														
													</div>
												</div>
											</div>
	</form>
	
	

									</div>
									<div class="tab-pane " id="editpass">

										<form method="post" action="<?php echo site_url("catalog/usermanage/updateloginpassword"); ?>" class="form-horizontal">
										<input type="hidden" name="login_user_id" value="<?php echo $edit_user_data[0]->admin_login_id; ?>" />
									
											<h4 class="mb-xlg">Change Password</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label for="profileNewPassword" class="col-md-3 control-label" >New Password</label>
													<div class="col-md-8">
														<input type="text" id="profileNewPassword" name="password" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label for="profileNewPasswordRepeat" class="col-md-3 control-label">Repeat New Password</label>
													<div class="col-md-8">
														<input type="text" id="profileNewPasswordRepeat" name="c_password" class="form-control"required>
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button class="btn btn-primary" type="submit">Submit</button>
														
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
						

					</div>
					<!-- end: page -->
				</section>