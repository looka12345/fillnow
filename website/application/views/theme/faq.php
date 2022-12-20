<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view($this->config->item("template_inclu") . "top_css_js"); ?>
		<style>
		button.accordion {
		background-color: #eee;
		color: #444;
		cursor: pointer;
		padding: 18px;
		width: 100%;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
		}
		button.accordion.active, button.accordion:hover {
		background-color: #ddd;
		}
		button.accordion:after {
		content: '\002B';
		color: #4caf50;
		font-weight: bold;
		float: right;
		margin-left: 5px;
		font-size:18px;
		}
		button.accordion.active:after {
		content: "\2212";
		}
		div.panel {
		padding: 0 18px;
		background-color: white;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.2s ease-out;
		margin-bottom:0px;
		}
		div.panel p {
		padding-top:20px;
		}
		</style>
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-863516042"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-863516042'); </script>
 <!-- Event snippet for April 2021 - Submit Lead Form conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-863516042/CfUtCPP2jIACEIrr4JsD', 'event_callback': callback }); return false; } </script>
	</head>
	<body>
		<div class="b-page-wrap">
			<?php $this->load->view($this->config->item("template_inclu") . "mobile-header"); ?>
			<?php $this->load->view($this->config->item("template_inclu") . "header"); ?>
			<div class="b-page-content with-layer-bg">
				<div class="b-layer">
					<div class="layer-bg page-layer-bg-faq" style="background-image: url(<?= site_url("assets/sitesfile/page_img/$page_info->image") ?>);">
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
				<div class="b-layer-main">
					<div class="b-service-page">
						<div class="b-awards">
							<div class="container">
								<div class="row">
									<div class="b-awards-info clearfix">
										<div class="col-xs-12 col-md-12 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
											<?php
											foreach ($faq_list as $faq_id => $faq) {?>
											<button class="accordion"><?=$faq_id+1?>. <?=$faq->question?></button>
											<div class="panel">
												<?=$faq->answer?>
												<hr>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view($this->config->item("template_inclu") . "footer"); ?>
		<?php $this->load->view($this->config->item("template_inclu") . "bottom_css_js"); ?>
		<script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) {
		acc[i].onclick = function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
		panel.style.maxHeight = null;
		} else {
		panel.style.maxHeight = panel.scrollHeight + "px";
		}
		}
		}
		</script>
	</body>
</html>