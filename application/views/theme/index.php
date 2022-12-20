<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view($this->config->item("template_inclu")."top_css_js");?>
        <meta name="robots" content="noindex">
        <meta name="google-site-verification" content="UsV4xh_eOOVP2cs1EKS0-LMfUcJDxH1fYpUb3IJ0mRM" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Global site tag (gtag.js) - Google Ads: 863516042 -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script async src="https://www.googletagmanager.com/gtag/js?id=AW-863516042"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-863516042'); </script>
 <!-- Event snippet for April 2021 - Submit Lead Form conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-863516042/CfUtCPP2jIACEIrr4JsD', 'event_callback': callback }); return false; } 

function send_message(){

     var phone = $("#phone").val();
     var email = $("#email").val();
     var name = $("#name").val();
     var subject = $("#subject").val();
     var message = $("#message").val();
     var hidden_captcha = $("#hidden_captcha").val();
     var captcha = $("#captcha").val();
     var flexRadioDefault = $("#flexRadioDefault").val();

     if(name=='' || email=='' || phone =='' || subject =='' || message=='' || flexRadioDefault=='')
     {
        document.getElementById("send_error").style.display = "block";
        return false;
     }else{
        document.getElementById("send_error").style.display = "none";
     }

     if(captcha != hidden_captcha)
     {
         document.getElementById("captcha_error").style.display = "block";
         return false;
     }else{
        document.getElementById("captcha_error").style.display = "none";
     }
     $.ajax({
        type:'post',
        url:"https://www.synergyteletech.com/Pages/contactmail",
        data: $('#contact-form').serialize(),
        beforeSend: function () {
            $("#loader").show();
            $("#enquiry_form").css("opacity", "0.6");
        },
        success:function(data)
        {
            $("#loader").hide();
             $("#enquiry_form").css("opacity", "");
            document.getElementById("send_success").style.display = "block";
            return true;    
        }
        
        
    }) 
}

function genratepromocode()
    {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < 6; i++ ) {
           result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        $("#captcha_show").append("<b>"+result+"</b>");
        $("#hidden_captcha").val(result);
    }
