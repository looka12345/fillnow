<?php


/**
 * plantyourtree
 *
 * A website backend system for developers for PHP 4.3.2 or newer
 *
 * @package         plantyourtree
 * @author          Cyber Worx Technologies Private Limited
 * @copyright       Copyright (c) 2013
 * @filesource
 */

// ---------------------------------------------------------------------------

/**
 *  Header Menu Admin Application
 *
 *  This view include in All page After Login Process.

 *
 * @package         plantyourtree
 * @subpackage      view Parts
 */

?>




<ul>
    <li><a class="current" href="index.html">Admin Home </a></li>
 				 <?php
			foreach ($menup as $value)
		  	{
				$childelements= elements($value->admin_page_id,$menuch); 
				$childelements=$childelements[$value->admin_page_id];
				$totalctild=count($childelements);
				
				if(!empty($childelements))
				{
					?>
				        <li> <a href="<?=site_url("catalog/".$value->page_url)?>"><?=$value->admin_page?></a>		
                 <?php
                ?>
                 
           
                    <ul>
                    <?php
					foreach ($childelements as $value)
		  			{
                    ?>
                    <li><a href="<?=site_url("catalog/".$value->page_url)?>"><?=$value->admin_page?></a></li>
                    
                    <?php
					}
                    ?> 
                    </ul>
               
          <?php
					}
					else
					{
					?>
                       <li><a class="" href="<?=site_url("catalog/".$value->page_url)?>"><?=$value->admin_page?></a></li>
                    <?php	
						
					}
				}
			
			
			?>      

 
 
 </ul>