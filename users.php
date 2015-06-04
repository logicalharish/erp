<?php
require_once('header.php');
$arrField = array(
	'user_id','name','email','username','password','(select role_name from role_master where role_master.role_id=user_master.user_role_id) as role_name','user_modules'
	
);
//$arrUserDetails = $objControl->getRecords('user_master',null,null,'user_id',$arrField);
$arrUserDetails = $objModel->getRecords(null,null,null,'user');
//$arrAvailableRoles    = $objModel -> getRecords(null, null, null, 'role_master');
$arrAvailableModules  = $objModel -> getRecords(user_module_master, null, null, null);
//$arrUserModules = explode(',', $arrUserDetails[0]['user_modules']);

?>

<div class="box span12 pull-left">
	
   
                
      
    <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Users</h2>
		<a href="users-edit.php" class="btn btn-info add-new pull-right">
            											<i class="icon-white icon-plus"></i>  
            											New User  
       												 </a>
    </div>
	 
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>User Role</th>
                 <!-- <th>Phone</th>-->
                  <th> Permitted Modules</th>
              </tr>
          </thead>   
          <tbody>
          <?php for($intIndex=0; $intIndex<count($arrUserDetails); $intIndex++){ 
		 ?>
		 	<tr>
                <td class="center"><a href="users-edit.php?user_id=<?php echo $arrUserDetails[$intIndex]['user_id']; ?>"><?php echo $arrUserDetails[$intIndex]['name']; ?></a></td>
                <td class="center"><a href="mailto:<?php echo $arrUserDetails[$intIndex]['email']; ?>" target="_blank"><?php echo $arrUserDetails[$intIndex]['email']; ?></a></td>
                <td class="center"><?php echo $arrUserDetails[$intIndex]['username']; ?></td>
                <td class="center"><?php /*for($intIndex = 0; $intIndex<count($arrAvailableRoles); $intIndex++)
                                                    {
														echo ($arrUserDetails[0]['user_role_id']==$arrAvailableRoles[$intIndex]['role_id'])? $arrAvailableRoles[$intIndex]['role_name'].',':'' ;
                                                    }*/
													echo $arrUserDetails[$intIndex]['role_name'];
									?>
				</td>
                <td class="center">
				<?php 
					$arrModuleRecords = $objControl->getRecords('user_module_master', 'user_id', $arrUserDetails[$intIndex]['user_id'], '');
					 for($intIndex1 =0; $intIndex1 < count($arrModuleRecords); $intIndex1++)
							{
								$arrUserModuleRecords = $objControl->getRecords('module_master', 'module_id', $arrModuleRecords[$intIndex1]['module_id'], '');
									echo ucfirst($arrUserModuleRecords[0]['module_name'].', ');
							}
				?>
				</td>
            </tr>
		 <?php
		  }?>
            
          </tbody>
      </table>            
    </div>
</div>
<?php
require_once('footer.php');
?>
