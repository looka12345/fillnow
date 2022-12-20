<section class="content-body" role="main">

					<header class="page-header">

						<h2>Social Media Management</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="<?php echo site_url("catalog"); ?>">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span>Social Media Management</span></li>

								

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



							<h2 class="panel-title">Social Media Management</h2>

						</header>

						<div class="panel-body">

							

							<div id="datatable-editable_wrapper" class="dataTables_wrapper no-footer"><div class="row datatables-header form-inline"></div><div class="table-responsive"><table id="datatable-editable" class="table table-bordered table-striped mb-none dataTable no-footer" role="grid" aria-describedby="datatable-editable_info">

								<thead>

									<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 205px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">Facebook</th><th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 271px;" aria-label="Browser: activate to sort column ascending">Email1</th><th class="sorting" tabindex="0" aria-controls="datatable-editable" rowspan="1" colspan="1" style="width: 244px;" aria-label="Platform(s): activate to sort column ascending">Email2</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 98px;" aria-label="Actions"><?php echo $heading_action; ?></th></tr>

								</thead>

								<tbody>

				

				<?php if(isset($socialmedia_data) && !empty($socialmedia_data)){ ?>

				<?php foreach($socialmedia_data as $value){ ?>

				

				<tr class="gradeA even" role="row">

										<td class="sorting_1"><?php echo $value->facebook; ?></td>

										<td><?php echo $value->email1 ; ?></td>

										<td><?php echo $value->email2; ?></td>

										<td class="actions">

											

											<a class="on-default edit-row" href="<?php echo site_url('catalog/socialmediamanage/edit'); ?>"><i class="fa fa-pencil"></i></a>

											

										</td>

									</tr>

			

				<?php 

				} ?>

				<?php } ?>

			</tbody>

							</table></div><div class="row datatables-footer"></div></div>

						</div>

					</section>

					<!-- end: page -->

				</section>