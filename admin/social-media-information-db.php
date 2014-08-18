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
			
			$obj->case_id			= $cmn->setval(trim($cmn->read_value($_POST['txtcase_id'],'')));
			$obj->relation			= $cmn->setval(trim($cmn->read_value($_POST['txtrelation'],'')));
			$obj->fname			= $cmn->setval(trim($cmn->read_value($_POST['txtfname'],'')));
			$obj->lname			= $cmn->setval(trim($cmn->read_value($_POST['txtlname'],'')));
			
			
						$objsmi_person_social_media_sites->sp_id	= $_POST['sp_idsmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->social_media_site	= $_POST['social_media_sitesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->country	= $_POST['countrysmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->pname	= $_POST['pnamesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->note	= $_POST['notesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->username	= $_POST['usernamesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->unote	= $_POST['unotesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->user_id	= $_POST['user_idsmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->ppage	= $_POST['ppagesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->ppnote	= $_POST['ppnotesmi_person_social_media_sites'];
						$objsmi_person_social_media_sites->about_url	= $_POST['about_urlsmi_person_social_media_sites'];
						$objsmi_person_company->sp_id	= $_POST['sp_idsmi_person_company'];
						$objsmi_person_company->education_name	= $_POST['education_namesmi_person_company'];
						$objsmi_person_company->note	= $_POST['notesmi_person_company'];
						$objsmi_person_education->sp_id	= $_POST['sp_idsmi_person_education'];
						$objsmi_person_education->education_name	= $_POST['education_namesmi_person_education'];
						$objsmi_person_education->note	= $_POST['notesmi_person_education'];
						$objsmi_person_place_lived->sp_id	= $_POST['sp_idsmi_person_place_lived'];
						$objsmi_person_place_lived->state	= $_POST['statesmi_person_place_lived'];
						$objsmi_person_place_lived->country	= $_POST['countrysmi_person_place_lived'];
						$objsmi_person_groups->sp_id	= $_POST['sp_idsmi_person_groups'];
						$objsmi_person_groups->number_of_groups	= $_POST['number_of_groupssmi_person_groups'];
						$objsmi_person_groups->note	= $_POST['notesmi_person_groups'];
						$objsmi_person_groups->groups_page_url	= $_POST['groups_page_urlsmi_person_groups'];
						$objsmi_person_groups->gpnote	= $_POST['gpnotesmi_person_groups'];
						$objperson_investigated_favorite_pages->sp_id	= $_POST['sp_idperson_investigated_favorite_pages'];
						$objperson_investigated_favorite_pages->url	= $_POST['urlperson_investigated_favorite_pages'];
						$objperson_investigated_favorite_pages->note	= $_POST['noteperson_investigated_favorite_pages'];
						$objperson_investigated_favorite_pages->box_url	= $_POST['box_urlperson_investigated_favorite_pages'];
						$objperson_investigated_favorite_pages->is_case_related_activity	= $_POST['is_case_related_activityperson_investigated_favorite_pages'];
						$objphotos_by_friends_of_person_investigated->sp_id	= $_POST['sp_idphotos_by_friends_of_person_investigated'];
						$objphotos_by_friends_of_person_investigated->url	= $_POST['urlphotos_by_friends_of_person_investigated'];
						$objphotos_by_friends_of_person_investigated->note	= $_POST['notephotos_by_friends_of_person_investigated'];
						$objphotos_by_friends_of_person_investigated->box_url	= $_POST['box_urlphotos_by_friends_of_person_investigated'];
						$objphotos_by_friends_of_person_investigated->is_case_related_activity	= $_POST['is_case_related_activityphotos_by_friends_of_person_investigated'];
						$objphotos_by_friends_of_person_investigated_like->sp_id	= $_POST['sp_idphotos_by_friends_of_person_investigated_like'];
						$objphotos_by_friends_of_person_investigated_like->url	= $_POST['urlphotos_by_friends_of_person_investigated_like'];
						$objphotos_by_friends_of_person_investigated_like->note	= $_POST['notephotos_by_friends_of_person_investigated_like'];
						$objphotos_by_friends_of_person_investigated_like->box_url	= $_POST['box_urlphotos_by_friends_of_person_investigated_like'];
						$objphotos_by_friends_of_person_investigated_like->is_case_related_activity	= $_POST['is_case_related_activityphotos_by_friends_of_person_investigated_like'];
						$objphotos_commented_on_by_friends_of_person_investigated->sp_id	= $_POST['sp_idphotos_commented_on_by_friends_of_person_investigated'];
						$objphotos_commented_on_by_friends_of_person_investigated->url	= $_POST['urlphotos_commented_on_by_friends_of_person_investigated'];
						$objphotos_commented_on_by_friends_of_person_investigated->note	= $_POST['notephotos_commented_on_by_friends_of_person_investigated'];
						$objphotos_commented_on_by_friends_of_person_investigated->box_url	= $_POST['box_urlphotos_commented_on_by_friends_of_person_investigated'];
						$objphotos_commented_on_by_friends_of_person_investigated->is_case_related_activity	= $_POST['is_case_related_activityphotos_commented_on_by_friends_of_person_investigated'];
						$objphotos_commented_on_by_person_investigated->sp_id	= $_POST['sp_idphotos_commented_on_by_person_investigated'];
						$objphotos_commented_on_by_person_investigated->url	= $_POST['urlphotos_commented_on_by_person_investigated'];
						$objphotos_commented_on_by_person_investigated->note	= $_POST['notephotos_commented_on_by_person_investigated'];
						$objphotos_commented_on_by_person_investigated->box_url	= $_POST['box_urlphotos_commented_on_by_person_investigated'];
						$objphotos_commented_on_by_person_investigated->is_case_related_activity	= $_POST['is_case_related_activityphotos_commented_on_by_person_investigated'];
						$objphotos_of_friends_of_person_investigated->sp_id	= $_POST['sp_idphotos_of_friends_of_person_investigated'];
						$objphotos_of_friends_of_person_investigated->url	= $_POST['urlphotos_of_friends_of_person_investigated'];
						$objphotos_of_friends_of_person_investigated->note	= $_POST['notephotos_of_friends_of_person_investigated'];
						$objphotos_of_friends_of_person_investigated->box_url	= $_POST['box_urlphotos_of_friends_of_person_investigated'];
						$objphotos_of_friends_of_person_investigated->is_case_related_activity	= $_POST['is_case_related_activityphotos_of_friends_of_person_investigated'];
						$objphotos_of_person_investigated->sp_id	= $_POST['sp_idphotos_of_person_investigated'];
						$objphotos_of_person_investigated->url	= $_POST['urlphotos_of_person_investigated'];
						$objphotos_of_person_investigated->note	= $_POST['notephotos_of_person_investigated'];
						$objphotos_of_person_investigated->box_url	= $_POST['box_urlphotos_of_person_investigated'];
						$objphotos_of_person_investigated->is_case_related_activity	= $_POST['is_case_related_activityphotos_of_person_investigated'];
						$objphotos_person_investigated_like->sp_id	= $_POST['sp_idphotos_person_investigated_like'];
						$objphotos_person_investigated_like->url	= $_POST['urlphotos_person_investigated_like'];
						$objphotos_person_investigated_like->note	= $_POST['notephotos_person_investigated_like'];
						$objphotos_person_investigated_like->box_url	= $_POST['box_urlphotos_person_investigated_like'];
						$objphotos_person_investigated_like->is_case_related_activity	= $_POST['is_case_related_activityphotos_person_investigated_like'];
						$objposts->sp_id	= $_POST['sp_idposts'];
						$objposts->url	= $_POST['urlposts'];
						$objposts->note	= $_POST['noteposts'];
						$objposts->box_url	= $_POST['box_urlposts'];
			
			//Code to add record.
			if ($strmode == 'add')
			{
				$obj->add();
				
				
		$objsmi_person_social_media_sites->sp_id	= $obj->id;
		$objsmi_person_social_media_sites->add();
		
		$objsmi_person_company->sp_id	= $obj->id;
		$objsmi_person_company->add();
		
		$objsmi_person_education->sp_id	= $obj->id;
		$objsmi_person_education->add();
		
		$objsmi_person_place_lived->sp_id	= $obj->id;
		$objsmi_person_place_lived->add();
		
		$objsmi_person_groups->sp_id	= $obj->id;
		$objsmi_person_groups->add();
		
		$objperson_investigated_favorite_pages->sp_id	= $obj->id;
		$objperson_investigated_favorite_pages->add();
		
		$objphotos_by_friends_of_person_investigated->sp_id	= $obj->id;
		$objphotos_by_friends_of_person_investigated->add();
		
		$objphotos_by_friends_of_person_investigated_like->sp_id	= $obj->id;
		$objphotos_by_friends_of_person_investigated_like->add();
		
		$objphotos_commented_on_by_friends_of_person_investigated->sp_id	= $obj->id;
		$objphotos_commented_on_by_friends_of_person_investigated->add();
		
		$objphotos_commented_on_by_person_investigated->sp_id	= $obj->id;
		$objphotos_commented_on_by_person_investigated->add();
		
		$objphotos_of_friends_of_person_investigated->sp_id	= $obj->id;
		$objphotos_of_friends_of_person_investigated->add();
		
		$objphotos_of_person_investigated->sp_id	= $obj->id;
		$objphotos_of_person_investigated->add();
		
		$objphotos_person_investigated_like->sp_id	= $obj->id;
		$objphotos_person_investigated_like->add();
		
		$objposts->sp_id	= $obj->id;
		$objposts->add();
		
								
				$msg->send_msg('mycase-list.php','Social Media Information ',3);
			}
						
			//Code to edit record
			if ($strmode == 'edit')
			{
				$obj->update();
				
				
		$objsmi_person_social_media_sites->sp_id	= $obj->id;
		$objsmi_person_social_media_sites->id	= $_POST['txtidsmi_person_social_media_sites'];
		$objsmi_person_social_media_sites->update();
		
		$objsmi_person_company->sp_id	= $obj->id;
		$objsmi_person_company->id	= $_POST['txtidsmi_person_company'];
		$objsmi_person_company->update();
		
		$objsmi_person_education->sp_id	= $obj->id;
		$objsmi_person_education->id	= $_POST['txtidsmi_person_education'];
		$objsmi_person_education->update();
		
		$objsmi_person_place_lived->sp_id	= $obj->id;
		$objsmi_person_place_lived->id	= $_POST['txtidsmi_person_place_lived'];
		$objsmi_person_place_lived->update();
		
		$objsmi_person_groups->sp_id	= $obj->id;
		$objsmi_person_groups->id	= $_POST['txtidsmi_person_groups'];
		$objsmi_person_groups->update();
		
		$objperson_investigated_favorite_pages->sp_id	= $obj->id;
		$objperson_investigated_favorite_pages->id	= $_POST['txtidperson_investigated_favorite_pages'];
		$objperson_investigated_favorite_pages->update();
		
		$objphotos_by_friends_of_person_investigated->sp_id	= $obj->id;
		$objphotos_by_friends_of_person_investigated->id	= $_POST['txtidphotos_by_friends_of_person_investigated'];
		$objphotos_by_friends_of_person_investigated->update();
		
		$objphotos_by_friends_of_person_investigated_like->sp_id	= $obj->id;
		$objphotos_by_friends_of_person_investigated_like->id	= $_POST['txtidphotos_by_friends_of_person_investigated_like'];
		$objphotos_by_friends_of_person_investigated_like->update();
		
		$objphotos_commented_on_by_friends_of_person_investigated->sp_id	= $obj->id;
		$objphotos_commented_on_by_friends_of_person_investigated->id	= $_POST['txtidphotos_commented_on_by_friends_of_person_investigated'];
		$objphotos_commented_on_by_friends_of_person_investigated->update();
		
		$objphotos_commented_on_by_person_investigated->sp_id	= $obj->id;
		$objphotos_commented_on_by_person_investigated->id	= $_POST['txtidphotos_commented_on_by_person_investigated'];
		$objphotos_commented_on_by_person_investigated->update();
		
		$objphotos_of_friends_of_person_investigated->sp_id	= $obj->id;
		$objphotos_of_friends_of_person_investigated->id	= $_POST['txtidphotos_of_friends_of_person_investigated'];
		$objphotos_of_friends_of_person_investigated->update();
		
		$objphotos_of_person_investigated->sp_id	= $obj->id;
		$objphotos_of_person_investigated->id	= $_POST['txtidphotos_of_person_investigated'];
		$objphotos_of_person_investigated->update();
		
		$objphotos_person_investigated_like->sp_id	= $obj->id;
		$objphotos_person_investigated_like->id	= $_POST['txtidphotos_person_investigated_like'];
		$objphotos_person_investigated_like->update();
		
		$objposts->sp_id	= $obj->id;
		$objposts->id	= $_POST['txtidposts'];
		$objposts->update();
		
				
				$msg->send_msg('mycase-list.php','Social Media Information ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('mycase-list.php','Social Media Information ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('mycase-list.php','Social Media Information ',5);
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
		$msg->send_msg('mycase-list.php','Social Media Information ',15);
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
		
		$msg->send_msg('mycase-list.php','Social Media Information ',62);
		exit();
	}
	
	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('investigation_case', 'cases.csv');
	}