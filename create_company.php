<?php
require_once('header.php');
$arrField = array('*');
$intCompanyId = $_REQUEST['company_id'];
if (isset($intCompanyId) && $intCompanyId != '')
{
	$arrData = $objControl->getRecords('company_master', 'company_id', $intCompanyId, '', $arrField);
	$arrCompanyProfileData = $objControl->getRecords('company_profile', 'company_id', $intCompanyId, '', $arrField);
	$arrCompanyContactData = $objControl->getRecords('company_contact', 'company_id', $intCompanyId, '', $arrField);
	$arrCompanyAdvertiseData = $objControl->getRecords('company_advertise', 'company_id', $intCompanyId, '', $arrField);
	$arrCompanyProductData = $objControl->getRecords('company_product', 'company_id', $intCompanyId, '', $arrField);
	$arrCompanyCategoryData = $objControl->getRecords('company_category', 'company_id', $intCompanyId, '', $arrField);
}
$arrStateRecords = $objControl->getRecords('branch_master', null, null, '', $arrField);
$arrCountryRecords = $objControl->getRecords('country_master', null, null, '', $arrField);
$arrCityRecords = $objControl->getRecords('city_master', null, null, '', $arrField);
$arrCategoryRecords = $objControl->getRecords('category_master', null, null, '', $arrField);
if($_SESSION['user']['user-role']=='Master-Admin'){
	$arrUserRecords = $objControl->getRecords('user_master', null, null, '', $arrField);
}elseif($_SESSION['user']['user-role']=='Admin'){
	$arrUserRecords = $objControl->getRecords('user_master', 'assigned_to', $_SESSION['user']['user_id'], '');
}

?>

<div>
  <ul class="breadcrumb">
    <li> <a href="index.php">Home</a> <span class="divider">/</span> </li>
    <li> <a href="company.php">Company</a><span class="divider">/</span> </li>
    <li> Add Company </li>
  </ul>
