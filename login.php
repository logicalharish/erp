<?php
$no_visible_elements=true;
include('header.php'); ?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2><img alt="Global Gujarat" src="img/logo.png" /></h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					 <?php
					if(isset($_POST['login']))
					{
						$objControl -> login();
					}
					else
					{
					?>
						<div class="alert alert-info">
							Please login with your Username and Password.
						</div>
					<?php
					}
					?>
					<form class="form-horizontal loginForm" method="post" style="display:block;">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="l_username" id="l_username" type="text"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="l_password" id="l_password" type="password"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
								<button type="submit" class="btn btn-primary" name="login">Login</button>
							</p>
							<p class="center span5">
								<a id="regiLink" href="#">New User ? Register with us.</a>
							</p>
						</fieldset>
					</form>
					<form class="form-horizontal registrationFrom" id="form" action="controller/routes.php" method="post" style="display:none;" >
						<input type="hidden" name="hid_action" id="hid_action" value="create_user"/>
						<input type="hidden" name="http_path" id="http_path" value="login.php"/>
						<fieldset>
							<div class="input-prepend" title="Firstname" data-rel="tooltip">
								<span class="add-on"><i class="icon-pencil"></i></span><input class="input-large span10 required" autofocus name="first_name" id="first_name" type="text" value="" placeholder="Enter Your Firstname"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Lastname" data-rel="tooltip">
								<span class="add-on"><i class="icon-pencil"></i></span><input class="input-large span10 required" name="last_name" id="last_name" type="text" value="" placeholder="Enter Your Lastname"/>
							</div>
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="E-mail" data-rel="tooltip">
								<span class="add-on"><i class="icon-envelope"></i></span><input class="input-large span10 required" name="email" id="email" type="text" value="" placeholder="Enter Your E-mail"/>
							</div>
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input class="input-large span10 required" name="username" id="username" type="text" value="" placeholder="Enter Your Username"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10 required" name="password" id="password" type="password" value="" placeholder="Enter Your Password"/>
							</div>
							<div class="clearfix"></div>
							<p class="center span5">
								<button type="submit" class="btn btn-primary" name="btn-submit" id="btnRegister" value="Save">Submit</button>
								<button type="button" class="btn" onclick="javascript:history.go(-1)" >Cancel</button>
							</p>
							<p class="center span5">
								<a id="loginLink" href="#">Existing User ? Login here.</a>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
<?php
require_once('javascript_methods.php');
?>