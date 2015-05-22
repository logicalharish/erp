<?php

$strAction = $_REQUEST['hid_action'];

require_once('controller.php');

$objControl = new CommonController();

switch ($strAction)
{
	case 'create_country':
		$arrData['country_name'] = $_REQUEST['txt_country'];
		$arrData['status'] = $_REQUEST['sel_status'];
		$objControl->createRecord($arrData, 'country_master');
		header('Location:' . HTTP_PATH . 'country.php');
		exit;
		break;
	case 'create_user':
		$arrData['name'] = $_REQUEST['name'];
		$arrData['email'] = $_REQUEST['email'];
		$arrData['username'] = $_REQUEST['username'];
		$arrData['password'] = $_REQUEST['password'];
		$arrData['user_role_id'] = $_REQUEST['userRole'];
		$arrData['user_modules'] = @implode(',', $_REQUEST['modules']);
		if ($_REQUEST['user_id'] != '')
		{
			$strUserId = $_REQUEST['user_id'];
			$strCondition = "user_id={$strUserId}";
			$objControl->createRecord($arrData, 'user_master', $strCondition);
		} else
		{
			$objControl->createRecord($arrData, 'user_master');
		}
		header('Location:' . HTTP_PATH . 'users.php');
		exit;
		break;
	case 'user-advance':

		$objControl->addOrUpdateUserAdvanced();
		exit;
		break;
	case 'create_module':
		$intModuleId = $_REQUEST['module_id'];
		$arrData['module_name'] = $_REQUEST['module_name'];
		$arrData['module_menu_link'] = $_REQUEST['module_menu_link'];
		$arrData['status'] = $_REQUEST['status'];

		if ($intModuleId != '')
		{
			$arrData['modified_datetime'] = date('d-m-y h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " module_id='$intModuleId'";
			$objControl->createRecord($arrData, "module_master", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('d-m-y h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'module_master');
		}
		header('Location:' . HTTP_PATH . 'module.php');
		exit;
		break;
	case 'create_nob':
	
		$intNobId = $_REQUEST['nob_id'];
		$arrData['nob_name'] = $_REQUEST['txt_nob'];
		$arrData['status'] = $_REQUEST['sel_status'];

		if ($intNobId != '')
		{
			$arrData['modified_datetime'] = date('d-m-y h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " nob_id='$intNobId'";
			$objControl->createRecord($arrData, "nob_master", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('d-m-y h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'nob_master');
		}
		
		header('Location:' . HTTP_PATH . 'nob.php');
		exit;
		break;
	case 'create_designation':
	
		$intDesignationId = $_REQUEST['nob_id'];
		$arrData['designation_name'] = $_REQUEST['txt_designation'];
		$arrData['status'] = $_REQUEST['sel_status'];

		if ($intDesignationId != '')
		{
			$arrData['modified_datetime'] = date('d-m-y h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " nob_id='$intDesignationId'";
			$objControl->createRecord($arrData, "designation_master", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('d-m-y h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'designation_master');
		}
		
		header('Location:' . HTTP_PATH . 'designation.php');
		exit;
		break;
	case 'create_city':
	
		$intCityId = $_REQUEST['city_id'];
		$arrData['city_name'] = $_REQUEST['txt_city'];
		$arrData['status'] = $_REQUEST['sel_status'];

		if ($intCityId != '')
		{
			$arrData['modified_datetime'] = date('d-m-y h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " city_id='$intCityId'";
			$objControl->createRecord($arrData, "City_master", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('d-m-y h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'City_master');
		}
		
		header('Location:' . HTTP_PATH . 'City.php');
		exit;
		break;
	case 'create_state':
	
		$intStateId = $_REQUEST['branch_id'];
		$arrData['branch_name'] = $_REQUEST['txt_state'];
		$arrData['status'] = $_REQUEST['sel_status'];

		if ($intStateId != '')
		{
			$arrData['modified_datetime'] = date('d-m-y h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " nob_id='$intStateId'";
			$objControl->createRecord($arrData, "branch_master", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('d-m-y h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'branch_master');
		}
		
		header('Location:' . HTTP_PATH . 'state.php');
		exit;
		break;
	case 'create_website':

		foreach ($_REQUEST as $key => $value)
		{
			$arrData = array();
			$arrData['option_value'] = $value;

			$strCondition = "  site_option = '$key'";
			$objControl->createRecord($arrData, "website_master", $strCondition);
		}
		header('Location:' . HTTP_PATH . 'website.php');
		exit;

		break;
	case 'create_page':
		$intPageId = $_REQUEST['page_id'];
		$arrData['page_name'] = $_REQUEST['page_name'];
		$arrData['page_title'] = $_REQUEST['page_title'];
		$arrData['page_url'] = $_REQUEST['page_url'];
		$arrData['page_description'] = $_REQUEST['page_description'];
		$arrData['in_nav_menu'] = $_REQUEST['show_in_menu'];
		$arrData['status'] = $_REQUEST['status'];
		$arrData['seq_no'] = $_REQUEST['seq_no'];
		$arrData['parent_page'] = $_REQUEST['parent_page'];
		$arrData['static_page'] = $_REQUEST['static_page'];

		$arrData['meta_keywords'] = $_REQUEST['meta_keywords'];
		$arrData['meta_description'] = $_REQUEST['meta_description'];
		$arrData['meta_abstract'] = $_REQUEST['meta_abstract'];
		$arrData['canonical_url'] = $_REQUEST['canonical_url'];
		$arrData['page_banner_id'] = $_REQUEST['page_banner_id'];


		if ($intPageId != '')
		{
			$arrData['modified_datetime'] = date('Y-m-d h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " page_id='$intPageId'";
			
			$objControl->createRecord($arrData, "page_master", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('Y-m-d h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'page_master');
		}

		header('Location:' . HTTP_PATH . 'pages.php');
		exit;
	case 'create_banner':
		$intPageId = $_REQUEST['page_banner_id'];
		
		$arrData['banner_title'] = $_REQUEST['banner_title'];
		$arrData['banner_url'] = $_REQUEST['banner_url'];
		$arrData['banner_alt_text'] = $_REQUEST['banner_alt_text'];
		$arrData['status'] = $_REQUEST['status'];
		if ($intPageId != '')
		{
			$arrData['modified_datetime'] = date('Y-m-d h:i:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " page_banner_id='$intPageId'";
			
			$objControl->createRecord($arrData, "page_banner", $strCondition);
		} else
		{
			$arrData['created_datetime'] = date('Y-m-d h:i:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'page_banner');
		}

		header('Location:' . HTTP_PATH . 'banners.php');
		exit;
	case 'update_status':
		$strTableName = $_REQUEST['table_name'];
		$intRecordId = $_REQUEST['id'];
		$strColumnName = $_REQUEST['column_name'];
		$strQuery = "UPDATE ".$strTableName." SET status = IF(status='Active', 'Inactive', 'Active') where ".$strColumnName." = ".$intRecordId;
		$objControl->updateRecord($strQuery);
		echo "Record Updated";
		break;
	case 'send_mail_package':
		
			$strBody    =   "<table><tr><td>Name: </td><td>";
			$strBody    .=   $strFirstName;
			$strBody    .=   "</td></tr><tr><td>Email: </td><td>";
			$strBody    .=   $strEmail;
			$strBody    .=   "</td></tr><tr><td>Phone: </td><td>";
			$strBody    .=   $strPhone;
			$strBody    .=   "</td></tr><tr valign='top'><td>Address: </td><td>";
			$strBody    .=   $strAddress.',<br />'.$strCity.',<br />'.$strState.',<br />'.$strZip;
			$strBody    .=   "</td></tr><tr><td>Comment:</td><td>";
			$strBody    .=   $strAppointmentType;
			$strBody    .=   "</td></tr><tr><td>Preferred Appointment Date 1: &nbsp;</td><td>";
			$strBody    .=   $strAppDate1.' &nbsp;&nbsp; '.$strAppTime1;
			$strBody    .=   "</td></tr><tr><td>Preferred Appointment Date 2: &nbsp;</td><td>";
			$strBody    .=   $strAppDate2.' &nbsp;&nbsp; '.$strAppTime2;
			$strBody    .=   "</td></tr><tr><td>Other Comments: </td><td>";
			$strBody    .=   $strComments;
			$strBody    .=   "</td></tr></table>";
			
			$strSubject = 'New Appointment Requested';
		$objControl->sendMail($strSubject. $strBody);
		header('Location:' . FRONTEND_HTTP_PATH. 'thankyou.html');
		exit;
		break;
		case 'create_company':
				echo "<pre>";
				print_r($_REQUEST);
				die;
		break;
		exit;
		case 'import_company':
		
		set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
		require_once 'PHPExcel/IOFactory.php';
		// This is the file path to be uploaded.
		$inputFileName = 'Book1.xlsx'; 

		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}


		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$arrField = array('category_name');
		$arrCategory = $objControl->getRecords("category_master",'','','category_name',$arrField);
		

		for($intIndex = 0; $intIndex <count($arrCategory); $intIndex++)
		{
			$arrCateg['category_name'] = $arrCategory[$intIndex]['category_name'];
		}

		for($i=2;$i<=$arrayCount;$i++){
		$arrData[$i]['company_name'] = trim($allDataInSheet[$i]["A"]);
		$arrData[$i]['address1'] = trim($allDataInSheet[$i]["B"]);
		$arrData[$i]['address2'] = trim($allDataInSheet[$i]["C"]);
		$arrData[$i]['address3'] = trim($allDataInSheet[$i]["D"]);
		$arrData[$i]['area'] = trim($allDataInSheet[$i]["E"]);
		$arrData[$i]['city'] = trim($allDataInSheet[$i]["F"]);
		$arrData[$i]['pincode'] = trim($allDataInSheet[$i]["G"]);
		$arrData[$i]['contact_no'] = trim($allDataInSheet[$i]["H"]);
		$arrData[$i]['category'] = trim($allDataInSheet[$i]["I"]);
		
		#$objControl->createRecord($arrData[$i], 'company_master_new');
		
	
		$objControl->saveCategory( $allDataInSheet[$i]["I"]);
		}
		echo "<pre>";
		#print_r($arrData);
		exit;
		header('Location:' . FRONTEND_HTTP_PATH. 'thankyou.html');
		exit;

}
?>