<?php function addOrUpdateUserAdvanced($strPostParameter, $strColumnName)
		{
			global $db;
			echo '<pre>';print_r($_POST);
			$arrPostArrayKeys = (array_keys($_POST));
			//echo '<pre>';print_r($arrPostArrayKeys);
			$arrPostArrayKeys = array_filter($arrPostArrayKeys,'is_int');
			echo '<pre>';print_r($arrPostArrayKeys);
			
			
			for($intIndex = 0; $intIndex<count($arrPostArrayKeys); $intIndex++)
			{	
				$arrPrivUserDetails['priv_create']  = 'N';
				$arrPrivUserDetails['priv_read']  = 'N';
				$arrPrivUserDetails['priv_update']  = 'N';
				$arrPrivUserDetails['priv_delete']  = 'N';
				$moduleId = $arrPostArrayKeys[$intIndex];echo $moduleId.'<br/>';
				for($intIndex1 = 0; $intIndex1<count($_POST[$arrPostArrayKeys[$intIndex]]);$intIndex1++)
				{
					echo $arrPrivUserDetails[$_POST[$arrPostArrayKeys[$intIndex]][$intIndex1]];
					$arrPrivUserDetails[$_POST[$arrPostArrayKeys[$intIndex]][$intIndex1]] = 'Y';
					echo $arrPrivUserDetails[$_POST[$arrPostArrayKeys[$intIndex]][$intIndex1]];
				}
				$strQuery1 = 'Select count(0) as count from privileged_user where module_id = '.$moduleId.' and user_id = '.$_GET['id'];
				$intCount = $db -> getAll($strQuery1);
				$strCondition = "module_id = ".$moduleId." and user_id =".$_GET['id'];
				if($intCount[0]['count'] == '1')
				{
					$db->AutoExecute('privileged_user', $arrPrivUserDetails, 'UPDATE', $strCondition);
				}
				else if($intCount[0]['count'] == '0')
				{	
					$arrPrivUserDetails['module_id'] = $moduleId;
					$arrPrivUserDetails['user_id']  = $_GET['id'];
					$db->AutoExecute('privileged_user', $arrPrivUserDetails, 'INSERT');
				}		
			}
			$strQuery2 = 'Select module_id from module_master';
			$arrModuleIds = $db -> getAll($strQuery2);
			for($intIndex2 = 0; $intIndex2 < count($arrModuleIds); $intIndex2++)
			{
				if(!in_array($arrModuleIds[$intIndex2]['module_id'], $arrPostArrayKeys))
				{
					//echo $arrModuleIds[$intIndex2]['module_id'];
					$strCondition1 = "module_id = ".$arrModuleIds[$intIndex2]['module_id']." and user_id =".$_GET['id'];
					echo $strCondition1;
					$arrPrivUserDetails['priv_create']  = 'N';
					$arrPrivUserDetails['priv_read']  = 'N';
					$arrPrivUserDetails['priv_update']  = 'N';
					$arrPrivUserDetails['priv_delete']  = 'N';
					echo '<pre>';print_r($arrPrivUserDetails);
					$db->AutoExecute('privileged_user', $arrPrivUserDetails, 'UPDATE', $strCondition1);
				}
			}
			header('location:'.HTTP_PATH.'users/advanced/'.$_GET['id']);	
		}
?>