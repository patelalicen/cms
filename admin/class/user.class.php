<?php
class user
{
	//Property
	var $user_id;
	var $user_role_id;
	var $first_name;
	var $last_name;
	var $email;
	var $user_name;
	var $password;
	var $user_active;
	
	var $middle_name;
	var $job_title;
	var $report_to;
	var $office_location;
	
	var $address;
	var $street;
	var $city;
	var $state;
	var $zip;
	var $country;
	
	var $company_email;
	var $office_phone;
	var $mobile_phone;
	var $home_phone;
	var $skype;
	var $fax;

	var $language;
	var $dob;
	
	var $security_clearance;
	var $note;
	
	var $image;
	var $old_image;
	
	var $checkedids;
	var $uncheckedids;

	//Method
	//Function to retrieve recordset of table
	function fetchrecordset($id="",$condition="",$order="user_id")
	{
		if($id!="" && $id!= NULL && is_null($id)==false)
		{
			$condition = " and user_id=". $id .$condition;
		}
		if($order!="" && $order!= NULL && is_null($order)==false)
		{
			$order = " order by " . $order;
		}
		$strquery="SELECT *, (SELECT user_role_name FROM " . DB_PREFIX . "user_role WHERE user_role_id = " . DB_PREFIX . "user.user_role_id) user_role_name FROM ".DB_PREFIX."user WHERE 1=1 " . $condition . $order;
		$rs=mysql_query($strquery);
		return $rs;
	}

	//Function to retrieve records of table in form of two dimensional array
	function fetchallasarray($intid=NULL, $stralphabet=NULL,$condition="",$order="user_id")
	{
		$arrlist = array();
		$i = 0;
		$and = $condition;
		if(!is_null($intid) && trim($intid)!="") $and .= " AND user_id = " . $intid;
		if(!is_null($stralphabet) && trim($stralphabet)!="")	$and .= " AND user_id like '" . $stralphabet . "%'";
		$strquery="SELECT * FROM ".DB_PREFIX."user WHERE 1=1 " . $and . " ORDER BY ".$order;
		$rs=mysql_query($strquery);
		while($aruser= mysql_fetch_array($rs))
		{
			$arrlist[$i] = $aruser;
			$i++;
		}
		return $arrlist;
	}

	//Function to set field values into object properties
	function setallvalues($id="",$condition="")
	{
		$rs=$this->fetchrecordset($id, $condition);
		if($aruser= mysql_fetch_array($rs))
		{
			$this->user_id = $aruser["user_id"];
			$this->user_role_id = $aruser["user_role_id"];
			$this->first_name = $aruser["first_name"];
			$this->last_name = $aruser["last_name"];
			$this->email = $aruser["email"];
			$this->user_name = $aruser["user_name"];
			$this->password = $aruser["password"];
			$this->user_active = $aruser["user_active"];
			
			
			$this->middle_name = $aruser["middle_name"];
			$this->job_title = $aruser["job_title"];
			$this->report_to = $aruser["report_to"];
			$this->office_location = $aruser["office_location"];
			
			$this->address = $aruser["address"];
			$this->street = $aruser["street"];
			$this->city = $aruser["city"];
			$this->state = $aruser["state"];
			$this->zip = $aruser["zip"];
			$this->country = $aruser["country"];
			
			$this->company_email = $aruser["company_email"];
			$this->office_phone = $aruser["office_phone"];
			$this->mobile_phone = $aruser["mobile_phone"];
			$this->home_phone = $aruser["home_phone"];
			$this->skype = $aruser["skype"];
			$this->fax = $aruser["fax"];
			
			$this->language = $aruser["language"];
			$this->dob = $aruser["dob"];
			
			$this->security_clearance = $aruser["security_clearance"];
			$this->note = $aruser["note"];
			
			$this->image = $aruser["image"];
		}
	}

