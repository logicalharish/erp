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
		
		$safeUsername=mysql_real_escape_string($_POST['l_username']);
		$safePassword=mysql_real_escape_string($_POST['l_password']);

		$userCount = $this->dbConnect->getAll("Select count(0), user_id from user_master where BINARY username ='".$safeUsername."' and BINARY password = '".$safePassword."'");
		
		if($userCount[0]['count(0)']==1)
		{
			$this -> getUserDetails($safeUsername);
			
			header('location:index.php');
			exit;
		}
		else
		{
			session_unset();
			session_destroy();
		?> <div width="500px" class="alert alert-error"><strong>Please enter a valid username or password.</strong></div>
		<?php 
		}			
	}
	
	//Function to get the User Detail
	function getUserDetails($safeUsername)
	{
		global $db;
		$strQuery  = "SELECT um.user_id, first_name,last_name, username, GROUP_CONCAT(umm.module_id
					ORDER BY umm.module_id) AS user_modules, role_name,role_id, rm.`public_read` AS normal_read, rm.`public_create` AS normal_create, rm.`public_update` AS normal_update, rm.`public_delete` AS normal_delete
					FROM user_master AS um
					JOIN role_master AS rm ON user_role_id = role_id
					JOIN user_module_master AS umm ON um.user_id = umm.user_id
					JOIN module_master AS mm ON mm.module_id = umm.module_id
					WHERE um.username = '".$safeUsername."'";
					
		$arrUserDetails = $db -> getAll($strQuery);
						
		$strQuery1  = 	"SELECT GROUP_CONCAT(module_id) AS module_ids, GROUP_CONCAT(module_name) AS modules, GROUP_CONCAT(module_menu_link) AS menu_link, 
						GROUP_CONCAT(module_menu_icon) AS menu_icon
						FROM module_master
						WHERE FIND_IN_SET(module_id,(
						SELECT group_concat(module_id  order by module_id)
						FROM user_module_master
						where user_id = '".$arrUserDetails[0]['user_id']."' ))";
			
		$arrUserModules = $db -> getAll($strQuery1);
		
		$_SESSION['user'] = array(
			'username'          => $arrUserDetails[0]['username'],
			'user_id'           => $arrUserDetails[0]['user_id'],
			'user-role'         => $arrUserDetails[0]['role_name'],
			'role_id'           => $arrUserDetails[0]['role_id'],
			'module_ids'        => $arrUserModules[0]['module_ids'],
			'module_names'      => $arrUserModules[0]['modules'],
			'module_menu_links' => $arrUserModules[0]['menu_link'],	
			'module_menu_icons' => $arrUserModules[0]['menu_icon'],
			'normal_read'       => $arrUserDetails[0]['normal_read'],
			'normal_create'     => $arrUserDetails[0]['normal_create'],
			'normal_update'     => $arrUserDetails[0]['normal_update'],
			'normal_delete'     => $arrUserDetails[0]['normal_delete'],
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
			if(isset($_SESSION['user']['user_id'])){
			$arrData['created_by'] = $_SESSION['user']['user_id'];
			}
			$this->dbConnect->AutoExecute($strTableName,$arrData,'INSERT');
			$strResult = 'Record Added Sucessfully';
		}
		return $strResult;
	}
	
	//Funtion to dete the records
	function deleteRecord($strTableName, $strkeyColoum, $strValue)
	{
			$strSQL = "DELETE FROM ".$strTableName." WHERE ".$strkeyColoum." = '".$strValue."'";
			
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

	function createTrigger($triggerName,$triggerEvent,$strTableName,$strLogTableName,$strkeyColoum)
	{
		//	$strSQL = "DROP TRIGGER IF EXISTS ".$triggerName."";
			if(strtoupper($triggerEvent)=="BEFORE UPDATE"){
			$strSQL = "DROP TRIGGER IF EXISTS ".$triggerName."
						CREATE TRIGGER ".$triggerName." BEFORE UPDATE ON ".$strTableName."
						FOR EACH ROW 
						   INSERT INTO ".$strLogTableName."
								  (SELECT *,now() FROM ".$strTableName." WHERE ".$strkeyColoum." = OLD.".$strkeyColoum.");";
			}else if(strtoupper($triggerEvent)=="BEFORE INSERT"){
				$strSQL .= "DROP TRIGGER IF EXISTS ".$triggerName."
							CREATE TRIGGER ".$triggerName." BEFORE INSERT ON ".$strTableName."
								FOR EACH ROW 
								INSERT INTO ".$strLogTableName." (company_contact_id, contact_full_name, dob, dom, contact_mobile, contact_email, designation, contact_status, created_datetime, created_by, modified_datetime, modified_by, company_id, insert_log_time)
										 values (new.company_contact_id, new.contact_full_name, new.dob, new.dom, new.contact_mobile, new.contact_email, new.designation, new.contact_status, new.created_datetime, new.created_by, new.modified_datetime, new.modified_by, new.company_id, now());";
			}
			$this->dbConnect->Execute($strSQL);
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
		
		public function uploadImage($img_path,$img,$companyId,$x1,$x2,$y1,$y2,$w,$h){
			$t_width = 100;	// Maximum thumbnail width
			$t_height = 100;	// Maximum thumbnail height
			$new_name = $companyId.'-'.time().'.'."jpg"; // Thumbnail image name
			$path = "../uploads/";
					$ext1 = explode(".", $img_path);
					//$ext = pathinfo($img, PATHINFO_EXTENSION);
					echo "ext....".end($ext1)."====";
					$ext = end($ext1);
					$ratio = ($t_width/$w); 
					$nw = ceil($w * $ratio);
					$nh = ceil($h * $ratio);
					$nimg = imagecreatetruecolor($nw,$nh);
					switch ($ext)
						{
							case 'jpg':
								$im_src = imagecreatefromjpeg($img);
								imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w,$h);
								$r = @imagejpeg($nimg,$path.$new_name);
								break;
							case 'png':
								$im_src = imagecreatefrompng($img);
								imagealphablending($nimg, FALSE);
								imagesavealpha($nimg, TRUE);
								imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w,$h);
								$r = @imagepng($nimg,$path.$new_name);
								break;
							case 'gif':
								$im_src = imagecreatefromgif($img);
								imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w,$h);
								$background = imagecolorallocate($nimg, 0, 0, 0); 
								imagecolortransparent($nimg, $background);
								$r = @imagegif($nimg,$path.$new_name);
								break;
						}
			return $new_name;
		}


	

}