<?php
require_once('header.php');

$intRoleId = $_REQUEST['role_id'];
if(isset($intRoleId) && $intRoleId !='')
{
	$arrData = $objControl->getRecords('role_master','role_id',$intRoleId);
}
?>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Role</a><span class="divider">/</span>
			</li>
			<li>
				Add Role
			</li>
		</ul>
	</div>
	<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create Role</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="form" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="create_role" />
							<input type="hidden" name="role_id" id="role_id" value="<?php echo $intRoleId; ?>" />
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="role_name">Role Name</label>
								<div class="controls">
								  <input class="input-xlarge focused required" id="txt_role" name="txt_role" type="text" value="<?php echo (isset($arrData[0]['role_name'])?$arrData[0]['role_name']:''); ?>">
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="sel_status">Status</label>
								<div class="controls">
								  <select class="input-xlarge focused required" id="status" name="status" >
									<option value="">&mdash; Please Select &mdash;</option>
									<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Active' ?'selected="selected"':''); ?> value="Active">Active</option>
									<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Inactive' ?'selected="selected"':''); ?> value="Inactive">Inactive</option>
                                  </select>
								</div>
							  </div>
							  
							  <div class="form-actions">
								<button type="submit" id="submit" class="btn btn-primary">Save changes</button>
								<button class="btn" type="reset" >Cancel</button>
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