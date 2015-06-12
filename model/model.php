<?php 

	#Page contains all the functions for controlling the view of the CMS
	class model
	{
		
		# Function establishes connection with the database
		function connect()
		{	
			global $db;
			$this->db = $db;
		}
		
		
		# Function fetches the Current Page URL
		function getCurrentPageURL()
		{
			$strCurrentPage = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],"?")+1);
			return $strCurrentPage;
		}
		
		# Function fetches the Current Page URL
		function getCurrentPageURLFrontEnd()
		{
			$strCurrentPage = strrchr( $_SERVER['REQUEST_URI'] , '/' );
			$strCurrentPage = substr($strCurrentPage , strrpos($strCurrentPage,"/")+1);
			return $strCurrentPage;
		}
		
		
		# Function gets the current included file name
		function getFileName()
		{
			$strFileName = $_REQUEST['file_name'];
			return $strFileName;	
		}
		
		
		/* Function manages user sessions
		 * If a user types the address of the cms, and he has not already been logged in, he is redirected to the login page.
		 * If a user has already been logged in and he tries to access the login page, then he is redirected to the main landing page of the CMS.
		 * If a user has clicked on the logout button, his session is destroyed and he is taken to the login page again.
		*/
		function checkSession()
		{
			$strPageName = $this-> getCurrentPageURLFrontEnd();
			#echo $strPageName;exit;
			if($strPageName == 'login.php' || $strPageName == 'login')
			{
			
				if(isset($_SESSION['user']['username']) && !isset($_GET['action']) && $_GET['action'] != 'logout')
				{
					header('location:index.php');
					exit;
				}
			}
			else if($strPageName != 'login.php')
			{	
				if(isset($_SESSION['user']['username']))
				{
					if(isset($_GET['action']) || $_GET['action']== 'logout')
					{
						header('location:login.php');
						session_destroy();
						exit;
					}
					else
					{
						
					}
				}
				else if(!isset($_SESSION['user']['username']))
				{
					header('location:login.php');
					session_destroy();	
					exit;
				}
			}
		}
		
		/* Function displays values in the input elements from the database if the screen is used for updating an already existing record
		 * @param $strControlType - Defines the type of the input element
		 * @param $strArrayField  - Defines the name of the array whose values are fetched from the respective record set */
		function retainRecords($strControlType, $strArrayField)
		{
			switch($strControlType)
			{
				case 'text':
					echo (isset($strArrayField)? $strArrayField:'');
					break;
					
				case 'select':
					echo (isset($strArrayField));
					break;
					
			 	case 'radio':
					echo '';
					break;
					
				case 'checkbox':
					echo($strArrayField=='Yes'?'checked':'');
					break;
			}
		}
		
		/* Function checks if the edit screen opened is being used to add a new record or update an already existing record 
		 * @param $strParameter    - the URL parameter that has been passed fot changing the screen's functionality from add to update. This variable also holds the parameter's value
		 * @param $strFunctionName - the function(for fetching records from the database) that gets called if the URL parameter is set
		 * @param $strTableName    - the table from which the records are to be fetched
		 * @param $strColumnName   - the database field name which is validated for updating the record
		*/
		function validateEditing($strParameter, $strFunctionName, $strTableName, $strColumnName, $strModuleName)
		{
			if(isset($strParameter))
			{
				$arrRecord = $this -> $strFunctionName($arg1 = $strTableName, $arg2 = $strColumnName, $arg3 = $strParameter, $arg4 = $strModuleName);
				return $arrRecord;
			}
		}
		
		
		/* Function fetches the records from the database
		 * @param $strTableName         - the table from which the records need to be fetched
		 * @param $strColumnName        - the column(primary key) which is validated for updating a particular record
		 * @param $strUrlParameterValue - the primary key value for which the record is updated
		 * @param $strModuleName        - used if a complex query for a prticular module is required
		*/
		function getRecords($strTableName, $strColumnName, $strUrlParameterValue, $strModuleName)
		{
			global $db;
			
			# $strModuleName is used to check whether a complex query is required or not
			
			switch($strModuleName)
			{
				case null:
				$strQuery = 'Select * from '.$strTableName;
				if($strCoulumnName != null || $strUrlParameterValue != null)
				{
					$strQuery.= ' where '.$strColumnName.' = '.$strUrlParameterValue;		
				}
				break;
				
				case 'user':
				if($_SESSION['user']['user-role']=='Master-Admin')
				{
					$strQuery = 'Select *, role_name from user_master as um join role_master as rm  on um.user_role_id = rm.role_id where rm.is_master_admin="N"';
				}
				else if($_SESSION['user']['user-role']=='Admin') 
				{
					$strQuery = 'Select user_id,first_name,last_name,email,username,rm.role_name from user_master as um join role_master as rm on user_role_id=role_id where um.assigned_to ="'.$_SESSION['user']['user_id'].'"';		
				}
				else 
				{
					$strQuery = 'Select user_id,first_name,last_name,email,username,rm.role_name from user_master as um join role_master as rm on user_role_id=role_id where um.user_id ="'.$_SESSION['user']['user_id'].'"';		
				}
				break;
				
				case 'user-edit':
 				$strQuery = 'select *, group_concat(module_name) as modules from module_master, user_master where FIND_IN_SET(module_id,(select user_modules from user_master where user_id = '.$_GET['id'].')) and user_id='.$_GET['id'].'';
				break;
				
				case 'user-edit-available-modules':
				$strQuery = 'select umm.module_id, mm.module_name,mm.module_menu_icon,mm.module_menu_link from user_module_master as umm JOIN module_master as mm on umm.module_id = mm.module_id where user_id ="'.$_SESSION['user']['user_id'].'"';
				break;
				
				case 'user-edit-available-roles';
				$strQuery = 'Select role_id, role_name from role_master where role_id >= "'.$_SESSION['user']['role_id'].'"';
				break;
				
				case 'user-company':
				if($_SESSION['user']['user-role']=='Master-Admin')
				{
					$strQuery = 'Select cm.*,um.first_name,um.last_name,um.assigned_to from company_master as cm join user_master as um  on cm.user_id = um.user_id ';
				}
				else if($_SESSION['user']['user-role']=='Admin') 
				{
					$strQuery = 'Select cm.*,um.first_name,um.last_name,um.assigned_to from company_master as cm join user_master as um  on cm.user_id = um.user_id where um.assigned_to="'.$_SESSION['user']['user_id'].'"';		
				}
				else 
				{
					$strQuery = 'Select cm.*,um.first_name,um.last_name,um.assigned_to from company_master as cm join user_master as um  on cm.user_id = um.user_id where um.user_id="'.$_SESSION['user']['user_id'].'"';		
				}
				break;
				
				case 'privileged_user_available_modules';
				$strQuery = 'select * from user_module_master JOIN module_master on user_module_master.module_id = module_master.module_id where user_id = "'.$_SESSION['user']['user_id'].'"';
				break;
				
				case 'menu':
				$strQuery = 'select  * , group_concat(module_name) as modules, group_concat(module_menu_link) as menu_link from module_master, user_master where FIND_IN_SET(module_id,(select user_modules from user_master where 
							 user_id = '.$_SESSION['user_id'].')) and 																																																		                             user_id='.$_SESSION['user_id'].'';
				break;
				
				case 'page-edit':
				$strQuery = 'select * from page_master as pm JOIN page_details as pd on pm.page_id = pd.page_id and pm.page_id = '.$strUrlParameterValue;
				break;
				
				case 'parent-page':
				$strQuery = 'Select page_title, page_id from page_master order by page_id';
				break;
				
				case 'widget-list':
				$strQuery = 'Select page_id, page_title from page_master where is_widget = "Yes"';
				break;
				
				case 'clients-edit':
				$strQuery = 'Select * from client_master as cm JOIN user_master as um on cm.client_id = um.client_id where cm.client_id = '.$strUrlParameterValue;
				break;
				
				case 'users-list':
				$strQuery = 'Select * from user_master where client_id = '.$_SESSION['user']['client_id'];
				break;
				
				case 'user-details':
			//	$strQuery = 'select is_role_updated from user_master where user_id = '.$_SESSION['user']['user_id'];
				$strQuery= 'select * from user_master as um JOIN role_master as rm on um.user_role_id = rm.role_id where '.$strColumnName.' = '.$strUrlParameterValue;
				break;
				
				case 'privileged_user':
				$strQuery = 'Select * from privileged_user where user_id = '.$_GET['id'].' order by module_id';
				break;
				
				case 'authorising_user_privileged_modules';
				$strQuery = 'Select * from privileged_user where user_id ='. $_SESSION['user']['user_id'].' order by module_id';
				break;
				
				case 'homePageCount';
				$strQuery = 'SELECT (SELECT COUNT(0) FROM page_master) AS pages_count,( SELECT COUNT(0) FROM post_master) AS posts_count';
				break;
				
				//Cases for frontend
				case 'frontEndPageDetails';
				$strCurrentPageName = $this -> getCurrentPageURLFrontEnd();
				if(trim($strCurrentPageName) == '' || $strCurrentPageName == 'index.php')
				{
					$strQuery = ' select * from page_master as pm JOIN page_details as pd where pm.page_id = pd.page_id and pm.page_url = "index.php" and status ="active"';
				}
				else
				{
					$strQuery = ' select * from page_master as pm JOIN page_details as pd where pm.page_id = pd.page_id and pm.page_url = "'.$strCurrentPageName.'" and status ="active"';
				}
				break;
				
				case 'careerPosts';
				$strQuery = 'Select *, date_format(created_datetime, "%d %M %y") as time from post_master where status = "Active" order by seq_no';
				break;
				
				case 'testimonials';
				$strQuery = 'Select * from testimonial_master where status = "Active" order by seq_no';
				break;
				
				case 'services';
				$strQuery = 'Select * from post_master where status = "Active" order by seq_no';
				break;		
				
				case 'store_items';
				$strQuery ='SELECT * FROM store_item_master JOIN store_item_category_master ON store_item_master.item_category = store_item_category_master.id JOIN banner_master on banner_master.banner_id = store_item_master.item_thumbnail_id';
				break;		
			}
			
			$rsRecords = $db -> getAll($strQuery);
			return $rsRecords;
		}
		
		/* Function returns a notification alert every time a record id added or updated 
		 * @param $strModuleType - the module to which the record belongs to
		 * $_SESSION['notification'] is set everytime a record id added or updated		
		*/
		function notificationAlert($strModuleType)
		{
				if(isset($_SESSION['notification']))
				{
					echo '<div style="text-align:center;" class="alert alert-success">'.$_SESSION['notification'].'<a href="#"> View '.$strModuleType.'</a></div>';
					unset($_SESSION['notification']);
				}
		}
		
		function getModuleDetails($strModuleName)
		{
			switch ($strModuleName)
			{			
				case 'clients':
				$arrModuleDetails['table_name'] = 'client_master';
				break;
				
				case 'pages':
				$arrModuleDetails['table_name'] = 'page_master';
				break;
				
				case 'posts':
				$arrModuleDetails['table_name'] = 'post_master';
				break;
				
				case 'website':
				$arrModuleDetails['table_name'] = 'website_details_master';
				break;
				
				case 'banners':
				$arrModuleDetails['table_name'] = 'banner_master';
				break;
				
				case 'reviews':
				$arrModuleDetails['table_name'] = 'review_master';
				break;
				
				case 'testimonials':
				$arrModuleDetails['table_name'] = 'testimonial_master';
				break;
			}
			
			return $arrModuleDetails['table_name'];
		}
		
		/* Function manages permissions on a local level
		   @param $strPermissionType - the permission type(create, read, update, delete)
		*/
		function userCan($strPermissionType)
		{						
			global $db;
			if(isset($_SESSION['priv_user'][$_GET['file_name']][$strPermissionType]))
			{
				switch ($strPermissionType)
				{			
					case 'read':
					$strPermissionValue = $_SESSION['priv_user'][$_GET['file_name']][$strPermissionType];
					break;
					
					case 'create':
					$strPermissionValue = $_SESSION['priv_user'][$_GET['file_name']][$strPermissionType];
					break;
					
					case 'update':
					$strPermissionValue = $_SESSION['priv_user'][$_GET['file_name']][$strPermissionType];
					break;
					
					case 'delete':
					$strPermissionValue = $_SESSION['priv_user'][$_GET['file_name']][$strPermissionType];
					break;
				}	
			}
			else
			{
				switch ($strPermissionType)
				{			
					case 'read':
					$strPermissionValue = $_SESSION['user']['normal_read'];
					break;
					
					case 'create':
					$strPermissionValue = $_SESSION['user']['normal_create'];
					break;
					
					case 'update':
					$strPermissionValue = $_SESSION['user']['normal_update'];
					break;
					
					case 'delete':
					$strPermissionValue = $_SESSION['user']['normal_delete'];
					break;
				}
			}	
			
			if($strPermissionValue == 'Y')
			{
				return true;
				exit;	
			}
		}
				
		/* Function generates the action buttons for the listing screens
		 * @param $intRecordId     - the record ID in the database that gets updated
		 * @param $strRecordStatus - the records status in the database. Can be active or inactive
		 * @param $strModuleName   - the current module
		*/
		function getActionButtons($intRecordId, $strRecordStatus, $strModuleName)
		{
			if($strRecordStatus == 'Active')
			{
				$strStatusButtonIcon = 'icon-envelope';
				$strStatusButtonText = 'Save as Draft';
				$strDataNoty         = '{"text":"Saved as Draft","layout":"topCenter","type":"alert","animateOpen": {"opacity": "show"}}';
			}
			else
			{
				$strStatusButtonIcon = 'icon-upload';
				$strStatusButtonText = 'Publish'	;
				$strDataNoty         = "{'text':'Page Published','layout':'topCenter','type':'alert','animateOpen': {'opacity': 'show'}}";
			}
			
			$strAjaxFunction = "changeStatus(this, 'Published', 'Saved as Draft');";
			
			if($this -> userCan('update'))
			{	
				echo '<a href="'.$_GET['file_name'].'/edit/'.$intRecordId.'"  class="btn btn-info">
						<i class="icon-edit icon-white"></i>  
							Edit  
					  </a> ';
			}
			if($this -> userCan('delete'))
			{
				echo '<a href="#"class="btn btn-info" onclick="deleteRecord(this);" id='.$intRecordId.'>
						<i class="icon-trash icon-white"></i>  
							Delete
					 </a> ';
			}
			if($this -> userCan('update'))
			{
				echo '<a href="#"class="btn btn-info status-btn noty" onclick="'.$strAjaxFunction.'" id="'.$intRecordId.'" data-noty-options="'.$strDataNoty.'">
						<i class="icon-white '.$strStatusButtonIcon.'"></i>  
						<span class="statusButtonText'.$intRecordId.'">'. $strStatusButtonText.'</span>  
					 </a>
					 <img src="'.IMAGE_PATH.'/loading.gif" id="loadingmessage" style="display:none;position:absolute; margin-left:2px;" width="15"> ';
			}
		}
		
		/*
		--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	FRONTEND FUNCTIONS START HERE
		--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		*/
		
		
		
		/* Function generates a dynamic navigation menu for the frontend
		 * @param $parent - the parent ID for which the childrens will be fetched
		*/
		function generateNavMenu($parent)
		{
			global $db;
			$strQuery = 'SELECT page_title, page_url, page_id,(
							SELECT COUNT(0)
							FROM page_master
							WHERE parent_page = child_table.page_id) AS child_count
							FROM page_master AS child_table
							WHERE child_table.parent_page = "'.$parent.'" and in_nav_menu = "Yes" and status="Active" order by seq_no';
			$arrCurrentLevelPages = $db -> getAll($strQuery);
			
			$count = count($arrCurrentLevelPages);
			$strNavMenuHtml = '';
			if($parent == 0)
			{
				$strNavMenuHtml.= '<ul class="nav primary-nav pull-right">';
			}
			else
			{
				$strNavMenuHtml.= '<ul>';
			}
			for($count1 = 0; $count1 < $count; $count1++)			
			{
				if($arrCurrentLevelPages[$count1]['child_count'] > 0)
				{
					$strNavMenuHtml.= '<li><a href="'.FRONTEND_HTTP_PATH.$arrCurrentLevelPages[$count1]['page_url'].'">'.$arrCurrentLevelPages[$count1]['page_title'].'</a>';	
					$strNavMenuHtml.= $this->generateNavMenu($arrCurrentLevelPages[$count1]['page_id']);
					$strNavMenuHtml.= '</li>';
				}
				else
				{
					$strNavMenuHtml.= '<li><a href="'.FRONTEND_HTTP_PATH.$arrCurrentLevelPages[$count1]['page_url'].'">'.$arrCurrentLevelPages[$count1]['page_title'].'</a>';	


				}
			}
			$strNavMenuHtml.= '</ul>';
			return $strNavMenuHtml;
		}
		
		/*
			Function gets widgets for a particular page
			@param $intWidgetId - the widgetId for a current page.
		*/
		function getWidgetDetails($intWidgetId)
		{
			global $db;
			$strQuery = 'select * from page_master as pm JOIN page_details as pd where pm.page_id = pd.page_id and pm.page_id in ('.$intWidgetId.') and status ="active"';
			//echo $strQuery;
			$arrWidgetDetails = $db-> getAll($strQuery);
			return $arrWidgetDetails;
		}
		
		function sendMessage()
		{
			$strName            =   $_POST['name'];
			$strEmail           =   $_POST['email'];
			$strPhone           =   $_POST['phone'];
			$strMessage         =   $_POST['message'];
			
			$strBody    =   "<table><tr><td>Name: </td><td>";
			$strBody    .=   $strName;
			$strBody    .=   "</td></tr><tr><td>Email: </td><td>";
			$strBody    .=   $strEmail;
			$strBody    .=   "</td></tr><tr><td>Phone: </td><td>";
			$strBody    .=   $strPhone;
			$strBody    .=   "</td></tr><tr><td>Message: </td><td>";
			$strBody    .=   $strMessage;
			$strBody    .=   "</td></tr></table>";
			
			$strSubject  = 'New Contact Us Requested';
			$this -> sendMail($strSubject, $strBody);	
		}
		
		function makeAnAppointment()
		{
			$strFirstName       =   $_POST['txt_first_name'];
			$strEmail           =   $_POST['txt_email'];
			$strPhone           =   $_POST['txt_phone'];
			$strAddress         =   $_POST['txt_address'];
			$strCity            =   $_POST['txt_city'];
			$strState           =   $_POST['txt_state'];
			$strZip             =   $_POST['txt_zip'];
			$strAppointmentType =   $_POST['reason_comments'];
			$strAppDate1        =   $_POST['txt_demo_date'];
			$strAppTime1        =   $_POST['calltime_demo_date'].' '.$_POST['slt_ampm_demo_date'];
			$strAppDate2        =   $_POST['txt_demo_date2'];
			$strAppTime2        =   $_POST['calltime_demo_date2'].' '.$_POST['slt_ampm_demo_date2'];
			$strComments        =    $_POST['Taara_comments'];

			
			
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
			
			$this -> sendMail($strSubject, $strBody);	
		}
		
		function sendMail($strSubject, $strBody)
			{
				include('php/class.phpmailer.php');
				$objMail = new PHPMailer(true);
				$objMail->IsSMTP();
			
				$objMail->SMTPAuth   = true;                  // enable SMTP authentication
				$objMail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$objMail->Host       = "smtp.gmail.com"; // sets the SMTP server
				$objMail->Port       = 465;                    // set the SMTP port for the SMTP server
				$objMail->Username   = "website4mdtesting@gmail.com"; // SMTP account username
				$objMail->Password   = "website4mdtest";        // SMTP account password
			    $objMail->SMTPDebug  = 1;
				$objMail->From       = "website4mdtesting@gmail.com";
				$objMail->FromName   = "Capitol Cardiology Associates";
				$objMail->Subject    = $strSubject;
				$objMail->MsgHTML($strBody);
			
				$objMail->AddAddress("anshulk@meditab.com");
				
				$objMail->Send();
				
				$_SESSION['data'] = '<p>Thank you for contacting us. We have received your email and will get back to you shortly.</p>';
				header('Location:'.FRONTEND_INDEX_PATH.'thank-you');
		}

		function getChildrenPages($strPageUrl)
		{
			global $db;
			$strQuery = 'Select page_id, page_title, page_url from page_master where parent_page = (select page_id from page_master where page_url = "'.$strPageUrl.'") and status = "Active" order by seq_no';
			$arrChildrenPages = $db-> getAll($strQuery);
			return $arrChildrenPages;
		}
		
		function getPageDetailsForAJAX($strUrl)
		{
			global $db;
			$strQuery = 'select * from page_master as pm JOIN page_details as pd where pm.page_id = pd.page_id and pm.page_url = "'.$strUrl.'" and status ="active"';
			$rsPageDetails = $db -> getAll($strQuery);
			echo json_encode($rsPageDetails[0]['page_description']);
		}
		
		function getTemplateDetails($strPageUrl)
		{
			global $db;
			$strQuery = 'select * from page_master as pm JOIN page_details as pd where pm.page_id = pd.page_id and pm.page_url = "'.$strPageUrl.'" and status ="active"';
			$rsTemplateDetails = $db-> getAll($strQuery);
			return $rsTemplateDetails;
		}	
		
		function getBannersForHomePage($strBannerIds)
		{
			global $db;
			$strQuery = 'select * from banner_master join website_details_master on find_in_set(banner_id, homepage_banners) order by find_in_set(banner_id, homepage_banners)';	
			$rsBannerDetails = $db->getAll($strQuery);
			return $rsBannerDetails;
		}
		
		function clickToSort($strSelectedIDs)
		{
			
			global $db;
			
			if(trim($strSelectedIDs) == '')
			{
				$strCondtion = '';	
			}
			else
			{
				$strCondtion = 'WHERE FIND_IN_SET(store_item_category_master.id, "'.$strSelectedIDs.'")';		
			}
			
			$strQuery = 'SELECT * FROM store_item_master JOIN store_item_category_master ON store_item_master.item_category = store_item_category_master.id JOIN banner_master on banner_master.banner_id = store_item_master.item_thumbnail_id '.$strCondtion ;
			
			$rsItemsInSet = $db->getAll($strQuery);
			
			$isEmpty = array_filter($rsItemsInSet);
			if (!empty($isEmpty)) {
				echo json_encode($rsItemsInSet);
			}
			else
			{
				echo '';	
			}
			
		}
	}	
	
?>