<?php
require_once('header.php');
$arrField = array('*');
$intPage = $_REQUEST['page_id'];
if (isset($intPageId) && $intPageId != '')
{
	$arrData = $objControl->getRecords('page_master', 'page_id', $intPageId, '', $arrField);
}
$arrField = array('page_id','page_name');
$arrParrentPageOption = $objControl->getRecords('page_master',null,null,'page_name',$arrField);

?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="module.php">Page</a><span class="divider">/</span>
		</li>
		<li>
			Add Page
		</li>
	</ul>
</div>
<div class="row-fluid">		
	<div class="box span12">

		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>Create Page</h2>

		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="controller/routes.php">
				<input type="hidden" name="hid_action" id="hid_action" value="create_page" />
				<input type="hidden" name="page_id" id="page_id" value="<?php echo $_REQUEST['page_id']; ?>" />
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Page Details</a></li>
						<li><a href="#tabs-2">Seo Details</a></li>

					</ul>
					<div id="tabs-1">
						<div class="row-fluid">
							<div class="control-group span6">
								<label class="control-label" for="focusedInput">Page  Name</label>
								<div class="controls">
									<input class="input-xlarge focused" id="page_name" name="page_name" type="text" value="<?php echo (isset($arrData[0]['page_name']) ? $arrData[0]['page_name'] : ''); ?>">
								</div>
							</div>
							<div class="control-group span6">
								<label class="control-label" for="focusedInput">Page  Title</label>
								<div class="controls">
									<input class="input-xlarge focused" id="page-title" name="page_title" type="text" value="<?php echo (isset($arrData[0]['page_title']) ? $arrData[0]['page_title'] : ''); ?>">
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="control-group span6">
								<label class="control-label" for="focusedInput">Page URL</label>
								<div class="controls">
									<input class="input-xlarge focused" id="page_url" name="page_url" type="text" value="<?php echo (isset($arrData[0]['page_url']) ? $arrData[0]['page_url'] : ''); ?>">
								</div>
							</div>
							<div class="control-group span6">
								<label class="control-label" for="focusedInput">Parent Page</label>
								<div class="controls">
									<select name="parent_page" id="parent_page"  class="input-xlarge focused" >
										<?php
										for($intIndex = 0; $intIndex  <count($arrParrentPageOption); $intIndex++)
										{
											echo "<option value='".$arrParrentPageOption[$intIndex]['page_id']."'>".$arrParrentPageOption[$intIndex]['page_name']."</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="control-group span6">
								<label class="control-label" for="focusedInput">Seq No</label>
								<div class="controls">
									<input class="input-xlarge focused" id="seq_no" name="seq_no" type="text" value="<?php echo (isset($arrData[0]['seq_no']) ? $arrData[0]['seq_no'] : ''); ?>">
								</div>
							</div>
							<div class="control-group span6">
								<label class="control-label" for="focusedInput">Show In Menu</label>
								<div class="controls">
									<select class="input-xlarge focused" id="show_in_menu" name="show_in_menu" >
										<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Yes' ? 'selected="selected"' : ''); ?> value="Yes">Yes</option>
										<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'No' ? 'selected="selected"' : ''); ?> value="No">No</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="control-group span12">
								<label class="control-label" for="focusedInput">Page Description</label>
								<div class="controls">
									<textarea class="ckeditor" name="page_description" id="page_description"></textarea>
								</div>
							</div>

						</div>


					</div>
					<div id="tabs-2">
						<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
					</div>

				</div> 
				<fieldset>
					<div class="row-fluid" style="height: 20px"></div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="focusedInput">Status</label>
							<div class="controls">
								<select class="input-xlarge focused" id="sel_status" name="status" >
									<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
									<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
								</select>
							</div>
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
