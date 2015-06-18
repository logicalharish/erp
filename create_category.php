<?php
require_once('header.php');
$arrField = array('*');
$intPageId = $_REQUEST['category_id'];
if (isset($intPageId) && $intPageId != '')
{
	$arrData = $objControl->getRecords('category_master', 'category_id', $intPageId, '', $arrField);
}
	$arrField = array('category_id', 'category_name');
	$arrCategoryOption = $objControl->getRecords('category_master', null, null, 'category_name', $arrField);
	if($arrData[0]['parent_category_id']==0){
		$parentCategoryId=$arrData[0]['category_id'];
	}else{
		$parentCategoryId=$arrData[0]['parent_category_id'];
	}
	
?>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Category</a><span class="divider">/</span>
			</li>
			<li>
				Add Category
			</li>
		</ul>
	</div>
	<div class="row-fluid">		
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create Category</h2>
					</div>
						   <div class="box-content">
						<form class="form-horizontal" id="form" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="create_category" />
							<input type="hidden" name="category_id" id="category_id" value="<?php echo $intPageId; ?>" />
							<fieldset>
							 <div class="control-group">
								<label class="control-label" for="parent_category_id">Parent Category</label>
								<div class="controls">
									<select name="parent_category_id" id="parent_category_id"  class="input-xlarge focused span4 required" >
										<option value="">&mdash; Please Select &mdash;</option>
										<option value="none">NO PARENT</option>
										<?php
											for ($intIndex = 0; $intIndex < count($arrCategoryOption); $intIndex++)
											{
												echo "<option value='" . $arrCategoryOption[$intIndex]['category_id'] . "' ".($arrCategoryOption[$intIndex]['category_id']==$parentCategoryId?'selected':'').">" . $arrCategoryOption[$intIndex]['category_name'] . "</option>";
											}
										?>
									</select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="txt_category">Category Name</label>
								<div class="controls">
								  <input class="input-xlarge focused span4 required" id="txt_category" name="txt_category" type="text" value="<?php echo (isset($arrData[0]['category_name'])?$arrData[0]['category_name']:''); ?>">
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="sel_status">Status</label>
								<div class="controls">
								  <select class="input-xlarge focused span4 required" id="sel_status" name="sel_status" >
								  <option value="">&mdash; Please Select &mdash;</option>
                                  <option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Active' ?'selected="selected"':''); ?> value="Active">Active</option>
                                  <option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Inactive' ?'selected="selected"':''); ?> value="Inactive">Inactive</option>
                                  </select>
								</div>
							  </div>
							  
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button type="button" class="btn" onclick="javascript:history.go(-1)">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>         
					
				</div><!--/span-->
                </div>
<?php
require_once('footer.php');
?>
<?php
require_once('javascript_methods.php');
?>