<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );
	
	if ( isset($_POST['btnsubmit'])){
		
		$objvalidation = new validation();

		//$objvalidation->add_validation("txtperson_investigated", "person_investigated", "req");
		//$objvalidation->add_validation("txtperson_investigated", "person_investigated", "dupli", "", DB_PREFIX."investigation_case|person_investigated|id|".$id."|1|1");
		
		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			//$obj->case_id		= $case_id;
			
			//$obj->title			= $cmn->setval(trim($cmn->read_value($_POST['txttitle'],'')));
			
			$objinvestigated_tv_channel->case_id	= $case_id;
			$objinvestigated_tv_channel->id	= $_POST['txtidinvestigated_tv_channel'];
			$objinvestigated_tv_channel->name	= $_POST['txtnameinvestigated_tv_channel'];
			$objinvestigated_tv_channel->url	= $_POST['txturlinvestigated_tv_channel'];
			$objinvestigated_tv_channel->newspaper	= $_POST['txtnewspaperinvestigated_tv_channel'];
			$objinvestigated_tv_channel->street	= $_POST['txtstreetinvestigated_tv_channel'];
			$objinvestigated_tv_channel->city	= $_POST['txtcityinvestigated_tv_channel'];
			$objinvestigated_tv_channel->zip	= $_POST['txtzipinvestigated_tv_channel'];
			$objinvestigated_tv_channel->state	= $_POST['txtstateinvestigated_tv_channel'];
			$objinvestigated_tv_channel->country	= $_POST['txtcountryinvestigated_tv_channel'];
			
			$objclip_information->case_id	= $case_id;
			$objclip_information->id	= $_POST['txtidclip_information'];
			$objclip_information->box_url	= $_POST['txtbox_urlclip_information'];
			$objclip_information->air_date	= $_POST['txtair_dateclip_information'];
			$objclip_information->online_view_count	= $_POST['txtonline_view_countclip_information'];
			$objclip_information->duration	= $_POST['txtdurationclip_information'];
			$objclip_information->clip_content_desc	= $_POST['txtclip_content_descclip_information'];
			$objclip_information->clip_notes	= $_POST['txtclip_notesclip_information'];
			
			$objstaff_with_clip->case_id	= $case_id;
			$objstaff_with_clip->id	= $_POST['txtidstaff_with_clip'];
			$objstaff_with_clip->ci_id	= $_POST['txtci_idstaff_with_clip'];
			$objstaff_with_clip->staff	= $_POST['txtstaffstaff_with_clip'];
			$objstaff_with_clip->fname	= $_POST['txtfnamestaff_with_clip'];
			$objstaff_with_clip->mname	= $_POST['txtmnamestaff_with_clip'];
			$objstaff_with_clip->lname	= $_POST['txtlnamestaff_with_clip'];
			$objstaff_with_clip->email	= $_POST['txtemailstaff_with_clip'];
			$objstaff_with_clip->phone_number	= $_POST['txtphone_numberstaff_with_clip'];
			$objstaff_with_clip->mobile_number	= $_POST['txtmobile_numberstaff_with_clip'];
			$objstaff_with_clip->twitter_username	= $_POST['txttwitter_usernamestaff_with_clip'];
			$objstaff_with_clip->twitter_url	= $_POST['txttwitter_urlstaff_with_clip'];
			$objstaff_with_clip->fb_username	= $_POST['txtfb_usernamestaff_with_clip'];
			$objstaff_with_clip->fb_url	= $_POST['txtfb_urlstaff_with_clip'];
			$objstaff_with_clip->linkedin_username	= $_POST['txtlinkedin_usernamestaff_with_clip'];
			$objstaff_with_clip->linkedin_url	= $_POST['txtlinkedin_urlstaff_with_clip'];
			$objstaff_with_clip->street	= $_POST['txtstreetstaff_with_clip'];
			$objstaff_with_clip->city	= $_POST['txtcitystaff_with_clip'];
			$objstaff_with_clip->zip	= $_POST['txtzipstaff_with_clip'];
			$objstaff_with_clip->state	= $_POST['txtstatestaff_with_clip'];
			$objstaff_with_clip->country	= $_POST['txtcountrystaff_with_clip'];
			$objstaff_with_clip->author_note	= $_POST['txtauthor_notestaff_with_clip'];
			
			
	
			//Code to add record.
			if ($strmode == 'add')
			{
				//$obj->add();
				$objinvestigated_tv_channel->add();
				$objclip_information->add();
				$objstaff_with_clip->add();
		
				$msg->send_msg('mycase-list.php','TV Channel ',3);
			}
						
			//Code to edit record
			if ($strmode == 'edit')
			{
				//$obj->update();
				
				$objinvestigated_tv_channel->update();
				$objclip_information->update();
				$objstaff_with_clip->update();
		
				$msg->send_msg('mycase-list.php','TV Channel ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('mycase-list.php','TV Channel ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('mycase-list.php','TV Channel ',5);
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
		$msg->send_msg('mycase-list.php','TV Channel ',15);
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
		
		$msg->send_msg('mycase-list.php','TV Channel ',62);
		exit();
	}
	
	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('investigation_case', 'cases.csv');
	}