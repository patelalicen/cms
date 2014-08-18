<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );

	if ( isset($_POST['btnsubmit'])){

		$objvalidation = new validation();

		$objvalidation->add_validation("txtlicense_number", "License Number", "req");
		
		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			$obj->id			= (int) $id;
			$obj->employee_id		= $cmn->setval(trim($cmn->read_value($_POST['selemployee_id'],0)));
			$obj->private_investigator		= $cmn->setval(trim($cmn->read_value($_POST['txtprivate_investigator'],'')));
			$obj->expiration_date			= $cmn->setval(trim($cmn->read_value($_POST["txtexpiration_date"],"")));
			$obj->valid_region	= $cmn->setval(trim($cmn->read_value($_POST['txtvalid_region'],'')));
			$obj->license_number		= $cmn->setval(trim($cmn->read_value($_POST['txtlicense_number'],'')));
			$obj->active		= $cmn->setval(trim($cmn->read_value($_POST['rdoactive'],'')));
			
			//Code to add record.
			if ($strmode == 'add')
			{
				$obj->add();
				$msg->send_msg('license-list.php','license ',3);
			}

			//Code to edit record
			if ($strmode == 'edit' && intval($id) > 0)
			{
				$obj->update();
				$msg->send_msg('license-list.php','license ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('license-list.php','license ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('license-list.php','license ',5);
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
		$msg->send_msg('license-list.php','license ',15);
		exit();
	}

	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('license', 'license.csv');
	}
	
	//Code to delete document
	if(isset($_POST['hdnmodedeletelicense']))
	{
        $obj->deleteFiles((int)$_POST['hdnmodedeletelicense']);
		$obj->updateImage((int)$_POST['hdnmodedeletelicense']);
	}