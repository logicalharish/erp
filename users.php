<?php
require_once('header.php');
$arrField = array(
	'user_id','name','email','username','password','(select role_name from role_master where role_master.role_id=user_master.user_role_id) as role_name','user_modules'
	
);
$arrUserDetails = $objControl->getRecords('user_master',null,null,'user_id',$arrField);

?>

<div class="box span12 pull-left">
	
   
                
      
    <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i>Users</h2>
		<?php echo '<a href="users-edit.php" class="btn btn-info add-new pull-right">
            											<i class="icon-white icon-plus"></i>  
            											New User  
       												 </a>';?>
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
                  <th> Permittled Modules</th>
              </tr>
          </thead>   
          <tbody>
          <?php for($intIndex=0; $intIndex<count($arrUserDetails); $intIndex++){ 
		 ?>
		 	<tr>
                <td class="center"><a href="users-edit.php?user_id=<?php echo $arrUserDetails[$intIndex]['user_id']; ?>"><?php echo $arrUserDetails[$intIndex]['name']; ?></a></td>
                <td class="center"><a href="mailto:<?php echo $arrUserDetails[$intIndex]['email']; ?>" target="_blank"><?php echo $arrUserDetails[$intIndex]['email']; ?></a></td>
                <td class="center"><?php echo $arrUserDetails[$intIndex]['username']; ?></td>
                <td class="center"><?php echo $arrUserDetails[$intIndex]['role_name']; ?></td>
                <td class="center"><?php echo $arrUserDetails[$intIndex]['user_modules']; ?></td>
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
