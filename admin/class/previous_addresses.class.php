<?php
class previous_addresses
{
	//Property
	var $id;
	var $pi_id;
	var $location_type;
	var $address;
	var $street;
	var $city;
	var $state;
	var $country;
	var $zip;
	var $start_date;
	var $end_date;
	var $web_url;
	
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
		
		$strquery='SELECT * FROM '.DB_PREFIX.'previous_addresses WHERE `is_deleted` = \'no\' ' . $condition . $order;
		$rs=mysql_query($strquery);
		return $rs;
	}

	//Function to retrieve records of table in form of two dimensional array
	function fetchallasarray($intid=NULL, $stralphabet=NULL,$condition='',$order='id')
	{
		$arrlist = array();
		$i = 0;
		$and = $condition;
		if(!is_null($intid) && trim($intid)!='') $and .= ' AND id IN (' . $intid . ')';
		if(!is_null($stralphabet) && trim($stralphabet)!='')	$and .= ' AND id like \'' . $stralphabet . '%\'';
		$strquery='SELECT * FROM '.DB_PREFIX.'previous_addresses WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
		$rs=mysql_query($strquery);
		
		while($ardoc= mysql_fetch_array($rs))
		{
			$arrlist[$i]				= $ardoc;
			$arrlist[$i]['start_date']	= date(DATE_FORMAT,strtotime($ardoc['start_date']));
			$arrlist[$i]['end_date']	= date(DATE_FORMAT,strtotime($ardoc['end_date']));
			$i++;
		}
		
		return $arrlist;
	}

	//Function to set field values into object properties
	function setallvalues($id='',$condition='')
	{
		$rs=$this->fetchrecordset($id, $condition);
		
		$i=0;
		
		while($ardoc= mysql_fetch_array($rs))
		{
			$this->id[$i]			= $ardoc['id'];
			$this->pi_id			= $ardoc['pi_id'];
			$this->location_type[$i]= $ardoc['location_type'];
			$this->address[$i]		= $ardoc['address'];
			$this->street[$i]		= $ardoc['street'];
			$this->city[$i]			= $ardoc['city'];
			$this->state[$i]		= $ardoc['state'];
			$this->country[$i]		= $ardoc['country'];
			$this->zip[$i]			= $ardoc['zip'];
			$this->end_date[$i]		= date(DATE_FORMAT,strtotime($ardoc['end_date']));
			$this->start_date[$i]	= date(DATE_FORMAT,strtotime($ardoc['start_date']));
			$this->web_url[$i]		= $ardoc['web_url'];
			
			$i++;
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
		
		/*foreach($this->location_type AS $key => $val)
		{*/
			$strquery='INSERT INTO '.DB_PREFIX.'previous_addresses SET
						pi_id			= \''.$this->pi_id.'\',
						location_type	= \''.$this->location_type.'\',
						address			= \''.$this->address.'\',
						street			= \''.$this->street.'\',
						city			= \''.$this->city.'\',
						state			= \''.$this->state.'\',
						country			= \''.$this->country.'\',
						end_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->end_date,''))))).'\',
						start_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->start_date,''))))).'\',
						zip				= \''.$this->zip.'\',
						web_url			= \''.$this->web_url.'\',
						created_date	= NOW(),
						created_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\',
						status			= \'active\'';
			mysql_query($strquery) or die(mysql_error());
		/*}*/
		
		$this->id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update()
	{
		global $cmn;
		
		foreach($this->location_type AS $key => $val)
		{
			if($this->id[$key] > 0)
			{
			$strquery='UPDATE '.DB_PREFIX.'previous_addresses SET 
						pi_id			= \''.$this->pi_id.'\',
						location_type	= \''.$this->location_type[$key].'\',
						address			= \''.$this->address[$key].'\',
						street			= \''.$this->street[$key].'\',
						city			= \''.$this->city[$key].'\',
						state			= \''.$this->state[$key].'\',
						country			= \''.$this->country[$key].'\',
						end_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->end_date[$key],''))))).'\',
						start_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->start_date[$key],''))))).'\',
						web_url			= \''.$this->web_url[$key].'\',
						zip				= \''.$this->zip[$key].'\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\',
						status			= \'active\'
						WHERE id		= '.$this->id[$key];
			mysql_query($strquery) or die(mysql_error());
		}
		else
		{
		
			$strquery='INSERT INTO '.DB_PREFIX.'previous_addresses SET
						pi_id			= \''.$this->pi_id.'\',
						location_type	= \''.$this->location_type[$key].'\',
						address			= \''.$this->address[$key].'\',
						street			= \''.$this->street[$key].'\',
						city			= \''.$this->city[$key].'\',
						state			= \''.$this->state[$key].'\',
						country			= \''.$this->country[$key].'\',
						end_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->end_date[$key],''))))).'\',
						start_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->start_date[$key],''))))).'\',
						web_url			= \''.$this->web_url[$key].'\',
						zip				= \''.$this->zip[$key].'\',
						created_date	= NOW(),
						created_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\',
						status			= \'active\'';
			mysql_query($strquery) or die(mysql_error());
		}
	}				
		return true;
	}
	
	//Function to delete record from table
	function delete()
	{
		global $cmn;
		
		$strquery='UPDATE '.DB_PREFIX.'previous_addresses SET 
					is_deleted		= \'yes\',
					deleted_date	= NOW(),
					deleted_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
					 WHERE id in('.$this->checkedids.')';
					 
		return mysql_query($strquery) or die(mysql_error());
	}
	
	//Function to active-inactive record of table
	function activeinactive()
	{
		global $cmn;
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'previous_addresses SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'previous_addresses SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
}
?>