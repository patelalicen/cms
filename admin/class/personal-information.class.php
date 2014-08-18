<?php
class personal_information
{
	//Property
	var $id;
	var $case_id;
	var $fname;
	var $mname;
	var $lname;
	var $dob;
	var $age_b;
	var $web_url_dob;
	var $dod;
	var $age_d;
	var $web_url_dod;
			
	var $checkedids;
	var $uncheckedids;

	//Method
	//Function to retrieve recordset of table
	function fetchrecordset($id='',$condition='',$order='id')
	{
		if($id!='' && $id!= NULL && is_null($id)==false)
		{
			$condition = ' and id='. $id .$condition;
		}
		if($order!='' && $order!= NULL && is_null($order)==false)
		{
			$order = ' order by ' . $order;
		}
		
		$strquery='SELECT * FROM '.DB_PREFIX.'personal_info WHERE `is_deleted` = \'no\' ' . $condition . $order;
		$rs=mysql_query($strquery);
		return $rs;
	}

	//Function to retrieve records of table in form of two dimensional array
	function fetchallasarray($intid=NULL, $stralphabet=NULL,$condition='',$order='id')
	{
		$arrlist = array();
		$i = 0;
		$and = $condition;
		if(!is_null($intid) && trim($intid)!='') $and .= ' AND case_id IN (' . $intid . ')';
		if(!is_null($stralphabet) && trim($stralphabet)!='')	$and .= ' AND id like \'' . $stralphabet . '%\'';
		$strquery='SELECT * FROM '.DB_PREFIX.'personal_info WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
		$rs=mysql_query($strquery);
		
		while($ardoc= mysql_fetch_array($rs))
		{
			$arrlist[$i]		= $ardoc;
			$arrlist[$i]['dob']	= date(DATE_FORMAT,strtotime($ardoc['dob']));
			$arrlist[$i]['dod']	= date(DATE_FORMAT,strtotime($ardoc['dod']));
			$i++;
		}
		
		return $arrlist;
	}

	//Function to set field values into object properties
	function setallvalues($id='',$condition='')
	{
		$rs=$this->fetchrecordset($id, $condition);
		
		if($ardoc= mysql_fetch_array($rs))
		{
			$this->id			= $ardoc['id'];
			$this->case_id		= $ardoc['case_id'];
			$this->fname		= $ardoc['fname'];
			$this->mname		= $ardoc['mname'];
			$this->lname		= $ardoc['lname'];
			$this->age_b		= $ardoc['age_b'];
			$this->web_url_dob	= $ardoc['web_url_dob'];
			$this->age_d		= $ardoc['age_d'];
			$this->dob			= date(DATE_FORMAT,strtotime($ardoc['dob']));
			$this->dod			= date(DATE_FORMAT,strtotime($ardoc['dod']));
			$this->web_url_dod	= $ardoc['web_url_dod'];
		}
	}

	//Function to get particular field value
	function fieldvalue($field='id',$id='',$condition='',$order='')
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
		
		$strquery='INSERT INTO '.DB_PREFIX.'personal_info SET
					case_id		= \''.$this->case_id.'\',
					fname		= \''.$this->fname.'\',
					mname		= \''.$this->mname.'\',
					lname		= \''.$this->lname.'\',
					age_b		= \''.$this->age_b.'\',
					age_d		= \''.$this->age_d.'\',
					dob			= \''.$this->dob.'\',
					dod			= \''.$this->dod.'\',
					web_url_dob	= \''.$this->web_url_dob.'\',
					web_url_dod	= \''.$this->web_url_dod.'\',
					created_date= NOW(),
					created_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status		= \'active\'';
					
		mysql_query($strquery) or die(mysql_error());
		$this->id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update()
	{
		global $cmn;
		
		$strquery='UPDATE '.DB_PREFIX.'personal_info SET 
					fname		= \''.$this->fname.'\',
					mname		= \''.$this->mname.'\',
					lname		= \''.$this->lname.'\',
					age_b		= \''.$this->age_b.'\',
					age_d		= \''.$this->age_d.'\',
					dob			= \''.$this->dob.'\',
					dod			= \''.$this->dod.'\',
					web_url_dob	= \''.$this->web_url_dob.'\',
					web_url_dod	= \''.$this->web_url_dod.'\',
					updated_date= NOW(),
					updated_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status		= \'active\'
					WHERE case_id	= '.$this->case_id;
//					exit;
		mysql_query($strquery) or die(mysql_error());
		
		$rs	= $this->fetchrecordset(null,'AND case_id	= '.$this->case_id);
		$ardoc= mysql_fetch_array($rs);
		$this->id	= $ardoc['id'];
	}
	
	//Function to delete record from table
	function delete()
	{
		global $cmn;
		
		$strquery='UPDATE '.DB_PREFIX.'personal_info SET 
					is_deleted			= \'yes\',
					deleted_date	= NOW(),
					deleted_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
					 WHERE id in('.$this->checkedids.')';
					 
		return mysql_query($strquery) or die(mysql_error());
	}
	
	//Function to active-inactive record of table
	function activeinactive()
	{
		global $cmn;
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'personal_info SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'personal_info SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
}
?>