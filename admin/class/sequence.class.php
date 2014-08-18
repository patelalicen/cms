<?php
class sequence
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
		$strquery='SELECT * FROM '.DB_PREFIX.'pi_sequence WHERE ' . $condition . $order;
		$rs=mysql_query($strquery);
		return $rs;
	}

	//Function to retrieve records of table in form of two dimensional array
	function fetchallasarray($intid=NULL, $stralphabet=NULL,$condition='',$order='id')
	{
		$arrlist = array();
		$i = 0;
		$and = $condition;
		// if(!is_null($intid) && trim($intid)!='') $and .= ' AND case_id IN (' . $intid . ')';
		// if(!is_null($stralphabet) && trim($stralphabet)!='')	$and .= ' AND id like \'' . $stralphabet . '%\'';
		$strquery='SELECT * FROM '.DB_PREFIX.'pi_sequence WHERE ' . $and . ' ORDER BY '.$order;
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
			$this->case_id		= $ardoc['case_id'];
			$this->table_name		= $ardoc['table_name'];
			$this->table_id	= $ardoc['table_id'];
			$this->sequence_no	= $ardoc['sequence_no'];
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
		
		$strquery='INSERT INTO '.DB_PREFIX.'pi_sequence SET
					case_id		= \''.$this->case_id.'\',
					table_name		= \''.$this->table_name.'\',
					table_id		= \''.$this->table_id.'\',
					sequence_no		= \''.$this->seq_no.'\'';					
		mysql_query($strquery) or die(mysql_error());
		$this->id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update()
	{
		global $cmn;
		// sequence_no		= \''.$this->seq_no.'\'
		$strquery='UPDATE '.DB_PREFIX.'pi_sequence SET 
					case_id		= \''.$this->case_id.'\',
					table_name		= \''.$this->table_name.'\',
					table_id		= \''.$this->table_id.'\',
					sequence_no		= \''.$this->seq_no.'\'
					WHERE id	= '.$this->id;
					// exit;
		return mysql_query($strquery) or die(mysql_error());
		
	}
	
	//Function to delete record from table
	function delete() 
	{
		$strquery="DELETE FROM ".DB_PREFIX."pi_sequence  WHERE table_name ='".$this->table_name."' AND table_id in(".$this->checkedids.")";
		return mysql_query($strquery) or die(mysql_error());
	}
	
	
	
}
?>