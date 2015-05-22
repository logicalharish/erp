<?php
require_once('header.php');
$intUserId = $_REQUEST['user_id'];

$arrField = array('user_id', 'module_id', 'priv_create', 'priv_read', 'priv_update', 'priv_delete');
$arrPrivUserDetails = $objControl->getRecords('privileged_user', 'user_id', $intUserId, 'user_id', $arrField);


$arrAvailablePrivileges = $objControl->getRecords('privileged_user', 'user_id', 1, 'user_id', $arrField);
#$arrAvailablePrivileges = $objModel -> getRecords(null, null, null, 'authorising_user_privileged_modules');
#$arrAvailableModules  = $objModel -> getRecords(null, null, null, 'privileged_user_available_modules');
$arrField = array('*');
$arrAvailableModules = $objControl->getRecords('module_master', null, null, '', $arrField);

//$arrUserModules = explode(',', $arrUserDetails[0]['user_modules']);
//echo '<pre>';print_r($arrAvailablePrivileges);print_r($arrPrivUserDetails);
//echo '</pre>';
?>

<div class="row-fluid">
    <form class="form-horizontal" id="formDetails" method="post" action="controller/routes.php">
		<input type="hidden" name="hid_action" id="hid-action" value="user-advance"/>
		<input type="hidden" name="user_id" id="user_id" value="<?php echo $_REQUEST['user_id']; ?>"/>

        <fieldset>
            <div class="box-content">  
                <div class="row-fluid" id="userAdvanced">
					<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2>You can also grant special permissions to the user for individual modules.</h2>
						</div>
						<div class="box-content">
							<table class="table table-condensed">
								<thead>
									<tr>
										<th>Modules</th>
										<th>Create</th>
										<th>Read</th>
										<th>Update</th>
										<th>Delete</th>                                          
									</tr>
								</thead>   
								<tbody>
									<?php
									for ($intIndex = 0; $intIndex < count($arrAvailableModules); $intIndex++)
									{
										//echo '<pre>';print_r($arrAvailableModules[$intIndex]);exit;
										?>

		  <!--<input type="hidden" value="" name="existing_priv_user" />-->
										<tr>
											<td><?php echo ucfirst($arrAvailableModules[$intIndex]['module_name']); ?>
											</td>
											<td>
												<label class="checkbox inline">
													<input type="checkbox" id="" value="priv_create" name="<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>[]"
													<?php
													for ($intIndex1 = 0; $intIndex1 < count($arrPrivUserDetails); $intIndex1++)
													{
														echo($arrPrivUserDetails[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrPrivUserDetails[$intIndex1]['priv_create'] == 'Y') ? 'checked="checked"' : '';
														echo($arrAvailablePrivileges[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrAvailablePrivileges[$intIndex1]['priv_create'] != 'Y') ? 'disabled="diasbled"' : '';
														//echo $arrAvailablePrivileges[$intIndex1]['priv_create'];
													}
													?>
														   >
												</label>
											</td>
											<td>
												<label class="checkbox inline">
													<input type="checkbox" id="" value="priv_read" name="<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>[]"
													<?php
													for ($intIndex1 = 0; $intIndex1 < count($arrPrivUserDetails); $intIndex1++)
													{
														echo($arrPrivUserDetails[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrPrivUserDetails[$intIndex1]['priv_read'] == 'Y') ? 'checked="checked"' : '';
														echo($arrAvailablePrivileges[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrAvailablePrivileges[$intIndex1]['priv_read'] != 'Y') ? 'disabled="diasbled"' : '';
													}
													?>
														   >
												</label>
											</td>
											<td>
												<label class="checkbox inline">
													<input type="checkbox" id="" value="priv_update" name="<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>[]"
													<?php
													for ($intIndex1 = 0; $intIndex1 < count($arrPrivUserDetails); $intIndex1++)
													{
														echo($arrPrivUserDetails[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrPrivUserDetails[$intIndex1]['priv_update'] == 'Y') ? 'checked="checked"' : '';
														echo($arrAvailablePrivileges[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrAvailablePrivileges[$intIndex1]['priv_update'] != 'Y') ? 'disabled="diasbled"' : '';
													}
													?>
														   >
												</label>
											</td>
											<td>
												<label class="checkbox inline">
													<input type="checkbox" id="" value="priv_delete" name="<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>[]" 
													<?php
													for ($intIndex1 = 0; $intIndex1 < count($arrPrivUserDetails); $intIndex1++)
													{
														echo($arrPrivUserDetails[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrPrivUserDetails[$intIndex1]['priv_delete'] == 'Y') ? 'checked="checked"' : '';
														echo($arrAvailablePrivileges[$intIndex1]['module_id'] == $arrAvailableModules[$intIndex]['module_id'] && $arrAvailablePrivileges[$intIndex1]['priv_delete'] != 'Y') ? 'disabled="diasbled"' : '';
													}
													?>
														   >
												</label>
											</td>                                       
										</tr> 
	<?php
}
?>
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
            <div class="form-actions">
				<input type="submit"  class="btn btn-primary" id="btn-submit" name="btn-submit" value="Save" />
				<button type="reset" class="btn" href="" >Cancel</button>
            </div>	
        </fieldset>   
    </form>
</div>

<?php
require_once('footer.php');
?>