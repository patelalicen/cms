<?php
class smi_person_social_media_sites
{
	//Property
	var $id;
	var $sp_id;
	
	
						var $social_media_site;
						var $country;
						var $pname;
						var $note;
						var $username;
						var $unote;
						var $user_id;
						var $ppage;
						var $ppnote;
						var $about_url;
	
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
		
		$strquery='SELECT * FROM '.DB_PREFIX.'smi_person_social_media_sites WHERE `is_deleted` = \'no\' ' . $condition . $order;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'smi_person_social_media_sites WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
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
		
		$i = 0;
		
		while($ardoc= mysql_fetch_array($rs))
		{
			$this->id[$i]			= $ardoc['id'];
			$this->sp_id			= $ardoc['sp_id'];
			
						$this->social_media_site[$i]		= $ardoc['social_media_site'];
						$this->country[$i]		= $ardoc['country'];
						$this->pname[$i]		= $ardoc['pname'];
						$this->note[$i]		= $ardoc['note'];
						$this->username[$i]		= $ardoc['username'];
						$this->unote[$i]		= $ardoc['unote'];
						$this->user_id[$i]		= $ardoc['user_id'];
						$this->ppage[$i]		= $ardoc['ppage'];
						$this->ppnote[$i]		= $ardoc['ppnote'];
						$this->about_url[$i]		= $ardoc['about_url'];
			
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
		
		foreach($this->fname AS $key => $val)
		{
			$strquery='INSERT INTO '.DB_PREFIX.'smi_person_social_media_sites SET
						sp_id		= \''.$this->sp_id.'\',
						
						
						social_media_site		= \''.$this->social_media_site[$key].'\',
						country		= \''.$this->country[$key].'\',
						pname		= \''.$this->pname[$key].'\',
						note		= \''.$this->note[$key].'\',
						username		= \''.$this->username[$key].'\',
						unote		= \''.$this->unote[$key].'\',
						user_id		= \''.$this->user_id[$key].'\',
						ppage		= \''.$this->ppage[$key].'\',
						ppnote		= \''.$this->ppnote[$key].'\',
						about_url		= \''.$this->about_url[$key].'\',
						
						created_date= NOW(),
						created_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
						status		= \'active\'';
			
			mysql_query($strquery) or die(mysql_error());
		}
		
		$this->id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update()
	{
		global $cmn;
		
		foreach($this->fname AS $key => $val)
		{
			if($this->id[$key] > 0)
			{
				$strquery='UPDATE '.DB_PREFIX.'smi_person_social_media_sites SET 
						sp_id		= \''.$this->sp_id.'\',
						
						
						social_media_site		= \''.$this->social_media_site[$key].'\',
						country		= \''.$this->country[$key].'\',
						pname		= \''.$this->pname[$key].'\',
						note		= \''.$this->note[$key].'\',
						username		= \''.$this->username[$key].'\',
						unote		= \''.$this->unote[$key].'\',
						user_id		= \''.$this->user_id[$key].'\',
						ppage		= \''.$this->ppage[$key].'\',
						ppnote		= \''.$this->ppnote[$key].'\',
						about_url		= \''.$this->about_url[$key].'\',
						
						
						updated_date= NOW(),
						updated_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
						status		= \'active\'
						WHERE id	= '.$this->id[$key];
						
				mysql_query($strquery) or die(mysql_error());
			}
			else
			{
				$strquery='INSERT INTO '.DB_PREFIX.'smi_person_social_media_sites SET
						sp_id		= \''.$this->sp_id.'\',
						
						social_media_site		= \''.$this->social_media_site[$key].'\',
						country		= \''.$this->country[$key].'\',
						pname		= \''.$this->pname[$key].'\',
						note		= \''.$this->note[$key].'\',
						username		= \''.$this->username[$key].'\',
						unote		= \''.$this->unote[$key].'\',
						user_id		= \''.$this->user_id[$key].'\',
						ppage		= \''.$this->ppage[$key].'\',
						ppnote		= \''.$this->ppnote[$key].'\',
						about_url		= \''.$this->about_url[$key].'\',
						
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
		$strquery='UPDATE '.DB_PREFIX.'smi_person_social_media_sites SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'smi_person_social_media_sites SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'smi_person_social_media_sites SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
}
?>