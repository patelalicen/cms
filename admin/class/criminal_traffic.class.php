<?php
class criminal_traffic
{
	//Property
	var $id;
	var $pi_id;
	var $parent_id;
	var $case_no;
	var $offense_date;
	var $category;
	var $offense_code;
	var $offense_dcescription;
    var $court;
	var $arresting_agency;
	var $admitted_date;
	var $release_date;
	var $time_served;
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
		
		$strquery='SELECT * FROM '.DB_PREFIX.'criminal_traffic WHERE `is_deleted` = \'no\' ' . $condition . $order;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'criminal_traffic WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
		$rs=mysql_query($strquery);
		
		while($ardoc= mysql_fetch_array($rs))
		{
			$arrlist[$i]		= $ardoc;
			$arrlist[$i]['offense_date']		= date(DATE_FORMAT,strtotime($ardoc['offense_date']));
			$arrlist[$i]['admitted_date']		= date(DATE_FORMAT,strtotime($ardoc['admitted_date']));
			$arrlist[$i]['release_date']			= date(DATE_FORMAT,strtotime($ardoc['release_date']));
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
			$this->id[$i]					= $ardoc['id'];
			$this->pi_id					= $ardoc['pi_id'];
			$this->parent_id[$i]			= $ardoc['parent_id'];
			$this->case_no[$i]				= $ardoc['case_no'];
			$this->offense_date[$i]			= date(DATE_FORMAT,strtotime($ardoc['offense_date']));
			$this->category[$i]				= $ardoc['category'];
			$this->offense_code[$i]			= $ardoc['offense_code'];
			$this->offense_dcescription[$i]	= $ardoc['offense_dcescription'];
			$this->court[$i]				= $ardoc['court'];
			$this->arresting_agency[$i]		= $ardoc['arresting_agency'];
			$this->admitted_date[$i]		= date(DATE_FORMAT,strtotime($ardoc['admitted_date']));
			$this->release_date[$i]			= date(DATE_FORMAT,strtotime($ardoc['release_date']));
			$this->time_served[$i]			= $ardoc['time_served'];
			$this->web_url[$i]					= $ardoc['web_url'];
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
		
		
		/*foreach($this->case_no AS $key => $val)
  {*/
		
		echo $strquery='INSERT INTO '.DB_PREFIX.'criminal_traffic SET
					pi_id		= \''.$this->pi_id.'\',
					parent_id		= \''.$this->parent_id.'\',                       
					case_no		= \''.$this->case_no.'\',
					offense_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->offense_date,''))))).'\',
					category		= \''.$this->category.'\',
					offense_code		= \''.$this->offense_code.'\',
					offense_dcescription		= \''.$this->offense_dcescription.'\',
					court		= \''.$this->court[$key].'\',
					arresting_agency		= \''.$this->arresting_agency.'\',
					admitted_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->admitted_date,''))))).'\',
					release_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->release_date,''))))).'\',
					time_served		= \''.$this->time_served.'\',					
					web_url		= \''.$this->web_url.'\',
					
					created_date= NOW(),
					created_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status		= \'active\'';
								
					
					
		mysql_query($strquery) or die(mysql_error());
	/*}*/
		$this->id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update()
	{
		global $cmn;
		
		foreach($this->case_no AS $key => $val)
		{
		if($this->id[$key] > 0)
		{

		$strquery='UPDATE '.DB_PREFIX.'criminal_traffic SET 
					pi_id		= \''.$this->pi_id.'\',
					parent_id		= \''.$this->parent_id[$key].'\',
					case_no		= \''.$this->case_no[$key].'\',
					offense_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->offense_date[$key],''))))).'\',
					category		= \''.$this->category[$key].'\',
					offense_code		= \''.$this->offense_code[$key].'\',
					offense_dcescription		= \''.$this->offense_dcescription[$key].'\',
					court		= \''.$this->court[$key].'\',
					arresting_agency		= \''.$this->arresting_agency[$key].'\',
					admitted_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->admitted_date[$key],''))))).'\',
					release_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->release_date[$key],''))))).'\',
					time_served		= \''.$this->time_served[$key].'\',
					
					web_url		= \''.$this->web_url[$key].'\',
					
					updated_date= NOW(),
					updated_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status		= \'active\'
					WHERE id	= '.$this->id[$key];
					
					
		 mysql_query($strquery) or die(mysql_error());
		 }
		 else
		 {
		 
		 $strquery='INSERT INTO '.DB_PREFIX.'criminal_traffic SET
					pi_id		= \''.$this->pi_id.'\',
					parent_id		= \''.$this->parent_id[$key].'\',                       
					case_no		= \''.$this->case_no[$key].'\',
					offense_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->offense_date[$key],''))))).'\',
					category		= \''.$this->category[$key].'\',
					offense_code		= \''.$this->offense_code[$key].'\',
					offense_dcescription		= \''.$this->offense_dcescription[$key].'\',
					court		= \''.$this->court[$key].'\',
					arresting_agency		= \''.$this->arresting_agency[$key].'\',
					
					admitted_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->admitted_date[$key],''))))).'\',
					release_date		= \''.date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($this->release_date[$key],''))))).'\',
					
					time_served		= \''.$this->time_served[$key].'\',					
					web_url		= \''.$this->web_url[$key].'\',
					
					created_date= NOW(),
					created_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status		= \'active\'';
								
					
					
		mysql_query($strquery) or die(mysql_error());
		 }
      }	
	  return true;
	}
	
	//Function to delete record from table
	function delete()
	{
		global $cmn;
		
		//$strquery='DELETE FROM '.DB_PREFIX.'personal_information  WHERE id in('.$this->checkedids.')';
		$strquery='UPDATE '.DB_PREFIX.'criminal_traffic SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'criminal_traffic SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'criminal_traffic SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
}
?>