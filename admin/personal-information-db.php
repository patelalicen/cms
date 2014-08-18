<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );
	/* echo "<pre>";
	print_R ($_REQUEST);
	die; */
	if ( isset($_POST['btnsubmit'])){
		
		$objvalidation = new validation();

		if($objvalidation->validate())
		{
			//Code to assign value of control to all property of object.
			$obj->case_id		= $case_id;
			$obj->fname			= $cmn->setval(trim($cmn->read_value($_POST['txtfname'],'')));
			$obj->mname			= $cmn->setval(trim($cmn->read_value($_POST['txtmname'],'')));
			$obj->lname			= $cmn->setval(trim($cmn->read_value($_POST['txtlname'],'')));
			$obj->dob			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdob'],'')))));
			$obj->age_b			= $cmn->setval(trim($cmn->read_value($_POST['txtage'],'')));
			$obj->web_url_dob	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_url_dob'],'')));
			$obj->dod			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdod'],'')))));
			$obj->age_d			= $cmn->setval(trim($cmn->read_value($_POST['txtage_d'],'')));
			$obj->web_url_dod	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_url_dod'],'')));
			
			$objAlias->fname	= $_POST['txtfnamealias'];
			$objAlias->mname	= $_POST['txtmnamealias'];
			$objAlias->lname	= $_POST['txtlnamealias'];
			$objAlias->web_url	= $_POST['txtweb_urlalias'];
			
			$objPreviousAddresses->location_type= $_POST['txtlocation_type'];
			$objPreviousAddresses->street		= $_POST['txtstreetpa'];
			$objPreviousAddresses->country		= $_POST['selCountrypa'];
			$objPreviousAddresses->state		= $_POST['selStatepa'];
			$objPreviousAddresses->city			= $_POST['selCitypa'];
			$objPreviousAddresses->zip			= $_POST['txtzippa'];
			$objPreviousAddresses->start_date	= $_POST['txtstart_date'];
			$objPreviousAddresses->end_date		= $_POST['txtend_date'];
			$objPreviousAddresses->web_url		= $_POST['txtweb_url_pa'];
			
			$objPreviousPhoneNumbers->line_type	= $_POST['selline_type'];
			$objPreviousPhoneNumbers->carrier	= $_POST['txtcarrier'];
			$objPreviousPhoneNumbers->fname		= $_POST['txtfnameppn'];
			$objPreviousPhoneNumbers->mname		= $_POST['txtmnameppn'];
			$objPreviousPhoneNumbers->lname		= $_POST['txtlnameppn'];
			$objPreviousPhoneNumbers->address	= $_POST['txtaddress'];
			$objPreviousPhoneNumbers->street	= $_POST['txtstreetppn'];
			$objPreviousPhoneNumbers->country	= $_POST['selCountryppn'];
			$objPreviousPhoneNumbers->state		= $_POST['selStateppn'];
			$objPreviousPhoneNumbers->city		= $_POST['selCityppn'];
			$objPreviousPhoneNumbers->zip		= $_POST['txtzipppn'];
			$objPreviousPhoneNumbers->start_date= $_POST['txtstart_dateppn'];
			$objPreviousPhoneNumbers->end_date	= $_POST['txtend_dateppn'];
			$objPreviousPhoneNumbers->web_url	= $_POST['txtweb_urlppn'];
			
			$objEmailAddresses->email			= $_POST['txtemail'];
			$objEmailAddresses->web_url			= $_POST['txtweb_urlemail'];
			
			$objVoterRegistration->political_affiliation	= $_POST['txtpolitical_affiliation'];
			$objVoterRegistration->registration_date		= $_POST['txtregistration_date'];
			$objVoterRegistration->state					= $_POST['selStatevr'];
			$objVoterRegistration->web_url					= $_POST['txtvr_web_url'];
			
			$objBusiness->business_name			= $_POST['txtbusiness_name'];
			$objBusiness->business_type			= $_POST['txtbusiness_type'];
			$objBusiness->number_of_employees	= $_POST['txtnumber_of_employees'];
			$objBusiness->annual_revenue		= $_POST['txtannual_revenue'];
			$objBusiness->street				= $_POST['txtstreetbus'];
			$objBusiness->country				= $_POST['selCountrybus'];
			$objBusiness->state					= $_POST['selStatebus'];
			$objBusiness->city					= $_POST['selCitybus'];
			$objBusiness->category				= $_POST['selcategorybus'];
			$objBusiness->zip					= $_POST['txtzipBusiness'];
			$objBusiness->web_url				= $_POST['txtweb_urlBusiness'];
			
			$objCriminalTraffic->case_no				= $_POST['txtcase_no'];
			$objCriminalTraffic->offense_date			= $_POST['txtoffense_date'];
			$objCriminalTraffic->category				= $_POST['selcategoryCriminal'];
			$objCriminalTraffic->offense_code			= $_POST['txtoffense_code'];
			$objCriminalTraffic->offense_dcescription	= $_POST['txtoffense_dcescription'];
			$objCriminalTraffic->court					= $_POST['txtcourt'];
			$objCriminalTraffic->arresting_agency		= $_POST['txtarresting_agency'];
			$objCriminalTraffic->admitted_date			= $_POST['txtadmitted_date'];
			$objCriminalTraffic->release_date			= $_POST['txtrelease_date'];			
			$objCriminalTraffic->time_served			= $_POST['txttime_served'];
			$objCriminalTraffic->web_url				= $_POST['txtweb_urlCriminal'];
			$objCriminalTraffic->admitted_date			= $_POST['txtadmitted_date'];
			$objCriminalTraffic->release_date			= $_POST['txtrelease_date'];
		
			//Code to add record.
			if ($strmode == 'add')
			{
				$obj->add();
				
				$objAlias->pi_id				= $obj->id;
				$objPreviousAddresses->pi_id	= $obj->id;
				$objPreviousPhoneNumbers->pi_id	= $obj->id;
				$objEmailAddresses->pi_id		= $obj->id;
				$objVoterRegistration->pi_id	= $obj->id;
				$objBusiness->pi_id				= $obj->id;
				$objCriminalTraffic->pi_id		= $obj->id;
				
				$objAlias->add();
				$objPreviousAddresses->add();
				$objPreviousPhoneNumbers->add();
				$objEmailAddresses->add();
				$objVoterRegistration->add();
				$objBusiness->add();
				$objCriminalTraffic->add();
				
				$msg->send_msg('mycase-list.php','Personal Information ',3);
			}
						
			//Code to edit record
			if ($strmode == 'edit')
			{
				$obj->update();
				
				//echo 'I am ehre';
				//exit;
				
				$objAlias->pi_id				= $obj->id;
				$objPreviousAddresses->pi_id	= $obj->id;
				$objPreviousPhoneNumbers->pi_id	= $obj->id;
				$objEmailAddresses->pi_id		= $obj->id;
				$objVoterRegistration->pi_id	= $obj->id;
				$objBusiness->pi_id				= $obj->id;
				$objCriminalTraffic->pi_id		= $obj->id;
				
				$objAlias->id				= $_POST['txtidalias'];
				$objPreviousAddresses->id	= $_POST['txtidpa'];
				$objPreviousPhoneNumbers->id= $_POST['txtidppn'];
				$objEmailAddresses->id		= $_POST['txtidemail'];
				$objVoterRegistration->id	= $_POST['txtidvr'];
				$objBusiness->id			= $_POST['txtidbus'];
				$objCriminalTraffic->id		= $_POST['txtidrecord'];
				
				$objAlias->update();
				$objPreviousAddresses->update();
				$objPreviousPhoneNumbers->update();
				$objEmailAddresses->update();
				$objVoterRegistration->update();
				$objBusiness->update();
				$objCriminalTraffic->update();
				
				$msg->send_msg('mycase-list.php','Personal Information ',4);
			}
		}
	}

	//Code to delete selected record.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'delete')
	{
		if (count($_POST['deletedids']) == 0)
		{
			$msg->send_msg('mycase-list.php','Case(s) ',9);
		}
		else
		{
			$obj->checkedids = implode(',',$_POST['deletedids']);
			$obj->delete();
			$msg->send_msg('mycase-list.php','Personal Information ',5);
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
		$msg->send_msg('mycase-list.php','Personal Information ',15);
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
		
		$msg->send_msg('mycase-list.php','Personal Information ',62);
		exit();
	}
	
	//Code to export table.
	if (isset($_POST['hdnmode']) && trim($_POST['hdnmode']) == 'export')
	{
		$cmn->export_to_csv('investigation_case', 'cases.csv');
	}