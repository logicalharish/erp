<?php

$strAction = $_REQUEST['hid_action'];

require_once('controller.php');

$objControl = new CommonController();

switch ($strAction)
{
	case 'create_country':
		$intCountryId = $_REQUEST['country_id'];
		$arrData['country_name'] = $_REQUEST['txt_country'];
		$arrData['status'] = $_REQUEST['sel_status'];

		if ($intCountryId != '')
		{
			//$arrData['modified_datetime'] = date('yyyy-mm-dd hh:mm:ss');//$objControl->dbConnect->new DateTime();//
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = "country_id='$intCountryId'";
			$objControl->createRecord($arrData, "country_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'country_master');
		}
		header('Location:' . HTTP_PATH . 'country.php');
		exit;
		break;
		
	case 'create_user':
		$arrData['name'] = $_REQUEST['name'];
		$arrData['email'] = $_REQUEST['email'];
		$arrData['username'] = $_REQUEST['username'];
		$arrData['password'] = $_REQUEST['password'];
		$arrData['user_role_id'] = $_REQUEST['userRole'];
		$arrModules = $_REQUEST['modules'];
		
		if ($_REQUEST['user_id'] != '')
		{
			$intUserId = $_REQUEST['user_id'];
			$objControl->deleteRecord('user_module_master', 'user_id', $intUserId);
			$strCondition = "user_id='$intUserId'";
			$objControl->createRecord($arrData, 'user_master', $strCondition);
			$arrData['user_id']=$intUserId;
		} else
		{
			$objControl->createRecord($arrData, 'user_master');
			$arrData['user_id']= $objControl->dbConnect->Insert_ID();
		}
		foreach ($arrModules as $module)
				{
					$arrData['module_id']=$module;
					$objControl->createRecord($arrData, 'user_module_master');
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
			//$arrData['modified_datetime'] = date('d-m-y h:i:s');
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " module_id='$intModuleId'";
			$objControl->createRecord($arrData, "module_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
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
			//$arrData['modified_datetime'] = date('d-m-y h:i:s');
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " nob_id='$intNobId'";
			$objControl->createRecord($arrData, "nob_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
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
			//$arrData['modified_datetime'] = date('d-m-y h:i:s');
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = " nob_id='$intDesignationId'";
			$objControl->createRecord($arrData, "designation_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'designation_master');
		}
		
		header('Location:' . HTTP_PATH . 'designation.php');
		exit;
		break;
	case 'create_city':
	
		$intCityId = $_REQUEST['city_id'];
		$arrData['city_name'] = $_REQUEST['txt_city'];
		$arrData['status'] = $_REQUEST['sel_status'];
		$arrData['country_id'] = $_REQUEST['country_id'];
		$arrData['state_id'] = $_REQUEST['state_id'];

		if ($intCityId != '')
		{
			//$arrData['modified_datetime'] = date('d-m-y h:i:s');
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = "city_id='$intCityId'";
			$objControl->createRecord($arrData, "City_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'City_master');
		}
		
		header('Location:' . HTTP_PATH . 'City.php');
		exit;
		break;
	case 'create_state':
	
		$intStateId = $_REQUEST['branch_id'];
		$arrData['branch_name'] = $_REQUEST['txt_state'];
		$arrData['status'] = $_REQUEST['sel_status'];
		$arrData['country_id'] = $_REQUEST['country_id'];

		if ($intStateId != '')
		{
			//$arrData['modified_datetime'] = date('yyyy-mm-dd hh:mm:ss');//$objControl->dbConnect->new DateTime();//
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = "branch_id='$intStateId'";
			$objControl->createRecord($arrData, "branch_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'branch_master');
		}
		header('Location:' . HTTP_PATH . 'state.php');
		exit;
		break;
		
		case 'create_category':
	
		$intCategoryId = $_REQUEST['category_id'];
		$arrData['category_name'] = $_REQUEST['txt_category'];
		$arrData['status'] = $_REQUEST['sel_status'];
		$parent_category_id = $_REQUEST['parent_category_id'];
			if($parent_category_id=="none" || $parent_category_id=="")
				{
					$arrData['parent_category_id']=0;
				}
				else{
					$arrData['parent_category_id']=$parent_category_id;
					}
		if ($intCategoryId != '')
		{
			//$arrData['modified_datetime'] = date('yyyy-mm-dd hh:mm:ss');//$objControl->dbConnect->new DateTime();//
			//$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$strCondition = "category_id='$intCategoryId'";
			$objControl->createRecord($arrData, "category_master", $strCondition);
		} else
		{
			//$arrData['created_datetime'] = date('d-m-y h:i:s');
			//$arrData['created_by'] = $_SESSION['user']['user_id'];
			$objControl->createRecord($arrData, 'category_master');
		}
		header('Location:' . HTTP_PATH . 'category.php');
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
		break;
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
		break;
	case 'update_status':
		$strTableName = $_REQUEST['table_name'];
		$intRecordId = $_REQUEST['id'];
		$strColumnName = $_REQUEST['column_name'];
		$page = $_REQUEST['page_url'];
		$status = $_REQUEST['status'];
		if($status=="Active"){$newStatus="Inactive";}else{$newStatus="Active";}
		$strQuery = "UPDATE ".$strTableName." SET status = '".$newStatus."' where ".$strColumnName." = ".$intRecordId;
		$objControl->dbConnect->Execute($strQuery);
		header('Location:' . HTTP_PATH . $page);
		//echo "Record Updated";
		exit;
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
			$intCompanyId = $_REQUEST['company_id'];
			$arrData['full_name'] = $_REQUEST['full_name'];
			$arrData['short_name'] = $_REQUEST['short_name'];
			$arrData['est_date'] = $_REQUEST['est_date'];
			$arrData['building'] = $_REQUEST['building'];
			$arrData['street'] = $_REQUEST['street'];
			$arrData['landmark'] = $_REQUEST['landmark'];
			$arrData['city_id'] = $_REQUEST['city_id'];
			$arrData['state_id'] = $_REQUEST['state_id'];
			$arrData['country_id'] = $_REQUEST['country_id'];
			$arrData['area'] = $_REQUEST['area'];
			$arrData['pincode'] = $_REQUEST['pincode'];
			$arrData['latitude'] = $_REQUEST['latitude'];
			$arrData['longitute'] = $_REQUEST['longitute'];
			$arrData['is_verified'] = isset($_REQUEST['is_verified']) ? $_REQUEST['is_verified'] : 'No' ;
			$arrData['nob'] = $_REQUEST['nob'];
			$arrData['turn_over'] = $_REQUEST['turn_over'];
			$arrData['status'] = $_REQUEST['status'];
			$arrData['email'] = $_REQUEST['email'];
			$arrData['email_dis'] = isset($_REQUEST['email_dis']) ? $_REQUEST['email_dis'] : 'No' ;
			$arrData['email_dnd'] = isset($_REQUEST['email_dnd']) ? $_REQUEST['email_dnd'] : 'No' ;
			$arrData['website'] = $_REQUEST['website'];
			$arrData['website_dis'] = isset($_REQUEST['website_dis']) ? $_REQUEST['website_dis'] : 'No' ;
			$arrData['website_dnd'] = isset($_REQUEST['website_dnd']) ? $_REQUEST['website_dnd'] : 'No' ;
			$arrData['mobile'] = $_REQUEST['mobile'];
			$arrData['mobile_dis'] = isset($_REQUEST['mobile_dis']) ? $_REQUEST['mobile_dis'] : 'No' ;
			$arrData['mobile_dnd'] = isset($_REQUEST['mobile_dnd']) ? $_REQUEST['mobile_dnd'] : 'No' ;
			$arrData['landline'] = $_REQUEST['landline'];
			$arrData['landline_dis'] = isset($_REQUEST['landline_dis']) ? $_REQUEST['landline_dis'] : 'No' ;
			$arrData['landline_dnd'] = isset($_REQUEST['landline_dnd']) ? $_REQUEST['landline_dnd'] : 'No' ;
			
			if ($intCompanyId != '')
			{
				$strCondition = "company_id='$intCompanyId'";
				//$objControl->createRecord($arrData, "company_master", $strCondition);
			//	$arrData['company_id']= $objControl->dbConnect->Insert_ID();
			}else{
				//$objControl->createRecord($arrData, 'company_master');
			//	$arrData['company_id']= $objControl->dbConnect->Insert_ID();
			}
			
			if($intCompanyId !='')
			{
				$arrData['company_id'] = $intCompanyId;
			}
			else{
				$arrData['company_id'] = $arrData['company_id'];
			}
			
			$arrCat = $_REQUEST['category_id'];
			$strSQL = "DELETE FROM company_category where company_id='".$_REQUEST['company_id']."'";
		//	$objControl->dbConnect->Execute($strSQL);
			/*	foreach ($arrCat as $categories)
				{
						$arrData['category_id']=$categories;
						$objControl->createRecord($arrData, 'company_category');
				}*/
			$intCompanyProfileId = $_REQUEST['company_profile_id'];
			$arrData['company_description'] = $_REQUEST['company_description'];
			
			$hoursOfOperation = array(
							'sunday' => array('sunday_from'=> $_REQUEST['sunday_from'],
												'sunday_to' => $_REQUEST['sunday_to'],
												'sunday_closed' => isset($_REQUEST['sunday_closed']) ? $_REQUEST['sunday_closed'] : 'No'),
							'monday' =>  array('monday_from'=> $_REQUEST['monday_from'],
												'monday_to' => $_REQUEST['monday_to'],
												'monday_closed' => isset($_REQUEST['monday_closed']) ? $_REQUEST['monday_closed'] : 'No'),
							'tuesday' => array('tuesday_from'=> $_REQUEST['tuesday_from'],
												'tuesday_to' => $_REQUEST['tuesday_to'],
												'tuesday_closed' => isset($_REQUEST['tuesday_closed']) ? $_REQUEST['tuesday_closed'] : 'No'),
							'wednesday' => array('wednesday_from'=> $_REQUEST['wednesday_from'],
												'wednesday_to' => $_REQUEST['wednesday_to'],
												'wednesday_closed' => isset($_REQUEST['wednesday_closed']) ? $_REQUEST['wednesday_closed'] : 'No'),
							'thursday' => array('thursday_from'=> $_REQUEST['thursday_from'],
												'thursday_to' => $_REQUEST['thursday_to'],
												'thursday_closed' => isset($_REQUEST['thursday_closed']) ? $_REQUEST['thursday_closed'] : 'No'),
							'friday' => array('friday_from'=> $_REQUEST['friday_from'],
												'friday_to' => $_REQUEST['friday_to'],
												'friday_closed' => isset($_REQUEST['friday_closed']) ? $_REQUEST['friday_closed'] : 'No'),
							'saturday' => array('saturday_from'=> $_REQUEST['saturday_from'],
												'saturday_to' => $_REQUEST['saturday_to'],
												'saturday_closed' => isset($_REQUEST['saturday_closed']) ? $_REQUEST['saturday_closed'] : 'No'),
						);
			
					$dataAttributes = array_map(function($value, $key) {
						$value = array_map(function($value1, $key1) {
											return $key1.'='.$value1;
										}, array_values($value), array_keys($value));
								$newvalue = implode(',', $value);
						return $newvalue;
					}, array_values($hoursOfOperation), array_keys($hoursOfOperation));

			$arrData['hours_of_operation']	= implode(',', $dataAttributes);	
			$arrData['company_profile_status'] = $_REQUEST['company_profile_status'];
			$arrData['payment_options'] = @implode(',', $_REQUEST['paymentOptions']);
				
				if ($intCompanyProfileId != '')
				{
					$strCondition = "company_profile_id='$intCompanyProfileId'";
					//$objControl->createRecord($arrData, "company_profile", $strCondition);
				}else{
					//$objControl->createRecord($arrData, 'company_profile');
				}
			$intCompanyContactId = $_REQUEST['company_contact_id'];
			$arrContact = $_REQUEST['contact_full_name'];
			$arrDOBContact = $_REQUEST['dob'];
			$arrDOMContact = $_REQUEST['dom'];
			$arrmobileContact = $_REQUEST['contact_mobile'];
			$arremailContact = $_REQUEST['contact_email'];
			$arrdesiContact = $_REQUEST['designation'];
			$arrConStatus = $_REQUEST['contact_status'];
			
			//$objControl->dbConnect->debug = true;
			$strSQL = "DELETE FROM company_contact where company_id='".$_REQUEST['company_id']."'";
		//	$objControl->dbConnect->Execute($strSQL);
				for ($intContact = 0; $intContact < count($arrContact); $intContact++)
					{
						$arrData['contact_full_name']=$arrContact[$intContact];
						$arrData['dob']=$arrDOBContact[$intContact];
						$arrData['dom']=$arrDOMContact[$intContact];
						$arrData['contact_mobile']=$arrmobileContact[$intContact];
						$arrData['contact_email']=$arremailContact[$intContact];
						$arrData['designation']=$arrdesiContact[$intContact];
						$arrData['contact_status']=$arrConStatus[$intContact];
						//$objControl->createRecord($arrData, 'company_contact');
					}
			$intCompanyAdvertiseId = $_REQUEST['company_advertise_id'];
			$arrData['data_source'] = $_REQUEST['data_source'];
			$arrData['ad_city'] = $_REQUEST['ad_city'];
			$arrData['budget'] = $_REQUEST['budget'];
			$arrData['year'] = $_REQUEST['year'];
			$arrData['ad_date'] = $_REQUEST['ad_date'];
			$arrData['page'] = $_REQUEST['page'];
			$arrData['ad_status'] = $_REQUEST['ad_status'];
			if ($intCompanyAdvertiseId != '')
				{
					$strCondition = "company_advertise_id='$intCompanyAdvertiseId'";
			//		$objControl->createRecord($arrData, "company_advertise", $strCondition);
				}else{
				//	$objControl->createRecord($arrData, 'company_advertise');
				}
			header('Location:' . HTTP_PATH . 'company.php');
			exit;
			break;
			
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