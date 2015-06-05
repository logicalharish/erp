<?php 
#echo $_SERVER['SERVER_NAME'].'/erp/controller/dbConnect.php';die;
@session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/erp/controller/dbConnect.php';
class CommonController 
{	
	public $dbconnect;
	//Data base connection throught adodb
	public function __construct()
	{
		global $db;
		$this->dbConnect = $db;
	}
	
	public function getMenu()
	{
		$strSQL = "SELECT * FROM area_master";
		$rsData = $this->dbConnect->getAll($strSQL);
		return $rsData;
	}
	
	//Function to login
	public function login()
	{
		
		$safeUsername=mysql_real_escape_string($_POST['username']);
		$safePassword=mysql_real_escape_string($_POST['password']);

		$userCount = $this->dbConnect->getAll("Select count(0), user_id from user_master where BINARY username ='".$safeUsername."' and BINARY password = '".$safePassword."'");
		
		if($userCount[0]['count(0)']==1)
		{
			$this -> getUserDetails($safeUsername);
			
			header('location:index.php');
			exit;
		}
		else
		{
		?> <div width="500px" class="alert alert-error"><strong>Please enter a valid username or password.
		<?php session_destroy();
		?></strong></div>
		<?php 
		}			
	}
	
	//Function to get the User Detail
	function getUserDetails($safeUsername)
	{
		global $db;
		$strQuery  = "SELECT um.user_id, name, username, GROUP_CONCAT(umm.module_id
					ORDER BY umm.module_id) AS user_modules, role_name,role_id, rm.`public_read` AS normal_read, rm.`public_create` AS normal_create, rm.`public_update` AS normal_update, rm.`public_delete` AS normal_delete
					FROM user_master AS um
					JOIN role_master AS rm ON user_role_id = role_id
					JOIN user_module_master AS umm ON um.user_id = umm.user_id
					JOIN module_master AS mm ON mm.module_id = umm.module_id
					WHERE um.username = '".$safeUsername."'";
					
		$arrUserDetails = $db -> getAll($strQuery);
						
		$strQuery1  = "SELECT *, GROUP_CONCAT(module_name) AS modules, GROUP_CONCAT(module_menu_link) AS menu_link, 
						GROUP_CONCAT(module_menu_icon) AS menu_icon
						FROM module_master, user_master
						WHERE FIND_IN_SET(module_id,(
						SELECT group_concat(module_id  order by module_id)
						FROM user_module_master
						where user_id = '".$arrUserDetails[0]['user_id']."')) and username= '".$safeUsername."'";
			
		$arrUserModules = $db -> getAll($strQuery1);
		
		$_SESSION['user'] = array(
			'username'          => $arrUserDetails[0]['username'],
			'user_id'           => $arrUserDetails[0]['user_id'],
			'user-role'         => $arrUserDetails[0]['role_name'],
			'role_id'           => $arrUserDetails[0]['role_id'],
			'module_id'         => $arrUserDetails[0]['user_modules'],
			'module_names'      => $arrUserModules[0]['modules'],
			'module_menu_links' => $arrUserModules[0]['menu_link'],	
			'module_menu_icons' => $arrUserModules[0]['menu_icon'],
			'normal_read'       => $arrUserDetails[0]['normal_read'],
			'normal_create'     => $arrUserDetails[0]['normal_create'],
			'normal_update'     => $arrUserDetails[0]['normal_update'],
			'normal_delete'     => $arrUserDetails[0]['normal_delete'],
			'database'          => $arrUserDetails[0]['database_name'],
			'client_id'         => $arrUserDetails[0]['client_id'],
		);
		//echo '<pre>';print_r($_SESSION['user']);exit;
		
