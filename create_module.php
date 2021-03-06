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
			<form class="form-horizontal" id="form" method="post" action="controller/routes.php">
				<input type="hidden" name="hid_action" id="hid_action" value="create_module" />
				<input type="hidden" name="module_id" id="module_id" value="<?php echo $_REQUEST['module_id']; ?>" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="module_name">Module  Name</label>
						<div class="controls">
							<input class="input-xlarge focused span4 required" id="module_name" name="module_name" type="text" value="<?php echo (isset($arrData[0]['module_name']) ? $arrData[0]['module_name'] : ''); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="module_menu_link">Module  Menu Link</label>
						<div class="controls">
							<input class="input-xlarge focused span4 required" id="module_menu_link" name="module_menu_link" type="text" value="<?php echo (isset($arrData[0]['module_menu_link']) ? $arrData[0]['module_menu_link'] : ''); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Module Menu Icon</label>
							<div class="controls">
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-home" ? 'checked' : ''); ?> value="icon-home"  class="required" title="Module  Menu Icon"> <i class='icon-home'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-list" ? 'checked' : ''); ?> value="icon-list"> <i class='icon-list'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-eye-open" ? 'checked' : ''); ?> value="icon-eye-open"> <i class="icon-eye-open"></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-edit" ? 'checked' : ''); ?> value="icon-edit"> <i class='icon-edit'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-user" ? 'checked' : ''); ?> value="icon-user"> <i class='icon-user'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-cog" ? 'checked' : ''); ?> value="icon-cog"> <i class='icon-cog'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-star" ? 'checked' : ''); ?> value="icon-star"> <i class='icon-star'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-film" ? 'checked' : ''); ?> value="icon-film"> <i class='icon-film'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-tag" ? 'checked' : ''); ?> value="icon-tag"> <i class='icon-tag'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-file" ? 'checked' : ''); ?> value="icon-file" > <i class='icon-file'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-pencil" ? 'checked' : ''); ?> value="icon-pencil" > <i class='icon-pencil'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-globe" ? 'checked' : ''); ?> value="icon-globe"> <i class='icon-globe'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-list-alt" ? 'checked' : ''); ?> value="icon-list-alt" > <i class='icon-list-alt'></i></label>
								<label class="radio inline"><input type="radio" name="module_menu_icon" <?php echo (isset($arrData[0]['module_menu_icon']) && $arrData[0]['module_menu_icon']=="icon-map-marker" ? 'checked' : ''); ?> value="icon-map-marker" > <i class='icon-map-marker'></i></label>
							</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="status">Status</label>
						<div class="controls">
							<select class="input-xlarge focused span4 required" id="status" name="status" >
							<option value="">&mdash; Please Select &mdash;</option>
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
<?php
require_once('javascript_methods.php');
?>