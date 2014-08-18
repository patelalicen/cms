<?php
class client
{
	//Property
	var $id;
	var $company_name;
	var $main_location;
	var $address;
	var $street;
	var $city;
	var $zip;
	var $state;
	var $country;
	var $email;
	var $primary_phone;
	var $secondary_phone;
	var $fax;
	var $web_url;
	var $note;
	var $case_policies;
	var $invoice_policies;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'client WHERE 1=1 ' . $condition . $order;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'client WHERE 1=1 ' . $and . ' ORDER BY '.$order;
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
			$this->company_name = $ardoc['company_name'];
			$this->main_location = $ardoc['main_location'];
			$this->address = $ardoc['address'];
			$this->street = $ardoc['street'];
			$this->city = $ardoc['city'];
			$this->zip = $ardoc['zip'];
			$this->state = $ardoc['state'];
			$this->country = $ardoc['country'];
			$this->email = $ardoc['email'];
			$this->primary_phone = $ardoc['primary_phone'];
			$this->secondary_phone = $ardoc['secondary_phone'];
			$this->fax = $ardoc['fax'];
			$this->web_url = $ardoc['web_url'];
			$this->note = $ardoc['note'];
			$this->case_policies = $ardoc['case_policies'];
			$this->invoice_policies = $ardoc['invoice_policies'];
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
		$strquery='INSERT INTO '.DB_PREFIX.'client SET
					company_name			= \''.$this->company_name.'\',
					main_location		= \''.$this->main_location.'\',
					address		= \''.$this->address.'\',
					street	= \''.$this->street.'\',
					city			= \''.$this->city.'\',
					zip		= \''.$this->zip.'\',
					state		= \''.$this->state.'\',
					country	= \''.$this->country.'\',
					email			= \''.$this->email.'\',
					primary_phone			= \''.$this->primary_phone.'\',
					secondary_phone		= \''.$this->secondary_phone.'\',
					fax		= \''.$this->fax.'\',
					note	= \''.$this->note.'\',
					case_policies			= \''.$this->case_policies.'\',
					invoice_policies		= \''.$this->invoice_policies.'\',
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
		$strquery='UPDATE '.DB_PREFIX.'client SET 
					company_name			= \''.$this->company_name.'\',
					main_location		= \''.$this->main_location.'\',
					address		= \''.$this->address.'\',
					street	= \''.$this->street.'\',
					city			= \''.$this->city.'\',
					zip		= \''.$this->zip.'\',
					state		= \''.$this->state.'\',
					country	= \''.$this->country.'\',
					email			= \''.$this->email.'\',
					primary_phone			= \''.$this->primary_phone.'\',
					secondary_phone		= \''.$this->secondary_phone.'\',
					fax		= \''.$this->fax.'\',
					note	= \''.$this->note.'\',
					case_policies			= \''.$this->case_policies.'\',
					invoice_policies		= \''.$this->invoice_policies.'\',
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
		$strquery='UPDATE '.DB_PREFIX.'client SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'client SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'client SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	
	}
}