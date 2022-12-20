<!doctype html>

<html class="fixed">

<!-- Mirrored from preview.oklerthemes.com/porto-admin/1.1.0/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 23 Sep 2014 05:11:36 GMT -->

<head>

		<!-- Basic -->

		<meta charset="UTF-8">



		<title><?php echo $site_data[0]->title ?></title>

		<meta name="keywords" content="HTML5 Admin Template" />

		<meta name="description" content="Porto Admin - Responsive HTML5 Template">

		<meta name="author" content="okler.net">



		<!-- Mobile Metas -->

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />



		<!-- Web Fonts  -->

		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">



		<!-- Vendor CSS -->

		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/bootstrap/css/bootstrap.css")?>" />

		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/font-awesome/css/font-awesome.css")?>" />

		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/magnific-popup/magnific-popup.css")?>" />

		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/bootstrap-datepicker/css/datepicker3.css")?>" />

		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/select2/select2.css")?>" />

		<!-- Specific Page Vendor CSS -->		

        <link rel="stylesheet" href="<?php echo  site_url("assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css")?>" />	

        <link rel="stylesheet" href="<?php echo  site_url("assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css")?>" />	

       	<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/morris/morris.css")?>" />



		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/summernote/summernote.css")?>" />

		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/summernote/summernote-bs3.css")?>" />

		<!-- Theme CSS -->

		<link rel="stylesheet" href="<?php echo  site_url("assets/stylesheets/theme.css")?>" />



		<!-- Theme Custom CSS -->

		<link rel="stylesheet" href="<?php echo  site_url("assets/stylesheets/theme-custom.css")?>">


		<!-- Head Libs -->

		<script src="<?php echo  site_url("assets/vendor/modernizr/modernizr.js")?>"></script>

	

		<script src="<?php echo  site_url("assets/admin/js/ajax_function.js")?>"></script>

		<style type="text/css">

 

#modalContainer {

background-color:transparent;

position:absolute;

width:100%;

height:100%;

top:0px;

left:0px;

z-index:10000;

background-image:url(tp.png); /* required by MSIE to prevent actions on lower z-index elements */

}

 

#alertBox {

position:relative;

width:300px;

min-height:100px;

margin-top:50px;

border:2px solid #3BB0DB;

background-color:#F2F5F6;

background-image:url(alert.png);

background-repeat:no-repeat;

background-position:20px 30px;

}

 

#modalContainer > #alertBox {

position:fixed;

}

 

#alertBox h1 {

margin:0;

font:bold 0.9em verdana,arial;

background-color:#3BB0DB;

color:#FFF;

padding:2px 0 2px 5px;

}

 

#alertBox p {

font:15px verdana,arial;

height:50px;

padding-left:5px;

margin-left:55px;

}

 

#alertBox #closeBtn {

display:block;

position:relative;

margin:5px auto;

padding:3px;

border:0px solid #000;

width:70px;

font:0.7em verdana,arial;

text-transform:uppercase;

text-align:center;

color:#FFF;

background-color:#3BB0DB;

text-decoration:none;

}

 

/* unrelated styles */

 

#mContainer {

position:relative;

width:600px;

margin:auto;

padding:5px;

border-top:2px solid #000;

border-bottom:2px solid #000;

font:0.7em verdana,arial;

}

 

h1,h2 {

margin:0;

padding:4px;

font:bold 1.5em verdana;

}

 

code {

font-size:1.2em;

color:#069;

}

 

#credits {

position:relative;

margin:25px auto 0px auto;

width:350px;

font:0.7em verdana;

border-top:1px solid #000;

border-bottom:1px solid #000;

height:90px;

padding-top:4px;

}

 

#credits img {

float:left;

margin:5px 10px 5px 0px;

border:1px solid #000000;

width:80px;

height:79px;

}

 

.important {

background-color:#F5FCC8;

padding:2px;

}

 

code span {

color:green;

}

</style>

<script type="text/javascript">

 

var ALERT_TITLE = "Error Message";

var ALERT_BUTTON_TEXT = "Ok";

 

if(document.getElementById) {

window.alert = function(txt) {

createCustomAlert(txt);

}

}

 

function createCustomAlert(txt) {

d = document;

 

if(d.getElementById("modalContainer")) return;

 

mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));

mObj.id = "modalContainer";

mObj.style.height = d.documentElement.scrollHeight + "px";

 

alertObj = mObj.appendChild(d.createElement("div"));

alertObj.id = "alertBox";

if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";

alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";

alertObj.style.visiblity="visible";

 

h1 = alertObj.appendChild(d.createElement("h1"));

h1.appendChild(d.createTextNode(ALERT_TITLE));

 

msg = alertObj.appendChild(d.createElement("p"));

//msg.appendChild(d.createTextNode(txt));

msg.innerHTML = txt;

 

btn = alertObj.appendChild(d.createElement("a"));

btn.id = "closeBtn";

btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));

btn.href = "#";

btn.focus();

btn.onclick = function() { removeCustomAlert();return false; }

 

alertObj.style.display = "block";

 

}

 

function removeCustomAlert() {

document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));

}

</script>

	</head>

	<body>

		<section class="body">



			<!-- start: header -->

			<header class="header">

				<div class="logo-container">

					<a href="<?php echo site_url("admin/welcome"); ?>" class="logo">

						<img src="<?php echo $this->config->item("SITE_ROOT_IMAGE")."siteconfig/".$site_data[0]->logo; ?>" height="35" alt="Porto Admin" />

					</a>

					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">

						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>

					</div>

				</div>



                  <!-- start: search & user box -->

             <div class="header-right">

			

			

					<div id="userbox" class="userbox">

						<a href="<?php echo site_url("catalog/usermanage/profile"); ?>" data-toggle="dropdown">

							<figure class="profile-picture">

								<img src="<?php echo site_url("assets/images/user")."/".$this->session->userdata("image"); ?>" alt="Login User" class="img-circle" data-lock-picture="assets/images/%21logged-user.jpg" />



							</figure>

							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">

								<span class="name"><?php echo $this->session->userdata("admin_username"); ?></span>

								<span class="role"><?php echo $this->session->userdata("admin_role"); ?></span>

							</div>

			

							<i class="fa custom-caret"></i>

						</a>

			

						<div class="dropdown-menu">

							<ul class="list-unstyled">

								<li class="divider"></li>

								<li>

									<a role="menuitem" tabindex="-1" href="<?php echo site_url("catalog/usermanage/profile"); ?>"><i class="fa fa-user"></i> My Profile</a>

								</li>

							

								<li>

									<a href="<?=site_url("admin/admin_logout")?>" role="menuitem" tabindex="-1"><i class="fa fa-power-off"></i> Logout</a>

								</li>

							</ul>

						</div>

					</div>

				</div>

                

        </header>        