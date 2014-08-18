<?php
	require_once 'include/general-includes.php';
	require_once 'class/case.class.php';
	require_once 'class/social-media-information.class.php';
	
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));

	//code to assign primary key to main variable...
	$case_id = 0;
	
	if (isset($_REQUEST['case_id']) && trim($_REQUEST['case_id'])!='')
		$case_id = $_REQUEST['case_id'];
	
	//set mode...
	$strmode='add';
	
	if(isset($_REQUEST['mode']))
		$strmode = trim($_REQUEST['mode']);
	
	if($cmn->is_record_exists('smi_person', 'case_id', $case_id, ''))
	{
		$strmode = 'edit';
	}
	
	//code to check record existance in case of edit...
	$record_condition = '';
	if (!($cmn->is_record_exists('investigation_case', 'id', $case_id, $record_condition)))
		$msg->send_msg('mycase-list.php','',46);

	//create object of main entity...
	$objCase = new investigation_case();
	
	$objCase->setallvalues($case_id);
	
	//create object of main entity...
	$obj = new social_media_information();
		//create object of smi_person_social_media_sites
		require_once 'class/smi_person_social_media_sites.class.php';
		$objsmi_person_social_media_sites = new smi_person_social_media_sites();
		//create object of smi_person_company
		require_once 'class/smi_person_company.class.php';
		$objsmi_person_company = new smi_person_company();
		//create object of smi_person_education
		require_once 'class/smi_person_education.class.php';
		$objsmi_person_education = new smi_person_education();
		//create object of smi_person_place_lived
		require_once 'class/smi_person_place_lived.class.php';
		$objsmi_person_place_lived = new smi_person_place_lived();
		//create object of smi_person_groups
		require_once 'class/smi_person_groups.class.php';
		$objsmi_person_groups = new smi_person_groups();
		//create object of person_investigated_favorite_pages
		require_once 'class/person_investigated_favorite_pages.class.php';
		$objperson_investigated_favorite_pages = new person_investigated_favorite_pages();
		//create object of photos_by_friends_of_person_investigated
		require_once 'class/photos_by_friends_of_person_investigated.class.php';
		$objphotos_by_friends_of_person_investigated = new photos_by_friends_of_person_investigated();
		//create object of photos_by_friends_of_person_investigated_like
		require_once 'class/photos_by_friends_of_person_investigated_like.class.php';
		$objphotos_by_friends_of_person_investigated_like = new photos_by_friends_of_person_investigated_like();
		//create object of photos_commented_on_by_friends_of_person_investigated
		require_once 'class/photos_commented_on_by_friends_of_person_investigated.class.php';
		$objphotos_commented_on_by_friends_of_person_investigated = new photos_commented_on_by_friends_of_person_investigated();
		//create object of photos_commented_on_by_person_investigated
		require_once 'class/photos_commented_on_by_person_investigated.class.php';
		$objphotos_commented_on_by_person_investigated = new photos_commented_on_by_person_investigated();
		//create object of photos_of_friends_of_person_investigated
		require_once 'class/photos_of_friends_of_person_investigated.class.php';
		$objphotos_of_friends_of_person_investigated = new photos_of_friends_of_person_investigated();
		//create object of photos_of_person_investigated
		require_once 'class/photos_of_person_investigated.class.php';
		$objphotos_of_person_investigated = new photos_of_person_investigated();
		//create object of photos_person_investigated_like
		require_once 'class/photos_person_investigated_like.class.php';
		$objphotos_person_investigated_like = new photos_person_investigated_like();
		//create object of posts
		require_once 'class/posts.class.php';
		$objposts = new posts();
	//include db file here...
	require_once 'social-media-information-db.php';

	if(isset($_SESSION['err']))
	{
		
			$obj->case_id	= $cmn->getval(trim($cmn->read_value($_POST['case_id'],0)));
			$obj->relation	= $cmn->getval(trim($cmn->read_value($_POST['relation'],0)));
			$obj->fname	= $cmn->getval(trim($cmn->read_value($_POST['fname'],0)));
			$obj->lname	= $cmn->getval(trim($cmn->read_value($_POST['lname'],0)));
	}
	else
	{
		if($strmode=='edit')
		{
			$obj->setallvalues($case_id);
			
			
		$objsmi_person_social_media_sites->setallvalues(null,' AND sp_id = '.$obj->id);
		$objsmi_person_company->setallvalues(null,' AND sp_id = '.$obj->id);
		$objsmi_person_education->setallvalues(null,' AND sp_id = '.$obj->id);
		$objsmi_person_place_lived->setallvalues(null,' AND sp_id = '.$obj->id);
		$objsmi_person_groups->setallvalues(null,' AND sp_id = '.$obj->id);
		$objperson_investigated_favorite_pages->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_by_friends_of_person_investigated->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_by_friends_of_person_investigated_like->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_commented_on_by_friends_of_person_investigated->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_commented_on_by_person_investigated->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_of_friends_of_person_investigated->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_of_person_investigated->setallvalues(null,' AND sp_id = '.$obj->id);
		$objphotos_person_investigated_like->setallvalues(null,' AND sp_id = '.$obj->id);
		$objposts->setallvalues(null,' AND sp_id = '.$obj->id);
		}
	}
	
	//set flags for jquery lib
	$isDatePicker	= true;
	$isValidation	= true;
	$isFancyBox		= false;
	$isGeneralTabs	= true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>
