<?php
class article_information
{
	//Property
	var $id;
	
	
						var $case_id;
						var $url;
						var $box_url;
						var $publish_date;
						var $note;
						var $fname;
						var $mname;
						var $lname;
						var $email;
						var $phone_number;
						var $mobile_number;
						var $twitter_username;
						var $twitter_url;
						var $fb_username;
						var $fb_url;
						var $linkedin_username;
						var $linkedin_url;
						var $street;
						var $city;
						var $zip;
						var $state;
						var $country;
						var $author_note;
	
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
		
		$strquery='SELECT * FROM '.DB_PREFIX.'article_information WHERE `is_deleted` = \'no\' ' . $condition . $order;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'article_information WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
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
			
			
						$this->case_id[$i]		= $ardoc['case_id'];
						$this->url[$i]		= $ardoc['url'];
						$this->box_url[$i]		= $ardoc['box_url'];
						$this->publish_date[$i]		= $ardoc['publish_date'];
						$this->note[$i]		= $ardoc['note'];
						$this->fname[$i]		= $ardoc['fname'];
						$this->mname[$i]		= $ardoc['mname'];
						$this->lname[$i]		= $ardoc['lname'];
						$this->email[$i]		= $ardoc['email'];
						$this->phone_number[$i]		= $ardoc['phone_number'];
						$this->mobile_number[$i]		= $ardoc['mobile_number'];
						$this->twitter_username[$i]		= $ardoc['twitter_username'];
						$this->twitter_url[$i]		= $ardoc['twitter_url'];
						$this->fb_username[$i]		= $ardoc['fb_username'];
						$this->fb_url[$i]		= $ardoc['fb_url'];
						$this->linkedin_username[$i]		= $ardoc['linkedin_username'];
						$this->linkedin_url[$i]		= $ardoc['linkedin_url'];
						$this->street[$i]		= $ardoc['street'];
						$this->city[$i]		= $ardoc['city'];
						$this->zip[$i]		= $ardoc['zip'];
						$this->state[$i]		= $ardoc['state'];
						$this->country[$i]		= $ardoc['country'];
						$this->author_note[$i]		= $ardoc['author_note'];
			
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
			$strquery='INSERT INTO '.DB_PREFIX.'article_information SET
						
						
						case_id		= \''.$this->case_id[$key].'\',
						url		= \''.$this->url[$key].'\',
						box_url		= \''.$this->box_url[$key].'\',
						publish_date		= \''.$this->publish_date[$key].'\',
						note		= \''.$this->note[$key].'\',
						fname		= \''.$this->fname[$key].'\',
						mname		= \''.$this->mname[$key].'\',
						lname		= \''.$this->lname[$key].'\',
						email		= \''.$this->email[$key].'\',
						phone_number		= \''.$this->phone_number[$key].'\',
						mobile_number		= \''.$this->mobile_number[$key].'\',
						twitter_username		= \''.$this->twitter_username[$key].'\',
						twitter_url		= \''.$this->twitter_url[$key].'\',
						fb_username		= \''.$this->fb_username[$key].'\',
						fb_url		= \''.$this->fb_url[$key].'\',
						linkedin_username		= \''.$this->linkedin_username[$key].'\',
						linkedin_url		= \''.$this->linkedin_url[$key].'\',
						street		= \''.$this->street[$key].'\',
						city		= \''.$this->city[$key].'\',
						zip		= \''.$this->zip[$key].'\',
						state		= \''.$this->state[$key].'\',
						country		= \''.$this->country[$key].'\',
						author_note		= \''.$this->author_note[$key].'\',
						
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
				$strquery='UPDATE '.DB_PREFIX.'article_information SET 
						
						case_id		= \''.$this->case_id[$key].'\',
						url		= \''.$this->url[$key].'\',
						box_url		= \''.$this->box_url[$key].'\',
						publish_date		= \''.$this->publish_date[$key].'\',
						note		= \''.$this->note[$key].'\',
						fname		= \''.$this->fname[$key].'\',
						mname		= \''.$this->mname[$key].'\',
						lname		= \''.$this->lname[$key].'\',
						email		= \''.$this->email[$key].'\',
						phone_number		= \''.$this->phone_number[$key].'\',
						mobile_number		= \''.$this->mobile_number[$key].'\',
						twitter_username		= \''.$this->twitter_username[$key].'\',
						twitter_url		= \''.$this->twitter_url[$key].'\',
						fb_username		= \''.$this->fb_username[$key].'\',
						fb_url		= \''.$this->fb_url[$key].'\',
						linkedin_username		= \''.$this->linkedin_username[$key].'\',
						linkedin_url		= \''.$this->linkedin_url[$key].'\',
						street		= \''.$this->street[$key].'\',
						city		= \''.$this->city[$key].'\',
						zip		= \''.$this->zip[$key].'\',
						state		= \''.$this->state[$key].'\',
						country		= \''.$this->country[$key].'\',
						author_note		= \''.$this->author_note[$key].'\',
						updated_date= NOW(),
						updated_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
						status		= \'active\'
						WHERE id	= '.$this->id[$key];
						
				mysql_query($strquery) or die(mysql_error());
			}
			else
			{
				$strquery='INSERT INTO '.DB_PREFIX.'article_information SET
						
						case_id		= \''.$this->case_id[$key].'\',
						url		= \''.$this->url[$key].'\',
						box_url		= \''.$this->box_url[$key].'\',
						publish_date		= \''.$this->publish_date[$key].'\',
						note		= \''.$this->note[$key].'\',
						fname		= \''.$this->fname[$key].'\',
						mname		= \''.$this->mname[$key].'\',
						lname		= \''.$this->lname[$key].'\',
						email		= \''.$this->email[$key].'\',
						phone_number		= \''.$this->phone_number[$key].'\',
						mobile_number		= \''.$this->mobile_number[$key].'\',
						twitter_username		= \''.$this->twitter_username[$key].'\',
						twitter_url		= \''.$this->twitter_url[$key].'\',
						fb_username		= \''.$this->fb_username[$key].'\',
						fb_url		= \''.$this->fb_url[$key].'\',
						linkedin_username		= \''.$this->linkedin_username[$key].'\',
						linkedin_url		= \''.$this->linkedin_url[$key].'\',
						street		= \''.$this->street[$key].'\',
						city		= \''.$this->city[$key].'\',
						zip		= \''.$this->zip[$key].'\',
						state		= \''.$this->state[$key].'\',
						country		= \''.$this->country[$key].'\',
						author_note		= \''.$this->author_note[$key].'\',
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
		
		$strquery='UPDATE '.DB_PREFIX.'article_information SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'article_information SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'article_information SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
}
?>