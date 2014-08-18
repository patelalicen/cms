<?php
class tv_channel
{
	//Property
	var $id;
	
	
	var $title;
	
	var $checkedids;
	var $uncheckedids;

	//Method
	//Function to retrieve recordset of table
	function fetchrecordset($id='',$condition='',$order='id')
	{
		if($id!='' && $id!= NULL && is_null($id)==false)
		{
			$condition = ' and case_id='. $id .$condition;
		}
		if($order!='' && $order!= NULL && is_null($order)==false)
		{
			$order = ' order by ' . $order;
		}
		
		$strquery='SELECT * FROM '.DB_PREFIX.'tv_channel WHERE `is_deleted` = \'no\' ' . $condition . $order;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'tv_channel WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
		$rs=mysql_query($strquery);
		
		while($ardoc= mysql_fetch_array($rs))
		{
			$arrlist[$i]		= $ardoc;
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
			
			$this->title		= $ardoc['title'];
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
		
		$strquery='INSERT INTO '.DB_PREFIX.'tv_channel SET
					
			title		= \''.$this->title.'\',
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
		
		$strquery='UPDATE '.DB_PREFIX.'tv_channel SET 
					
			title		= \''.$this->title.'\',
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
		
		$strquery='UPDATE '.DB_PREFIX.'tv_channel SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'tv_channel SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'tv_channel SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
}
?>