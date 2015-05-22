<?php
#require_once('header.php');
?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Import Company</a><span class="divider">/</span>
					</li>
					<li>
						Import Company
					</li>
				</ul>
			</div>
<div class="row-fluid">		
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Import Company</h2>
						
					</div>
						   <div class="box-content">
						<form class="form-horizontal" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="import_company" />
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">CSV File</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="txt_file" name="txt_file" type="file" value="">
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
#require_once('footer.php');
?>
