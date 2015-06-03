<?php
require_once('header.php');
$arrField = array('*');
$arrRecords = $objControl->getRecords('branch_master', null, null, '', $arrField);
?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="#">State</a>
		</li>

	</ul>
</div>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-eye-open"></i>State</h2>
			<div class="pull-right">
				<a href="create_State.php" class="btn btn-info add-new">
					<i class="icon-white icon-plus"></i>  
					Add New
				</a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th style="width: 20%">State Name</th>
						<th style="width: 5%">Status</th>
						<th style="width: 10%">Created Date</th>
						<th style="width: 15%">Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php
					for ($intIndex = 0; $intIndex < count($arrRecords); $intIndex++)
					{
						?>
						<tr>
							<td><?php echo $arrRecords[$intIndex]['branch_name']; ?></td>
							
							<td class="center" >
								<?php
									
									if($arrRecords[$intIndex]['status']=='Active')
									{
										$strClass = 'label-success';
										$newStatus = 'Inactive';
										$btn='btn-danger';
									}
									else{
										$strClass = ' label-warning';
										$newStatus = 'Active';
										$btn='btn-success';
									}
								?>
								<span class="label <?php echo $strClass;?>"><?php echo $arrRecords[$intIndex]['status']; ?></span>
							</td>
							<td class="center"><?php echo $arrRecords[$intIndex]['created_datetime']; ?></td>


							<td class="center">

								<a class="btn btn-info" href="create_state.php?branch_id=<?php echo $arrRecords[$intIndex]['branch_id']; ?>">
									<i class="icon-edit icon-white"></i>  
									Edit                                            
								</a>
								
								<a class="btn <?php echo $btn; ?>" href="controller/routes.php?hid_action=update_status&id=<?php echo $arrRecords[$intIndex]['branch_id']; ?>&status=<?php echo $arrRecords[$intIndex]['status']; ?>&table_name=branch_master&column_name=branch_id&page_url=state.php">
									<i class="icon-trash icon-white"></i> 
									<?php echo $newStatus; ?>
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
