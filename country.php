<?php
require_once('header.php');

$arrRecords = $objControl->getRecords('country_master','','','modified_datetime');

?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Country</a>
					</li>
					
				</ul>
			</div>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Country</h2>
						<div class="pull-right">
							<a href="create_country.php" class="btn btn-info add-new">
            <i class="icon-white icon-plus"></i>  
         Add New
        </a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Country Name</th>
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
								<td><?php echo $arrRecords[$intIndex]['country_name'];?></td>
								<td class="center"><?php echo ($arrRecords[$intIndex]['status']=='Active'?'<span class="label label-success">Active</span>':'<span class="label label-important">Inactive</span>');?></td>
								<td width="20%"><?php echo $arrRecords[$intIndex]['created_datetime'];?></td>
								<td >
									<?php echo $arrRecords[$intIndex]['modified_datetime'];?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
									<a class="btn btn-info" href="create_country.php?country_id=<?php echo $arrRecords[$intIndex]['country_id'];?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										Delete
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
