<?php
class contact_person
{
	//Property
	var $id;
	var $client_id;
	var $full_name;
	var $main_location;
	var $email;
	var $office_phone;
	var $mobile;
	var $fax;
	var $active;
	
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

		$strquery='SELECT * FROM '.DB_PREFIX.'contact_person WHERE 1=1 ' . $condition . $order;
		$rs=mysql_query($strquery);
		return $rs;
	}

	//Function to retrieve records of table in form of two dimensional array
	function fetchallasarray($intid=NULL, $stralphabet=NULL,$condition='',$order='id')
	{
		$arrlist = array();
		$i = 0;
		$and = $condition;
		if(!is_null($intid) && trim($intid)!='') $and .= ' AND id = ' . $intid;
		if(!is_null($stralphabet) && trim($stralphabet)!='')	$and .= ' AND id like \'' . $stralphabet . '%\'';
		$strquery='SELECT * FROM '.DB_PREFIX.'contact_person WHERE 1=1 ' . $and . ' ORDER BY '.$order;
		$rs=mysql_query($strquery);
		while($ardoc= mysql_fetch_array($rs))
		{
			$arrlist[$i]	= $ardoc;
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
			$this->id = $ardoc['id'];
			$this->client_id = $ardoc['client_id'];
			$this->full_name = $ardoc['full_name'];
			$this->email = $ardoc['email'];
			$this->office_phone = $ardoc['office_phone'];
			$this->mobile = $ardoc['mobile'];
			$this->fax = $ardoc['fax'];
			$this->active = $ardoc['status'];
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
		$strquery='INSERT INTO '.DB_PREFIX.'contact_person SET
					client_id		= \''.$this->client_id.'\',
					full_name		= \''.$this->full_name.'\',
					email			= \''.$this->email.'\',
					office_phone			= \''.$this->office_phone.'\',
					mobile		= \''.$this->mobile.'\',
					fax		= \''.$this->fax.'\',
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
		$strquery='UPDATE '.DB_PREFIX.'contact_person SET 
					client_id		= \''.$this->client_id.'\',
					full_name			= \''.$this->full_name.'\',
					email			= \''.$this->email.'\',
					office_phone			= \''.$this->office_phone.'\',
					mobile		= \''.$this->mobile.'\',
					fax		= \''.$this->fax.'\',
					updated_date= NOW(),
					updated_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status		= \'active\'
					WHERE id		= '.$this->id;

		return mysql_query($strquery) or die(mysql_error());	
	}
	
	//Function to delete record from table
	function delete()
	{
		global $cmn;
		$strquery='UPDATE '.DB_PREFIX.'contact_person SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'contact_person SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'contact_person SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	
	}
}