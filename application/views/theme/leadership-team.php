<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view($this->config->item("template_inclu") . "top_css_js"); ?>
        <style>
            .leadtesti{border-radius:50%;}
        </style>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-863516042"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-863516042'); </script>
 <!-- Event snippet for April 2021 - Submit Lead Form conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-863516042/CfUtCPP2jIACEIrr4JsD', 'event_callback': callback }); return false; } </script>
    </head>
    <body>
        <div class="b-page-wrap">
            <?php $this->load->view($this->config->item("template_inclu") . "mobile-header"); ?>
            <?php $this->load->view($this->config->item("template_inclu") . "header"); ?>
            <div class="b-page-content with-layer-bg">
                <!-- ==========================-->
                <!-- PAGES BACKGROUND -->
                <!-- ==========================-->
                <div class="b-layer">
                    <div class="layer-bg page-layer-bg-leadership" style="background-image: url(assets/media/content/pages-background/about_team_banner.jpg);">
                        <div class="layer-content">
                            <div class="container wow slideInUp">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 text-center">
                                        <!-- Breadcrumbs -->

                                        <h1 class="main-heading">
                                            Leadership
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-awards leadd">

                    <div class="b-layer-main">
                        <div class="b-about">
                            <div class="b-about">
                                <div class="container">
                                    <div class="row">

                                        <div class="text-center">
                                            <h3 class="big-title-mod">
                                                Leadership Team
                                            </h3>
                                            <div class="big-title-text">
                                                <p>
                                                    “Building a strong team is both possible and remarkably simple. But is painfully difficult.”<br>
                                                    - Patrick Lencioni
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Info columns -->

                                        <!-- Team list -->
                                        <div class="row">&nbsp;</div>
                                        <?php
                                      
        foreach ($team_list as $team_id => $team) {?>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3"><img src="<?=site_url("assets/sitesfile/image/team/$team->image") ?>" class="img-responsive leadtesti" alt="/"></div>
                                            <div class="col-md-9"> <h3><?=$team->name?></h3>
                                                <p> -  <?=$team->designation?></p>
                                                <?=$team->description?>
                                            </div>
                                        </div> 
                                        <div class="row">&nbsp;</div>
                                        <hr>
                                        <div class="row">&nbsp;</div>
                                       <?php } ?>
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