<?php
require_once('header.php');
?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Nature of Business</a><span class="divider">/</span>
					</li>
					<li>
						Add Nature of Business
					</li>
				</ul>
			</div>
<div class="row-fluid">		
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create Nature of Business</h2>
						
					</div>
						   <div class="box-content">
						<form class="form-horizontal" id="form"method="post" action="#">
                        	<input type="hidden" name="hid_action" id="hid_action" value="create_nob" />
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Nature of Business Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="txt_nob" name="txt_nob" type="text" value="<?php echo (isset($arrData[0]['nob_name'])?$arrData[0]['nob_name']:''); ?>">
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
<script type="text/javascript">
	$("#form").validate({
		debug: false,
		errorClass: "label label-important",
		errorElement: "span",
		rules: {
			txt_nob: {
				required: true,
				minlength: 10
			},
			password: {
				required: true  
			}
		},
		messages: {
			txt_nob: {
				required: "Please enter your username"
			},
			password: {
				required: "Please enter your password"
			}
		},
		highlight: function(element, errorClass) {
			$(element).removeClass(errorClass);
		}
	});
</script>