	//Function to get particular field value
	function fieldvalue($field="user_id",$id="",$condition="",$order="")
	{
		$rs=$this->fetchrecordset($id, $condition, $order);
		$ret=0;
		while($rw=mysql_fetch_assoc($rs))
		{
			$ret=$rw[$field];
		}
		return $ret;
	}

	//Function to add record into table
	function add() 
	{
		global $cmn;
		$cmn->upload('txtimage','',USER_UPLOAD_DIR);
		
		$strquery="INSERT INTO ".DB_PREFIX."user SET 
					user_role_id	= '".$this->user_role_id."',
					first_name	= '".$this->first_name."',
					last_name	= '".$this->last_name."',
					email		= '".$this->email."',
					user_name	= '".$this->user_name."',
					password	= '".$this->password."',
					user_active	= '".$this->user_active."',
					
					middle_name = '".$this->middle_name."',
					job_title = '".$this->job_title."',
					report_to = '".$this->report_to."',
					office_location = '".$this->office_location."',
					
					address = '".$this->address."',
					street = '".$this->street."',
					city = '".$this->city."',
					state = '".$this->state."',
					zip = '".$this->zip."',
					country = '".$this->country."',
					
					company_email = '".$this->company_email."',
					office_phone = '".$this->office_phone."',
					mobile_phone = '".$this->mobile_phone."',
					home_phone = '".$this->home_phone."',
					skype = '".$this->skype."',
					fax = '".$this->fax."',
					
					language = '".$this->language."',
					dob = '".$this->dob."',
					
					security_clearance = '".$this->security_clearance."',
					note = '".$this->note."',
					
					image = '".$this->image."'";
					
		mysql_query($strquery) or die(mysql_error());
		$this->user_id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update() 
	{
		global $cmn;
		
		if($_FILES['txtimage']['name'] != '')
		{
			$cmn->upload('txtimage', $this->old_image, USER_UPLOAD_DIR);
			$extQuery	= 'image		= \''.$this->image.'\',';
		}
		
		$strquery="UPDATE ".DB_PREFIX."user SET 
					middle_name = '".$this->middle_name."',
					job_title = '".$this->job_title."',
					report_to = '".$this->report_to."',
					office_location = '".$this->office_location."',
					
					address = '".$this->address."',
					street = '".$this->street."',
					city = '".$this->city."',
					state = '".$this->state."',
					zip = '".$this->zip."',
					country = '".$this->country."',
					
					company_email = '".$this->company_email."',
					office_phone = '".$this->office_phone."',
					mobile_phone = '".$this->mobile_phone."',
					home_phone = '".$this->home_phone."',
					skype = '".$this->skype."',
					fax = '".$this->fax."',
					
					language = '".$this->language."',
					dob = '".$this->dob."',
					".$extQuery."
					security_clearance = '".$this->security_clearance."',
					note = '".$this->note."'
					
					WHERE user_id=".$this->user_id;
					
		return mysql_query($strquery) or die(mysql_error());
	}

	//Function to delete record from table
	function delete() 
	{
		$strquery="DELETE FROM ".DB_PREFIX."user  WHERE user_id in(".$this->checkedids.")";
		return mysql_query($strquery) or die(mysql_error());
	}

	//Function to active-inactive record of table
	function activeinactive()
	{
		$strquery	=	"UPDATE " . DB_PREFIX . "user SET user_active='n' WHERE user_id in(" . $this->uncheckedids . ")";
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	"UPDATE " . DB_PREFIX . "user SET user_active='y' WHERE user_id in(" . $this->checkedids . ")";
		return mysql_query($strquery) or die(mysql_error());
	}
	
	function change_password ( $old_password, $new_password ) {
		global $cmn;
		$user_id = $cmn->get_session(ADMIN_USER_ID);
		$strquery = 'UPDATE ' . DB_PREFIX . 'user SET password = \'' . $new_password . '\' WHERE user_id = ' . (int) $user_id . ' AND password = \'' . $old_password . '\'';
		mysql_query($strquery) or die(mysql_error());
		return mysql_affected_rows();
	}
}
?>