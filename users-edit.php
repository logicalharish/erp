<?php 
require_once('header.php');

$intUserId = $_REQUEST['user_id'];
if(isset($intUserId) && $intUserId !='')
{	
	$arrField = array(
	'user_id','name','email','username','password','(select role_name from role_master where role_master.role_id=user_master.user_role_id) as role_name','user_modules'
	
		);
	$arrUserDetails = $objControl->getRecords('user_master','user_id',$intUserId,'user_id',$arrField);
}
$arrAvailableRoles    = $objModel -> getRecords(null, null, null, 'user-edit-available-roles');
$arrAvailableModules  = $objModel -> getRecords(null, null, null, 'user-edit-available-modules');
$arrUserModules = explode(',', $arrUserDetails[0]['user_modules']);


?>
<div class="row-fluid">
    <div class="box span12">
        <div class="">
            <div class="box-header well" data-original-title>
                <h2><?php echo (isset($_GET['id']))?'Edit '.$arrUserDetails[0]['name'].'\'s details':'New User'; ?></h2>
                	<?php echo (isset($_GET['id']))?'<a href="'.HTTP_PATH.'users/edit" class="btn btn-info add-new">
            											<i class="icon-white icon-plus"></i>  
            											New User  
       												 </a>':''; ?>
					<?php echo (isset($_GET['user_id']))?'<span class="box-header-link add-new"><i class="icon-cog"></i>
														<a href="'.HTTP_PATH.'admin/users-advanced.php?user_id='.$_GET['user_id'].'" 
													    class="" data-rel="tooltip" data-original-title="Manage custom access to individual modules"> Advanced User Settings </a></span>':'';
														?>
                
            </div>
			<form class="form-horizontal" id="formDetails" method="post" action="controller/routes.php">
				<input  type="hidden" name="hid_action" id="hid_action" value="create_user"/>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $_REQUEST['user_id']; ?>"/>
                	<fieldset>
                    	<div class="box-content">                               
                            	<div class="row-fluid tab-pane active" id="userBasic">                      
                                    <div class="control-group">
                                    <label class="control-label">Name:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['name']); ?>" class="span4 typeahead name" id="name" name="name" />
                                      </div>
                                    </div>
                                    <div class="control-group">
                                    <label class="control-label">Email:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['email']); ?>" class="span4 typeahead email" id="email" name="email" />
                                      </div>
                                    </div>
                             
                                    <div class="control-group">
                                    <label class="control-label">Username:</label>
                                      <div class="controls">
                                        <input type="text"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['username']); ?>" class="span4 typeahead username" id="username" name="username" />
                                      </div>
                                    </div>
                                    <div class="control-group">
                                    <label class="control-label">Password:</label>
                                      <div class="controls">
                                        <input type="password"  value="<?php $objModel ->retainRecords('text', $arrUserDetails[0]['password']); ?>" class="span4 typeahead password" id="password" name="password" />
                                      </div>
                                    </div>
                                    <div class="control-group">
                                    <label class="control-label">User Role:</label>
                                      <div class="controls">
                                        <select name="userRole" class="userRole" id="userRole">
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
                                          <input type="checkbox" <?php echo(in_array($arrAvailableModules[$intIndex]['module_id'], $arrUserModules))?'checked':'';?>  id="inlineCheckbox<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>" value="<?php echo $arrAvailableModules[$intIndex]['module_id']; ?>" name="modules[]"><?php echo ucfirst($arrAvailableModules[$intIndex]['module_name']); ?>
                                          </label>
										<?php
                                        }
										?>
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
