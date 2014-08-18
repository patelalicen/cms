<?php
class investigation_case
{
	//Property
	var $id;
	var $client_id;
	var $case_type;
	var $assing_to;
	var $created_on;
	var $due_date;
	var $salesperson_affiliate;
	var $client_matter_number;
	var $doi;
	var $report_date;
	var $carrier;
	var $end_client;
	var $toonari_client;
	var $budget;
	var $hours;
	var $hourly_rate;
	var $person_investigated_fname;
	var $person_investigated_mname;
	var $person_investigated_lname;
	var $clientnote;
	var $address;
	var $street;
	var $city;
	var $state;
	var $zip;
	var $sex;
	var $dob;
	var $height;
	var $weight;
	var $build;
	var $other_characteristics;
	var $cell_phone;
	var $email;
	var $facebook;
	var $twitter;
	var $myspace;
	var $note;
	var $priority;
	var $estimated_completion_date;
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
		
		$strquery='SELECT * FROM '.DB_PREFIX.'investigation_case WHERE `is_deleted` = \'no\' ' . $condition . $order;
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
		$strquery='SELECT * FROM '.DB_PREFIX.'investigation_case WHERE `is_deleted` = \'no\' ' . $and . ' ORDER BY '.$order;
		$rs=mysql_query($strquery);
		while($ardoc= mysql_fetch_array($rs))
		{
			$arrlist[$i]								= $ardoc;
			$arrlist[$i]['doi']							= date(DATE_FORMAT,strtotime($ardoc['doi']));
			$arrlist[$i]['dob']							= date(DATE_FORMAT,strtotime($ardoc['dob']));
			$arrlist[$i]['created_on']					= date(DATE_FORMAT,strtotime($ardoc['created_on']));
			$arrlist[$i]['due_date']					= date(DATE_FORMAT,strtotime($ardoc['due_date']));
			$arrlist[$i]['report_date']					= date(DATE_FORMAT,strtotime($ardoc['report_date']));
			$arrlist[$i]['estimated_completion_date']	= date(DATE_FORMAT,strtotime($ardoc['estimated_completion_date']));
			
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
			$this->id						= $ardoc['id'];
			$this->client_id				= $ardoc['client_id'];
			$this->case_type				= $ardoc['case_type'];
			$this->assing_to				= $ardoc['assing_to'];
			$this->created_on				= date(DATE_FORMAT,strtotime($ardoc['created_on']));
			$this->due_date					= date(DATE_FORMAT,strtotime($ardoc['due_date']));
			$this->salesperson_affiliate	= $ardoc['salesperson_affiliate'];
			$this->client_matter_number		= $ardoc['client_matter_number'];
			$this->doi						= date(DATE_FORMAT,strtotime($ardoc['doi']));
			$this->report_date				= date(DATE_FORMAT,strtotime($ardoc['report_date']));
			$this->carrier					= $ardoc['carrier'];
			$this->end_client				= $ardoc['end_client'];
			$this->toonari_client			= $ardoc['toonari_client'];
			$this->budget					= $ardoc['budget'];
			$this->hours					= $ardoc['hours'];
			$this->hourly_rate				= $ardoc['hourly_rate'];
			$this->person_investigated_fname= $ardoc['person_investigated_fname'];
			$this->person_investigated_mname= $ardoc['person_investigated_mname'];
			$this->person_investigated_lname= $ardoc['person_investigated_lname'];
			$this->clientnote				= $ardoc['clientnote'];
			$this->address					= $ardoc['address'];
			$this->street					= $ardoc['street'];
			$this->city						= $ardoc['city'];
			$this->state					= $ardoc['state'];
			$this->zip						= $ardoc['zip'];
			$this->sex						= $ardoc['sex'];
			$this->height					= $ardoc['height'];
			$this->weight					= $ardoc['weight'];
			$this->build					= $ardoc['build'];
			$this->other_characteristics	= $ardoc['other_characteristics'];
			$this->cell_phone				= $ardoc['cell_phone'];
			$this->email					= $ardoc['email'];
			$this->facebook					= $ardoc['facebook'];
			$this->twitter					= $ardoc['twitter'];
			$this->myspace					= $ardoc['myspace'];
			$this->note						= $ardoc['note'];
			$this->priority					= $ardoc['priority'];
			$this->estimated_completion_date= date(DATE_FORMAT,strtotime($ardoc['estimated_completion_date']));
			$this->active					= $ardoc['active'];
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
		
		$strquery='INSERT INTO '.DB_PREFIX.'investigation_case SET
					client_id					= \''.$this->client_id.'\',
					case_type					= \''.$this->case_type.'\',
					assing_to					= \''.$this->assing_to.'\',
					created_on					= \''.$this->created_on.'\',
					due_date					= \''.$this->due_date.'\',
					salesperson_affiliate		= \''.$this->salesperson_affiliate.'\',
					client_matter_number		= \''.$this->client_matter_number.'\',
					doi							= \''.$this->doi.'\',
					report_date					= \''.$this->report_date.'\',
					carrier						= \''.$this->carrier.'\',
					end_client					= \''.$this->end_client.'\',
					toonari_client				= \''.$this->toonari_client.'\',
					budget						= \''.$this->budget.'\',
					hours						= \''.$this->hours.'\',
					hourly_rate					= \''.$this->hourly_rate.'\',
					person_investigated_fname	= \''.$this->person_investigated_fname.'\',
					person_investigated_mname	= \''.$this->person_investigated_mname.'\',
					person_investigated_lname	= \''.$this->person_investigated_lname.'\',
					clientnote					= \''.$this->clientnote.'\',
					address						= \''.$this->address.'\',
					street						= \''.$this->street.'\',
					city						= \''.$this->city.'\',
					state						= \''.$this->state.'\',
					zip							= \''.$this->zip.'\',
					sex							= \''.$this->sex.'\',
					height						= \''.$this->height.'\',
					weight						= \''.$this->weight.'\',
					build						= \''.$this->build.'\',
					other_characteristics		= \''.$this->other_characteristics.'\',
					cell_phone					= \''.$this->cell_phone.'\',
					email						= \''.$this->email.'\',
					facebook					= \''.$this->facebook.'\',
					twitter						= \''.$this->twitter.'\',
					myspace						= \''.$this->myspace.'\',
					note						= \''.$this->note.'\',
					priority					= \''.$this->priority.'\',
					estimated_completion_date	= \''.$this->estimated_completion_date.'\',

					created_date				= NOW(),
					created_by					= \''.$cmn->get_session(ADMIN_USER_ID).'\',
					status						= \''.$this->active.'\'';
			
		mysql_query($strquery) or die(mysql_error());
		$this->id = mysql_insert_id();
		return mysql_insert_id();
	}

