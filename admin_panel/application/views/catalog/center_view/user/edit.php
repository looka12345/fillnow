<section class="content-body" role="main">
					<header class="page-header">
						<h2>Edit User</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="<?php echo site_url("catalog/usermanage"); ?>">User Management</a></span></li>
								<li><span>Edit User</span></li>
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

									<h2 class="panel-title">Edit User</h2>
								</header>
							
								<div class="panel-body">
									<form action="<?php echo site_url("catalog/usermanage/updateAdminLogin/".$edit_user_data[0]->admin_detail_id); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
									<input type="hidden" name="admin_login_id" value="<?php echo  $edit_user_data[0]->admin_login_id; ?>" />
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">User Group</label>
											<div class="col-md-6">
												<select class="form-control" name="user_group" required><option value="0">Select User Group</option><?php foreach($user_group_array as $value){ ?>
											<?php if($value->user_group_id==$edit_user_data[0]->user_group){ ?>
											<option value="<?php echo $value->user_group_id; ?>" selected="selected"><?php echo $value->user_group_name; ?></option>											<?php }else{ ?>
											<option value="<?php echo $value->user_group_id; ?>"><?php echo $value->user_group_name; ?></option>					
											<?php } ?>
											<?php } ?>
											</select>
											</div>
										</div>

										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label"> User Mail ID: </label>
											<div class="col-md-6">
												<input type="text" name="user_mail_id" id="inputDefault" class="form-control" value="<?php echo $edit_user_data[0]->email_id; ?>" required >
											</div>
										</div>
									
									

										
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">User Name</label>
											<div class="col-md-6">
										<input type="text" name="user_name" id="inputDefault" class="form-control" value="<?php echo $edit_user_data[0]->name; ?>" required >
												
											</div>
										</div>
						
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Designation:-</label>
											<div class="col-md-6">
										<input type="text" name="designation" id="inputDefault" class="form-control" value="<?php echo $edit_user_data[0]->designation; ?>" required >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Contact No</label>
											<div class="col-md-6">
										<input type="text" name="contact_no" id="inputDefault" class="form-control" value="<?php echo $edit_user_data[0]->contact_no; ?>" required >
												
											</div>
										</div>
										<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Employer Id  </label>
											<div class="col-md-6">
										<input type="text" name="employer_id" id="inputDefault" class="form-control" value="<?php echo $edit_user_data[0]->employer_Id; ?>" required >
												
											</div>
										</div>
									

									
							<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
											<div class="col-md-6">
												<input type="submit" name="submit" id="inputDefault" class="form-control" value="Submit">
											</div>
										</div>
										
									</form>
								</div>
							</section>
					<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a class="fa fa-caret-down" href="#"></a>
									</div>

									<h2 class="panel-title">Update Password</h2>
								</header>
								<div class="panel-body">
									<form action="<?php echo site_url('catalog/usermanage/updateAdminPassword'); ?>" id="form" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
									<input type="hidden" name="admin_login_id" value="<?php echo  $edit_user_data[0]->admin_login_id; ?>" />
									<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Password </label>
											<div class="col-md-6">
										<input type="text" name="password" id="inputDefault" class="form-control"  required >
												
											</div>
										</div>
									
									<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">Confirm Password </label>
											<div class="col-md-6">
										<input type="text" name="c_password" id="inputDefault" class="form-control"  required >
												
											</div>
										</div>
									
							<div class="form-group">
											<label for="inputDefault" class="col-md-3 control-label">&nbsp;</label>
											<div class="col-md-6">
												<input type="submit" name="submit" id="inputDefault" class=" btn btn-primary" value="Update Password">
											</div>
										</div>
										
									</form>
								</div>
								</form>
								</div>

					</section>
							
							

							

						</div>
					</div>

					

					

					
					<!-- end: page -->
				</section>