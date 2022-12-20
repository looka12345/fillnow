<section class="content-body" role="main">
					<header class="page-header">
						<h2>Menu Management</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Menu Management</span></li>
								
							</ol>
					
							<a data-open="sidebar-right" class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a class="fa fa-caret-down" href="#"></a>
							
							</div>

							<h2 class="panel-title">Menu Manage</h2>
							<h4 style="color:green"><?php echo $this->session->flashdata('action_message'); ?></h4>
							<h4 style="color:red"><?php echo $this->session->flashdata('error_message'); ?></h4>
						</header>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="mb-md">
										<a href="<?php echo site_url("catalog/menumanage/add"); ?>" >Add</a> <i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
							<div id="datatable-editable_wrapper" class="dataTables_wrapper no-footer"><div class="row datatables-header form-inline"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable-editable_length"></div></div><div class="col-sm-12 col-md-6"><div id="datatable-editable_filter" class="dataTables_filter"></div></div></div><div class="table-responsive"><table id="datatable-editable" class="table table-bordered table-striped mb-none dataTable no-footer" role="grid" aria-describedby="datatable-editable_info">
								<thead>
									<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Page Name </th><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Parent menu Name</th><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Page Link</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions">Actions</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions">Priority</th></tr>
								</thead>
								<tbody>
									
								  <?php
	
	if(!empty($pairent_menu))
				{
			foreach ($pairent_menu as $value)
		  	{
		  		$child_manu =$this->FM->getMenuDataNew($value->menu_id);
		  		
				//print_r($child_manu);
				#$childelements= elements($value->menu_id,$child_manu); 
				#$childelements=$childelements[$value->menu_id];
				#$totalctild=count($childelements);
								
				if(!empty($child_manu))
				{
					?>
				       <tr>

        	
            <td style="font-weight:600; color:#006600;"><?php echo $value->menu_title ?>&nbsp;(Parent)</td>
            <td><?php ?></td>
            <td><?php echo $value->menu_url ?></td>
         <td>  <?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',0)" title="status" />
											<?php } ?>
											<a class="on-default edit-row" href="<?php echo site_url("catalog/menumanage/edit")."/".$value->menu_id 	; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row" onclick="recordAddToTrace(this,'<?php echo $value->menu_id 	 ?>','menu','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a>
</td><td>
<input type="text"  id="priority<?php echo $value->menu_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->menu_id ?>',<?php echo $value->menu_id ?>,'menu')"  value="Update" />	
</td>
        </tr>		
                 <?php
                ?>
                 
                <div class="submenu">
                    <ul>
                    <?php
					foreach ($child_manu as $value)
		  			{
		  				$sub_child_manu =$this->FM->getMenuDataNew($value->menu_id);
						//$value=$value[0];
				
                    ?>
                     <tr>
                       
                        <td  ><?php echo $value->menu_title ?></td>
                        <td  ><?php echo $value->parentmenu ?></td>
                        <td ><?php echo $value->menu_url ?></td>
                    <td>   <?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',0)" title="status" />
											<?php } ?>
											<a class="on-default edit-row" href="<?php echo site_url("catalog/menumanage/edit")."/".$value->menu_id 	; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row" onclick="recordAddToTrace(this,'<?php echo $value->menu_id 	 ?>','menu','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a>
</td><td>
	<input type="text"  id="priority<?php echo $value->menu_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->menu_id ?>',<?php echo $value->menu_id ?>,'menu')"  value="Update" />	
</td>
                    </tr>
                    <?php
					foreach ($sub_child_manu as $value)
		  			{
				
                    ?>
                     <tr>
                       
                        <td  ><?php echo $value->menu_title ?></td>
                        <td  ><?php echo $value->parentmenu ?></td>
                        <td ><?php echo $value->menu_url ?></td>
                    <td>   <?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',0)" title="status" />
											<?php } ?>
											<a class="on-default edit-row" href="<?php echo site_url("catalog/menumanage/edit")."/".$value->menu_id 	; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row" onclick="recordAddToTrace(this,'<?php echo $value->menu_id 	 ?>','menu','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a>
</td><td>
	<input type="text"  id="priority<?php echo $value->menu_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->menu_id ?>',<?php echo $value->menu_id ?>,'menu')"  value="Update" />	
</td>
                    </tr>
                    
                    <?php
					}
                    ?> 
                    
                    <?php
					}
                    ?> 
                    </ul>
                </div>
          <?php
					}
					else
					{
					?>
                   <tr>
        	
           <td style="font-weight:600; color:#006600;"><?php echo $value->menu_title ?>&nbsp;(Parent)</td>
            <td><?php ?></td>
            <td><?php echo $value->menu_url ?></td>
        <td>  <?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->menu_id; ?>,'menu',0)" title="status" />
											<?php } ?>
											<a class="on-default edit-row" href="<?php echo site_url("catalog/menumanage/edit")."/".$value->menu_id 	; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row" onclick="recordAddToTrace(this,'<?php echo $value->menu_id 	 ?>','menu','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a></td><td>
<input type="text"  id="priority<?php echo $value->menu_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->menu_id ?>',<?php echo $value->menu_id ?>,'menu')"  value="Update" />	
</td>
            
        </tr>		
                    <?php	
						
					}
				}
				 } else { ?>
									<tr><td colspan="4">No Data Found</td></tr>
									<?php } ?>
									
									
									</tbody>
							</table></div><div class="row datatables-footer"><div class="col-sm-12 col-md-6">
 
</div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_bs_normal" id="datatable-editable_paginate"><!--<li class="prev disabled"><a href="#"><span class="fa fa-chevron-left"></span></a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#"><span class="fa fa-chevron-right"></span></a></li>--></div></div></div></div>
						</div>
					</section>
					<!-- end: page -->
				</section>