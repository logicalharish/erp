<?php 
require_once('header.php');

$intUserId = $_REQUEST['user_id'];
if(isset($intUserId) && $intUserId !='')
{	
	/*$arrField = array(
	'user_id','first_name','last_name','email','username','password','(select role_name from role_master where role_master.role_id=user_master.user_role_id) as role_name'
		);*/
	
	$arrUserDetails = $objModel->getRecords(null,'user_id',$intUserId,'user-details');
	$arrUserModules = $objControl->getRecords('user_module_master','user_id',$intUserId,'');
}
$arrAvailableRoles    = $objControl -> getRecords('role_master','is_master_admin','"N"','');
$arrAvailableModules  = $objModel -> getRecords("module_master", null, null,null);
$arrAdminRole = $objControl -> getRecords('role_master','role_name','"Admin"','');
$arrAdmins = $objControl -> getRecords('user_master','user_role_id',$arrAdminRole[0]['role_id'],'');

//$arrUserModules = explode(',', $arrUserModulesData[0]['module_id']);


?>
<div class="row-fluid">
    <div class="box span12">
        <div class="">
            <div class="box-header well" data-original-title>
                <h2><?php echo (isset($_GET['id']))?'Edit '.$arrUserDetails[0]['first_name']." ".$arrUserDetails[0]['last_name'].'\'s details':'New User'; ?></h2>
                	<?php echo (isset($_GET['id']))?'<a href="'.HTTP_PATH.'users/edit" class="btn btn-info add-new">
            											<i class="icon-white icon-plus"></i>  
            											New User  
       												 </a>':''; ?>
					<?php echo (isset($_GET['user_id']))?'<span class="box-header-link add-new"><i class="icon-cog"></i>
														<a href="'.HTTP_PATH.'admin/users-advanced.php?user_id='.$_GET['user_id'].'" 
													    class="" data-rel="tooltip" data-original-title="Manage custom access to individual modules"> Advanced User Settings </a></span>':'';
														?>
                
            </div>
			<form class=".re" id="form" method="post" action="controller/routes.php">
				<input  type="hidden" name="hid_action" id="hid_action" value="create_user"/>
				<input type="hidden" name="http_path" id="http_path" value="users.php"/>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $_REQUEST['user_id']; ?>"/>
				<input type="hidden" name="user_role_id" id="user_role_id" value="<?php echo $arrUserDetails[0]['user_role_id']; ?>"/>
                	<fieldset>
                    	<div class="box-content">                               
                            	<div class="row-fluid tab-pane active" id="userBasic">                      
                                    <div class="control-group">
                                    <label class="control-label">First Name:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['first_name']); ?>" class="input-xlarge focused span4 required" id="first_name" name="first_name" />
                                      </div>
                                    </div>
									<div class="control-group">
                                    <label class="control-label">Last Name:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['last_name']); ?>" class="input-xlarge focused span4 required" id="last_name" name="last_name" />
                                      </div>
                                    </div>
                                    <div class="control-group">
                                    <label class="control-label">Email:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['email']); ?>" class="input-xlarge focused span4 required" id="email" name="email" />
                                      </div>
                                    </div>
                             
                                    <div class="control-group">
                                    <label class="control-label">Username:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['username']); ?>" class="input-xlarge focused span4 required" id="username" name="username" />
                                      </div>
                                    </div>
                                    <div class="control-group">
                                    <label class="control-label">Password:</label>
                                      <div class="controls">
                                        <input type="password"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['password']); ?>" class="input-xlarge focused span4 required" id="password" name="password" />
                                      </div>
                                    </div>
									<div class="control-group">
                                    <label class="control-label">Assign to:</label>
                                      <div class="controls">
                                        <select name="assigned_to" class="input-xlarge focused span4 required" id="assigned_to">
											<option value="<?php echo $_SESSION['user']['user_id']; ?>"><?php echo "Self--".$_SESSION['user']['username']; ?></option>
                                            <?php 	if(isset($_SESSION['user']['user-role']) && $_SESSION['user']['user-role']=='Master-Admin'){
														for($intIndex = 0; $intIndex < count($arrAdmins); $intIndex++)
															{
																echo "<option value='".$arrAdmins[$intIndex]['user_id']."'".($arrUserDetails[0]['assigned_to']==$arrAdmins[$intIndex]['user_id']?'selected':'').">"."Admin-".$arrAdmins[$intIndex]['first_name']." ".$arrAdmins[$intIndex]['last_name']."</option>";
															}
														}
                                            ?>
                                        </select>
                                      </div>
                                    </div>
									<?php if(isset($_SESSION['user']['user-role']) && $_SESSION['user']['user-role']=='Master-Admin'){ ?>
                                    <div class="control-group">
                                    <label class="control-label">User Role:</label>
                                      <div class="controls">
                                        <select name="userRole" class="input-xlarge focused span4 required" id="userRole">
											<option value="">&mdash; Please Select &mdash;</option>
                                            <?php for($intIndex = 0; $intIndex < count($arrAvailableRoles); $intIndex++)
                                                    {
                                            			echo "<option value='".$arrAvailableRoles[$intIndex]['role_id']."'".($arrUserDetails[0]['user_role_id']==$arrAvailableRoles[$intIndex]['role_id']?'selected':'').">".$arrAvailableRoles[$intIndex]['role_name']."</option>";
                                                    }
                                            ?>
                                        </select>
                                      </div>
                                    </div>
									
                                    <div class="control-group">
                                        <label class="control-label">Modules:</label>
                                        <div class="controls">
										
                                        <?php for($intIndex = 0; $intIndex <count($arrAvailableModules); $intIndex++)
										{
										?>
                                          <label class="checkbox inline">
                                          <input type="checkbox" <?php 
											  for($intIndex1 =0; $intIndex1 < count($arrUserModules); $intIndex1++)
												{
													if($arrUserModules[$intIndex1]['module_id']==$arrAvailableModules[$intIndex]['module_id']){echo 'checked'; break;}
												}
										  ?>  id="inlineCheckbox<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>" value="<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>" class="required" name="modules[]"/><?php echo ucfirst($arrAvailableModules[$intIndex]['module_name']); ?>
                                          </label>
										<?php
                                        }
										?>
                                        </div>
							 		</div>
									<?php } ?>
									 <div class="control-group">
										<label class="control-label" for="user_status">Status</label>
										<div class="controls">
											<select class="input-xlarge focused span4 required" id="user_status" name="user_status">
												<option value="">&mdash; Please Select &mdash;</option>
												<option <?php echo (isset($arrUserDetails[0]['user_status']) && $arrUserDetails[0]['user_status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
												<option <?php echo (isset($arrUserDetails[0]['user_status']) && $arrUserDetails[0]['user_status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
											</select>
										</div>
									</div>
                                </div>
                        </div>
                        <div class="form-actions">
                          <input type="submit"  class="btn btn-primary" id="btn-submit" name="btn-submit" value="Save" />
                          <button type="button" class="btn" onclick="javascript:history.go(-1)" >Cancel</button>
                        </div>	
                        
                 	</fieldset>   
                </form>
            </div>
    </div>
</div>


<?php
require_once('footer.php');
?>
<?php
require_once('javascript_methods.php');
?>