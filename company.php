<?php
require_once('header.php');
$arrField = array('*');

	if($_SESSION['user']['user-role']=='Master-Admin'){
		$arrRecords = $objControl->getRecords('company_master', null, null, '', $arrField);
	}else if($_SESSION['user']['user-role']=='Admin'){
		$arrRecords = $objControl->getRecords('company_master', 'assigned_to', $_SESSION['user']['user_id'], '');
	}else{
		$arrRecords = $objControl->getRecords('company_master', 'user_id', $_SESSION['user']['user_id'],'');
	}

?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Company</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Company</h2>
						<div class="pull-right">
							<a href="create_company.php" class="btn btn-info add-new">
            <i class="icon-white icon-plus"></i>  
         Add New
        </a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Company Name</th>
								  <th>Address</th>
								  <th>Status</th>
								  <th>Category</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  for($intIndex =0; $intIndex < count($arrRecords); $intIndex++)
						  {
						  	?>
							<tr>
								<td><?php echo $arrRecords[$intIndex]['full_name'];?></td>
								<td><?php 	$arrCityRecords = $objControl->getRecords('city_master', 'city_id', $arrRecords[$intIndex]['city_id'], '');
											$arrStateRecords = $objControl->getRecords('branch_master', 'branch_id', $arrRecords[$intIndex]['state_id'], '');
											$arrCountryRecords = $objControl->getRecords('country_master', 'country_id', $arrRecords[$intIndex]['country_id'], '');
									echo $arrCityRecords[0]['city_name'].' ,'.$arrStateRecords[0]['branch_name'].' ,'.$arrCountryRecords[0]['country_name'];?></td>
								<td class="center" width="20%"><?php
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
								<td><?php $arrCCRecords = $objControl->getRecords('company_category', 'company_id', $arrRecords[$intIndex]['company_id'], '');
										
										 for($intIndex1 =0; $intIndex1 < count($arrCCRecords); $intIndex1++)
												{
													$arrCategoryRecords = $objControl->getRecords('category_master', 'category_id', $arrCCRecords[$intIndex1]['category_id'], '');
														echo $arrCategoryRecords[0]['category_name'].',<br/>';
												}
									?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>-->
									<a class="btn btn-info" href="create_company.php?company_id=<?php echo $arrRecords[$intIndex]['company_id'];?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="controller/routes.php?hid_action=update_status&id=<?php echo $arrRecords[$intIndex]['company_id']; ?>&status=<?php echo $arrRecords[$intIndex]['status']; ?>&table_name=company_master&column_name=company_id&page_url=company.php">
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
