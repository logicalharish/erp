
<?php 
require_once('header.php');
$arrField = array('*');
$arrCategoryRecords = $objControl->getRecords('category_master', null, null, '', $arrField);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="6 new members." class="well span3 top-block" href="#">
					<span class="icon32 icon-red icon-user"></span>
					<div>Total Members</div>
					<div>507</div>
					<span class="notification">6</span>
				</a>

				<a data-rel="tooltip" title="4 new pro members." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-star-on"></span>
					<div>Pro Members</div>
					<div>228</div>
					<span class="notification green">4</span>
				</a>

				<a data-rel="tooltip" title="$34 new sales." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Sales</div>
					<div>$13320</div>
					<span class="notification yellow">$34</span>
				</a>
				
				<a data-rel="tooltip" title="12 new messages." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-envelope-closed"></span>
					<div>Messages</div>
					<div>25</div>
					<span class="notification red">12</span>
				</a>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Form Elements</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" style="box-shadow:5px">
							<fieldset>
							  <!--<div class="control-group">
								<label class="control-label" for="appendedInputButton">Append with button</label>
								<div class="controls">
								  <div class="input-append">
									<input id="appendedInputButton" size="16" type="text"><button class="btn" type="button">Go!</button>
								  </div>
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="selectError">Category</label>
								<div class="controls">
								  <select data-placeholder="Category" id="selectError" data-rel="chosen">
									<?php
										for ($intIndex = 0; $intIndex < count($arrCategoryRecords); $intIndex++)
										{
											echo "<option value='" . $arrCategoryRecords[$intIndex]['category_id']."'";
											//print_r (in_array('category_id',in_array(,$arrCompanyCategoryData)));
											//print_r($arrCompanyCategoryData);
											//echo in_array($arrCategoryRecords[$intIndex]['category_id'],$arrCompanyCategoryData['category_id'])?"selected":"";
											/* if(in_array($arrCompanyCategoryData['company_id'],$arrCategoryRecords[$intIndex]['category_id'])){
														echo 'selected';
													 }*/
											//echo in_array($arrCompanyCategoryData, $a);
											for ($intIndex1 = 0; $intIndex1 < count($arrCompanyCategoryData); $intIndex1++){
													 if($arrCategoryRecords[$intIndex]['category_id']==$arrCompanyCategoryData[$intIndex1]['category_id']){
														echo 'selected';
													 }
											}
										echo ">".$arrCategoryRecords[$intIndex]['category_name'] . "</option>";
										}
									?>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Search</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						</form>
					</div>
				</div><!--/span-->

			</div><!--/row-->
       
<?php include('footer.php'); ?>
