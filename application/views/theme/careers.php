<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view($this->config->item("template_inclu") . "top_css_js"); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>		
				<script>
$(document).ready(function (e) {
 $("#contact-form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
   url:"https://www.synergyteletech.com/Pages/careermail",
   type:"POST",
   data:new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   
   success: function(data)
      {
        return true;
      }
              
    });
 }));
});

</script>

<!-- Global site tag (gtag.js) - Google Ads: 863516042 -->
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
            <div class="b-page-content map-bg2">
                <div class="container">
                    <div class="row">
                        <div class="b-map-form-holder carer">
                            <div class="b-contact-form">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 style="color:#fff;">We are a Great Company to Work </h1>
                                            <!-- Modded Form for simple valid check -->
                                            <form id="contact-form" class="b-form form-check" method="get"  style="padding-top:30px;" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="col-xs-12 col-sm-12 form-check-line">
                                                                <input type="text" pattern=".{3,}" class="required-field form-control empty-field" id="user-name" name="name"placeholder="Your Name">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 form-check-line">
                                                                <input type="text" pattern=".{3,}" class="required-field form-control empty-field" id="user-subject" placeholder="Mobile No." name="contact" autocomplete="off">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 form-check-line">
                                                                <input type="text" pattern=".{3,}" class="required-field form-control empty-field" id="user-subject" placeholder="Total Exp." name="exp" autocomplete="off">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 form-check-line">
                                                                <input type="file" pattern=".{3,}" class="required-field form-control empty-field" id="user-subject" placeholder="Total Exp." name="resume" autocomplete="off">
                                                            </div>
                                                        </div>
														<div class="col-sm-6">
                                                        <div class="col-xs-12 col-sm-12 form-check-line">
                                                            <input type="email" pattern=".{3,}" class="required-field mailfield form-control empty-field" id="user-email" placeholder="Your Email" name="email" autocomplete="off">
                                                        </div>

                                                        <div class="col-xs-12 col-sm-12 form-check-line">
                                                            <input type="text" pattern=".{3,}" class="required-field form-control empty-field" id="user-subject" placeholder="Applied for" name="applied_for" autocomplete="off">
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 form-check-line">
                                                            <textarea id="user-message" class="required-field textfield form-control empty-field" rows="6" name="message" placeholder="Message"></textarea>
                                                        </div>

                                                        <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                                                            <input type="submit" class="btn btn-submit" value="Send Message">
                                                            <div class="send-alert send-success">
                                                                Your message was sent successfully. Thanks!
                                                            </div>
                                                            <div class="send-alert send-error">
                                                                Please check the form carefully for errors!
                                                            </div>
                                                        </div>
														</div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item("template_inclu") . "footer"); ?>
<?php $this->load->view($this->config->item("template_inclu") . "bottom_css_js"); ?>
</body>
</html>