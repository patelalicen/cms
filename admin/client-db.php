<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );

	if ( isset($_POST['btnsubmit'])){

		$objvalidation = new validation();

		$objvalidation->add_validation("txtcompany_name", "company_name", "req");
		$objvalidation->add_validation("txtmain_location", "main_location", "req");
		$objvalidation->add_validation("txtemail", "email", "req");
		$objvalidation->add_validation("txtemail", "email", "email");
		$objvalidation->add_validation("txtprimary_phone", "primary_phone", "req");
		
		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			$obj->id			= (int) $id;
			$obj->company_name			= $cmn->setval(trim($cmn->read_value($_POST['txtcompany_name'],'')));
			$obj->main_location			= $cmn->setval(trim($cmn->read_value($_POST['txtmain_location'],'')));
			
			$obj->address			= $cmn->setval(trim($cmn->read_value($_POST['txtaddress'],'')));
			$obj->street	= $cmn->setval(trim($cmn->read_value($_POST['txtstreet'],'')));
			$obj->city			= $cmn->setval(trim($cmn->read_value($_POST['txtcity'],'')));
			$obj->zipcode= $cmn->setval(trim($cmn->read_value($_POST['txtzipcode'],'')));
			$obj->state	= $cmn->setval(trim($cmn->read_value($_POST['txtstate'],'')));
			$obj->country	= $cmn->setval(trim($cmn->read_value($_POST['txtcountry'],'')));
			$obj->email = $cmn->setval(trim($cmn->read_value($_POST["txtemail"],"")));
			$obj->primary_phone	= $cmn->setval(trim($cmn->read_value($_POST['txtprimary_phone'],'')));
			$obj->secondary_phone	= $cmn->setval(trim($cmn->read_value($_POST['txtsecondary_phone'],'')));
			$obj->secondary_phone	= $cmn->setval(trim($cmn->read_value($_POST['txtsecondary_phone'],'')));
			$obj->fax	= $cmn->setval(trim($cmn->read_value($_POST['txtfax'],'')));
			$obj->web_url	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_url'],'')));
			$obj->note		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtnote'],'')));
			$obj->case_policies		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtcase_policies'],'')));
			$obj->invoice_policies		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtinvoice_policies'],'')));
			
			$obj->active		= $cmn->setval(trim($cmn->read_value($_POST['rdoactive'],'')));
			
			//Code to add record.
			if ($strmode == 'add')
			{
				$obj->add();
				$msg->send_msg('client-list.php','client ',3);
			}

			//Code to edit record
			if ($strmode == 'edit' && intval($id) > 0)
			{
				$obj->update();
				$msg->send_msg('client-list.php','client ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('client-list.php','client ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('client-list.php','client ',5);
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
		$msg->send_msg('client-list.php','client ',15);
		exit();
	}

	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('client', 'client.csv');
	}
	
	//Code to delete document
	if(isset($_POST['hdnmodedeleteclient']))
	{
        $obj->deleteFiles((int)$_POST['hdnmodedeleteclient']);
		$obj->updateImage((int)$_POST['hdnmodedeleteclient']);
	}