</script>
    </head>
    <body onload="genratepromocode()">
        <div class="b-page-wrap">
            <?php $this->load->view($this->config->item("template_inclu")."mobile-header");?>
            <?php $this->load->view($this->config->item("template_inclu")."header");?>
            <div class="b-page-content with-layer-bg">
                <div class="b-layer-big">
                    <div class="layer-big-bg page-layer-big-bg-home" style="background-image: url(assets/sitesfile/page_img/<?=$page_info->image?>);">
                        <div class="layer-content-big">
                            <div class="b-home-slider-holder wow slideInUp">
                                <div class="b-home-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "fade": true, "speed": 1000, "autoplay": true}'>
                                    <div class="home-slide">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 text-center">
                                                    <div class="b-home-slider-content">
                                                        <h2 class="main-heading">
                                                        <span class="blue"> Fuel Delivered.</span> <span class="green">Anywhere.</span>
                                                        </h2>
                                                        <div class="home-slider-text">
                                                            Download our app to order now
                                                        </div>
                                                        <a href="https://play.google.com/store/apps/details?id=com.synergy.fillnows" tabindex="0"><img src="assets/media/buttons/app-store-google.png"></a>
                                                        <a href="#" tabindex="0"><img src="assets/media/buttons/app-store-apple.png"></a>
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
                <div class="b-homepage-content ">
                    <div class="b-layer-main">
                        <div class="page-arrow">
                            <i class="fa fa-play" aria-hidden="true"></i>
                            <a class="popup-youtube video-icon" href="https://www.youtube.com/embed/<?=$home_video->path?>">
                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="b-about">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 text-center">
                                        <h3 class="big-title-mod">
                                        As simple & convenient as it sounds
                                        </h3>
                                    </div>
                                    <div class="b-info-columns-holder b-steps-list col-xs-12 col-sm-12 wow zoomIn">
                                        <div class="row equal">
                                            <div class="b-info-column col-xs-4 col-sm-4">
                                                <div class="info-column-icon">
                                                    <img src="assets/media/icons/1.png">
                                                    <span class="step-number">
                                                        1
                                                    </span>
                                                </div>
                                                <h6 class="info-column-title">
                                                Request FillNow
                                                </h6>
                                                <div class="info-column-text">
                                                    <p>
                                                        Let us know where, when and what you want.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="b-info-column col-xs-4 col-sm-4">
                                                <div class="info-column-icon">
                                                    <img src="assets/media/icons/2.png">
                                                    <span class="step-number">
                                                        2
                                                    </span>
                                                </div>
                                                <h6 class="info-column-title">
                                                Redirect your staff
                                                </h6>
                                                <div class="info-column-text">
                                                    <p>
                                                        to do more productive work.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="b-info-column col-xs-4 col-sm-4">
                                                <div class="info-column-icon">
                                                    <img src="assets/media/icons/3.png">
                                                    <span class="step-number">
                                                        3
                                                    </span>
                                                </div>
                                                <h6 class="info-column-title">
                                                Get assured Q&Q of product
                                                </h6>
                                                <div class="info-column-text">
                                                    <p>
                                                        Save like never before.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-service-page">
                            <div class="b-title-service">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <h3 class="big-title-mod">
                                            About Us
                                            </h3>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 ">
                                            <div class="b-text">
                                                <p><?=strip_tags($about_info->about1)?></p>
                                                <p><a href="<?=site_url("company-profile")?>" class="btn btn-secondary3" tabindex="0">Read More</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-video">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-helper-wrapper">
            <div class="layer-bg-mod page-layer-bg4">
                <div class="b-add-info-holder">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 wow slideInLeft" style="visibility: visible; animation-name: slideInLeft;">
                                <h4>Fulfilling Customer’s Needs</h4>
                                <h3 class="big-title-mod" style="color:#fff; margin-bottom:30px;">
                                Mobile App Features
                                </h3>
                                <div class="row equal">
                                    <?php
                                    foreach ($app_feat as $feat_id => $feat) {?>
                                    <div class="b-add-info col-xs-6 col-sm-6 col-md-4">
                                        <div class="add-info-number">
                                            0<?=$feat_id+1?>.
                                        </div>
                                        <div class="add-info-content">
                                            <div class="add-info-content-title">
                                                <?=$feat->name?>
                                            </div>
                                            <div class="add-info-content-text">
                                                <?=$feat->content?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-4 slideInRight" style="visibility: visible; animation-name: slideInRight;">
                                <div class="app-img " ><a href="#">
                                    <img src="assets/media/general/mobile_app.png">
                                </a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shape-bg"></div>
            </div>
            <div class="container-absolute hidden-xs hidden-sm">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="mac-wrapper-mod wow slideInRight" style="visibility: visible; animation-name: slideInRight;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-history new">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <h3 class="inherit-title">
                        Great Features, Unprecedented Benefits
                    </h3></div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="b-pager-slideshow-holder">
                            <div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" aria-live="polite" style="width: 100%; overflow: hidden; position: relative; height: 141px;">
                                <ul class="pager-slideshow bxslider-pager" style="width: 7215%; position: relative; transition-duration: 0s; transform: translate3d(-1210px, 0px, 0px);">
                                    <?php
                                    foreach ($home_feat as $feat_id => $feat) {?>
                                    <li style="float: left; list-style: none; position: relative; width: 1170px;" class="bx-clone" aria-hidden="true">
                                        <div class="pager-item">
                                            <div class="pager-item-title">
                                                <?=$feat->name?>
                                            </div>
                                            <div class="pager-item-description">
                                                <?=$feat->description?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    </ul></div><div class="bx-controls"></div></div>
                                    <div class="custom-slideshow-controls hidden-xs">
                                        <span id="pager-slideshow-prev"><a class="bx-prev" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a></span>
                                        <span id="pager-slideshow-next"><a class="bx-next" href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a></span>
                                    </div>
                                </div>
                                <div class="bx-pager custom-pager">
                                    <?php
                                    foreach ($home_feat as $feat_id => $feat) {?>
                                    <a data-slide-index="<?=$feat_id?>" href="#" class="active">
                                        <div class="info-column-icon">
                                            <img src="<?=site_url("assets/sitesfile/image/client/$feat->image")?>">
                                        </div>
                                        <span class="pager-title">
                                            <?=$feat->name?>
                                        </span>
                                        <span class="circle">
                                            <span class="inner-circle"></span>
                                        </span>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-reviews">
                    <section id="carousel">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
                                    <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="10000">
                                        <ol class="carousel-indicators">
                                            <?php
                                            foreach ($testi_list as $test_id => $testi) {?>
                                            <li data-target="#fade-quote-carousel" data-slide-to="<?=$test_id?>" class="<?=$test_id=='0'?'active':''?>"></li>
                                            <?php } ?>
                                        </ol>
                                        <div class="carousel-inner">
                                            <?php
                                            foreach ($testi_list as $test_id => $testi) {?>
                                            <div class="item <?=$test_id=='0'?'active':''?>">
                                                <blockquote>
                                                    <p>“<?=$testi->description?>”<br>- <strong><?=$testi->name?></strong></p>
                                                </blockquote>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <a class="left carousel-control" href="#fade-quote-carousel" data-slide="prev">
                                            <span class="fa fa-angle-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#fade-quote-carousel" data-slide="next">
                                            <span class="fa fa-angle-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
              <!--   <div class="scroll-to-top open-close-chat" style="display: block; right: 74px;"><span class="fa fa-comment"></span></div>
                <div style="padding: 0;width: 400px;position: fixed;margin: 0;z-index: 9999999;height: 322px;bottom: 62px;right: 15px; display:none" id="chat-wrapper">
                        <div class="grident-form-heading chat-header">
                            <img src="assets/media/buttons/app-store-google.png" class="chat_user">
                            <div class="chat_user_name">
                                <h5>Chat with Khalid</h5>

                            </div>
                            <span style="position: absolute;top: 30px;right: 15px;font-size: 23px; cursor:pointer;" class="open-close-chat"><i class="fa fa-phone" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                        <div class="consultant-form-box">
                            <div class="card-body" style="padding: 0;">
                                
                                <form enctype="multipart/form-data" id="chat_form" style="padding: 15px;">
                                    <input type="hidden" name="_token" value="XyT9weY2LitsCekEBpUKg4D4hkUf6n8h9mnMWpHE">
                                    <div class="form-group mt-2">
                                        <input class="form-control cus-form-control" name="name" type="text" placeholder="Name" required="" id="chat_name">
                                        <span id="chat_name_error" class="text-danger"></span>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input class="form-control cus-form-control" name="email" type="email" placeholder="Email*" required="" id="chat_email">
                                        <span id="chat_email_error" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control cus-form-control" name="phone" type="text" placeholder="Phone Number" required="" id="chat_phone">
                                        <span id="chat_phone_error" class="text-danger"></span>
                                    </div>
                                   <input type="email" class="form-control" id="" placeholder="Enter Your Massage">
                                   <div class="form-group mt-4 text-center">
                                        <button class="btn btn-submit" value="button" type="button" id="chat-submit-btn" style="height: 40px;"><i class="fa fa-spin fa-spinner" style="font-size: 17px;display: none;"></i><span>Start Chat</span></button>
                                    </div> -->
                                </form>
                                <div id="messages" style="display: none;"><div class="message-wrapper">
                                    <ul class="messages">
                                    </ul>
                                 </div>
                        <div class="input-text">
                            <input type="text" name="message" class="submit" placeholder="Type a message">
                        </div>
                    </div>
                                <!-- <div id="messages"></div> -->
                            </div>
                            </div>
                        </div>

                <div class="form-popup" id='enquiry_form'>

                  <div id="loader" style="display:none"><div class="loader-wrap" style="z-index: 999;"><span class="loader02"></span></div></div>
                  <form action="/action_page.php" class="form-container" id='contact-form'>
                    <h5>Enquiry</h5>

                    <input type="text" placeholder="Enter name" name="name" id='name' required>

                    <input type="text" placeholder="Enter phone no." name="phone" id='phone' required>
                    <input type="text" placeholder="Enter email" name="email" id='email' required>
                    <input type="text" placeholder="Enter subject" name="subject"  id='subject'required>
                  
                    <textarea placeholder="Message" name="message" rows="3"></textarea>
                    <h5>Query regarding ?</h5>
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
                    <input type="text" placeholder="Enter captcha" name="captcha"  id='captcha'required>
                    <p id='captcha_show'>Captcha : </p>
                    <input type="hidden" name="hidden_captcha" value='' id='hidden_captcha'>
                    <div id="send_success" style="display:none;color: green;">
                        Your message was sent successfully. Thanks!
                    </div>
                    <div id="send_error" style="display:none;color: red;">
                        Please fill all fields. Thanks!
                    </div>
                    <div id="captcha_error" style="display:none;color: red;">
                         CAPTCHA does not match!
                    </div>

                   
                    <button type="submit" onclick="send_message()" class="btn">Send Message</button>
                    <button type="button" class="btn-close cancel" onclick="closeForm()" aria-label="Close"><i class="fa fa-times"></i></button>
                    
                   
                  </form>
                </div>
                <?php $this->load->view($this->config->item("template_inclu")."footer");?>

                <style>
                section {
                padding-top: 100px;
                padding-bottom: 100px;
                z-index: 1;
                }
                {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */

.form-popup textarea{
    resize: none;
    width: 100%;
    background: #c7f7bd;
    border: navajowhite;
    font-size: 14px;
    padding: 5px;
 margin-top: 5px;
}
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  position: fixed;
  bottom: 0;
  right: 0px;
  z-index: 9;
  height: 85vh;
}
.form-popup h5{
    color: #33bf18;
    font-size: 18px;
    text-align: center;
    font-weight: bold;
}
/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 13px 20px;
  background-color: white;
box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
border: none;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
 width: 100%;
    padding: 7px;
    margin: 5px 0 5px 0px;
    border: none;
    background: #c7f7bd;
}
input[type="radio"]:checked + .radio-label:before {
    background-color: #42ad11!important;
    box-shadow: inset 0 0 0 4px #f4f4f4;
}
input[type="radio"] + .radio-label:before {
    content: '';
    background: #f4f4f4;
    border-radius: 100%;
    border: 1px solid #b4b4b4;
    display: inline-block;
    width: 1.4em;
    height: 1.4em;
    position: relative;
    top: -0.2em;
    margin-right: 1em;
    vertical-align: top;
    cursor: pointer;
    text-align: center;
    transition: all 250ms ease;
}
    

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
.form-container::placeholder{
    color: red;
}
/* Set a style for the submit/login button */
.form-container .btn {
 background-color: #42ad11;
    color: white;
    padding: 11px 15px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin: 5px 0;
    opacity: 1;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
       top: 0;
    right: 0px;
    position: absolute;
    border: none;
    background: #42ad11;
    color: #fff;
}
/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
                .quote {
                color: rgba(0,0,0,.1);
                text-align: center;
                margin-bottom: 30px;
                color: #42ad11;
                }
                #fade-quote-carousel.carousel {
                padding-bottom: 60px;
                color: #fff;
                }
                #fade-quote-carousel.carousel .carousel-inner .item {
                opacity: 0;
                -webkit-transition-property: opacity;
                -ms-transition-property: opacity;
                transition-property: opacity;
                }
                #fade-quote-carousel.carousel .carousel-inner .active {
                opacity: 1;
                -webkit-transition-property: opacity;
                -ms-transition-property: opacity;
                transition-property: opacity;
                }
                #fade-quote-carousel.carousel .carousel-indicators {
                bottom: 10px;
                }
                #fade-quote-carousel.carousel .carousel-indicators > li {
                background-color: #42ad11;
                border: none;
                }
                #fade-quote-carousel blockquote {
                text-align: center;
                border: none;
                }
                #fade-quote-carousel .profile-circle {
                width: 100px;
                height: 100px;
                margin: 0 auto;
                border-radius: 100px;
                }
                .scroll-to-top {
    position: fixed;
    bottom: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    color: #ffffff;
    font-size: 24px;
    text-transform: uppercase;
    line-height: 40px;
    text-align: center;
    z-index: 100;
    cursor: pointer;
    background: #42ad11;
    display: none;
    -webkit-transition: all 300ms ease;
    -ms-transition: all 300ms ease;
    -o-transition: all 300ms ease;
    -moz-transition: all 300ms ease;
    transition: all 300ms ease;
}
.grident-form-heading {
    position: relative;
    background-color: #42ad11;
    background-image: linear-gradient(#42ad11,#000000);
    padding: 25px 25px;
    color: #fff;
    border-top-left-radius: 5px;
    height:100px;
    border-top-right-radius: 5px;
}
.grident-form-heading .chat_user{
    height: 50px; width: 50px;border-radius: 50%;
    float: left;
}
.open-close-chat i{
    padding: 0 20px ;
}
.consultant-form-box {
    background: #fff;
    box-shadow: 0px 2px 15px rgba(0,0,0,0.15);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
.grident-form-heading .chat_user_name h5{
    font-size: 20px ;
    float: left;
    padding-left: 10px;
}
input {
    position: relative;
    width: 90%;
    font-size: 14px;
    line-height: 20px;
    font-weight: 500;
    color: #4b4b4b;
    -webkit-font-smoothing: antialiased;
    font-smoothing: antialiased;
    outline: none;
    background: #fff;
    display: inline-block;
    resize: none;
    padding: 5px;
    border-radius: 3px;
}
.consultant-form-box .card-body .cus-form-control {
    display: block;
    width: 100%;
    padding: .475rem .50rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 0;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.text-danger {
    color: #dc3545!important;
}
.consultant-form-box .card-body .btn-submit {
    background-color: #42ad11;
    width: 60%;
    border-radius: 25px;
    padding: 9px 20px;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
}
.query{
    display: flex;
    justify-content: space-around;
}
.query label{
    font-size: 12px;
    font-weight: normal;
    color: #42ad11;
}


 
                </style>
                
                <?php $this->load->view($this->config->item("template_inclu")."bottom_css_js");?>
            </body>
            <script>
            $(document).ready(function(){
              $(".open-close-chat").click(function(){
                $("#chat-wrapper").toggle();
              });
            });
            function openForm() {
  document.getElementById("contact-form").style.display = "block";
}

function closeForm() {
  document.getElementById("contact-form").style.display = "none";
}
            </script>
        </html>