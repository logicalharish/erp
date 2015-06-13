<?php
require_once('header.php');

	$arrData = $objControl->getRecords('user_master','user_id',$_SESSION['user']['user_id'],'');
?>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="index.php">Home</a> <span class="divider">/</span>
			</li>
			<li>
				Profile
			</li>
		</ul>
	</div>
	<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Profile</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="form" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="change_pwd" />
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="txt_country">Name</label>
								<div class="controls">
								  <input class="input-xlarge focused required" disabled id="" name="" type="text" value="<?php echo (isset($arrData[0]['first_name'])?$arrData[0]['first_name']." ".$arrData[0]['last_name']:''); ?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="txt_country">New Password</label>
								<div class="controls">
								  <input class="input-xlarge focused required" id="newPwd" name="newPwd" type="password" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="txt_country">Conform Password</label>
								<div class="controls">
								  <input class="input-xlarge focused required" id="conformPwd" name="conformPwd" type="password" value="">
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