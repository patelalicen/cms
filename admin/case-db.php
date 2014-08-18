<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );

	if ( isset($_POST['btnsubmit'])){

		$objvalidation = new validation();

		$objvalidation->add_validation("txtperson_investigated", "person_investigated", "req");
		$objvalidation->add_validation("txtperson_investigated", "person_investigated", "dupli", "", DB_PREFIX."investigation_case|person_investigated|id|".$id."|1|1");
		
		$cmn->ank_r($_POST,false);
		$cmn->ank_r($_FILES,false);
		
		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			$obj->id						= (int) $id;
			
			$obj->client_id		= $cmn->setval(trim($cmn->read_value($_POST['selclient_id'],0)));
			$obj->case_type		= $cmn->setval(trim($cmn->read_value($_POST['selcase_type'],0)));
			$obj->assing_to		= $cmn->setval(trim($cmn->read_value($_POST['selassing_to'],0)));
			$obj->created_on	= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtcreated_on'],'')))));
			$obj->due_date		= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdue_date'],'')))));
			$obj->salesperson_affiliate		= $cmn->setval(trim($cmn->read_value($_POST['selsalesperson_affiliate'],0)));
			$obj->client_matter_number		= $cmn->getval(trim($cmn->read_value($_POST['txtclient_matter_number'],'')));
			$obj->doi						= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdoi'],'')))));
			$obj->report_date				= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtreport_date'],'')))));
			$obj->carrier					= $cmn->getval(trim($cmn->read_value($_POST['txtcarrier'],'')));
			$obj->end_client				= $cmn->getval(trim($cmn->read_value($_POST['txtend_client'],'')));
			$obj->toonari_client			= $cmn->getval(trim($cmn->read_value($_POST['txttoonari_client'],'')));
			$obj->budget					= $cmn->getval(trim($cmn->read_value($_POST['txtbudget'],'')));
			$obj->hours						= $cmn->getval(trim($cmn->read_value($_POST['txthours'],'')));
			$obj->hourly_rate				= $cmn->getval(trim($cmn->read_value($_POST['txthourly_rate'],'')));
			$obj->hours						= $cmn->getval(trim($cmn->read_value($_POST['txthours'],'')));
			$obj->person_investigated_fname	= $cmn->setval(trim($cmn->read_value($_POST['txtperson_investigated_fname'],'')));
			$obj->person_investigated_mname	= $cmn->setval(trim($cmn->read_value($_POST['txtperson_investigated_mname'],'')));
			$obj->person_investigated_lname	= $cmn->setval(trim($cmn->read_value($_POST['txtperson_investigated_lname'],'')));
			$obj->clientnote				= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtclientnote'],'')));
			$obj->address					= $cmn->setval(trim($cmn->read_value($_POST['txtaddress'],'')));
			$obj->street					= $cmn->setval(trim($cmn->read_value($_POST['txtstreet'],'')));
			$obj->city						= $cmn->setval(trim($cmn->read_value($_POST['selcity'],0)));
			$obj->state						= $cmn->setval(trim($cmn->read_value($_POST['selstate'],0)));
			$obj->zip						= $cmn->setval(trim($cmn->read_value($_POST['txtzip'],0)));
			$obj->sex						= $cmn->setval(trim($cmn->read_value($_POST['txtsex'],'Male')));
			$obj->dob						= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdob'],'')))));
			$obj->height					= $cmn->setval(trim($cmn->read_value($_POST['txtheight'],0)));
			$obj->weight					= $cmn->setval(trim($cmn->read_value($_POST['txtweight'],0)));
			$obj->build						= $cmn->setval(trim($cmn->read_value($_POST['txtbuild'],0)));
			$obj->other_characteristics		= $cmn->setval(trim($cmn->read_value($_POST['txtother_characteristics'],'')));
			$obj->cell_phone				= $cmn->setval(trim($cmn->read_value($_POST['txtcell_phone'],'')));
			$obj->email						= $cmn->setval(trim($cmn->read_value($_POST['txtemail'],'')));
			$obj->facebook					= $cmn->setval(trim($cmn->read_value($_POST['txtfacebook'],'')));
			$obj->twitter					= $cmn->setval(trim($cmn->read_value($_POST['txttwitter'],'')));
			$obj->myspace					= $cmn->setval(trim($cmn->read_value($_POST['txtmyspace'],'')));
			$obj->note						= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtnote'],'')));
			$obj->priority					= $cmn->getval(trim($cmn->read_value($_POST['selpriority'],'')));
			$obj->estimated_completion_date	= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtestimated_completion_date'],'')))));
			$obj->active					= ($cmn->setval(trim($cmn->read_value($_POST['rdoactive'],'n'))) == 'n') ? 'inactive' : 'active';
	

			//Code to add record.
			if ($strmode == 'add')
			{
				$obj->add();
				$msg->send_msg('case-list.php','Case ',3);
			}

			//Code to edit record
			if ($strmode == 'edit' && intval($id) > 0)
			{
				$obj->update();
				$msg->send_msg('case-list.php','Case ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('case-list.php','Case(s) ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('case-list.php','Case(s) ',5);
		}
		exit();
	}

	//Code to active inactive selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'active')
	{
		if (isset($_POST['activeids']))
			$arrayactiveids = $_POST['activeids'];
		else
			$arrayactiveids = array('0');
		$obj->checkedids = implode(',',$arrayactiveids);
		$obj->uncheckedids = $_POST['inactiveids'];
		$obj->activeinactive();
		$msg->send_msg('case-list.php','Case(s) ',15);
		exit();
	}
	
	//Code to active inactive selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'assign')
	{
		if (isset($_POST['seluser']))
			$arrayids = $_POST['seluser'];
		else
			$arrayids = array('0');
			
		$obj->checkedids = implode(',',$arrayids);
		$obj->uncheckedids = $_POST['inactiveids'];
		
		$obj->assignCase();
		
		$msg->send_msg('case-list.php','Case(s) ',62);
		exit();
	}
	
	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('investigation_case', 'cases.csv');
	}