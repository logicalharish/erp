<?php
require_once('header.php');
$arrField = array('*');
$intPageId = $_REQUEST['branch_id'];
if (isset($intPageId) && $intPageId != '')
{
	$arrData = $objControl->getRecords('branch_master', 'branch_id', $intPageId, '', $arrField);
}
$arrField = array('country_id', 'country_name');
$arrCountryOption = $objControl->getRecords('country_master', null, null, 'country_name', $arrField);

?>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="index.php">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="state.php">State</a><span class="divider">/</span>
			</li>
			<li>
				Add State
			</li>
		</ul>
	</div>
	<div class="row-fluid">		
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Create State</h2>
						
					</div>
						   <div class="box-content">
						<form class="form-horizontal" id="form" method="post" action="controller/routes.php">
                        	<input type="hidden" name="hid_action" id="hid_action" value="create_state" />
							<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $intPageId; ?>" />
							<fieldset>
							 <div class="control-group">
								<label class="control-label" for="country_id">Country Name</label>
								<div class="controls">
									<select name="country_id" id="country_id"  class="input-xlarge focused required" >
										<option value="">&mdash; Please Select &mdash;</option>
										<?php
										for ($intIndex = 0; $intIndex < count($arrCountryOption); $intIndex++)
										{
											echo "<option value='" . $arrCountryOption[$intIndex]['country_id'] . "' ".($arrCountryOption[$intIndex]['country_id']==$arrData[0]['country_id']?'selected':'').">" . $arrCountryOption[$intIndex]['country_name'] . "</option>";
										}
										?>
									</select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="txt_state">State Name</label>
								<div class="controls">
								  <input class="input-xlarge focused required" data-trim data-min-chars="3" id="txt_state" name="txt_state" type="text" value="<?php echo (isset($arrData[0]['branch_name'])?$arrData[0]['branch_name']:''); ?>">
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
							
						}
					}
				}
			});
		return isvalidated;
		});
	});
	
</script>
