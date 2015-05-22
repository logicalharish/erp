<?php
require_once('header.php');
?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Designation</a><span class="divider">/</span>
					</li>
					<li>
						Add Designation
					</li>
				</ul>
			</div>
<div class="row-fluid">		
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create Designation</h2>
						
					</div>
						   <div class="box-content">
						<form class="form-horizontal" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="create_designation" />
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Designation Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="txt_designation" name="txt_designation" type="text" value="<?php echo (isset($arrData[0]['designation_name'])?$arrData[0]['designation_name']:''); ?>">
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Status</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="sel_status" name="sel_status" >
                                  <option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Active' ?'selected="selected"':''); ?> value="Active">Active</option>
                                  <option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Inactive' ?'selected="selected"':''); ?> value="Inactive">Inactive</option>
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
