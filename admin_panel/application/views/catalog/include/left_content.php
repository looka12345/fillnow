<!-- start: sidebar -->

<aside id="sidebar-left" class="sidebar-left">
  <div class="sidebar-header">
    <div class="sidebar-title"> Navigation </div>
    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle"> <i class="fa fa-bars" aria-label="Toggle sidebar"></i> </div>
  </div>
  <div class="nano">
    <div class="nano-content">
      <nav id="menu" class="nav-main" role="navigation">
        <ul class="nav nav-main">
          <li class="nav-active"> <a href="<?php echo site_url("admin/welcome"); ?>"> <i class="fa fa-home" aria-hidden="true"></i> <span>Dashboard</span> </a> </li>
          
          <!--hhhhhhhhhhhhhhhhhhh-->
          
          <?php
            foreach ($menup as $value)
            {
                $childelements= elements($value->admin_page_id,$menuch); 
                $childelements=$childelements[$value->admin_page_id];
                $totalctild=count($childelements);
                
                if(!empty($childelements))
                {
                    ?>
          <li class="nav-parent"> <a> <i class="fa <?=$value->icon_class ?>" aria-hidden="true"></i> <span>
            <?=$value->admin_page?>
            </span> </a>
            <ul class="nav nav-children">
              <?php
            foreach ($childelements as $value)
            {
                ?>
              <li> <a href="<?=site_url("catalog/".$value->page_url)?>">
                <?=$value->admin_page?>
                </a> </li>
              <?php
                }
                ?>
            </ul>
          </li>
          <?php
            }
            else
            {
                ?>
          <li class="nav-parent"> <a href="<?=site_url("admin/".$value->page_url)?>" > <i class="fa fa-copy" aria-hidden="true"></i> <span>
            <?=$value->admin_page?>
            </span> </a> </li>
          <?php	
								
            }
        }
        
        
        ?>
        </ul>
      </nav>
      <hr class="separator" />
      
      <!--<div class="sidebar-widget widget-tasks">
								<div class="widget-header">
									<h6>Projects</h6>
									<div class="widget-toggle">+</div>
								</div>
								<div class="widget-content">
									<ul class="list-unstyled m-none">
										<li><a href="#">Porto HTML5 Template</a></li>
										<li><a href="#">Tucson Template</a></li>
										<li><a href="#">Porto Admin</a></li>
									</ul>
								</div>
							</div>-->
      
      <hr class="separator" />
      
      <!--<div class="sidebar-widget widget-stats">
								<div class="widget-header">
									<h6>Company Stats</h6>
									<div class="widget-toggle">+</div>
								</div>
								<div class="widget-content">
									<ul>
										<li>
											<span class="stats-title">Stat 1</span>
											<span class="stats-complete">85%</span>
											<div class="progress">
												<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
													<span class="sr-only">85% Complete</span>
												</div>
											</div>
										</li>
										<li>
											<span class="stats-title">Stat 2</span>
											<span class="stats-complete">70%</span>
											<div class="progress">
												<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
													<span class="sr-only">70% Complete</span>
												</div>
											</div>
										</li>
										<li>
											<span class="stats-title">Stat 3</span>
											<span class="stats-complete">2%</span>
											<div class="progress">
												<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
													<span class="sr-only">2% Complete</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>--> 
    </div>
  </div>
</aside>