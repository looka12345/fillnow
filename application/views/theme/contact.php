<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view($this->config->item("template_inclu") . "top_css_js"); ?>
		<script>
function send_message(){

     var phone   = $("#user-phone").val();
     var email   = $("#user-email").val();
     var name    = $("#user-name").val();
     var subject = $("#user-subject").val();
     var message = $("#user-message").val();
     var flexRadioDefault = $("#flexRadioDefault").val();
     if(name=='' || email=='' || phone =='' || subject =='' || message=='' || flexRadioDefault=='')
     {
        return false;
     }
     $.ajax({
		type:'post',
		url:"https://www.synergyteletech.com/Pages/contactmail",
		data: $('#contact-form').serialize(),
		success:function(data)
		{
		 return true;	 
		}
		
		
	}) 
}
</script>
<style>
    .query{
    display: flex;
    justify-content: space-around;
}
.queryheading{
    color:#fff;
    font-size: 18px;
    font-weight: bold;
}
.query label {
    font-size: 14px;
    font-weight: normal;
    color: #ffff;
    padding-bottom: 10px;
}

</style>

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
                    <div class="layer-bg page-layer-bg-contact" style="background-image: url(<?= site_url("assets/sitesfile/page_img/$page_info->image") ?>);">
                        <div class="layer-content">
                            <div class="container wow slideInUp">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 text-center">
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
            <div class="b-page-content map-bg">
                <div class="container">
                    <div class="row">
                        <!-- Info columns -->
                        <div class="b-info-columns-holder col-xs-12 col-sm-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="row equal">
                                <div class="b-info-column col-xs-6 col-sm-3">
                                    <div class="info-column-icon">
                                        <i class="flaticon-placeholder"></i>
                                    </div>
                                    <h6 class="info-column-title">
                                        Address
                                    </h6>
                                    <div class="info-column-text">
                                        <p>
                                           <?=$site_info->site_address?>

                                        </p>
                                    </div>
                                </div>
                                <div class="b-info-column col-xs-6 col-sm-3">
                                    <div class="info-column-icon">
                                        <i class="flaticon-phone-call"></i>
                                    </div>
                                    <h6 class="info-column-title">
                                        Phone/Fax
                                    </h6>
                                    <div class="info-column-text">
                                        <p >
                                            P : <?=$social_info->phone1?>
                                            <br>
                                            F : <?=$social_info->phone2?>
                                        </p>
                                    </div>
                                </div>
                                <div class="b-info-column col-xs-6 col-sm-3">
                                    <div class="info-column-icon">
                                        <i class="flaticon-envelope"></i>
                                    </div>
                                    <h6 class="info-column-title">
                                        E-mail
                                    </h6>
                                    <div class="info-column-text">
                                        <p>
                                           <?=$social_info->email1?>
                                        </p>
                                    </div>
                                </div>
                                <div class="b-info-column col-xs-6 col-sm-3">
                                    <div class="info-column-icon">
                                        <i class="flaticon-square"></i>
                                    </div>
                                    <h6 class="info-column-title">
                                        Website
                                    </h6>
                                    <div class="info-column-text">
                                        <p>
                                            <a href="http://www.fillnow.in">www.fillnow.in</a>
                                            <br>
                                            <a href="http://www.fillnow.co.in">www.fillnow.co.in</a>
                                            <br>
                                            <a href="http://www.synergyteletech.co.in">www.synergyteletech.com</a><br>
                                            <a href="http://www.synergyteletech.co.in">www.synergyteletech.co.in</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="locationmap">
                            <div class="col-md-8 col-md-offset-2"><img src="<?= site_url("assets/media/content/pages-background/map.png")?>" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-map-form-holder">
                    <div class="map-form-switcher">
                        <div class="switcher-bg">
                            <span class="switcher-text text-uppercase">Form</span>
                            <span class="switcher-toggle">
                                <span class="icon"></span>
                            </span>
                            <span class="switcher-text text-uppercase">Map</span>
                        </div>
                    </div>
                    <div class="b-map">
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:800px;width:1920px;'><div id='gmap_canvas' style='height:800px;width:1920px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map() {
                                var myOptions = {zoom: 10, center: new google.maps.LatLng(28.6128, 77.3871), mapTypeId: google.maps.MapTypeId.TERRAIN};
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(28.6128, 77.3871)});
                                infowindow = new google.maps.InfoWindow({content: '<strong>Synergy Teletech</strong>'});
                                google.maps.event.addListener(marker, 'click', function () {
                                    infowindow.open(map, marker);
                                });
                                infowindow.open(map, marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);</script>
                        <div class="b-contact-form">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <!-- Modded Form for simple valid check -->
                                        <form id="contact-form" class="b-form form-check" method="get" action="#">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 form-check-line">
                                                        <input type="text"  class="required-field form-control empty-field" id="user-name" name="name" placeholder="Your Name">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 form-check-line">
                                                        <input type="email"  class="required-field mailfield form-control empty-field" id="user-email" name="email" placeholder="Your Email" autocomplete="off">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 form-check-line">
                                                        <input type="text"  class="required-field  form-control empty-field" id="user-phone" name="phone" placeholder="Your Phone" autocomplete="off">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 form-check-line">
                                                        <input type="text" class="required-field form-control empty-field" id="user-subject" name="subject" placeholder="Subject" autocomplete="off">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 form-check-line">
                                                        <textarea id="user-message" class="required-field textfield form-control empty-field" name="message" rows="6" placeholder="Message"></textarea>
                                                    </div>
                                                    <h5 class="queryheading">Query Regarding ?</h5>
                                            <div class="query">
                                                <div class="form-check" >
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault" value='Bio Diesel'>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Bio Diesel
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault" value='Bowser Fabrication'>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Bowser Fabrication
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault" value='Technical Support'>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Technical Support
                                                    </label>
                                                </div>
                                                </div>
                                                    <div class="col-xs-12 col-sm-12">
                                                        <!-- <button type="submit" class="btn btn-submit" onclick="send_message()">
                                                            Send Message
                                                        </button> -->
                                                        <button type="submit" class="btn btn-submit" onclick="send_message()"> Send Message</button>
                                                        
                                                        <div class="send-alert send-success">
                                                            Your message was sent successfully. Thanks!
                                                        </div>
                                                        <div class="send-alert send-error">
                                                            Please check the form carefully for errors!
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

<?php $this->load->view($this->config->item("template_inclu") . "footer"); ?>
<?php $this->load->view($this->config->item("template_inclu") . "bottom_css_js"); ?>
</body>
</html>