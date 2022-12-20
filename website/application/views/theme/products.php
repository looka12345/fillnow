<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view($this->config->item("template_inclu")."top_css_js");?>
		<meta name="google-site-verification" content="UsV4xh_eOOVP2cs1EKS0-LMfUcJDxH1fYpUb3IJ0mRM" />
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-863516042"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-863516042'); </script>
 <!-- Event snippet for April 2021 - Submit Lead Form conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-863516042/CfUtCPP2jIACEIrr4JsD', 'event_callback': callback }); return false; } </script>
	</head>
	<body>
		<div class="b-page-wrap">
			<?php $this->load->view($this->config->item("template_inclu")."mobile-header");?>
			<?php $this->load->view($this->config->item("template_inclu")."header");?>
			<div class="b-page-content with-layer-bg">
				<div class="b-layer">
					<div class="layer-bg page-layer-bg-productdiesel" style="background-image: url(<?=site_url("assets/sitesfile/page_img/$page_info->image")?>);">
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
						<?php if(strip_tags($product->overview) || strip_tags($product->description)){?>
						<div class="b-awards">
							<div class="container">
							<?php if(strip_tags($product->overview)){?>
								<div class="row">
									<div class="b-awards-info clearfix">
										<div class="col-xs-12 col-md-5 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
											<h3 class="heading-line">
											Overview
											</h3>
										</div>
										
										<div class="col-xs-12 col-md-7 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
											<div class="b-text">
												<?=$product->overview?>
											</div>
										</div>
									</div>
								</div>
							<?php } 
							if(strip_tags($product->description)){
							?>
								<div class="row">
									<div class="b-awards-info clearfix">
										<div class="col-xs-12 col-md-12 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
											<div class="b-text">
												<?=$product->description?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
						<?php } if(strip_tags($product->feature) || strip_tags($product->feature_short) || $usp_list){?>
						<div class="b-title-service2">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="col-xs-12 col-md-5 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
											<h3 class="heading-line">
											Features <?php if($usp_list){?>&amp; USPs<?php } ?>
											</h3>
										</div>
										<?php
										if(strip_tags($product->feature_short)){?>
										<div class="col-xs-12 col-md-7 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
											<div class="b-text">
												<?=$product->feature_short?>
											</div>
										</div>
										<?php } if($usp_list){?>
										<div class="col-xs-12 col-md-12 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
											<h2>Our Main USPs</h2>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="b-features-columns-holder ">
							<div class="container">
								<div class="row equal">
									<div class="wave-bg"></div>
									<?php
									foreach ($usp_list as $usp_id => $usp) {?>
									<div class="col-xs-6 col-sm-6 col-md-4 wow slideInRight">
										<div class="b-features-column">
											<div class="features-column-icon">
												<img src="<?=site_url("assets/sitesfile/image/counter/$usp->image")?>">
											</div>
											<h6 class="features-column-title">
											<?=$usp->name?>
											</h6>
											<div class="features-column-text">
												<?=$usp->value?>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php
										if(strip_tags($product->feature)){?>
								<div class="row">
									<div class="col-md-12">
										<div class="b-text pad-bot">
											<?=$product->feature?>
										</div>
									</div>
								</div>
										<?php } ?>
							</div>
						</div>
						<?php } if(strip_tags($product->benefit_short) || strip_tags($product->benefit)){?>
						<div class="b-title-service2 bac">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="col-xs-12 col-md-5 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
											<h3 class="heading-line">
											Benefits
											</h3>
										</div>
										<?php
										if(strip_tags($product->benefit_short)){?>
										<div class="col-xs-12 col-md-7 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
											<div class="b-text">
												<?=$product->benefit_short?>
											</div>
										</div>
										<?php } ?>
									</div>
									<?php
										if(strip_tags($product->benefit)){?>
									<div class="b-tab-list ">
										<div class="container">
											<div class="row ">
												<div class="col-xs-12 col-sm-6 col-md-12 mar">
													<?=$product->benefit?>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php } if(strip_tags($product->application)){?>
						<div class="b-title-service2 bac">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="col-xs-12 col-md-5 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
											<h3 class="heading-line">
											Applications
											</h3>
										</div>
									</div>
									<?=$product->application?>
								</div>
							</div>
						</div>
						<?php } if($gallery_list){?>
						<div class="b-title-service2 bac">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="col-xs-12 col-md-5 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
											<h3 class="heading-line">
											Gallery
											</h3>
										</div>
									</div>
								</div>
								<div class="b-gallery b-isotope">
									<div class="b-gallery-sorting-holder">
										<div class="container">
											<div class="row">
												<div class="col-xs-12 col-sm-12">
													<ul class="list-inline text-uppercase text-center b-items-sort b-isotope__filter">
														<li>
															<a href="#" data-filter="*" class="">all</a>
														</li>
														<li>
															<a href="#" data-filter=".photos" class="">Photos</a>
														</li>
														<li>
															<a href="#" data-filter=".video" class="">Video</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="b-items-gallery-holder">
										<div class="container">
											<div class="row">
												<div class="js-zoom-gallery grid clearfix" style="position: relative; height: 870px;">
													<div class="grid-sizer"></div>

													<div class="b-gallery-1__item  photos gallerry_block row col-md-12" >
														<?php
															foreach ($gallery_list as $gallery_id => $gallery) {
														if($gallery->image){?>
														<div class="gallery-item-content col-sm-4 col-md-4 col-lg-4 col-xs-12">
															<div class="gallery-item-img">
																<img src="<?=site_url("assets/sitesfile/image/gallery/$gallery->image")?>" alt="/" class="img-responsive">
																<div class="gallery-item-hover">
																	<a href="<?=site_url("assets/sitesfile/image/gallery/$gallery->image")?>" class="js-zoom-gallery__item">
																		<span class="item-hover-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
																		<img src="<?=site_url("assets/sitesfile/image/gallery/$gallery->image")?>" alt="/" class="img-responsive">
																	</a>
																</div>
															</div>
														</div>
														<?php } } ?>
													</div>
													<div class="b-gallery-1__item grid-item video" >
														<?php
															foreach ($gallery_list as $gallery_id => $gallery) {
														if($gallery->path){?>
														<div class="gallery-item-content">
															<div class="gallery-item-img">
																<iframe width="370" height="370" src="https://www.youtube.com/embed/<?=$gallery->path?>" frameborder="0" allowfullscreen=""></iframe>
															</div>
														</div>
														<?php } } ?>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view($this->config->item("template_inclu")."footer");?>
		<?php $this->load->view($this->config->item("template_inclu")."bottom_css_js");?>

		
	</body>
</html>