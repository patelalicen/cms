<?php 
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );
	if ( isset($_POST['btnsubmit']) ) {
		
		$objvalidation = new validation();		
		
		$objvalidation->add_validation("txtfirst_name", "first name", "req");
		$objvalidation->add_validation("txtlast_name", "last name", "req");
		$objvalidation->add_validation("txtfirst_name", "name", "dupli" , "",DB_PREFIX."user|first_name|user_id|" . (int) $user_id . "|last_name|" . $cmn->setval($_POST['txtlast_name']));
		$objvalidation->add_validation("txtemail", "email", "req");
		$objvalidation->add_validation("txtemail", "email", "email");
		$objvalidation->add_validation("txtcompany_email", "company_email", "req");
		$objvalidation->add_validation("txtcompany_email", "company_email", "email");
		
		$objvalidation->add_validation("txtoffice_phone", "office_phone", "req");
		$objvalidation->add_validation("txtmobile_phone", "mobile_phone", "req");
		$objvalidation->add_validation("txthome_phone", "home_phone", "req");
		
		$objvalidation->add_validation("seluser_role", "user role", "selone");
		$objvalidation->add_validation("txtuser_name", "user", "req");
		$objvalidation->add_validation("txtuser_name", "user", "dupli" , "",DB_PREFIX."user|user_name|user_id|" . (int) $user_id . "|1|1");
		
		if($objvalidation->validate()){

			//Code to assign value of control to all property of object.
			$objuser->user_id = (int) $user_id;
			$objuser->user_role_id = $cmn->setval(trim($cmn->read_value($_POST["seluser_role"],"")));
			$objuser->first_name = $cmn->setval(trim($cmn->read_value($_POST["txtfirst_name"],"")));
			$objuser->last_name = $cmn->setval(trim($cmn->read_value($_POST["txtlast_name"],"")));
			$objuser->email = $cmn->setval(trim($cmn->read_value($_POST["txtemail"],"")));
			$objuser->user_name = $cmn->setval(trim($cmn->read_value($_POST["txtuser_name"],"")));
			$objuser->password = $cmn->setval(trim($cmn->read_value($_POST["txtpassword"],"")));
			$objuser->user_active = $cmn->setval(trim($cmn->read_value($_POST["rdouser_active"],"y")));
			
			$objuser->middle_name = $cmn->setval(trim($cmn->read_value($_POST["txtmiddle_name"],"")));
			$objuser->job_title = $cmn->setval(trim($cmn->read_value($_POST["txtjob_title"],"")));
			$objuser->report_to = $cmn->setval(trim($cmn->read_value($_POST["txtreport_to"],"")));
			$objuser->office_location = $cmn->setval(trim($cmn->read_value($_POST["txtoffice_location"],"")));
			
			$objuser->address			= $cmn->setval(trim($cmn->read_value($_POST['txtaddress'],'')));
			$objuser->street			= $cmn->setval(trim($cmn->read_value($_POST['txtstreet'],'')));
			$objuser->city				= $cmn->setval(trim($cmn->read_value($_POST['txtcity'],'')));
			$objuser->state				= $cmn->setval(trim($cmn->read_value($_POST['txtstate'],'')));
			$objuser->zip				= $cmn->setval(trim($cmn->read_value($_POST['txtzip'],'')));
			$objuser->country			= $cmn->setval(trim($cmn->read_value($_POST['txtcountry'],'')));
			
			$objuser->company_email = $cmn->setval(trim($cmn->read_value($_POST["txtcompany_email"],"")));
			$objuser->office_phone		= $cmn->setval(trim($cmn->read_value($_POST['txtoffice_phone'],'')));
			$objuser->mobile_phone		= $cmn->setval(trim($cmn->read_value($_POST['txtmobile_phone'],'')));
			$objuser->home_phone		= $cmn->setval(trim($cmn->read_value($_POST['txthome_phone'],'')));
			$objuser->skype				= $cmn->setval(trim($cmn->read_value($_POST['txtskype'],'')));
			$objuser->fax				= $cmn->setval(trim($cmn->read_value($_POST['txtfax'],'')));
			
			$objuser->language = $cmn->setval(trim($cmn->read_value($_POST["chklanguage"],"")));
			$objuser->dob = $cmn->setval(trim($cmn->read_value($_POST["txtdob"],"")));
			
			$objuser->security_clearance = $cmn->setval(trim($cmn->read_value($_POST["selsecurity_clearance"],"")));
			$objuser->note		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtnote'],'')));
			
			$objuser->image		= $cmn->setval(trim($cmn->read_value($_FILES['txtimage']['name'],'')));
			$objuser->old_image	= $cmn->setval(trim($cmn->read_value($_POST['txtold_image'],'')));
		
			//Code to add record.
			if ($strmode == 'add')
			{
				$objuser->add();
				$msg->send_msg("user-list.php","User ",3);
			}

			//Code to edit record
			if ($strmode == 'edit' && intval($user_id) > 0 )
			{
				$objuser->update();
				$msg->send_msg("user-list.php","User ",4);
			}

		}
		
	}
	
	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete') {
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg("user-list.php","User ",9);
		}
		else
		{
			$objuser->checkedids = implode(",",$_POST['deletedids']);
			$objuser->delete();
			$msg->send_msg("user-list.php","User ",5);
		}
		exit();
	}

	//Code to active inactive selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'active') {
		if (isset($_POST['activeids']))
			$arrayactiveids = $_POST['activeids'];
		else
			$arrayactiveids = array("0");
		$objuser->checkedids = implode(",",$arrayactiveids);
		$objuser->uncheckedids = $_POST['inactiveids'];
		$objuser->activeinactive();
		$msg->send_msg("user-list.php","User ",15);
		exit();
	}
	
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export') {
		$cmn->export_to_csv('user', 'user.csv');
	}
?>