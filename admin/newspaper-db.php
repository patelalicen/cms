<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );
	
	if ( isset($_POST['btnsubmit'])){
		
		$objvalidation = new validation();

		//$objvalidation->add_validation("txtperson_investigated", "person_investigated", "req");
		//$objvalidation->add_validation("txtperson_investigated", "person_investigated", "dupli", "", DB_PREFIX."investigation_case|person_investigated|id|".$id."|1|1");
		
		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			$obj->case_id		= $case_id;
			
			$obj->title			= $cmn->setval(trim($cmn->read_value($_POST['txttitle'],'')));
			
			$objinvestigated_newspaper->case_id	= $_POST['case_idinvestigated_newspaper'];
			$objinvestigated_newspaper->name	= $_POST['nameinvestigated_newspaper'];
			$objinvestigated_newspaper->url	= $_POST['urlinvestigated_newspaper'];
			$objinvestigated_newspaper->newspaper	= $_POST['newspaperinvestigated_newspaper'];
			$objinvestigated_newspaper->street	= $_POST['streetinvestigated_newspaper'];
			$objinvestigated_newspaper->city	= $_POST['cityinvestigated_newspaper'];
			$objinvestigated_newspaper->zip	= $_POST['zipinvestigated_newspaper'];
			$objinvestigated_newspaper->state	= $_POST['stateinvestigated_newspaper'];
			$objinvestigated_newspaper->country	= $_POST['countryinvestigated_newspaper'];
			$objarticle_information->case_id	= $_POST['case_idarticle_information'];
			$objarticle_information->url	= $_POST['urlarticle_information'];
			$objarticle_information->box_url	= $_POST['box_urlarticle_information'];
			$objarticle_information->publish_date	= $_POST['publish_datearticle_information'];
			$objarticle_information->note	= $_POST['notearticle_information'];
			$objarticle_information->fname	= $_POST['fnamearticle_information'];
			$objarticle_information->mname	= $_POST['mnamearticle_information'];
			$objarticle_information->lname	= $_POST['lnamearticle_information'];
			$objarticle_information->email	= $_POST['emailarticle_information'];
			$objarticle_information->phone_number	= $_POST['phone_numberarticle_information'];
			$objarticle_information->mobile_number	= $_POST['mobile_numberarticle_information'];
			$objarticle_information->twitter_username	= $_POST['twitter_usernamearticle_information'];
			$objarticle_information->twitter_url	= $_POST['twitter_urlarticle_information'];
			$objarticle_information->fb_username	= $_POST['fb_usernamearticle_information'];
			$objarticle_information->fb_url	= $_POST['fb_urlarticle_information'];
			$objarticle_information->linkedin_username	= $_POST['linkedin_usernamearticle_information'];
			$objarticle_information->linkedin_url	= $_POST['linkedin_urlarticle_information'];
			$objarticle_information->street	= $_POST['streetarticle_information'];
			$objarticle_information->city	= $_POST['cityarticle_information'];
			$objarticle_information->zip	= $_POST['ziparticle_information'];
			$objarticle_information->state	= $_POST['statearticle_information'];
			$objarticle_information->country	= $_POST['countryarticle_information'];
			$objarticle_information->author_note	= $_POST['author_notearticle_information'];
			
			//Code to add record.
			if ($strmode == 'add')
			{
				//$obj->add();
				$objinvestigated_newspaper->add();
				$objarticle_information->add();
		
				$msg->send_msg('mycase-list.php','Newspaper ',3);
			}

			//Code to edit record
			if ($strmode == 'edit')
			{
				$obj->update();
				
				
		$objinvestigated_newspaper->id	= $_POST['txtidinvestigated_newspaper'];
		$objinvestigated_newspaper->update();
		
		$objarticle_information->id	= $_POST['txtidarticle_information'];
		$objarticle_information->update();
		
				
				$msg->send_msg('mycase-list.php','Newspaper ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('mycase-list.php','Newspaper ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('mycase-list.php','Newspaper ',5);
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
		$msg->send_msg('mycase-list.php','Newspaper ',15);
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
		
		$msg->send_msg('mycase-list.php','Newspaper ',62);
		exit();
	}
	
	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('investigation_case', 'cases.csv');
	}