</div>
<div class="row-fluid">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Create Company</h2>
    </div>
    <div class="box-content">
      <form class="form-horizontal" id="form" method="post" action="controller/routes.php" enctype="multipart/form-data">
        <input type="hidden" name="hid_action" id="hid_action" value="create_company" />
		<input type="hidden" name="company_id" id="company_id" value="<?php echo $intCompanyId; ?>" />
        <input type="hidden" name="company_profile_id" id="company_profile_id" value="<?php echo (isset($arrCompanyProfileData[0]['company_profile_id']) ? $arrCompanyProfileData[0]['company_profile_id'] : ''); ?>" />
		<input type="hidden" name="company_advertise_id" id="company_advertise_id" value="<?php echo (isset($arrCompanyAdvertiseData[0]['company_advertise_id']) ? $arrCompanyAdvertiseData[0]['company_advertise_id'] : ''); ?>" />
		<input type="hidden" name="company_product_id" id="company_product_id" value="<?php echo (isset($arrCompanyProductData[0]['company_product_id']) ? $arrCompanyProductData[0]['company_product_id'] : ''); ?>" />
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Basic Details</a></li>
            <li><a href="#tabs-2">Company Profile</a></li>
            <li><a href="#tabs-3">Company Contact</a></li>
            <li><a href="#tabs-4">Company Advertise</a></li>
			<li><a href="#tabs-5">Product</a></li>
          </ul>
          <div id="tabs-1">
		  <?php if($_SESSION['user']['user-role']=='Master-Admin' || $_SESSION['user']['user-role']=='Admin'){ ?>
		  <div class="row-fluid">
			<div class="control-group span6">
                <label class="control-label" for="user_id">User</label>
                <div class="controls">
					<select name="user_id" id="user_id"  class="input-xlarge focused required" >
						<option value="">&mdash; Please Select &mdash;</option>
						<?php
							for ($intIndex = 0; $intIndex < count($arrUserRecords); $intIndex++)
							{
								echo "<option value='" . $arrUserRecords[$intIndex]['user_id'] . "' ".($arrUserRecords[$intIndex]['user_id']==$arrData[0]['user_id']?'selected':'').">" . $arrUserRecords[$intIndex]['first_name']." ".$arrUserRecords[$intIndex]['last_name']."</option>";
							}
						?>
					</select>
                </div>
              </div>
			</div>	
		  <?php } ?>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="full_name">Full Name</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="full_name" maxlength="100" name="full_name" type="text" value="<?php echo (isset($arrData[0]['full_name']) ? $arrData[0]['full_name'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="short_name">Short Name</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="short_name" maxlength="23" name="short_name" type="text" value="<?php echo (isset($arrData[0]['short_name']) ? $arrData[0]['short_name'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="est_date">Establish Date</label>
                <div class="controls">
                  <input class="input-xlarge datepicker required" id="est_date" maxlength="128" name="est_date" type="text" value="<?php echo (isset($arrData[0]['est_date']) ? $arrData[0]['est_date'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="category_id">Category</label>
                <div class="controls">
					<select multiple data-rel="chosen" name="category_id[]" id="category_id"  class="input-xlarge focused required" style="width: 70%">
						<?php
							for ($intIndex = 0; $intIndex < count($arrCategoryRecords); $intIndex++)
							{
								echo "<option value='" . $arrCategoryRecords[$intIndex]['category_id']."'";
								//print_r (in_array('category_id',in_array(,$arrCompanyCategoryData)));
								//print_r($arrCompanyCategoryData);
								//echo in_array($arrCategoryRecords[$intIndex]['category_id'],$arrCompanyCategoryData['category_id'])?"selected":"";
								/* if(in_array($arrCompanyCategoryData['company_id'],$arrCategoryRecords[$intIndex]['category_id'])){
											echo 'selected';
										 }*/
								//echo in_array($arrCompanyCategoryData, $a);
								/*array_filter($arrCompanyCategoryData,function ($ac) {
																 if(array_key_exists('category_id', $ac) && $ac['category_id'] == $arrCategoryRecords[$intIndex]['category_id']){
																	 echo 'selected';
																 }
															}
											);*/
								for ($intIndex1 = 0; $intIndex1 < count($arrCompanyCategoryData); $intIndex1++){
										 if($arrCategoryRecords[$intIndex]['category_id']==$arrCompanyCategoryData[$intIndex1]['category_id']){
											echo 'selected';
										 }
								}
							echo ">".$arrCategoryRecords[$intIndex]['category_name'] . "</option>";
							}
						?>
					</select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="street">Street</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="street" name="street" type="text" value="<?php echo (isset($arrData[0]['street']) ? $arrData[0]['street'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="landmark">Landmark</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="landmark" name="landmark" type="text" value="<?php echo (isset($arrData[0]['landmark']) ? $arrData[0]['landmark'] : ''); ?>">
                </div>
              </div>
            </div>
			 <div class="row-fluid">
			  <div class="control-group span6">
                <label class="control-label" for="building">Building</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="building" name="building" type="text" value="<?php echo (isset($arrData[0]['building']) ? $arrData[0]['building'] : ''); ?>">
                </div>
              </div>
			  <div class="control-group span6">
                <label class="control-label" for="city_id">City</label>
                <div class="controls">
					<select name="city_id" id="city_id"  class="input-xlarge focused required" >
						<option value="">&mdash; Please Select &mdash;</option>
						<?php
							for ($intIndex = 0; $intIndex < count($arrCityRecords); $intIndex++)
							{
								echo "<option value='" . $arrCityRecords[$intIndex]['city_id'] . "' ".($arrCityRecords[$intIndex]['city_id']==$arrData[0]['city_id']?'selected':'').">" . $arrCityRecords[$intIndex]['city_name'] . "</option>";
							}
						?>
					</select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              
              <div class="control-group span6">
                <label class="control-label" for="state_id">State</label>
                <div class="controls">
					<select name="state_id" id="state_id"  class="input-xlarge focused required" >
					<option value="">&mdash; Please Select &mdash;</option>
						<?php
							for ($intIndex = 0; $intIndex < count($arrStateRecords); $intIndex++)
							{
								echo "<option value='" . $arrStateRecords[$intIndex]['branch_id'] . "' ".($arrStateRecords[$intIndex]['branch_id']==$arrData[0]['state_id']?'selected':'').">" . $arrStateRecords[$intIndex]['branch_name'] . "</option>";
							}
						?>
					</select>
                </div>
              </div>
			  <div class="control-group span6">
                <label class="control-label" for="country_id">Country</label>
                <div class="controls">
                  <select name="country_id" id="country_id"  class="input-xlarge focused required" >
				  <option value="">&mdash; Please Select &mdash;</option>
						<?php
							for ($intIndex = 0; $intIndex < count($arrCountryRecords); $intIndex++)
							{
								echo "<option value='" . $arrCountryRecords[$intIndex]['country_id'] . "' ".($arrCountryRecords[$intIndex]['country_id']==$arrData[0]['country_id']?'selected':'').">" . $arrCountryRecords[$intIndex]['country_name'] . "</option>";
							}
						?>
					</select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="area">Area</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="area" name="area" type="text" value="<?php echo (isset($arrData[0]['area']) ? $arrData[0]['area'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="pincode">Pin code</label>
                <div class="controls">
                  <input class="input-xlarge focused required" maxlength="9" id="pincode" name="pincode" type="text" value="<?php echo (isset($arrData[0]['pincode']) ? $arrData[0]['pincode'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="latitude">Latitude</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="latitude" name="latitude" type="text" value="<?php echo (isset($arrData[0]['latitude']) ? $arrData[0]['latitude'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="longitute">Longitude</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="longitute" name="longitute" type="text" value="<?php echo (isset($arrData[0]['longitute']) ? $arrData[0]['longitute'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="nob">Nature of Bussiness</label>
					<div class="controls">
					  <input class="input-xlarge focused required" id="nob" name="nob" type="text" value="<?php echo (isset($arrData[0]['nob']) ? $arrData[0]['nob'] : ''); ?>">
					</div>
				 </div>
				<div class="control-group span6">
                <label class="control-label" for="status">Status</label>
                <div class="controls">
					<select class="input-xlarge focused required" id="status" name="status" >
					<option value="">&mdash; Please Select &mdash;</option>
						<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
						<option <?php echo (isset($arrData[0]['status']) && $arrData[0]['status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
					</select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="turn_over">Turn Over</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="turn_over" name="turn_over" type="text" value="<?php echo (isset($arrData[0]['turn_over']) ? $arrData[0]['turn_over'] : ''); ?>">
                </div>
              </div>
			  <?php if($_SESSION['user']['user-role']=='Master-Admin'){ ?>
              <div class="control-group span6">
                <label class="control-label">Is Verified</label>
                <div class="controls">
                  <input type="checkbox" name="is_verified" id="is_verified" value="Yes" <?php echo ($arrData[0]['is_verified']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
			<?php } ?>
            </div>
            <div class="row-fluid">
              <div class="control-group span4">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="email" name="email" type="text" value="<?php echo (isset($arrData[0]['email']) ? $arrData[0]['email'] : ''); ?>">
                </div>
              </div>
			  <?php if($_SESSION['user']['user-role']=='Master-Admin'){ ?>
              <div class="control-group span4">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="email_dis" id="email_dis" value="yes" <?php echo ($arrData[0]['email_dis']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
              <div class="control-group span2">
                <label class="control-label" for="focusedInput">Don't Provide email</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" id="email_dnd" name="email_dnd" value="yes" <?php echo ($arrData[0]['email_dnd']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
			  <?php } ?>
            </div>
            <div class="row-fluid">
              <div class="control-group span4">
                <label class="control-label" for="website">Website</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="website" name="website" type="text" value="<?php echo (isset($arrData[0]['website']) ? $arrData[0]['website'] : ''); ?>">
                </div>
              </div>
			  <?php if($_SESSION['user']['user-role']=='Master-Admin'){ ?>
              <div class="control-group span4">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="website_dis" id="website_dis" value="yes" <?php echo ($arrData[0]['website_dis']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
              <div class="control-group span2">
                <label class="control-label" for="focusedInput">Don't Provide Website</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="website_dnd" id="website_dnd" value="yes" <?php echo ($arrData[0]['website_dnd']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
			  <?php } ?>
            </div>
            <div class="row-fluid">
              <div class="control-group span4">
                <label class="control-label" for="mobile">Mobile</label>
                <div class="controls">
                  <input class="input-xlarge focused required" data-int data-min-chars="10" maxlength="10" id="mobile" name="mobile" type="text" value="<?php echo (isset($arrData[0]['mobile']) ? $arrData[0]['mobile'] : ''); ?>">
                </div>
              </div>
			  <?php if($_SESSION['user']['user-role']=='Master-Admin'){ ?>
              <div class="control-group span4">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="mobile_dis" id="mobile_dis" value="yes" <?php echo ($arrData[0]['mobile_dis']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
              <div class="control-group span2">
                <label class="control-label" for="focusedInput">Don't Provide Mobile</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="mobile_dnd" id="mobile_dnd" value="yes" <?php echo ($arrData[0]['mobile_dnd']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
			  <?php } ?>
            </div>
            <div class="row-fluid">
              <div class="control-group span4">
                <label class="control-label" for="landline">Landline</label>
                <div class="controls">
                  <input class="input-xlarge focused required" data-int data-min-chars="8" maxlength="15" id="landline" name="landline" type="tel" value="<?php echo (isset($arrData[0]['landline']) ? $arrData[0]['landline'] : ''); ?>">
                </div>
              </div>
			  <?php if($_SESSION['user']['user-role']=='Master-Admin'){ ?>
              <div class="control-group span4">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="landline_dis" id="landline_dis" value="yes" <?php echo ($arrData[0]['landline_dis']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
              <div class="control-group span2">
                <label class="control-label" for="focusedInput">Don't Provide Landline</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="landline_dnd" id="landline_dnd" value="yes" <?php echo ($arrData[0]['landline_dnd']=='Yes'?"checked='checked'":"")?>>
                </div>
              </div>
			  <?php } ?>
            </div>
          </div>
          <div id="tabs-2">
            <div class="row-fluid">
              <div class="control-group span12">
                <label class="control-label" for="company_description">Company Description</label>
                <div class="controls">
                  <textarea class="ckeditor required" name="company_description" id="company_description"><?php echo (isset($arrCompanyProfileData[0]['company_description']) ? $arrCompanyProfileData[0]['company_description'] : ''); ?></textarea>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span12">
                <label class="control-label" for="sunday_from">Hours of Operation</label>
                <div class="controls">
				 <?php isset($arrCompanyProfileData[0]['hours_of_operation']) ? $operationValue=$arrCompanyProfileData[0]['hours_of_operation'] : '';
							$optionsHours = @explode(',', $operationValue);
						//print_r($optionsHours);
					?>
                  <table class="table table-striped table-bordered">
                    <tbody>
                      <tr>
                        <td><h3>Day</h3></td>
                        <td><h3>From</h3></td>
                        <td><h3>To</h3></td>
                        <td><h3>Close</h3></td>
                      </tr>
                      <tr>
                        <td>Sunday</td>
                        <td><select name="sunday_from" id="sunday_from" class="input-small focused required">
							<option value="">&mdash; Please Select &mdash;</option>
                            <option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=01:00"){echo "selected"; }}} ?>>01:00</option>
                            <option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
                            <option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
                            <option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
                            <option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
                            <option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
                            <option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
                            <option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
                            <option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
                            <option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
                            <option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
                            <option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
                            <option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
                            <option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
                            <option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
                            <option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
                            <option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
                            <option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
                            <option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
                            <option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
                            <option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
                            <option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
                            <option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
                            <option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                          </select>
						</td>
                        <td><select name="sunday_to" class="input-small focused required">
							<option value="">&mdash; Please Select &mdash;</option>
                            <option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=01:00"){echo "selected"; }}} ?>>01:00</option>
                            <option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
                            <option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
                            <option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
                            <option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
                            <option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
                            <option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
                            <option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
                            <option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
                            <option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
                            <option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
                            <option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
                            <option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
                            <option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
                            <option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
                            <option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
                            <option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
                            <option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
                            <option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
                            <option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
                            <option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
                            <option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
                            <option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
                            <option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
                          </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="sunday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="sunday_closed=Yes"){echo "checked='checked'"; }}} ?>/></td>
                      </tr>
                      <tr>
                        <td>Monday</td>
                        <td><select name="monday_from" class="input-small focused required">
							<option value="">&mdash; Please Select &mdash;</option>
							<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=01:00"){echo "selected"; }}} ?>>01:00</option>
                            <option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
                            <option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
                            <option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
                            <option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
                            <option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
                            <option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
                            <option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
                            <option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
                            <option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
                            <option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
                            <option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
                            <option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
                            <option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
                            <option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
                            <option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
                            <option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
                            <option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
                            <option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
                            <option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
                            <option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
                            <option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
                            <option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
                            <option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><select name="monday_to" class="input-small focused required">
							<option value="">&mdash; Please Select &mdash;</option>
							<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=01:00"){echo "selected"; }}} ?>>01:00</option>
                            <option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
                            <option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
                            <option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
                            <option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
                            <option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
                            <option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
                            <option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
                            <option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
                            <option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
                            <option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
                            <option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
                            <option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
                            <option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
                            <option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
                            <option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
                            <option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
                            <option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
                            <option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
                            <option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
                            <option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
                            <option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
                            <option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
                            <option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="monday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="monday_closed=Yes"){echo "checked='checked'"; }}} ?>></td>
                      </tr>
                      <tr>
                        <td>Tuesday</td>
                        <td><select name="tuesday_from" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><select name="tuesday_to"class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
                          		<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
							</select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="tuesday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="tuesday_closed=Yes"){echo "checked='checked'"; }}} ?>></td>
                      </tr>
                      <tr>
                        <td>Wednesday</td>
                        <td><select name="wednesday_from" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><select name="wednesday_to" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="wednesday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="wednesday_closed=Yes"){echo "checked='checked'"; }}} ?>></td>
                      </tr>
                      <tr>
                        <td>Thursday</td>
                        <td><select name="thursday_from" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><select name="thursday_to" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="thursday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_closed=Yes"){echo "checked='checked'"; }}} ?>></td>
                      </tr>
                      <tr>
                        <td>Friday</td>
                        <td><select name="friday_from"class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="thursday_to=01:00"){echo "selected"; }}} ?>>01:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><select name="friday_to" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="01:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=01:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="friday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="friday_closed=Yes"){echo "checked='checked'"; }}} ?>></td>
                      </tr>
					  <tr>
                        <td>Saturday</td>
                        <td><select name="saturday_from" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_from=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><select name="saturday_to" class="input-small focused required">
								<option value="">&mdash; Please Select &mdash;</option>
								<option value="02:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=02:00"){echo "selected"; }}} ?>>02:00</option>
								<option value="03:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=03:00"){echo "selected"; }}} ?>>03:00</option>
								<option value="04:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=04:00"){echo "selected"; }}} ?>>04:00</option>
								<option value="05:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=05:00"){echo "selected"; }}} ?>>05:00</option>
								<option value="06:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=06:00"){echo "selected"; }}} ?>>06:00</option>
								<option value="07:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=07:00"){echo "selected"; }}} ?>>07:00</option>
								<option value="08:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=08:00"){echo "selected"; }}} ?>>08:00</option>
								<option value="09:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=09:00"){echo "selected"; }}} ?>>09:00</option>
								<option value="10:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=10:00"){echo "selected"; }}} ?>>10:00</option>
								<option value="11:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=11:00"){echo "selected"; }}} ?>>11:00</option>
								<option value="12:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=12:00"){echo "selected"; }}} ?>>12:00</option>
								<option value="13:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=13:00"){echo "selected"; }}} ?>>13:00</option>
								<option value="14:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=14:00"){echo "selected"; }}} ?>>14:00</option>
								<option value="15:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=15:00"){echo "selected"; }}} ?>>15:00</option>
								<option value="16:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=16:00"){echo "selected"; }}} ?>>16:00</option>
								<option value="17:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=17:00"){echo "selected"; }}} ?>>17:00</option>
								<option value="18:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=18:00"){echo "selected"; }}} ?>>18:00</option>
								<option value="19:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=19:00"){echo "selected"; }}} ?>>19:00</option>
								<option value="20:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=20:00"){echo "selected"; }}} ?>>20:00</option>
								<option value="21:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=21:00"){echo "selected"; }}} ?>>21:00</option>
								<option value="22:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=22:00"){echo "selected"; }}} ?>>22:00</option>
								<option value="23:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=23:00"){echo "selected"; }}} ?>>23:00</option>
								<option value="24:00" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_to=24:00"){echo "selected"; }}} ?>>24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="saturday_closed" value="Yes" <?php if(isset($optionsHours)){foreach($optionsHours as $optionsHour){if($optionsHour=="saturday_closed=Yes"){echo "checked='checked'"; }}} ?>></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row-fluid">
            <legend>Payment Options</legend>
			
              <div class="control-group span12">
			  <?php isset($arrCompanyProfileData[0]['payment_options']) ? $paymentValue=$arrCompanyProfileData[0]['payment_options'] : '';
							$options = @explode(',', $paymentValue);
							
					?>
				<div class="row-fluid">
					 <div class="control-group span4">
					 <label class="control-label">Cash</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" title="Select at least one Payment Option" class="iphone-toggle required"  name="paymentOptions[]" value="Cash" <?php if(isset($options)){foreach($options as $option){if($option=="Cash"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span4">
						<label class="control-label">Master Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required" data-min-options="1"  name="paymentOptions[]" value="Master Card" <?php if(isset($options)){foreach($options as $option){if($option=="Master Card"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label">Visa Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required "  name="paymentOptions[]" value="Visa Card" <?php if(isset($options)){foreach($options as $option){if($option=="Visa Card"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
                </div>
                <div class="row-fluid">
					<div class="control-group span4">
						<label class="control-label">Debit Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Debit Card" <?php if(isset($options)){foreach($options as $option){if($option=="Debit Card"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span4">
						<label class="control-label">Money Orders</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Money Orders" <?php if(isset($options)){foreach($options as $option){if($option=="Money Orders"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label">Cheques</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Cheques" <?php if(isset($options)){foreach($options as $option){if($option=="Cheques"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
                </div>
                <div class="row-fluid">
					<div class="control-group span4">
						<label class="control-label">Credit Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Credit Card" <?php if(isset($options)){foreach($options as $option){if($option=="Credit Card"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span4">
						<label class="control-label">Travellers Cheque</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Travellers Cheque" <?php if(isset($options)){foreach($options as $option){if($option=="Travellers Cheque"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label">Financing Available</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Financing Available" <?php if(isset($options)){foreach($options as $option){if($option=="Financing Available"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
                </div>
                <div class="row-fluid">
					<div class="control-group span4">
						<label class="control-label">American Express Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="American Express Card" <?php if(isset($options)){foreach($options as $option){if($option=="American Express Card"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span4">
						<label class="control-label">Dinners Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle required"  name="paymentOptions[]" value="Dinners Card" <?php if(isset($options)){foreach($options as $option){if($option=="Dinners Card"){echo "checked='checked'"; }}} ?>>
						</div>
					</div>
					<div class="control-group span3">
						<div id="paymentResult"></div>
					</div>
                </div>
					
				<div class="row-fluid">
					<div class="control-group span6">
					  <label class="control-label" for="company_profile_status">Status</label>
					  <div class="controls">
						<select class="input-xlarge focused required" id="company_profile_status" name="company_profile_status" >
							<option value="">&mdash; Please Select &mdash;</option>
						  <option <?php echo (isset($arrCompanyProfileData[0]['company_profile_status']) && $arrCompanyProfileData[0]['company_profile_status'] == 'Active' ? 'selected="selected"' : '');?> value="Active">Active</option>
						  <option <?php echo (isset($arrCompanyProfileData[0]['company_profile_status']) && $arrCompanyProfileData[0]['company_profile_status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
						</select>
					  </div>
					</div>
				</div>
              </div>
            </div>
			
          </div>
          <div id="tabs-3">
			<div>
				<div class="row-fluid">
				  <div class="control-group span6">
					<label class="control-label" for="focusedInput">Full Name</label>
					<div class="controls">
						<input type="hidden" id="c_id" name="c_id" value="">
					  <input class="input-xlarge focused" id="c_name" name="c_name" type="text" value="">
					</div>
				  </div>
				  <div class="control-group span6">
					<label class="control-label" for="focusedInput">Date Of Birth</label>
					<div class="controls">
					  <input class="input-xlarge datepicker" id="c_dob" name="c_dob" type="text" value="">
					</div>
				  </div>
				</div>
				<div class="row-fluid">
				  <div class="control-group span6">
					<label class="control-label" for="focusedInput">Date Of Marriage</label>
					<div class="controls">
					  <input class="input-xlarge datepicker" id="c_dom" name="c_dom" type="text" value="">
					</div>
				  </div>
				  <div class="control-group span6">
					<label class="control-label" for="focusedInput">Mobile</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="c_mobile" name="c_mobile" type="text" value="">
					</div>
				  </div>
				</div>
				<div class="row-fluid">
				  <div class="control-group span6">
					<label class="control-label" for="focusedInput">E-Mail</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="c_email" name="c_email" type="text" value="">
					</div>
				  </div>
				  <div class="control-group span6">
					<label class="control-label" for="focusedInput">Designation</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="c_designation" name="c_designation" type="text" value="">
					</div>
				  </div>
				</div>
				<div class="row-fluid">
				<div class="control-group span6">
				  <label class="control-label" for="focusedInput">Status</label>
				  <div class="controls">
					<select class="input-xlarge focused" id="c_status" name="c_status" >
					<option value="">&mdash; Please Select &mdash;</option>
					  <option value="Active">Active</option>
					  <option value="Inactive">Inactive</option>
					</select>
				  </div>
				</div>
			  </div>
				<div class="row-fluid">
					<div class="control-group span6">
						<div class="controls">
							<input class="btn btn-success" id="addrows" type="button" value="Add"></input>
						</div>
					</div>
				</div>
				<table class="table table-striped table-bordered bootstrap-datatable" id="mytable" name="mytable">
						  <thead>
							  <tr>
								  <th>Full Name</th>
								  <th>Date Of Birth</th>
								  <th>Date Of Marriage</th>
								  <th>Mobile</th>
                                  <th>E-Mail</th>
                                  <th>Designation</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						</thead>  
						<tbody>	
							<?php 
								if(isset($arrCompanyContactData)){
									for($intIndex = 0; $intIndex <count($arrCompanyContactData); $intIndex++)
										{
							?>
							
							<tr id="visibleDiv" name="visibleDiv">
								<td><input type="hidden" name="company_contact_id[]" id="company_contact_id" value="<?php echo (isset($arrCompanyContactData[$intIndex]['company_contact_id']) ? $arrCompanyContactData[$intIndex]['company_contact_id'] : ''); ?>" />
									<input class="input-small focused required field" id="contact_full_name" name="contact_full_name[]" type="text" value="<?php echo (isset($arrCompanyContactData[$intIndex]['contact_full_name']) ? $arrCompanyContactData[$intIndex]['contact_full_name'] : ''); ?>"></td>
								<td class="center"><input type="text" class="input-small datepicker required field" id="dob" name="dob[]" value="<?php echo (isset($arrCompanyContactData[$intIndex]['dob']) ? $arrCompanyContactData[$intIndex]['dob'] : ''); ?>"></td>
                                <td class="center"><label for="dom"><input type="text" class="input-small datepicker required field" id="dom" name="dom[]"value="<?php echo (isset($arrCompanyContactData[$intIndex]['dom']) ? $arrCompanyContactData[$intIndex]['dom'] : ''); ?>"></td>
								<td class="center"><input class="input-small focused required field" id="contact_mobile" maxlength="10" name="contact_mobile[]" type="text" value="<?php echo (isset($arrCompanyContactData[$intIndex]['contact_mobile']) ? $arrCompanyContactData[$intIndex]['contact_mobile'] : ''); ?>"></td>
                                <td class="center"><input class="input-small focused required field" id="contact_email" name="contact_email[]" type="email" value="<?php echo (isset($arrCompanyContactData[$intIndex]['contact_email']) ? $arrCompanyContactData[$intIndex]['contact_email'] : ''); ?>"></td>
								<td class="center"><input class="input-small focused required field" id="designation" name="designation[]" type="text" value="<?php echo (isset($arrCompanyContactData[$intIndex]['designation']) ? $arrCompanyContactData[$intIndex]['designation'] : ''); ?>"></td>
								<td class="center"> <select class="input-small focused required field" id="contact_status" name="contact_status[]" >
													  <option <?php echo (isset($arrCompanyContactData[$intIndex]['contact_status']) && $arrCompanyContactData[$intIndex]['contact_status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
													  <option <?php echo (isset($arrCompanyContactData[$intIndex]['contact_status']) && $arrCompanyContactData[$intIndex]['contact_status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
													</select>
								<td class="center"><input class="btn btn-success" id="removeRows" type="button" value="Remove"></input></td>
							</tr>
							<?php
										}
								}
							?>
                          </tbody>
				</table>
			</div>
          </div>
          <div id="tabs-4">
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="data_source">Data Source</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="data_source" name="data_source" type="text" value="<?php echo (isset($arrCompanyAdvertiseData[0]['data_source']) ? $arrCompanyAdvertiseData[0]['data_source'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="ad_city">City</label>
                <div class="controls">
					<select name="ad_city" id="ad_city"  class="input-xlarge focused required" >
						<option value="">&mdash; Please Select &mdash;</option>
						<?php
							for ($intIndex = 0; $intIndex < count($arrCityRecords); $intIndex++)
							{
								echo "<option value='" . $arrCityRecords[$intIndex]['city_id'] . "' ".($arrCityRecords[$intIndex]['city_id']==$arrCompanyAdvertiseData[0]['city_id']?'selected':'').">" . $arrCityRecords[$intIndex]['city_name'] . "</option>";
							}
						?>
					</select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="budget">Budget</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="budget" data-int name="budget" type="text" value="<?php echo (isset($arrCompanyAdvertiseData[0]['budget']) ? $arrCompanyAdvertiseData[0]['budget'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="year">Year</label>
                <div class="controls">
                  <input class="input-xlarge focused required" maxlength="4" id="year" name="year" type="text" value="<?php echo (isset($arrCompanyAdvertiseData[0]['year']) ? $arrCompanyAdvertiseData[0]['year'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="ad_date">Date</label>
                <div class="controls">
                  <input class="input-xlarge datepicker required" id="ad_date" name="ad_date" type="text" value="<?php echo (isset($arrCompanyAdvertiseData[0]['ad_date']) ? $arrCompanyAdvertiseData[0]['ad_date'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="page">Page</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="page" name="page" type="text" value="<?php echo (isset($arrCompanyAdvertiseData[0]['page']) ? $arrCompanyAdvertiseData[0]['page'] : ''); ?>">
                </div>
              </div>
            </div>
			<div class="row-fluid">
            <div class="control-group span6">
              <label class="control-label" for="ad_status">Status</label>
              <div class="controls">
                <select class="input-xlarge focused required" id="ad_status" name="ad_status" >
					<option value="">&mdash; Please Select &mdash;</option>
                  <option <?php echo (isset($arrCompanyAdvertiseData[0]['ad_status']) && $arrCompanyAdvertiseData[0]['ad_status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
                  <option <?php echo (isset($arrCompanyAdvertiseData[0]['ad_status']) && $arrCompanyAdvertiseData[0]['ad_status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>
         </div>
		 <div id="tabs-5">
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="data_source">Product Name</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="product_name" name="product_name" type="text" value="<?php echo (isset($arrCompanyProductData[0]['product_name']) ? $arrCompanyProductData[0]['product_name'] : ''); ?>">
                </div>
              </div>
            </div>
			<div class="row-fluid">
              <div class="control-group span12">
                <label class="control-label" for="product_description">Product Description</label>
                <div class="controls">
                  <textarea class="ckeditor required" name="product_description" id="product_description"><?php echo (isset($arrCompanyProductData[0]['product_description']) ? $arrCompanyProductData[0]['product_description'] : ''); ?></textarea>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="price">Price</label>
                <div class="controls">
                  <input class="input-xlarge focused required" id="price" name="price" type="text" value="<?php echo (isset($arrCompanyProductData[0]['price']) ? $arrCompanyProductData[0]['price'] : ''); ?>">
                </div>
              </div>
            </div>
			<div class="row-fluid">
              <div class="control-group span12">
                <label class="control-label" for="upload_image">Upload image</label>
				<div class="controls">
					<div id="previewDiv"><?php echo (isset($arrCompanyProductData[0]['product_img_path']) ? "<img src='uploads/".$arrCompanyProductData[0]['product_img_path']."' id='photo'>" : ''); ?></div>
					<div id="thumbs" style="padding:5px"></div>
					<input type="file" class="required" name="photoimg" id="photoimg" value="<?php echo (isset($arrCompanyProductData[0]['product_img_path']) ? "uploads/".$arrCompanyProductData[0]['product_img_path'] : ''); ?>"/>
					<input type="hidden" name="img_path" id="img_path" value="<?php echo (isset($arrCompanyProductData[0]['product_img_path']) ? "uploads/".$arrCompanyProductData[0]['product_img_path'] : ''); ?>" />
					<input type="hidden" name="x_axis" value="" id="x_axis" />
					<input type="hidden" name="y_axis" value="" id="y_axis" />
					<input type="hidden" name="x2_axis" value="" id="x2_axis" />
					<input type="hidden" name="y2_axis" value="" id="y2_axis" />
					<input type="hidden" name="thumb_width" value="" id="thumb_width" />
					<input type="hidden" name="thumb_height" value="" id="thumb_height" />
				</div>
              </div>
            </div>
			<div class="row-fluid">
            <div class="control-group span6">
              <label class="control-label" for="product_status">Status</label>
              <div class="controls">
                <select class="input-xlarge focused required" id="product_status" name="product_status" >
					<option value="">&mdash; Please Select &mdash;</option>
                  <option <?php echo (isset($arrCompanyProductData[0]['product_status']) && $arrCompanyProductData[0]['product_status'] == 'Active' ? 'selected="selected"' : ''); ?> value="Active">Active</option>
                  <option <?php echo (isset($arrCompanyProductData[0]['product_status']) && $arrCompanyProductData[0]['product_status'] == 'Inactive' ? 'selected="selected"' : ''); ?> value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>
         </div>
        </div>
        <fieldset>
          <div class="row-fluid" style="height: 20px"></div>
          
          <div class="form-actions">
            <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
			<button type="button" class="btn" onclick="javascript:history.go(-1)">Cancel</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <!--/span--> 
</div>

<?php
require_once('footer.php');
?>

<?php
require_once('javascript_methods.php');
?>
<script type="text/javascript">
   function getSizes(im,obj)
	{
		if(obj.width > 0){
			$("#x_axis").val(obj.x1);
			$("#x2_axis").val(obj.x2);
			$("#y_axis").val(obj.y1);
			$("#y2_axis").val(obj.y2);
			$("#thumb_width").val(obj.width);
			$("#thumb_height").val(obj.height);
		}else
			alert("Please select image portion to upload..!");
	}

$(document).ready(function () {
	
	$("#photoimg").on('change', function () {

		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

		if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
			if (typeof (FileReader) != "undefined") {

				var image_holder = $("#previewDiv");
				image_holder.empty();

				var reader = new FileReader();
				reader.onload = function (e) {
					$("<img />", {
						"src": e.target.result,
							"id":"photo"
					}).appendTo(image_holder);
					$("#img_path").val(e.target.result);
					$('#photo').imgAreaSelect({
						//aspectRatio: '1:1',
						onSelectEnd: getSizes
					});

				}
				image_holder.show();
				reader.readAsDataURL($(this)[0].files[0]);
			} else {
				alert("This browser does not support FileReader.");
			}
		} else {
			alert("Pls select only images");
		}
	});
    
});

</script>
