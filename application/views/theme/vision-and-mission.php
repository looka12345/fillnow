<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view($this->config->item("template_inclu")."top_css_js");?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-863516042"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-863516042'); </script>
 <!-- Event snippet for April 2021 - Submit Lead Form conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-863516042/CfUtCPP2jIACEIrr4JsD', 'event_callback': callback }); return false; } </script>
	</head>
	<body>
		<div class="b-page-wrap">
			<?php $this->load->view($this->config->item("template_inclu")."mobile-header");?>
			<?php $this->load->view($this->config->item("template_inclu")."header");?>
			<div class="b-page-content with-layer-bg">
				<div class="b-layer">
					<div class="layer-bg page-layer-bg-vision" style="background-image: url(<?=site_url("assets/sitesfile/page_img/$page_info->image")?>);">
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
				<div class="b-awards">
					<div class="container">
						<div class="row">
							<div class="b-awards-info clearfix">
								<div class="col-xs-12 col-md-5 wow fadeInLeft">
									<h3 class="heading-line">
									Vision & Mission
									</h3>
								</div>
								<div class="col-xs-12 col-md-7 wow fadeIn">
									<?=$page_info->content?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view($this->config->item("template_inclu")."footer");?>
		<?php $this->load->view($this->config->item("template_inclu")."bottom_css_js");?>
	</body>
</html>