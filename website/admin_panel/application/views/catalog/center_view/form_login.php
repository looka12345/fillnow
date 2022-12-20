<div class="panel-body">
						  <?php  print form_open("admin/login_process",array("onSubmit"=>"return ValidateForm(this)") );?>
                <fieldset>
                <?php 
		      if(isset($errormessage))
	 			{
	
           			 echo "<div style='color:#FF0000; text-align:center'  align='center' >$errormessage</div>";
				}
           ?>
							<div class="form-group mb-lg">
								<label>Username &nbsp;&nbsp;  <?php echo form_error("username","<spane style='color:#FF0000;' >", "</spane>");?></label>
								<div class="input-group input-group-icon">
                                <?php print form_input(array('id' => 'username', 'name' => 'username',"class" => "form-control input-lg"),set_value("username"))?>
									<!--<input name="username" type="text" class="form-control input-lg" />-->
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
                                        
									</span>
								</div>
                                
							</div>
                            

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password &nbsp;&nbsp; <?php echo form_error("password","<spane style='color:#FF0000;' >", "</spane>");?></label> 
<!--									<a href="pages-recover-password.html" class="pull-right">Lost Password?</a>
-->								</div>
								<div class="input-group input-group-icon">
                                   <?php print form_password(array('id' => 'password', 'name' => 'password',"class" => "form-control input-lg"),set_value("password"));?>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
					 	
					             
							
					   
							</div>

							<div class="row">
								<div class="col-sm-8">
									<!--<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>-->
								</div>
								<div class="col-sm-4 text-right">
                                 	<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
								</div>
							</div>

						  <?php echo form_close(); ?>
					</div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  