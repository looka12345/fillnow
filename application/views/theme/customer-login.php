<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view($this->config->item("template_inclu") . "top_css_js"); ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-863516042"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-863516042'); </script>
 <!-- Event snippet for April 2021 - Submit Lead Form conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-863516042/CfUtCPP2jIACEIrr4JsD', 'event_callback': callback }); return false; } </script>
    </head>
    <body>
        <div class="b-page-wrap">
            <?php $this->load->view($this->config->item("template_inclu") . "mobile-header"); ?>
            <?php $this->load->view($this->config->item("template_inclu") . "header"); ?>
            <div class="b-page-content with-layer-bg">
                <div class="b-layer">
                    <div class="layer-bg page-layer-bg-career" style="background-image: url(<?= site_url("assets/sitesfile/page_img/$page_info->image") ?>);">
                        <div class="layer-content">
                            <div class="container wow slideInUp">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 text-center">
                                        <!-- Breadcrumbs -->
                                        <h1 class="main-heading">
                                            <?=$page_info->content_title?>
                                        </h1>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
           <div class="container wow slideInUp">
                                <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 login-form">
               <form class="form-customer-login" method="post" action="#">
                 <div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon bgblue"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
					<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div> 
						
							<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon bggreen"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>
						
						<div class="form-group ">
							<button type="button" class="btn btn-primary btn-lg btn-block login-button">Sign In</button>
						</div>
                   
               </form>  
               <div class="form-txt-">
                   <p>or sign in using</p>
               </div>
               <div class="social-btn">
                 <a href="#"><i class="fa fa-facebook facebk"></i></a> 
                  <a href="#"><i class="fa fa-google-plus googleps"></i></a>  
               </div>
               
               <div class="forpasswd"><a href="#">Forget Password</a></div>
                                </div>
                                 </div></div>
     </div>
    </div>
</div>
<?php $this->load->view($this->config->item("template_inclu") . "footer"); ?>
<?php $this->load->view($this->config->item("template_inclu") . "bottom_css_js"); ?>
</body>
</html>