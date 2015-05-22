<?php
require_once('header.php');
$arrField = array('module_id', 'module_name', 'module_menu_link', 'module_menu_icon', 'status');
$intModuleId = $_REQUEST['module_id'];
if (isset($intModuleId) && $intModuleId != '')
{
	$arrData = $objControl->getRecords('module_master', 'module_id', $intModuleId, '', $arrField);
}
?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="module.php">Module</a><span class="divider">/</span>
		</li>
		<li>
			Add Module
		</li>
	</ul>
</div>
<div class="row-fluid">		
	<div class="box span12">

		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>Create Module</h2>

		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="controller/routes.php">
				<input type="hidden" name="hid_action" id="hid_action" value="create_module" />
				<input type="hidden" name="module_id" id="module_id" value="<?php echo $_REQUEST['module_id']; ?>" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Module  Name</label>
						<div class="controls">
							<input class="input-xlarge focused" id="module_name" name="module_name" type="text" value="<?php echo (isset($arrData[0]['module_name']) ? $arrData[0]['module_name'] : ''); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Module  Menu Link</label>
						<div class="controls">
							<input class="input-xlarge focused" id="module_menu_link" name="module_menu_link" type="text" value="<?php echo (isset($arrData[0]['module_name']) ? $arrData[0]['module_name'] : ''); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Status</label>
						<div class="controls">
							<select class="input-xlarge focused" id="sel_status" name="status" >
								<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
								<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
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
