<footer>
    <div class="b-footer-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a href="index.php" class="footer-logo">
                        <img src="<?=site_url("assets/media/general/logo-final-ft.jpg")?>" alt="Logo">
                    </a>
                    <p class="copy">
                        <?=$site_info->site_description?>
                    </p>
                </div>
                <div class="col-xs-4 col-sm-2 col-md-2">
                    <div class="b-footer-box">
                        <h5 class="footer-box-title">
                        Links
                        </h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">Privacy</a>
                            </li>
                            <li>
                                <a href="#">Terms</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="b-footer-box">
                        <h5 class="footer-box-title">
                        Contact Us
                        </h5>
                        <p class="con">
                            <?=$social_info->phone1?>
                        </p>
                        <p class="footer-mail">
                            <?=$social_info->email1?>
                        </p>
                        <div class="b-socials">
                            <ul class="list-inline">
                                <li>
                                    <a href="<?=$social_info->facebook?>">
                                        <i class="fa fa-facebook fa-fw" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=$social_info->twitter?>">
                                        <i class="fa fa-twitter fa-fw" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=$social_info->linkedin?>">
                                        <i class="fa fa-linkedin fa-fw" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=$social_info->google?>">
                                        <i class="fa fa-google-plus fa-fw" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-3 col-md-4">
                    <div class="b-footer-box">
                        <h5 class="footer-box-title">
                        Download the app
                        </h5>
                        <ul class="list-unstyled">
                            <li style="float:left; padding-right:10px;"> <a href="#" tabindex="0"><img src="<?=site_url("assets/media/buttons/app-store-google.png")?>" ></a></li>
                            <li> <a href="#" tabindex="0"><img src="<?=site_url("assets/media/buttons/app-store-apple.png")?>"></a> </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h5></h5>
                </div>
            </div>
        </div>
    </div>
</footer>