<?php
require_once('header.php');

$intCountryId = $_REQUEST['country_id'];
if(isset($intCountryId) && $intCountryId !='')
{
	$arrData = $objControl->getRecords('country_master','country_id',$intCountryId);
}
?>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Country</a><span class="divider">/</span>
			</li>
			<li>
				Add Country
			</li>
		</ul>
	</div>
	<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create Country</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="form" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="create_country" />
							<input type="hidden" name="country_id" id="country_id" value="<?php echo $intCountryId; ?>" />
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="txt_country">Country Name</label>
								<div class="controls">
								  <input class="input-xlarge focused required" data-trim data-min-chars="3" id="txt_country" name="txt_country" type="text" value="<?php echo (isset($arrData[0]['country_name'])?$arrData[0]['country_name']:''); ?>">
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="sel_status">Status</label>
								<div class="controls">
								  <select class="input-xlarge focused required" id="sel_status" name="sel_status" >
									<option value="">&mdash; Please Select &mdash;</option>
									<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Active' ?'selected="selected"':''); ?> value="Active">Active</option>
									<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status']=='Inactive' ?'selected="selected"':''); ?> value="Inactive">Inactive</option>
                                  </select>
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
<script type="text/javascript">
	$(document).ready(function() {
		
	// Validate when the submit button is clicked
		$('form').submit(function(e) {
			//e.preventDefault();
				var isvalidated=false;
			// From the anchor element find the closest form element
			$(this).closest('form').formvalidate({
				failureMessages: true,
				successMessages: false,
				messageFailureClass: 'label label-important',
				//messageSuccessClass: 'label label-success',
				onSuccess: function(form) {
					isvalidated = true;
					return isvalidated;
				},
				validations: {
					isNot: function(input, params) {
						return $.inArray(input.toLowerCase(), params);
					}
				},
				localization: {
					en: {
						success: {
						
						},
						failure: {
							email: function(title, value, name, input) {
								return 'There is no way that email ' + value + ' is valid.';
							},
							isNot: function(title, value, name, input) {
								return 'That name is not original enough.';
							}
						}
					}
				}
			});
		return isvalidated;
		});
	});
	
</script>
