<?php
require_once('header.php');
$arrField = array('*');
$intCompanyId = $_REQUEST['company_id'];
if (isset($intPageId) && $intPageId != '')
{
	$arrData = $objControl->getRecords('company_master', 'company_id', $intCompanyId, '', $arrField);
}


?>

<div>
  <ul class="breadcrumb">
    <li> <a href="#">Home</a> <span class="divider">/</span> </li>
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
      <form class="form-horizontal" method="post" action="controller/routes.php">
        <input type="hidden" name="hid_action" id="hid_action" value="create_company" />
        <input type="hidden" name="company_id" id="company_id" value="<?php echo $_REQUEST['company_id']; ?>" />
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Basic Details</a></li>
            <li><a href="#tabs-2">Company Profile</a></li>
            <li><a href="#tabs-3">Company Contact</a></li>
            <li><a href="#tabs-4">Company Advertise</a></li>
          </ul>
          <div id="tabs-1">
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Full  Name</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="full_name" name="full_name" type="text" value="<?php echo (isset($arrData[0]['full_name']) ? $arrData[0]['full_name'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Short Name</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="short_name" name="short_name" type="text" value="<?php echo (isset($arrData[0]['short_name']) ? $arrData[0]['short_name'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Establish Date</label>
                <div class="controls">
                  <input class="input-xlarge datepicker" id="est_date" name="est_date" type="text" value="<?php echo (isset($arrData[0]['est_date']) ? $arrData[0]['est_date'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Building</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="building" name="building" type="text" value="<?php echo (isset($arrData[0]['building']) ? $arrData[0]['building'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Street</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="street" name="street" type="text" value="<?php echo (isset($arrData[0]['street']) ? $arrData[0]['street'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Landmark</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="landmark" name="landmark" type="text" value="<?php echo (isset($arrData[0]['landmark']) ? $arrData[0]['landmark'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">City</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="city" name="city" type="text" value="<?php echo (isset($arrData[0]['city']) ? $arrData[0]['city'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">State</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="state" name="state" type="text" value="<?php echo (isset($arrData[0]['state']) ? $arrData[0]['state'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Area</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="area" name="area" type="text" value="<?php echo (isset($arrData[0]['area']) ? $arrData[0]['area'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Pin code</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="pincode" name="pincode" type="text" value="<?php echo (isset($arrData[0]['pincode']) ? $arrData[0]['state'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Latitude</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="latitude" name="latitude" type="text" value="<?php echo (isset($arrData[0]['latitude']) ? $arrData[0]['latitude'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Longitude</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="longitute" name="longitute" type="text" value="<?php echo (isset($arrData[0]['longitute']) ? $arrData[0]['longitute'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Is Verified</label>
                <div class="controls">
                  <input type="checkbox" name="is_verified" id="is_verified" value="yes">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Nature of Bussiness</label>
                <div class="controls">
                  <select class="input-xlarge focused" name="nob" id="nob">
                    <option value="Nature of Bussiness">Nature of Bussiness</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Turn Over</label>
                <div class="controls">
                  <select class="input-xlarge focused" name="turn_over" id="turn_over">
                    <option value="Turn Over">Turn Over</option>
                  </select>
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Status</label>
                <div class="controls">
                  <select class="input-xlarge focused" name="status" id="status">
                    <option value="status">Status</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Email</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="email" name="email" type="text" value="<?php echo (isset($arrData[0]['email']) ? $arrData[0]['email'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="email_dis" id="email_dis" value="yes">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Don't Provide email</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" id="email_dnd" name="email_dnd" value="yes">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Website</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="website" name="website" type="text" value="<?php echo (isset($arrData[0]['website']) ? $arrData[0]['website'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="website_dis" id="website_dis" value="yes">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Don't Provide Website</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="website_dnd" id="website_dnd" value="yes">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Mobile</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="mobile" name="mobile" type="text" value="<?php echo (isset($arrData[0]['mobile']) ? $arrData[0]['mobile'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="mobile_dis" id="mobile_dis" value="yes">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Don't Provide number</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="mobile_dnd" id="mobile_dnd" value="yes">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Landline</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="landline" name="landline" type="text" value="<?php echo (isset($arrData[0]['landline']) ? $arrData[0]['landline'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Display in Search</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="landline_dis" id="landline_dis" value="yes">
                </div>
              </div>
              <div class="control-group span3">
                <label class="control-label" for="focusedInput">Don't Provide number</label>
                <div class="controls">
                  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="landline_dnd" id="landline_dnd" value="yes">
                </div>
              </div>
            </div>
          </div>
          <div id="tabs-2">
            <div class="row-fluid">
              <div class="control-group span12">
                <label class="control-label" for="focusedInput">Company Description</label>
                <div class="controls">
                  <textarea class="ckeditor" name="company_description" id="company_description"></textarea>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span12">
                <label class="control-label" for="focusedInput">Hours of Operation:</label>
                <div class="controls">
                  <table class="table table-bordered table-striped">
                    <tbody>
                      <tr>
                        <td><h3>Day</h3></td>
                        <td><h3>From</h3></td>
                        <td><h3>To</h3></td>
                        <td><h3>Close</h3></td>
                      </tr>
                      <tr>
                        <td>Sunday</td>
                        <td><select name="sunday_from">
                            <option value="01:00">01:00</option>
                            <option value="02:00">02:00</option>
                            <option value="03:00">03:00</option>
                            <option value="04:00">04:00</option>
                            <option value="05:00">05:00</option>
                            <option value="06:00">06:00</option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                            <option value="22:00">22:00</option>
                            <option value="23:00">23:00</option>
                            <option value="24:00">24:00</option>

                          </select></td>
                        <td><select name="sunday_to">
                            <option value="01:00">01:00</option>
                            <option value="02:00">02:00</option>
                            <option value="03:00">03:00</option>
                            <option value="04:00">04:00</option>
                            <option value="05:00">05:00</option>
                            <option value="06:00">06:00</option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                            <option value="22:00">22:00</option>
                            <option value="23:00">23:00</option>
                            <option value="24:00">24:00</option>

                          </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="sunday_closed" value="Yes"></td>
                      </tr>
                      <tr>
                        <td>Monday</td>
                        <td><select name="monday_from">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><select name="monday_to">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="monday_closed" value="Yes"></td>
                      </tr>
                      <tr>
                        <td>Tuesday</td>
                        <td><select name="tuesday_from">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><select name="tuesday_to">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="tuesday_closed" value="Yes"></td>
                      </tr>
                      <tr>
                        <td>Wednesday</td>
                        <td><select name="wednesday_from">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><select name="wednesday_to">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="wednesday_closed" value="Yes"></td>
                      </tr>
                      <tr>
                        <td>Thursday</td>
                        <td><select name="thursday_from">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><select name="thursday_to">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="thursday_closed" value="Yes"></td>
                      </tr>
                      <tr>
                        <td>Friday</td>
                        <td><select name="friday_from">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><select name="friday_to">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="friday_closed" value="Yes"></td>
                      </tr>
					  <tr>
                        <td>Saturday</td>
                        <td><select name="saturday_from">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><select name="saturday_to">
                          <option value="01:00">01:00</option>
                          <option value="02:00">02:00</option>
                          <option value="03:00">03:00</option>
                          <option value="04:00">04:00</option>
                          <option value="05:00">05:00</option>
                          <option value="06:00">06:00</option>
                          <option value="07:00">07:00</option>
                          <option value="08:00">08:00</option>
                          <option value="09:00">09:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="12:00">12:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                          <option value="23:00">23:00</option>
                          <option value="24:00">24:00</option>
                        </select></td>
                        <td><input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="saturday_closed" value="Yes"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row-fluid">
            <legend>Payment Options</legend>
              <div class="control-group span12">
                <div class="row-fluid">
					 <div class="control-group span3">
						<label class="control-label" for="focusedInput">Cash</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Cash">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Master Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Master Card">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Visa Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Visa Card">
						</div>
					</div>
                </div>
                <div class="row-fluid">
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Debit Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Debit Card">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Money Orders</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Money Orders">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Cheques</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Cheques">
						</div>
					</div>
                </div>
                <div class="row-fluid">
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Credit Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Credit Card">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Travellers Cheque</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Travellers Cheque">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Financing Available</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Financing Available">
						</div>
					</div>
                </div>
                <div class="row-fluid">
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">American Express Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="American Express Card">
						</div>
					</div>
					<div class="control-group span3">
						<label class="control-label" for="focusedInput">Dinners Card</label>
						<div class="controls">
						  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="paymentOptions[]" value="Dinners Card">
						</div>
					</div>
                </div>
              </div>
            </div>
          </div>
          <div id="tabs-3">
			<div>
				<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Full Name</th>
								  <th>Date Of Birth</th>
								  <th>Date Of Marriage</th>
								  <th>Mobile</th>
                                  <th>E-Mail</th>
                                  <th>Designation</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td><input class="input-small focused" id="contact_full_name" name="contact_full_name" type="text" value="<?php echo (isset($arrData[0]['contact_full_name']) ? $arrData[0]['contact_full_name'] : ''); ?>"></td>
								<td class="center"><input type="text" class="input-small datepicker" id="dob" name="dob" value="<?php echo (isset($arrData[0]['dob']) ? $arrData[0]['dob'] : ''); ?>"></td>
                                <td class="center"><input type="text" class="input-small datepicker" id="dom" name="dom"value="<?php echo (isset($arrData[0]['dom']) ? $arrData[0]['dom'] : ''); ?>"></td>
								<td class="center"><input class="input-small focused" id="contact_mobile" name="contact_mobile" type="text" value="<?php echo (isset($arrData[0]['contact_mobile']) ? $arrData[0]['contact_mobile'] : ''); ?>"></td>
                                <td class="center"><input class="input-small focused" id="contact_email" name="contact_email" type="email" value="<?php echo (isset($arrData[0]['contact_email']) ? $arrData[0]['contact_email'] : ''); ?>"></td>
								<td class="center"><input class="input-small focused" id="designation" name="designation" type="text" value="<?php echo (isset($arrData[0]['designation']) ? $arrData[0]['designation'] : ''); ?>"></td>
								<td class="center"><a class="btn btn-success" href="#"><i class="icon-plus icon-white"></i>Add</a></td>
							</tr>
                          </tbody>
				</table>
			</div>
          </div>
          <div id="tabs-4">
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Data Source</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="data_source" name="data_source" type="text" value="<?php echo (isset($arrData[0]['data_source']) ? $arrData[0]['data_source'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">City</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="ad_city" name="ad_city" type="text" value="<?php echo (isset($arrData[0]['ad_city']) ? $arrData[0]['ad_city'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Budget</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="budget" name="budget" type="text" value="<?php echo (isset($arrData[0]['budget']) ? $arrData[0]['budget'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Year</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="year" name="year" type="text" value="<?php echo (isset($arrData[0]['year']) ? $arrData[0]['year'] : ''); ?>">
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Date</label>
                <div class="controls">
                  <input class="input-xlarge datepicker" id="ad_date" name="ad_date" type="text" value="<?php echo (isset($arrData[0]['ad_date']) ? $arrData[0]['ad_date'] : ''); ?>">
                </div>
              </div>
              <div class="control-group span6">
                <label class="control-label" for="focusedInput">Page</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="page" name="page" type="text" value="<?php echo (isset($arrData[0]['page']) ? $arrData[0]['page'] : ''); ?>">
                </div>
              </div>
            </div>
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
  </div>
  <!--/span--> 
</div>
<?php
require_once('footer.php');
?>
