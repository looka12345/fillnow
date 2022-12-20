<section class="content-body" role="main">
					<header class="page-header">
						<h2>Admin Page Management</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Admin Page Management</span></li>
								
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

							<h2 class="panel-title">Admin Page Management</h2>
							<h4 style="color:green"><?php echo $this->session->flashdata('action_message'); ?></h4>
							<h4 style="color:red"><?php echo $this->session->flashdata('error_message'); ?></h4>
						</header>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="mb-md">
										<a href="<?php echo site_url('catalog/pagemanage/add');?>" >Add</a> <i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
							<div id="datatable-editable_wrapper" class="dataTables_wrapper no-footer"><div class="table-responsive"><table id="datatable-editable" class="table table-bordered table-striped mb-none dataTable no-footer" role="grid" aria-describedby="datatable-editable_info">
								<thead>
									<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Page Title</th><th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 271px;" aria-label="Browser: activate to sort column ascending">Parent</th><th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 244px;" aria-label="Platform(s): activate to sort column ascending">Page URL</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions">Actions</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions">Priority</th></tr>
								</thead>
								<tbody>
    <?php
			foreach ($menup as $value)
		  	{
				$childelements= elements($value->admin_page_id,$menuch); 
				$childelements=$childelements[$value->admin_page_id];
				$totalctild=count($childelements);
				
				if(!empty($childelements))
				{
					?>
				       <tr>
        	
            <td style="font-weight:600; color:#006600;"><?php echo $value->admin_page ?>&nbsp;(Parent)</td>
            <td><?php ?></td>
            <td><?php echo $value->page_url ?></td>
           <td>	<?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->admin_page_id; ?>,'admin_page',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->admin_page_id; ?>,'admin_page',0)" title="status" />
											<?php } ?>	<a class="on-default edit-row" href="<?php echo site_url('catalog/pagemanage/edit')."/".$value->admin_page_id; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row ask"   onclick="recordAddToTrace(this,'<?php echo $value->admin_page_id ?>','admin_page','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a></td><td><input type="text"  id="priority<?php echo $value->admin_page_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->admin_page_id ?>',<?php echo $value->admin_page_id ?>,'admin_page')"  value="Update" /></td>
        </tr>		
                 <?php
                ?>
                 
                <div class="submenu">
                    <ul>
                    <?php
					foreach ($childelements as $value)
		  			{
                    ?>
                     <tr>
                      
                        <td  ><?php echo $value->admin_page ?></td>
                        <td ><?php echo $value->parentpage ?></td>
                        <td ><?php echo $value->page_url ?></td>
                       <td>	<?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->admin_page_id; ?>,'admin_page',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->admin_page_id; ?>,'admin_page',0)" title="status" />
											<?php } ?>	<a class="on-default edit-row" href="<?php echo site_url('catalog/pagemanage/edit')."/".$value->admin_page_id; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row ask"   onclick="recordAddToTrace(this,'<?php echo $value->admin_page_id ?>','admin_page','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a></td><td><input type="text"  id="priority<?php echo $value->admin_page_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->admin_page_id ?>',<?php echo $value->admin_page_id ?>,'admin_page')"  value="Update" />	</td>
                     
                    </tr>
                    
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
        
           <td style="font-weight:600; color:#006600;"><?php echo $value->admin_page ?>&nbsp;(Parent)</td>
            <td><?php ?></td>
            <td><?php echo $value->page_url ?></td>
            <td>	<?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->admin_page_id; ?>,'admin_page',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->admin_page_id; ?>,'admin_page',0)" title="status" />
											<?php } ?>	<a class="on-default edit-row" href="<?php echo site_url('catalog/pagemanage/edit')."/".$value->admin_page_id; ?>"><i class="fa fa-pencil"></i></a>
											<a lass="on-default remove-row ask"   onclick="recordAddToTrace(this,'<?php echo $value->admin_page_id ?>','admin_page','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a>
</td><td>
<input type="text"  id="priority<?php echo $value->admin_page_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->admin_page_id ?>',<?php echo $value->admin_page_id ?>,'admin_page')"  value="Update" />	
</td>
        </tr>		
                    <?php	
						
					}
				}
			
			
			?>      
        
    </tbody>
							</table></div></div>
						</div>
					</section>
					<!-- end: page -->
				</section>