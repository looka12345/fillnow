<div id="page-preloader"><div class="loader-wrap"><span class="loader02"></span></div></div>
<div class="header-search open-search">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                <div class="navbar-search">
                    <form class="search-global">
                        <input type="text" placeholder="Type to search" autocomplete="off" name="s" value="" class="search-global__input"/>
                        <button class="search-global__btn"><i class="icon fa fa-search"></i></button>
                        <div class="search-global__note">Begin typing your search above and press return to search.</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="search-close close"><i class="fa fa-times"></i></button>
</div>
<header class="header-transparent wow slideInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <div class="b-logo">
                    <a href="<?=site_url("")?>">
                        <span class="logo-title">
                            <img src="<?=site_url("assets/sitesfile/image/siteconfig/$site_info->logo")?>" alt="Synergy">
                        </span>
                    </a>
                </div>
                <button class="menu-mobile-button visible-xs-block js-toggle-mobile-slidebar toggle-menu-button"><i class="toggle-menu-button-icon"><span></span><span></span><span></span><span></span><span></span><span></span></i></button>
            </div>
            <div class="hidden-xs col-sm-9 col-md-6 col-lg-6">
                <div class="header-navibox-2">
                    <nav id="nav" class="navbar">
                        <ul class="yamm main-menu nav navbar-nav hidden-xs">
                            <?=$menuhtml?>
    </ul>
</nav>
</div>
</div>
<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
<div class="b-socials">
<ul class="list-inline">
    <li>
        <a href="http://www.synergyteletech.com/customer_login.html" target="_blank" class="btn btn-secondary4" tabindex="0">Customer Login</a>
    </li>
    <li>
        <a href="http://www.synergyteletech.com/intranet_login.html" target="_blank" class="btn btn-secondary4" tabindex="0">Intranet Login</a>
    </li>
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
    <li class="search-toogle">
        <a href="#" class="btn_header_search">
            <i class="fa fa-search fa-fw" aria-hidden="true"></i>
        </a>
    </li>
</ul>
</div>
</div>
</div>
</div>
</header>