	//Function to update record of table
	function update()
	{
		global $cmn;
		
		$strquery='UPDATE '.DB_PREFIX.'investigation_case SET 
					client_id					= \''.$this->client_id.'\',
					case_type					= \''.$this->case_type.'\',
					assing_to					= \''.$this->assing_to.'\',
					created_on					= \''.$this->created_on.'\',
					due_date					= \''.$this->due_date.'\',
					salesperson_affiliate		= \''.$this->salesperson_affiliate.'\',
					client_matter_number		= \''.$this->client_matter_number.'\',
					doi							= \''.$this->doi.'\',
					report_date					= \''.$this->report_date.'\',
					carrier						= \''.$this->carrier.'\',
					end_client					= \''.$this->end_client.'\',
					toonari_client				= \''.$this->toonari_client.'\',
					budget						= \''.$this->budget.'\',
					hours						= \''.$this->hours.'\',
					hourly_rate					= \''.$this->hourly_rate.'\',
					person_investigated_fname	= \''.$this->person_investigated_fname.'\',
					person_investigated_mname	= \''.$this->person_investigated_mname.'\',
					person_investigated_lname	= \''.$this->person_investigated_lname.'\',
					clientnote					= \''.$this->clientnote.'\',
					address						= \''.$this->address.'\',
					street						= \''.$this->street.'\',
					city						= \''.$this->city.'\',
					state						= \''.$this->state.'\',
					zip							= \''.$this->zip.'\',
					sex							= \''.$this->sex.'\',
					height						= \''.$this->height.'\',
					weight						= \''.$this->weight.'\',
					build						= \''.$this->build.'\',
					other_characteristics		= \''.$this->other_characteristics.'\',
					cell_phone					= \''.$this->cell_phone.'\',
					email						= \''.$this->email.'\',
					facebook					= \''.$this->facebook.'\',
					twitter						= \''.$this->twitter.'\',
					myspace						= \''.$this->myspace.'\',
					note						= \''.$this->note.'\',
					priority					= \''.$this->priority.'\',
					estimated_completion_date	= \''.$this->estimated_completion_date.'\',
					updated_date	= NOW(),
					status			= \''.$this->active.'\',
					updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
					WHERE id		= '.$this->id;
					
		return mysql_query($strquery) or die(mysql_error());	
	}
	
	//Function to delete record from table
	function delete()
	{
		global $cmn;
		
		//$strquery='DELETE FROM '.DB_PREFIX.'investigation_case  WHERE id in('.$this->checkedids.')';
		$strquery='UPDATE '.DB_PREFIX.'investigation_case SET 
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
		
		$strquery	=	'UPDATE ' . DB_PREFIX . 'investigation_case SET
							status=\'inactive\',
							updated_date	= NOW(),
							updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
							WHERE id in(' . $this->uncheckedids . ')';
							
		$result = mysql_query($strquery) or die(mysql_error());
		if($result == false)
			return ;
		$strquery	=	'UPDATE ' . DB_PREFIX . 'investigation_case SET
						status=\'active\',
						updated_date	= NOW(),
						updated_by		= \''.$cmn->get_session(ADMIN_USER_ID).'\'
						WHERE id in(' . $this->checkedids . ')';
		return mysql_query($strquery) or die(mysql_error());
	}
	
	function assignCase()
	{
		global $cmn;
		
		//$rows	= $this->fetchallasarray($this->uncheckedids);
		$ids	= explode(',',$this->uncheckedids);
		$uIds	= explode(',',$this->checkedids);
		
		foreach($ids as $key => $val)
		{
			if($uIds[$key] > 0)
			{
				$strquery	=	'INSERT INTO ' . DB_PREFIX . 'assign_transfer SET
								case_id		= '.$val.',
								assign_to	= '.$uIds[$key].',
								assign_by	= \''.$cmn->get_session(ADMIN_USER_ID).'\',
								assign_date	= NOW(),
								status		=\'active\'';
				$result = mysql_query($strquery) or die(mysql_error());
			}
		}
		
		return true;
	}
	
	function getClientLocation($id)
	{
		require_once 'client.class.php';
		
		//create object of client entity...
		$objClient = new client();
		
		$clientLocation = ((int) $id > 0) ? $objClient->fieldvalue('main_location',$id) : '';
		
		return $clientLocation;
	}
	
	function getClientCasePolicies($id)
	{
		require_once 'client.class.php';
		
		//create object of client entity...
		$objClient = new client();
		
		$clientCasePolicies = ((int) $id > 0) ? $objClient->fieldvalue('case_policies',$id) : '';
		
		return $clientCasePolicies;
	}
}