<?php
	$smi_person_social_media_sites_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>smi_person_social_media_sites:</label></td><td align="left" valign="top"><input type="button" name="btnDeletesmi_person_social_media_sites" class="button" value="Delete" onclick="deletesmi_person_social_media_sites(this,0);" /><input type="hidden" name="txtidsmi_person_social_media_sites[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idsmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Social_media_site:</label></td><td align="left" valign="top"><input type="text" name="txtsocial_media_sitesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Country:</label></td><td align="left" valign="top"><input type="text" name="txtcountrysmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Pname:</label></td><td align="left" valign="top"><input type="text" name="txtpnamesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Username:</label></td><td align="left" valign="top"><input type="text" name="txtusernamesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Unote:</label></td><td align="left" valign="top"><input type="text" name="txtunotesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>User_id:</label></td><td align="left" valign="top"><input type="text" name="txtuser_idsmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Ppage:</label></td><td align="left" valign="top"><input type="text" name="txtppagesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Ppnote:</label></td><td align="left" valign="top"><input type="text" name="txtppnotesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>About_url:</label></td><td align="left" valign="top"><input type="text" name="txtabout_urlsmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$smi_person_company_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>smi_person_company:</label></td><td align="left" valign="top"><input type="button" name="btnDeletesmi_person_company" class="button" value="Delete" onclick="deletesmi_person_company(this,0);" /><input type="hidden" name="txtidsmi_person_company[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idsmi_person_company[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Education_name:</label></td><td align="left" valign="top"><input type="text" name="txteducation_namesmi_person_company[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotesmi_person_company[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$smi_person_education_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>smi_person_education:</label></td><td align="left" valign="top"><input type="button" name="btnDeletesmi_person_education" class="button" value="Delete" onclick="deletesmi_person_education(this,0);" /><input type="hidden" name="txtidsmi_person_education[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idsmi_person_education[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Education_name:</label></td><td align="left" valign="top"><input type="text" name="txteducation_namesmi_person_education[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotesmi_person_education[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$smi_person_place_lived_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>smi_person_place_lived:</label></td><td align="left" valign="top"><input type="button" name="btnDeletesmi_person_place_lived" class="button" value="Delete" onclick="deletesmi_person_place_lived(this,0);" /><input type="hidden" name="txtidsmi_person_place_lived[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idsmi_person_place_lived[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>State:</label></td><td align="left" valign="top"><input type="text" name="txtstatesmi_person_place_lived[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Country:</label></td><td align="left" valign="top"><input type="text" name="txtcountrysmi_person_place_lived[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$smi_person_groups_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>smi_person_groups:</label></td><td align="left" valign="top"><input type="button" name="btnDeletesmi_person_groups" class="button" value="Delete" onclick="deletesmi_person_groups(this,0);" /><input type="hidden" name="txtidsmi_person_groups[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idsmi_person_groups[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Number_of_groups:</label></td><td align="left" valign="top"><input type="text" name="txtnumber_of_groupssmi_person_groups[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotesmi_person_groups[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Groups_page_url:</label></td><td align="left" valign="top"><input type="text" name="txtgroups_page_urlsmi_person_groups[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Gpnote:</label></td><td align="left" valign="top"><input type="text" name="txtgpnotesmi_person_groups[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$person_investigated_favorite_pages_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>person_investigated_favorite_pages:</label></td><td align="left" valign="top"><input type="button" name="btnDeleteperson_investigated_favorite_pages" class="button" value="Delete" onclick="deleteperson_investigated_favorite_pages(this,0);" /><input type="hidden" name="txtidperson_investigated_favorite_pages[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnoteperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_by_friends_of_person_investigated_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_by_friends_of_person_investigated:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_by_friends_of_person_investigated" class="button" value="Delete" onclick="deletephotos_by_friends_of_person_investigated(this,0);" /><input type="hidden" name="txtidphotos_by_friends_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_by_friends_of_person_investigated_like_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_by_friends_of_person_investigated_like:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_by_friends_of_person_investigated_like" class="button" value="Delete" onclick="deletephotos_by_friends_of_person_investigated_like(this,0);" /><input type="hidden" name="txtidphotos_by_friends_of_person_investigated_like[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_commented_on_by_friends_of_person_investigated_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_commented_on_by_friends_of_person_investigated:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_commented_on_by_friends_of_person_investigated" class="button" value="Delete" onclick="deletephotos_commented_on_by_friends_of_person_investigated(this,0);" /><input type="hidden" name="txtidphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_commented_on_by_person_investigated_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_commented_on_by_person_investigated:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_commented_on_by_person_investigated" class="button" value="Delete" onclick="deletephotos_commented_on_by_person_investigated(this,0);" /><input type="hidden" name="txtidphotos_commented_on_by_person_investigated[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_of_friends_of_person_investigated_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_of_friends_of_person_investigated:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_of_friends_of_person_investigated" class="button" value="Delete" onclick="deletephotos_of_friends_of_person_investigated(this,0);" /><input type="hidden" name="txtidphotos_of_friends_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_of_person_investigated_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_of_person_investigated:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_of_person_investigated" class="button" value="Delete" onclick="deletephotos_of_person_investigated(this,0);" /><input type="hidden" name="txtidphotos_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$photos_person_investigated_like_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>photos_person_investigated_like:</label></td><td align="left" valign="top"><input type="button" name="btnDeletephotos_person_investigated_like" class="button" value="Delete" onclick="deletephotos_person_investigated_like(this,0);" /><input type="hidden" name="txtidphotos_person_investigated_like[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotephotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Is_case_related_activity:</label></td><td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$posts_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>posts:</label></td><td align="left" valign="top"><input type="button" name="btnDeleteposts" class="button" value="Delete" onclick="deleteposts(this,0);" /><input type="hidden" name="txtidposts[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Sp_id:</label></td><td align="left" valign="top"><input type="text" name="txtsp_idposts[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlposts[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnoteposts[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlposts[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
?>
<script language="javascript" type="text/javascript">
	function validate(){
		/*var index = 0;
		var arValidate = new Array;
		arValidate[index++] = new Array("R", "document.frm.txtperson_investigated", "person_investigated");
		
		if (!Isvalid(arValidate)){
			return false;
		}*/
		return true;
	}
	
	
		function addMoresmi_person_social_media_sites()
		{
			var html	= '<?php echo $smi_person_social_media_sites_html; ?>';
			$('#smi_person_social_media_sites_container').append(html);
		}
		
		function deletesmi_person_social_media_sites(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this smi_person_social_media_sites?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletesmi_person_social_media_sites", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMoresmi_person_company()
		{
			var html	= '<?php echo $smi_person_company_html; ?>';
			$('#smi_person_company_container').append(html);
		}
		
		function deletesmi_person_company(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this smi_person_company?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletesmi_person_company", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMoresmi_person_education()
		{
			var html	= '<?php echo $smi_person_education_html; ?>';
			$('#smi_person_education_container').append(html);
		}
		
		function deletesmi_person_education(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this smi_person_education?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletesmi_person_education", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMoresmi_person_place_lived()
		{
			var html	= '<?php echo $smi_person_place_lived_html; ?>';
			$('#smi_person_place_lived_container').append(html);
		}
		
		function deletesmi_person_place_lived(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this smi_person_place_lived?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletesmi_person_place_lived", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMoresmi_person_groups()
		{
			var html	= '<?php echo $smi_person_groups_html; ?>';
			$('#smi_person_groups_container').append(html);
		}
		
		function deletesmi_person_groups(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this smi_person_groups?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletesmi_person_groups", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMoreperson_investigated_favorite_pages()
		{
			var html	= '<?php echo $person_investigated_favorite_pages_html; ?>';
			$('#person_investigated_favorite_pages_container').append(html);
		}
		
		function deleteperson_investigated_favorite_pages(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this person_investigated_favorite_pages?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deleteperson_investigated_favorite_pages", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_by_friends_of_person_investigated()
		{
			var html	= '<?php echo $photos_by_friends_of_person_investigated_html; ?>';
			$('#photos_by_friends_of_person_investigated_container').append(html);
		}
		
		function deletephotos_by_friends_of_person_investigated(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_by_friends_of_person_investigated?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_by_friends_of_person_investigated", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_by_friends_of_person_investigated_like()
		{
			var html	= '<?php echo $photos_by_friends_of_person_investigated_like_html; ?>';
			$('#photos_by_friends_of_person_investigated_like_container').append(html);
		}
		
		function deletephotos_by_friends_of_person_investigated_like(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_by_friends_of_person_investigated_like?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_by_friends_of_person_investigated_like", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_commented_on_by_friends_of_person_investigated()
		{
			var html	= '<?php echo $photos_commented_on_by_friends_of_person_investigated_html; ?>';
			$('#photos_commented_on_by_friends_of_person_investigated_container').append(html);
		}
		
		function deletephotos_commented_on_by_friends_of_person_investigated(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_commented_on_by_friends_of_person_investigated?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_commented_on_by_friends_of_person_investigated", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_commented_on_by_person_investigated()
		{
			var html	= '<?php echo $photos_commented_on_by_person_investigated_html; ?>';
			$('#photos_commented_on_by_person_investigated_container').append(html);
		}
		
		function deletephotos_commented_on_by_person_investigated(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_commented_on_by_person_investigated?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_commented_on_by_person_investigated", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_of_friends_of_person_investigated()
		{
			var html	= '<?php echo $photos_of_friends_of_person_investigated_html; ?>';
			$('#photos_of_friends_of_person_investigated_container').append(html);
		}
		
		function deletephotos_of_friends_of_person_investigated(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_of_friends_of_person_investigated?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_of_friends_of_person_investigated", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_of_person_investigated()
		{
			var html	= '<?php echo $photos_of_person_investigated_html; ?>';
			$('#photos_of_person_investigated_container').append(html);
		}
		
		function deletephotos_of_person_investigated(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_of_person_investigated?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_of_person_investigated", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMorephotos_person_investigated_like()
		{
			var html	= '<?php echo $photos_person_investigated_like_html; ?>';
			$('#photos_person_investigated_like_container').append(html);
		}
		
		function deletephotos_person_investigated_like(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this photos_person_investigated_like?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletephotos_person_investigated_like", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
		function addMoreposts()
		{
			var html	= '<?php echo $posts_html; ?>';
			$('#posts_container').append(html);
		}
		
		function deleteposts(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this posts?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deleteposts", id: id }
					})
					.done(function( msg ) {
						//alert( "Data Saved: " + msg );
						$(obj).closest('table').remove();
					});
				}
				else
				{
					$(obj).closest('table').remove();
				}
				//alert($(obj).closest('table').html());
			}
		}
		
	$(document).ready(function() {
		$('.saveme-ajax').click(function(obj){
			if(confirm('Are you sure you want to save this info?'))
			{
				var form = $(this).closest('form');
				
				$.ajax({
					type: "POST",
					url: $(form).attr('action'),
					data: $(form).serialize(),
					dataType: "json"
				})
				.done(function( data ) {
					alert('Note save successfully!');
					
					if(data.reloadMe == 'yes')
					{
						window.location.reload();
					}
				});
			}
		});
	});
</script>
</head>
<body>
<form name="frmfiledelete" id="frmfiledelete" style="display:none;visibility:hidden;" method="post">
	<input type="hidden" name="hdnmodedeleteimage" id="hdnmodedeleteimage" value="<?php echo htmlspecialchars($obj->id); ?>" style="display:none;visibility:hidden;" />
</form>
<table height="100%" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td height="72" valign="middle" class="header-main"><?php require_once 'include/header.php'; ?></td>
  </tr>
  <tr>
    <td height="100%" valign="top" class="content-background"><div class="content">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr valign="top">
            <td class="main-content"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td align="left" valign="top" class="box-heading"><h2>Social Media Information</h2></td>
                </tr>
                <tr>
                  <td align="left" valign="top" height="15"></td>
                </tr>
                <?php 
					if ( isset($_SESSION['err']) ) {
				?>
                <tr>
                  <td align="left" valign="top"><?php $msg->display_msg(); ?></td>
                </tr>
                <?php	
					}
				?>
                <tr>
                  <td align="left" valign="top">
				  <?php 
						if ( ( $user_rights_array['add'] && $strmode == 'add' )  || ( $user_rights_array['edit'] && $strmode == 'edit' ) ) {
					?>
                    <form name="frm" id="frm" method="post" action="<?php echo trim($_SERVER['REQUEST_URI']); ?>" onsubmit="javascript: return validate();" enctype="multipart/form-data">
                    	<input type="hidden" name="case_id" class="textbox" id="case_id" value="<?php echo htmlspecialchars($objCase->id); ?>" maxlength="100" />
                      <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="100%">
						<tr>
							<td colspan="2">
								<table width="100%">
								   <tr>
										<td align="left" valign="middle" height="25" width="80%">
													<a href="personal-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Personal Information</a>&nbsp;&nbsp;
													<a href="social-media-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="active">Manage Social
													Media Information</a>&nbsp;&nbsp;
													<a href="newspaper-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Newspaper</a>&nbsp;&nbsp;
													<a href="tv-channel-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage TV Channel</a>&nbsp;&nbsp;
													<a href="sequence-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Sequence</a>
												  </td>
									  <td align="right" valign="top" class="required-sentence" ><?php echo REQUIRED_SENTENCE; ?></td>
									</tr>
								</table>
							</td>
						</tr>
					
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Person investigated:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($objCase->person_investigated); ?></td>
                        </tr>
             			<tr>
                          <td align="left" valign="top"width="150"><label>DOI:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($objCase->doi); ?></td>
                        </tr>
             			<tr>
                          <td align="left" valign="top"width="150"><label>Report date:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($objCase->report_date); ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                          <td align="left" valign="top">
                          	<?php echo $objCase->note; ?>
                          </td>
                        </tr>
						
                        <!-- Social Media Information start -->
                        <tr>
                          <td align="left" valign="top" colspan="2">
	                          	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="100%">
                                    <tr>
                                    	<td valign="top">
                                        	<fieldset>
                                                <legend>Person</legend>
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                    
			<tr>
			  <td align="left" valign="top"><label></label></td>
			  <td align="left" valign="top"><input type="hidden" name="txtcase_id" class="textbox" id="txtcase_id" value="<?php echo htmlspecialchars($obj->case_id); ?>" maxlength="100" /></td>
			</tr>
			<tr>
			  <td align="left" valign="top"><label>Relation of Person:</label></td>
			  <td align="left" valign="top"><input type="text" name="txtrelation" class="textbox" id="txtrelation" value="<?php echo htmlspecialchars($obj->relation); ?>" maxlength="100" /></td>
			</tr>
			<tr>
			  <td align="left" valign="top"><label>First Name:</label></td>
			  <td align="left" valign="top"><input type="text" name="txtfname" class="textbox" id="txtfname" value="<?php echo htmlspecialchars($obj->fname); ?>" maxlength="100" /></td>
			</tr>
			<tr>
			  <td align="left" valign="top"><label>Last Name:</label></td>
			  <td align="left" valign="top"><input type="text" name="txtlname" class="textbox" id="txtlname" value="<?php echo htmlspecialchars($obj->lname); ?>" maxlength="100" /></td>
			</tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </table>
                          </td>
                        </tr>
                        
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Social Media Site</legend>
                                <div id="smi_person_social_media_sites_container">
                                	<?php
                                    	if(count($objsmi_person_social_media_sites->id) > 0)
										{
											$i=0;
											
											foreach($objsmi_person_social_media_sites->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Social Profile:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoresmi_person_social_media_sites" class="button" id="btnaddmoresmi_person_social_media_sites" value="Add More" onclick="addMoresmi_person_social_media_sites();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletesmi_person_social_media_sites" class="button" value="Delete" onclick="deletesmi_person_social_media_sites(this,<?php echo htmlspecialchars($objsmi_person_social_media_sites->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidsmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->sp_id[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Social Media Site:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtsocial_media_sitesmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->social_media_site[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountrysmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->country[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtpnamesmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->pname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotesmi_person_social_media_sites[]" rows="12"><?php echo $objsmi_person_social_media_sites->note[$key]; ?></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtusernamesmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Username Notes:</label></td>
							  <td align="left" valign="top">
                              	<textarea name="txtunotesmi_person_social_media_sites[]" rows="12"><?php echo $objsmi_person_social_media_sites->unote[$key]; ?></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>User ID:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtuser_idsmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->user_id[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtppagesmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->ppage[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Page Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtppnotesmi_person_social_media_sites[]" rows="12"><?php echo $objsmi_person_social_media_sites->ppnote[$key]; ?></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>About Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtabout_urlsmi_person_social_media_sites[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_social_media_sites->about_url[$key]); ?>" maxlength="100" /></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Social Profile:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoresmi_person_social_media_sites" class="button" id="btnaddmoresmi_person_social_media_sites" value="Add More" onclick="addMoresmi_person_social_media_sites();" /><input type="hidden" name="txtidsmi_person_social_media_sites[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Social Media Site:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtsocial_media_sitesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountrysmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtpnamesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotesmi_person_social_media_sites[]" rows="12"></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtusernamesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Username Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtunotesmi_person_social_media_sites[]" rows="12"></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>User ID:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtuser_idsmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtppagesmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Profile Page Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtppnotesmi_person_social_media_sites[]" rows="12"></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>About Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtabout_urlsmi_person_social_media_sites[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Company</legend>
                                <div id="smi_person_company_container">
                                	<?php
                                    	if(count($objsmi_person_company->id) > 0)
										{
											$i=0;
											
											foreach($objsmi_person_company->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Company:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoresmi_person_company" class="button" id="btnaddmoresmi_person_company" value="Add More" onclick="addMoresmi_person_company();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletesmi_person_company" class="button" value="Delete" onclick="deletesmi_person_company(this,<?php echo htmlspecialchars($objsmi_person_company->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidsmi_person_company[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_company->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_company[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_company->sp_id[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Company Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txteducation_namesmi_person_company[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_company->education_name[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Company Note:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotesmi_person_company[]" rows="12"><?php echo $objsmi_person_company->note[$key]; ?></textarea></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Company:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoresmi_person_company" class="button" id="btnaddmoresmi_person_company" value="Add More" onclick="addMoresmi_person_company();" /><input type="hidden" name="txtidsmi_person_company[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_company[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Company Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txteducation_namesmi_person_company[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Company Note:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnotesmi_person_company[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Education</legend>
                                <div id="smi_person_education_container">
                                	<?php
                                    	if(count($objsmi_person_education->id) > 0)
										{
											$i=0;
											
											foreach($objsmi_person_education->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Education:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoresmi_person_education" class="button" id="btnaddmoresmi_person_education" value="Add More" onclick="addMoresmi_person_education();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletesmi_person_education" class="button" value="Delete" onclick="deletesmi_person_education(this,<?php echo htmlspecialchars($objsmi_person_education->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidsmi_person_education[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_education->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_education[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_education->sp_id[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Education Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txteducation_namesmi_person_education[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_education->education_name[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Education Note:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotesmi_person_education[]" rows="12"><?php echo htmlspecialchars($objsmi_person_education->note[$key]); ?></textarea></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Education:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoresmi_person_education" class="button" id="btnaddmoresmi_person_education" value="Add More" onclick="addMoresmi_person_education();" /><input type="hidden" name="txtidsmi_person_education[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_education[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Education Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txteducation_namesmi_person_education[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Education Note:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotesmi_person_education[]" rows="12"></textarea></td>
							</tr>
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Place Lived</legend>
                                <div id="smi_person_place_lived_container">
                                	<?php
                                    	if(count($objsmi_person_place_lived->id) > 0)
										{
											$i=0;
											
											foreach($objsmi_person_place_lived->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Place Lived:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoresmi_person_place_lived" class="button" id="btnaddmoresmi_person_place_lived" value="Add More" onclick="addMoresmi_person_place_lived();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletesmi_person_place_lived" class="button" value="Delete" onclick="deletesmi_person_place_lived(this,<?php echo htmlspecialchars($objsmi_person_place_lived->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidsmi_person_place_lived[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_place_lived->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_place_lived[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_place_lived->sp_id[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstatesmi_person_place_lived[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_place_lived->state[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountrysmi_person_place_lived[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_place_lived->country[$key]); ?>" maxlength="100" /></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Place Lived:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoresmi_person_place_lived" class="button" id="btnaddmoresmi_person_place_lived" value="Add More" onclick="addMoresmi_person_place_lived();" /><input type="hidden" name="txtidsmi_person_place_lived[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						<tr>
							  <td align="left" valign="top"width="150"><label></label></td>
							  <td align="left" valign="top"><input type="hidden" name="txtsp_idsmi_person_place_lived[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstatesmi_person_place_lived[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountrysmi_person_place_lived[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Groups</legend>
                                <div id="smi_person_groups_container">
                                	<?php
                                    	if(count($objsmi_person_groups->id) > 0)
										{
											$i=0;
											
											foreach($objsmi_person_groups->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Groups:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoresmi_person_groups" class="button" id="btnaddmoresmi_person_groups" value="Add More" onclick="addMoresmi_person_groups();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletesmi_person_groups" class="button" value="Delete" onclick="deletesmi_person_groups(this,<?php echo htmlspecialchars($objsmi_person_groups->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidsmi_person_groups[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_groups->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Number of Groups:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnumber_of_groupssmi_person_groups[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_groups->number_of_groups[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Groups Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotesmi_person_groups[]" rows="12"><?php echo $objsmi_person_groups->note[$key]; ?></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Groups Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtgroups_page_urlsmi_person_groups[]" class="textbox" value="<?php echo htmlspecialchars($objsmi_person_groups->groups_page_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Groups Page Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtgpnotesmi_person_groups[]" rows="12"><?php echo $objsmi_person_groups->gpnote[$key]; ?></textarea>
                              </td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Groups:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoresmi_person_groups" class="button" id="btnaddmoresmi_person_groups" value="Add More" onclick="addMoresmi_person_groups();" /><input type="hidden" name="txtidsmi_person_groups[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Number of Groups:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnumber_of_groupssmi_person_groups[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Groups Notes:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnotesmi_person_groups[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Groups Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtgroups_page_urlsmi_person_groups[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Groups Page Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtgpnotesmi_person_groups[]" rows="12"></textarea></td>
							</tr>
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Person Investigated Favorite Pages</legend>
                                <div id="person_investigated_favorite_pages_container">
                                	<?php
                                    	if(count($objperson_investigated_favorite_pages->id) > 0)
										{
											$i=0;
											
											foreach($objperson_investigated_favorite_pages->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Favorite Pages:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoreperson_investigated_favorite_pages" class="button" id="btnaddmoreperson_investigated_favorite_pages" value="Add More" onclick="addMoreperson_investigated_favorite_pages();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeleteperson_investigated_favorite_pages" class="button" value="Delete" onclick="deleteperson_investigated_favorite_pages(this,<?php echo htmlspecialchars($objperson_investigated_favorite_pages->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidperson_investigated_favorite_pages[]" class="textbox" value="<?php echo htmlspecialchars($objperson_investigated_favorite_pages->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlperson_investigated_favorite_pages[]" class="textbox" value="<?php echo htmlspecialchars($objperson_investigated_favorite_pages->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnoteperson_investigated_favorite_pages[]" rows="12"><?php echo $objperson_investigated_favorite_pages->note[$key]; ?></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityperson_investigated_favorite_pages[]" class="textbox" value="<?php echo htmlspecialchars($objperson_investigated_favorite_pages->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlperson_investigated_favorite_pages[]" class="textbox" value="<?php echo htmlspecialchars($objperson_investigated_favorite_pages->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>	Favorite Pages:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoreperson_investigated_favorite_pages" class="button" id="btnaddmoreperson_investigated_favorite_pages" value="Add More" onclick="addMoreperson_investigated_favorite_pages();" /><input type="hidden" name="txtidperson_investigated_favorite_pages[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnoteperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlperson_investigated_favorite_pages[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos By Friends of Person Investigated</legend>
                                <div id="photos_by_friends_of_person_investigated_container">
                                	<?php
                                    	if(count($objphotos_by_friends_of_person_investigated->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_by_friends_of_person_investigated->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos By Friends:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_by_friends_of_person_investigated" class="button" id="btnaddmorephotos_by_friends_of_person_investigated" value="Add More" onclick="addMorephotos_by_friends_of_person_investigated();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_by_friends_of_person_investigated" class="button" value="Delete" onclick="deletephotos_by_friends_of_person_investigated(this,<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_by_friends_of_person_investigated[]" rows="12"><?php echo $objphotos_by_friends_of_person_investigated->note[$key]; ?></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos By Friends:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_by_friends_of_person_investigated" class="button" id="btnaddmorephotos_by_friends_of_person_investigated" value="Add More" onclick="addMorephotos_by_friends_of_person_investigated();" /><input type="hidden" name="txtidphotos_by_friends_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_by_friends_of_person_investigated[]" rows="12"></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos Friends of Person Investigated Like</legend>
                                <div id="photos_by_friends_of_person_investigated_like_container">
                                	<?php
                                    	if(count($objphotos_by_friends_of_person_investigated_like->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_by_friends_of_person_investigated_like->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos by Friends of Person Investigated Like:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_by_friends_of_person_investigated_like" class="button" id="btnaddmorephotos_by_friends_of_person_investigated_like" value="Add More" onclick="addMorephotos_by_friends_of_person_investigated_like();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_by_friends_of_person_investigated_like" class="button" value="Delete" onclick="deletephotos_by_friends_of_person_investigated_like(this,<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated_like->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_by_friends_of_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated_like->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						 <tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_by_friends_of_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated_like->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_by_friends_of_person_investigated_like[]" rows="12"><?php echo $objphotos_by_friends_of_person_investigated_like->note[$key]; ?></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_by_friends_of_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated_like->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
						<tr>
							  <td align="left" valign="top"width="150"><label>Box url:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_by_friends_of_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_by_friends_of_person_investigated_like->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>

							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos by Friends of Person Investigated Like:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_by_friends_of_person_investigated_like" class="button" id="btnaddmorephotos_by_friends_of_person_investigated_like" value="Add More" onclick="addMorephotos_by_friends_of_person_investigated_like();" /><input type="hidden" name="txtidphotos_by_friends_of_person_investigated_like[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_by_friends_of_person_investigated_like[]" rows="12"></textarea></td>
							</tr>
						
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_by_friends_of_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos Commented on by Friend of Person Investigated</legend>
                                <div id="photos_commented_on_by_friends_of_person_investigated_container">
                                	<?php
                                    	if(count($objphotos_commented_on_by_friends_of_person_investigated->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_commented_on_by_friends_of_person_investigated->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos Commented on by Friend of Person Investigated:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_commented_on_by_friends_of_person_investigated" class="button" id="btnaddmorephotos_commented_on_by_friends_of_person_investigated" value="Add More" onclick="addMorephotos_commented_on_by_friends_of_person_investigated();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_commented_on_by_friends_of_person_investigated" class="button" value="Delete" onclick="deletephotos_commented_on_by_friends_of_person_investigated(this,<?php echo htmlspecialchars($objphotos_commented_on_by_friends_of_person_investigated->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_friends_of_person_investigated->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_friends_of_person_investigated->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_commented_on_by_friends_of_person_investigated[]" rows="12"><?php echo $objphotos_commented_on_by_friends_of_person_investigated->note[$key]; ?></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_friends_of_person_investigated->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_friends_of_person_investigated->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>

							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos Commented on by Friend of Person Investigated:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_commented_on_by_friends_of_person_investigated" class="button" id="btnaddmorephotos_commented_on_by_friends_of_person_investigated" value="Add More" onclick="addMorephotos_commented_on_by_friends_of_person_investigated();" /><input type="hidden" name="txtidphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_commented_on_by_friends_of_person_investigated[]" rows="12"></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_commented_on_by_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos Commented on by Person Investigated</legend>
                                <div id="photos_commented_on_by_person_investigated_container">
                                	<?php
                                    	if(count($objphotos_commented_on_by_person_investigated->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_commented_on_by_person_investigated->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos Commented on by Person Investigated:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_commented_on_by_person_investigated" class="button" id="btnaddmorephotos_commented_on_by_person_investigated" value="Add More" onclick="addMorephotos_commented_on_by_person_investigated();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_commented_on_by_person_investigated" class="button" value="Delete" onclick="deletephotos_commented_on_by_person_investigated(this,<?php echo htmlspecialchars($objphotos_commented_on_by_person_investigated->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_commented_on_by_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_person_investigated->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_commented_on_by_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_person_investigated->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_commented_on_by_person_investigated[]" rows="12"><?php echo $objphotos_commented_on_by_person_investigated->note[$key]; ?></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_commented_on_by_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_person_investigated->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_commented_on_by_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_commented_on_by_person_investigated->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos Commented on by Person Investigated:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_commented_on_by_person_investigated" class="button" id="btnaddmorephotos_commented_on_by_person_investigated" value="Add More" onclick="addMorephotos_commented_on_by_person_investigated();" /><input type="hidden" name="txtidphotos_commented_on_by_person_investigated[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_commented_on_by_person_investigated[]" rows="12"></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_commented_on_by_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos of Friends of Person Investigated</legend>
                                <div id="photos_of_friends_of_person_investigated_container">
                                	<?php
                                    	if(count($objphotos_of_friends_of_person_investigated->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_of_friends_of_person_investigated->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos of Friends of Person Investigated:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_of_friends_of_person_investigated" class="button" id="btnaddmorephotos_of_friends_of_person_investigated" value="Add More" onclick="addMorephotos_of_friends_of_person_investigated();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_of_friends_of_person_investigated" class="button" value="Delete" onclick="deletephotos_of_friends_of_person_investigated(this,<?php echo htmlspecialchars($objphotos_of_friends_of_person_investigated->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_of_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_friends_of_person_investigated->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_of_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_friends_of_person_investigated->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_of_friends_of_person_investigated[]" rows="12"><?php echo $objphotos_of_friends_of_person_investigated->note[$key]; ?></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_of_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_friends_of_person_investigated->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_of_friends_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_friends_of_person_investigated->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos of Friends of Person Investigated:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_of_friends_of_person_investigated" class="button" id="btnaddmorephotos_of_friends_of_person_investigated" value="Add More" onclick="addMorephotos_of_friends_of_person_investigated();" /><input type="hidden" name="txtidphotos_of_friends_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_of_friends_of_person_investigated[]" rows="12"></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_of_friends_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos of Person Investigated</legend>
                                <div id="photos_of_person_investigated_container">
                                	<?php
                                    	if(count($objphotos_of_person_investigated->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_of_person_investigated->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos of Person Investigated:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_of_person_investigated" class="button" id="btnaddmorephotos_of_person_investigated" value="Add More" onclick="addMorephotos_of_person_investigated();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_of_person_investigated" class="button" value="Delete" onclick="deletephotos_of_person_investigated(this,<?php echo htmlspecialchars($objphotos_of_person_investigated->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_person_investigated->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_person_investigated->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_of_person_investigated[]" rows="12"><?php echo $objphotos_of_person_investigated->note[$key]; ?></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_person_investigated->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_of_person_investigated[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_of_person_investigated->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos of Person Investigated:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_of_person_investigated" class="button" id="btnaddmorephotos_of_person_investigated" value="Add More" onclick="addMorephotos_of_person_investigated();" /><input type="hidden" name="txtidphotos_of_person_investigated[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_of_person_investigated[]" rows="12"></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_of_person_investigated[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Photos Person Investigated Like</legend>
                                <div id="photos_person_investigated_like_container">
                                	<?php
                                    	if(count($objphotos_person_investigated_like->id) > 0)
										{
											$i=0;
											
											foreach($objphotos_person_investigated_like->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos Person Investigated Like:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorephotos_person_investigated_like" class="button" id="btnaddmorephotos_person_investigated_like" value="Add More" onclick="addMorephotos_person_investigated_like();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletephotos_person_investigated_like" class="button" value="Delete" onclick="deletephotos_person_investigated_like(this,<?php echo htmlspecialchars($objphotos_person_investigated_like->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidphotos_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_person_investigated_like->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_person_investigated_like->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_person_investigated_like[]" rows="12"><?php echo $objphotos_person_investigated_like->note[$key]; ?></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_person_investigated_like->is_case_related_activity[$key]); ?>" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_person_investigated_like[]" class="textbox" value="<?php echo htmlspecialchars($objphotos_person_investigated_like->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
							
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Photos Person Investigated Like:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorephotos_person_investigated_like" class="button" id="btnaddmorephotos_person_investigated_like" value="Add More" onclick="addMorephotos_person_investigated_like();" /><input type="hidden" name="txtidphotos_person_investigated_like[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnotephotos_person_investigated_like[]" rows="12"></textarea></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Case Related Activity:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtis_case_related_activityphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
							<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlphotos_person_investigated_like[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
							
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
		<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>Posts</legend>
                                <div id="posts_container">
                                	<?php
                                    	if(count($objposts->id) > 0)
										{
											$i=0;
											
											foreach($objposts->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Posts:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoreposts" class="button" id="btnaddmoreposts" value="Add More" onclick="addMoreposts();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeleteposts" class="button" value="Delete" onclick="deleteposts(this,<?php echo htmlspecialchars($objposts->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidposts[]" class="textbox" value="<?php echo htmlspecialchars($objposts->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnoteposts[]" class="textbox" value="<?php echo htmlspecialchars($objposts->note[$key]); ?>" maxlength="100" /></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlposts[]" class="textbox" value="<?php echo htmlspecialchars($objposts->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlposts[]" class="textbox" value="<?php echo htmlspecialchars($objposts->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Posts:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoreposts" class="button" id="btnaddmoreposts" value="Add More" onclick="addMoreposts();" /><input type="hidden" name="txtidposts[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                             <tr>
							  <td align="left" valign="top"width="150"><label>Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtnoteposts[]" rows="12"></textarea></td>
							</tr>           
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlposts[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlposts[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
                                    </table>
                                    <?php } ?>
                                </div>
                          	</fieldset>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top"><input type="submit" name="btnsubmit" class="save-button" id="btnsubmit" value=""/>
                            <input type="button" name="btncancel" class="cancel-button" id="btncancel" onclick="javascript:window.location.href='case-list.php'" value="" /></td>
                        </tr>
                      </table>
                    </form>
                    <?php 
						}
					else {
					?>
                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn view-table" width="550">
                      <tr>
                        <td align="left" valign="top"width="150"><label>Person investigated:</label></td>
                        <td align="left" valign="top"><?php echo htmlspecialchars($objCase->person_investigated); ?></td>
                      </tr>
                      
					  
					  <tr>
                          <td align="left" valign="top"width="150"><label>DOI:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($objCase->doi); ?></td>
                        </tr>
                        
						
						<tr>
                          <td align="left" valign="top"width="150"><label>Report date:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($objCase->report_date); ?></td>
                        </tr>
                        
						
                      <tr>
                        <td align="left" valign="top"width="150"><label>Note:</label></td>
                        <td align="left" valign="top"><?php echo $objCase->note; ?></td>
                      </tr>
					  <tr>
                        <td align="left" valign="top"width="150"><label>Active?:</label></td>
                        <td align="left" valign="top"><?php echo strtoupper(htmlspecialchars($obj->active)); ?></td>
                      </tr>
                      
                      <tr>
                        <td align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top"><input type="button" name="btnback" class="button" id="btnback" onclick="javascript:window.location.href='case-list.php'" value="Back" /></td>
                      </tr>
                    </table>
                    <?php	
					}
					?>
                    </td>
                </tr>
                <tr>
                  <td align="left" valign="top" height="25"></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td valign="middle" height="40" class="footer-main"><?php require_once 'include/footer.php'; ?></td>
  </tr>
</table>
<?php include_once 'tabs-addedit.php'; ?>
<script type="text/javascript" language="javascript">
	document.getElementById('txtfname').focus();
</script>
</body>
</html>