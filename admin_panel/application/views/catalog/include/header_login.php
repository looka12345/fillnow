<!doctype html>
<html class="fixed">
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="Nishant Chaudhary">
		<title><?php echo $site_data[0]->title ; ?></title>
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/bootstrap/css/bootstrap.css")?>" />
		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/font-awesome/css/font-awesome.css")?>" />
		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/magnific-popup/magnific-popup.css")?>" />
		<link rel="stylesheet" href="<?php echo  site_url("assets/vendor/bootstrap-datepicker/css/datepicker3.css")?>" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo  site_url("assets/stylesheets/theme.css")?>" />
		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo  site_url("assets/stylesheets/theme-custom.css")?>">
		<!-- Head Libs -->
		<script src="<?php echo  site_url("assets/vendor/modernizr/modernizr.js")?>"></script>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="<?php echo str_replace("/admin","",site_url()); ?>" target="_blank" class="logo pull-left">
					<img src="<?php echo $this->config->item("SITE_ROOT_IMAGE")."siteconfig/".$site_data[0]->logo;?>" height="54" alt="Porto Admin" />
				</a>
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>