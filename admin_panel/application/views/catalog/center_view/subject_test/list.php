<section class="content-body" role="main">
					<header class="page-header">
						<h2>Subject Test Management</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo site_url("catalog"); ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Subject Test Management</span></li>
								
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

							<h2 class="panel-title">Subject Test Management</h2>
							<h4 style="color:green"><?php echo $this->session->flashdata('action_message'); ?></h4>
							<h4 style="color:red"><?php echo $this->session->flashdata('error_message'); ?></h4>
						</header>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="mb-md">
										<a href="<?php echo site_url("catalog/subject_test/add"); ?>" >Add</a> <i class="fa fa-plus"></i>
									</div>
								</div>
							</div>
							<div id="datatable-editable_wrapper" class="dataTables_wrapper no-footer"><div class="row datatables-header form-inline"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable-editable_length"></div></div><div class="col-sm-12 col-md-6"><div id="datatable-editable_filter" class="dataTables_filter"><form id="SearchForm" method="post"><label><input type="search" class="form-control" name="searchact" placeholder="Name" value="<?php echo $searchsubject_test; ?>" aria-controls="datatable-editable"></label><label><input type="button"  onclick='javascript:searchload( "<?php echo site_url("catalog/subject_test"); ?>")'  style="  background: none repeat scroll 0 0 #491e03;color: #fff;width:50%;margin-left:25%;"  value="Search" /></label></form></div></div></div><div class="table-responsive"><table id="datatable-editable" class="table table-bordered table-striped mb-none dataTable no-footer" role="grid" aria-describedby="datatable-editable_info">
								<thead>
									<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Name</th><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Image</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions">Actions</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions">Priority</th></tr>
								</thead>
								<tbody>
									
									<?php 
				
					if(isset($subject_test_arr) && !empty($subject_test_arr)) { ?>
									<?php foreach($subject_test_arr as $value) { ?>
										<tr  role="row">
										<td class="sorting_1"><?php echo ucfirst($value->name); ?></td>
										<td class="sorting_1"><?php if(isset($value->image) && !empty($value->image)) { ?> <img src="<?php echo site_url("../assets/sitesfile/image/subject_test")."/".$value->image;?>" height="100" width="100" /><?php } ?></td>

										<td class="actions">
											<?php if($value->active_status==1){ ?>
											<img src="<?php echo site_url("assets/images/icons")."/active.png"; ?>" onclick="changeStatus(<?php echo $value->subject_test_id; ?>,'subject_test',1)" title="status" />
											<?php }else{ ?> 
										   	<img src="<?php echo site_url("assets/images/icons")."/deactive.png"; ?>" onclick="changeStatus(<?php echo $value->subject_test_id; ?>,'subject_test',0)" title="status" />
											<?php } ?>
											<a class="on-default edit-row" href="<?php echo site_url("catalog/subject_test/edit")."/".$value->subject_test_id 	; ?>"><i class="fa fa-pencil"></i></a>
											<a class="on-default remove-row" onclick="recordAddToTrace(this,'<?php echo $value->subject_test_id 	 ?>','subject_test','<?php echo $value->delete_status?>','1')"><i class="fa fa-trash-o"></i></a>
							</td><td>	<input type="text"  id="priority<?php echo $value->subject_test_id ?>" size="1" value="<?=$value->priority?>" />
							<input type="button" id="save" onclick="setpriority('priority<?php echo $value->subject_test_id ?>',<?php echo $value->subject_test_id ?>,'subject_test')"  value="Update" />			</td>
									</tr>
									<?php } } else { ?>
									<tr><td colspan="5">No Data Found</td></tr>
									<?php } ?>
									
									
									</tbody>
							</table></div><div class="row datatables-footer"><div class="col-sm-12 col-md-6">
 
</div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_bs_normal" id="datatable-editable_paginate"><ul class="pagination"> <?php echo $pagination_helper->create_links(); ?> </ul><div class="dataTables_info" id="datatable-editable_info" role="status" aria-live="polite"><?php  echo $this->pagination->cur_page.'/'.$this->pagination->total_rows;?></div></div></div></div></div>
						</div>
					</section>
					<!-- end: page -->
				</section>