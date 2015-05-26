<?php
require_once('header.php');
$arrField = array('*');
$arrRecords = $objControl->getRecords('category_master', null, null, '', $arrField);
?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Category</a>
					</li>
					
				</ul>
			</div>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Category</h2>
						<div class="pull-right">
							<a href="create_category.php" class="btn btn-info add-new">
            <i class="icon-white icon-plus"></i>  
         Add New
        </a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Category Name</th>
								  <th>Parent Category</th>
								  <th>Status</th>
								  <th>Created Date</th>
								  <th>Modified Date</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  for($intIndex =0; $intIndex < count($arrRecords); $intIndex++)
						  {
						  	?>

							<tr>
								<td><?php echo $arrRecords[$intIndex]['category_name'];?></td>
								<td><?php for($intIndex1 =0; $intIndex1 < count($arrRecords); $intIndex1++)
												{
													if($arrRecords[$intIndex1]['category_id']==$arrRecords[$intIndex]['parent_category_id'])
													{
														echo $arrRecords[$intIndex1]['category_name'];break;
													}else if($intIndex1 == count($arrRecords)-1){
														echo $arrRecords[$intIndex]['category_name'];
													}
												}
									?>
								</td>
								<td class="center">
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
								<td width="20%"><?php echo $arrRecords[$intIndex]['created_datetime'];?></td>
								<td >
									<?php echo $arrRecords[$intIndex]['modified_datetime'];?>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="create_category.php?category_id=<?php echo $arrRecords[$intIndex]['category_id'];?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn <?php echo $btn; ?>" href="controller/routes.php?hid_action=update_status&id=<?php echo $arrRecords[$intIndex]['category_id']; ?>&status=<?php echo $arrRecords[$intIndex]['status']; ?>&table_name=category_master&column_name=category_id&page_url=category.php">
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
                </div>
			
<?php
require_once('footer.php');
?>
