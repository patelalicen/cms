<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );

	if ( isset($_POST['btnsubmit'])){

		$objvalidation = new validation();

		$objvalidation->add_validation("txtemail", "email", "req");
		$objvalidation->add_validation("txtemail", "email", "email");
		$objvalidation->add_validation("txtoffice_phone", "office_phone", "req");
		
		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			$obj->id			= (int) $id;
			$obj->client_id		= $cmn->setval(trim($cmn->read_value($_POST['txtclient_id'],'')));
			$obj->full_name		= $cmn->setval(trim($cmn->read_value($_POST['txtfull_name'],'')));
			$obj->email			= $cmn->setval(trim($cmn->read_value($_POST["txtemail"],"")));
			$obj->office_phone	= $cmn->setval(trim($cmn->read_value($_POST['txtoffice_phone'],'')));
			$obj->mobile		= $cmn->setval(trim($cmn->read_value($_POST['txtmobile'],'')));
			$obj->active		= $cmn->setval(trim($cmn->read_value($_POST['rdoactive'],'')));
			
			//Code to add record.
			if ($strmode == 'add')
			{
				$obj->add();
				$msg->send_msg('contact_person-list.php','contact_person ',3);
			}

			//Code to edit record
			if ($strmode == 'edit' && intval($id) > 0)
			{
				$obj->update();
				$msg->send_msg('contact_person-list.php','contact_person ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('contact_person-list.php','contact_person ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('contact_person-list.php','contact_person ',5);
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
		$msg->send_msg('contact_person-list.php','contact_person ',15);
		exit();
	}

	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('contact_person', 'contact_person.csv');
	}
	
	//Code to delete document
	if(isset($_POST['hdnmodedeletecontact_person']))
	{
        $obj->deleteFiles((int)$_POST['hdnmodedeletecontact_person']);
		$obj->updateImage((int)$_POST['hdnmodedeletecontact_person']);
	}