		$strQuery2 = "Select count(0) as count from privileged_user where user_id = ".$arrUserDetails[0]['user_id'];
		$arrayPrivUserCount = $db -> getAll($strQuery2);
		if($arrayPrivUserCount[0][count] > 0)
		{
			$strQuery3 = "Select * from privileged_user as pu, module_master as mm where user_id = ".$arrUserDetails[0]['user_id']." and pu.module_id = mm.module_id";
			$arrayPrivUserDetails = $db -> getAll($strQuery3);
			for($intIndex = 0; $intIndex < count($arrayPrivUserDetails); $intIndex++)
			{
				$strModuleName = $arrayPrivUserDetails[$intIndex]['module_name'];
				$_SESSION['priv_user'][$strModuleName]['module_id'] = $arrayPrivUserDetails[$intIndex]['module_id'];
				$_SESSION['priv_user'][$strModuleName]['create'] = $arrayPrivUserDetails[$intIndex]['priv_create'];	
				$_SESSION['priv_user'][$strModuleName]['read'] = $arrayPrivUserDetails[$intIndex]['priv_read'];
				$_SESSION['priv_user'][$strModuleName]['update'] = $arrayPrivUserDetails[$intIndex]['priv_update'];
				$_SESSION['priv_user'][$strModuleName]['delete'] = $arrayPrivUserDetails[$intIndex]['priv_delete'];
			}
			
		}
		//echo '<pre>';print_r($_SESSION['user']['priv_user'][$strModuleName]);exit;
		$strQuery4 = 'Update user_master set is_role_updated = "N" where user_id = "'.$_SESSION['user']['user_id'].'"';
		$db-> Execute($strQuery4);
	}

	//Function to get the records for listing
	function getRecords($strTableName, $strColumnName = '', $strUrlParameterValue = '',$strOrderBy = '')
	{
			$strQuery = 'Select * from '.$strTableName;
			if($strCoulumnName != null || $strUrlParameterValue != null)
			{
				$strQuery.= ' where '.$strColumnName.' = '.$strUrlParameterValue;		
			}

			if($strOrderBy!='')
			{
				$strQuery .= ' order By '.$strOrderBy;
			}
			//echo $strQuery;
			$rsData = $this->dbConnect->getAll($strQuery);
			return $rsData;
	}

	//Function to create The record
	function createRecord($arrData, $strTableName, $strCondition='')
	{
		#$this->dbConnect->debug = true;
		if($strCondition !='')
		{
			$arrData['modified_datetime'] = date('y-m-d h:m:s');
			$arrData['modified_by'] = $_SESSION['user']['user_id'];
			$this->dbConnect->AutoExecute($strTableName,$arrData,'UPDATE',$strCondition);
			$strResult = 'Record Added Sucessfully';
		}
		else
		{
			$arrData['created_datetime'] = date('y-m-d h:m:s');
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			$this->dbConnect->AutoExecute($strTableName,$arrData,'INSERT');
			$strResult = 'Record Added Sucessfully';
		}
		return $strResult;
	}
	
	//Funtion to dete the records
	function deleteRecord($strTableName, $strkeyColoum, $strValue)
	{
			$strSQL = "DELETE FROM ".$strTableName." WHERE ".$strkeyColoum."=".$strValue;
			
			$this->dbConnect->Execute($strSQL);
			if($this->dbConnect->affected_rows()>0)
			{
				$strResult = "Record deleted sucessfully";
			}	
			else
			{
				$strResult = "There was some issue, Record not deleted";	
			}
			return $strResult;
	}

	public function saveCategory( $strCategoryId)
		{
			$arrField = array('category_name');
			$arrCategory = $this->getRecords("category_master",'','','category_name',$arrField);
			$arrCateg = array();
			for($intIndex = 0; $intIndex <count($arrCategory); $intIndex++)
			{
				$arrCateg[] = trim(strtolower($arrCategory[$intIndex]['category_name']));
			}
			
			if($strCategoryId !='')
			{
				$arrCat = explode(',',$strCategoryId);
				for($intIndex =0; $intIndex < count($arrCat); $intIndex++)
				{
					
					if(!in_array(trim(strtolower($arrCat[$intIndex])), $arrCateg) && trim(strtolower($arrCat[$intIndex])) != "")
					{
						echo '<br>'.$arrCat[$intIndex];echo '<br>';
						echo '<br>';
						echo '<br>';

						$arrData['category_name'] = $arrCat[$intIndex];
						$this->dbConnect->AutoExecute('category_master',$arrData,'INSERT');
					}
					
				}
			}

		}


	

}