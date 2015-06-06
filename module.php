<?php
require_once('header.php');
$arrField = array('module_id', 'module_name', 'module_menu_link', 'module_menu_icon', 'status');
$arrRecords = $objControl->getRecords('module_master', null, null, '', $arrField);
?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="#">Module</a>
		</li>

	</ul>
</div>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-cog"></i> Module</h2>
			<div class="pull-right">
				<a href="create_module.php" class="btn btn-info add-new">
					<i class="icon-white icon-plus"></i>  
					Add New
				</a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Module Name</th>
						<th>Module link</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php
					for ($intIndex = 0; $intIndex < count($arrRecords); $intIndex++)
					{
						?>
						<tr>
							<td><?php echo $arrRecords[$intIndex]['module_name']; ?></td>
							<td><?php echo $arrRecords[$intIndex]['module_menu_link']; ?></td>
							<td class="center" >
                            <?php
									
									if($arrRecords[$intIndex]['status']=='Active')
									{
										$strClass = 'label-success';
									}
									else{
										$strClass = ' label-warning';
									}
								?>
								<span class="label <?php echo $strClass;?>"><?php echo $arrRecords[$intIndex]['status']; ?></span>
							</td>
							<td class="center"><?php echo $arrRecords[$intIndex]['created_datetime']; ?></td>


							<td class="center">

								<a class="btn btn-info" href="create_module.php?module_id=<?php echo $arrRecords[$intIndex]['module_id']; ?>">
									<i class="icon-edit icon-white"></i>  
									Edit                                            
								</a>
								<a class="btn btn-danger" href="controller/routes.php?hid_action=update_status&id=<?php echo $arrRecords[$intIndex]['module_id']; ?>&status=<?php echo $arrRecords[$intIndex]['status']; ?>&table_name=module_master&column_name=module_id&page_url=module.php" >
									<i class="icon-trash icon-white"></i> 
									Inactive
								</a>
							</td>
						</tr>
						<?php
					}
					?>


				</tbody>
			</table>            
		</div>
	</div><!--/span-->

	<?php
	require_once('footer.php');
	?>
