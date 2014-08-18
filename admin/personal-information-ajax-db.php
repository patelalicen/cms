<?php
	require_once 'include/ajax-includes.php';
	require_once 'class/sequence.class.php';
	$mode	= isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
	$_SESSION['mode']	= $mode;
	
	/*print_r($_REQUEST);
	
	Array
(
    [case_id] => 4
    [mode] => 
    [txtfname] => Vipul2
    [txtmname] => m2
    [txtlname] => patel2
)*/
	$returnArray	= array();
	
	if($mode == 'pi_name')
	{
		require_once 'class/personal-information.class.php';
		
		//create object of main entity...
		$obj = new personal_information();
		
		if(isset($_REQUEST['pi_id']) && $_REQUEST['pi_id'] > 0)
		{
			$obj->setallvalues($_POST['pi_id'], ' AND case_id = '.$_POST['case_id']);
			$obj->fname		= $cmn->setval(trim($cmn->read_value($_POST['txtfname'],'')));
			$obj->mname		= $cmn->setval(trim($cmn->read_value($_POST['txtmname'],'')));
			$obj->lname		= $cmn->setval(trim($cmn->read_value($_POST['txtlname'],'')));
			
			$obj->update();
			
			$returnArray	= array('pi_id'=>$obj->id);
		}
		else
		{
			$obj->case_id	= $_POST['case_id'];
			$obj->id		= $_POST['pi_id'];
			$obj->fname		= $cmn->setval(trim($cmn->read_value($_POST['txtfname'],'')));
			$obj->mname		= $cmn->setval(trim($cmn->read_value($_POST['txtmname'],'')));
			$obj->lname		= $cmn->setval(trim($cmn->read_value($_POST['txtlname'],'')));
			
			$obj->add();
			
			$returnArray	= array('pi_id'=>$obj->id);
		}
	}
	
	if($mode == 'date-of-birth')
	{
		require_once 'class/pi_dob.class.php';
		
		//create object of main entity...
		$obj = new dob();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id	= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'pi_dob';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-date-of-birth']= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['txtdob']			= $rows[0]['dob'];
			$returnArray['txtage']			= $rows[0]['age_b'];
			$returnArray['txtweb_url_dob']	= $rows[0]['web_url_dob'];
			$returnArray['txtnote_dob']		= $rows[0]['note_dob'];
		}
		else
		{
			$obj->pi_id			= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->dob			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdob'],'')))));
			$obj->age_b			= $cmn->setval(trim($cmn->read_value($_POST['txtage'],'')));
			$obj->web_url_dob	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_url_dob'],'')));
			$obj->note_dob		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtnote_dob'],'')));
					
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}
	
	if($mode == 'date-of-dath')
	{
		require_once 'class/pi_dod.class.php';

		//create object of main entity...
		$obj = new dod();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id	= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'pi_dod';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-date-of-dath']	= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['txtdod']			= $rows[0]['dod'];
			$returnArray['txtage_d']		= $rows[0]['age_d'];
			$returnArray['txtweb_url_dod']	= $rows[0]['web_url_dod'];
			$returnArray['txtnote_dod']		= $rows[0]['note_dod'];
		}
		else
		{
			$obj->pi_id			= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->dod			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdod'],'')))));
			$obj->age_d			= $cmn->setval(trim($cmn->read_value($_POST['txtage_d'],'')));
			$obj->web_url_dod	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_url_dod'],'')));
			$obj->note_dod		= $cmn->setval(trim($cmn->read_value($_POST['txtnote_dod'],'')));
			
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}
	
	if($mode == 'aliases')
	{
		require_once 'class/alias.class.php';
		
		//create object of main entity...
		$obj = new alias();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'aliases';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-aliases']	= $rows[0]['id'];
			$returnArray['pi_id']		= $rows[0]['pi_id'];
			$returnArray['txtfname']	= $rows[0]['fname'];
			$returnArray['txtmname']	= $rows[0]['mname'];
			$returnArray['txtlname']	= $rows[0]['lname'];
			$returnArray['txtweb_url']	= $rows[0]['web_url'];
			$returnArray['txtnote']		= $rows[0]['note'];
		}
		else
		{
			$obj->pi_id		= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->fname		= $cmn->setval(trim($cmn->read_value($_POST['txtfnamealias'],'')));
			$obj->mname		= $cmn->setval(trim($cmn->read_value($_POST['txtmnamealias'],'')));
			$obj->lname		= $cmn->setval(trim($cmn->read_value($_POST['txtlnamealias'],'')));
			$obj->web_url	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_urlalias'],'')));
			$obj->note		= $cmn->setval(trim($cmn->read_value($_POST['txtnotealias'],'')));
			
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			
			$returnArray	= array('resetMe'=>'yes','mode'=>$mode,'pi_id'=>$obj->pi_id);
		}
	}
	
	if($mode == 'previous-addresses')
	{
		require_once 'class/previous_addresses.class.php';
		
		//create object of main entity...
		$obj = new previous_addresses();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'previous_addresses';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-previous-addresses']				= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['txtlocation_type']= $rows[0]['location_type'];
			$returnArray['selCountrypa']	= $rows[0]['country'];
			$returnArray['selStatepa']		= $rows[0]['state'];
			$returnArray['selCitypa']		= $rows[0]['city'];
			$returnArray['txtzippa']		= $rows[0]['zip'];
			$returnArray['txtstart_date']	= $rows[0]['start_date'];
			$returnArray['txtend_date']		= $rows[0]['end_date'];
			$returnArray['txtweb_url_pa']	= $rows[0]['web_url'];
			$returnArray['txtnotepa']		= $rows[0]['note'];
		}
		else
		{
			$obj->pi_id			= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->location_type	= $cmn->setval(trim($cmn->read_value($_POST['txtlocation_type'],'')));
			$obj->country		= $cmn->setval(trim($cmn->read_value($_POST['selCountrypa'],'')));
			$obj->state			= $cmn->setval(trim($cmn->read_value($_POST['selStatepa'],'')));
			$obj->city			= $cmn->setval(trim($cmn->read_value($_POST['selCitypa'],'')));
			$obj->zip			= $cmn->setval(trim($cmn->read_value($_POST['txtzippa'],'')));
			$obj->start_date	= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtstart_date'],'')))));
			$obj->end_date		= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtend_date'],'')))));
			$obj->web_url		= $cmn->setval(trim($cmn->read_value($_POST['txtweb_url_pa'],'')));
			$obj->note			= $cmn->setval(trim($cmn->read_value($_POST['txtnotepa'],'')));
			
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}
	
	if($mode == 'previous-phone-numbers')
	{
		require_once 'class/previous_phone_numbers.class.php';
		
		//create object of main entity...
		$obj = new previous_phone_numbers();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'previous_phone_numbers';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-previous-phone-numbers']				= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['selline_type']	= $rows[0]['line_type'];
			$returnArray['txtcarrier']		= $rows[0]['carrier'];
			$returnArray['txtfnameppn']		= $rows[0]['fname'];
			$returnArray['txtmnameppn']		= $rows[0]['mname'];
			$returnArray['txtlnameppn']		= $rows[0]['lname'];
			$returnArray['txtaddress']		= $rows[0]['address'];
			$returnArray['txtstreetppn']	= $rows[0]['street'];
			$returnArray['selCountryppn']	= $rows[0]['country'];
			$returnArray['selStateppn']		= $rows[0]['state'];
			$returnArray['selCityppn']		= $rows[0]['city'];
			$returnArray['txtzipppn']		= $rows[0]['zip'];
			$returnArray['txtstart_dateppn']= $rows[0]['start_date'];
			$returnArray['txtend_dateppn']	= $rows[0]['end_date'];
			$returnArray['txtweb_urlppn']	= $rows[0]['web_url'];
			
		}
		else
		{
			$obj->pi_id		= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->line_type	= $cmn->setval(trim($cmn->read_value($_POST['selline_type'],'')));
			$obj->carrier	= $cmn->setval(trim($cmn->read_value($_POST['txtcarrier'],'')));
			$obj->fname		= $cmn->setval(trim($cmn->read_value($_POST['txtfnameppn'],'')));
			$obj->mname		= $cmn->setval(trim($cmn->read_value($_POST['txtmnameppn'],'')));
			$obj->lname		= $cmn->setval(trim($cmn->read_value($_POST['txtlnameppn'],'')));
			$obj->address	= $cmn->setval(trim($cmn->read_value($_POST['txtaddress'],'')));
			$obj->street	= $cmn->setval(trim($cmn->read_value($_POST['txtstreetppn'],'')));
			$obj->country	= $cmn->setval(trim($cmn->read_value($_POST['selCountryppn'],'')));
			$obj->state		= $cmn->setval(trim($cmn->read_value($_POST['selStateppn'],'')));
			$obj->city		= $cmn->setval(trim($cmn->read_value($_POST['selCityppn'],'')));
			$obj->zip		= $cmn->setval(trim($cmn->read_value($_POST['txtzipppn'],'')));
			$obj->start_date= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtstart_dateppn'],'')))));
			$obj->end_date	= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtend_dateppn'],'')))));
			$obj->web_url	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_urlppn'],'')));
			$obj->note		= $cmn->setval(trim($cmn->read_value($_POST['txtnoteppn'],'')));
			
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}
	
	if($mode == 'email-addresses')
	{
		require_once 'class/email_addresses.class.php';
		
		//create object of main entity...
		$obj = new email_addresses();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'emails';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-email-addresses']				= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['txtemail']			= $rows[0]['dob'];
			$returnArray['txtweb_urlemail']			= $rows[0]['age_b'];
			$returnArray['txtnoteemail']		= $rows[0]['note'];
		}
		else
		{
			$obj->pi_id			= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->dod			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtdod'],'')))));
			$obj->email			= $cmn->setval(trim($cmn->read_value($_POST['txtemail'],'')));
			$obj->web_url	= $cmn->setval(trim($cmn->read_value($_POST['txtweb_urlemail'],'')));
			$obj->note		= $cmn->setval(trim($cmn->read_value($_POST['txtnote_dod'],'')));
			
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}

	if($mode == 'voter-registration')
	{
		require_once 'class/voter_registration.class.php';
		
		//create object of main entity...
		$obj = new voter_registration();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
	
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'voter_registration';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-voter-registration']				= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['txtregistration_date']			= $rows[0]['registration_date'];
			$returnArray['txtpolitical_affiliation']			= $rows[0]['political_affiliation'];
			$returnArray['selStatevr']			= $rows[0]['state'];
			
			$returnArray['txtvr_web_url']	= $rows[0]['web_url'];
			$returnArray['txtvrnote']		= $rows[0]['note'];
		}
		else
		{
			$obj->pi_id			= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->registration_date			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtregistration_date'],'')))));
			$obj->political_affiliation			= $cmn->setval(trim($cmn->read_value($_POST['txtpolitical_affiliation'],'')));
			$obj->state			= $cmn->setval(trim($cmn->read_value($_POST['selStatevr'],'')));
			$obj->web_url	= $cmn->setval(trim($cmn->read_value($_POST['txtvr_web_url'],'')));
			$obj->note_dod		= $cmn->setval(trim($cmn->read_value($_POST['txtnote_dod'],'')));
						
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}
	
	if($mode == 'businesses')
	{
		require_once 'class/business.class.php';
		
		//create object of main entity...
		$obj = new business();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'businesses';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-businesses']				= $rows[0]['id'];
			$returnArray['pi_id']			= $rows[0]['pi_id'];
			$returnArray['txtbusiness_name']= $rows[0]['location_type'];
			$returnArray['txtbusiness_type']	= $rows[0]['country'];
			$returnArray['txtnumber_of_employees']		= $rows[0]['state'];
			$returnArray['txtannual_revenue']		= $rows[0]['city'];
			$returnArray['txtstreetbus']		= $rows[0]['zip'];
			$returnArray['selCountrybus']	= $rows[0]['start_date'];
			$returnArray['selStatebus']		= $rows[0]['end_date'];
			$returnArray['selCitybus']	= $rows[0]['web_url'];
			$returnArray['selcategorybus']	= $rows[0]['web_url'];
			$returnArray['txtzipBusiness']	= $rows[0]['web_url'];
			$returnArray['txtweb_urlBusiness']	= $rows[0]['web_url'];
			$returnArray['txtnoteBusiness']		= $rows[0]['note'];
		}
		else
		{
			$obj->pi_id			= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->location_type	= $cmn->setval(trim($cmn->read_value($_POST['txtbusiness_name'],'')));
			$obj->country		= $cmn->setval(trim($cmn->read_value($_POST['txtbusiness_type'],'')));
			$obj->state			= $cmn->setval(trim($cmn->read_value($_POST['txtnumber_of_employees'],'')));
			$obj->city			= $cmn->setval(trim($cmn->read_value($_POST['txtannual_revenue'],'')));
			$obj->city			= $cmn->setval(trim($cmn->read_value($_POST['txtstreetbus'],'')));			
			$obj->zip			= $cmn->setval(trim($cmn->read_value($_POST['selCountrybus'],'')));
			$obj->start_date	= $cmn->setval(trim($cmn->read_value($_POST['selStatebus'],'')));
			$obj->end_date		= $cmn->setval(trim($cmn->read_value($_POST['selCitybus'],'')));
			$obj->web_url		= $cmn->setval(trim($cmn->read_value($_POST['selcategorybus'],'')));
			$obj->end_date		= $cmn->setval(trim($cmn->read_value($_POST['txtzipBusiness'],'')));
			$obj->web_url		= $cmn->setval(trim($cmn->read_value($_POST['txtweb_urlBusiness'],'')));			
			$obj->note			= $cmn->setval(trim($cmn->read_value($_POST['txtnoteBusiness'],'')));
						
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}
	
	if($mode == 'criminal-traffic')
	{
		require_once 'class/criminal_traffic.class.php';
		
		//create object of main entity...
		$obj = new criminal_traffic();
		
		//create object of sequence
		$objSeq = new sequence();
		
		$obj->id			= $cmn->setval(trim($cmn->read_value($_POST['id'],0)));
		
		if(isset($_POST['mode2']) && $_POST['mode2'] == 'delete')
		{
			$obj->checkedids	= $obj->id;
			$objSeq->checkedids	= $obj->id;
			$objSeq->table_name	= 'criminal_traffic';
			$obj->delete();
			$objSeq->delete();
		}
		elseif(isset($_POST['mode2']) && $_POST['mode2'] == 'edit')
		{
			$rows	= $obj->fetchallasarray($obj->id);
			
			$returnArray['id-criminal-traffic']		= $rows[0]['id'];
			$returnArray['pi_id']					= $rows[0]['pi_id'];
			$returnArray['parent_id']				= $rows[0]['parent_id'];
			$returnArray['txtcase_no']				= $rows[0]['case_no'];
			$returnArray['txtoffense_date']			= $rows[0]['offense_date'];
			$returnArray['selcategoryCriminal']		= $rows[0]['category'];
			$returnArray['txtoffense_code']			= $rows[0]['offense_code'];
			$returnArray['txtoffense_dcescription']	= $rows[0]['offense_dcescription'];
			$returnArray['txtcourt']				= $rows[0]['court'];
			$returnArray['txtarresting_agency']		= $rows[0]['arresting_agency'];
			$returnArray['txtadmitted_date']		= $rows[0]['admitted_date'];
			$returnArray['txtrelease_date']			= $rows[0]['release_date'];
			$returnArray['txttime_served']			= $rows[0]['time_served'];
			$returnArray['txtweb_urlCriminal']		= $rows[0]['web_url'];
			$returnArray['txtnoteCriminal']			= $rows[0]['note'];
		}
		else
		{
			$obj->pi_id					= $cmn->setval(trim($cmn->read_value($_POST['pi_id'],0)));
			$obj->parent_id				= $cmn->setval(trim($cmn->read_value($_POST['parent_id'],0)));
			$obj->case_no				= $cmn->setval(trim($cmn->read_value($_POST['txtcase_no'],'')));
			$obj->offense_date			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtoffense_date'],'')))));
			$obj->category				= $cmn->setval(trim($cmn->read_value($_POST['selcategoryCriminal'],'')));
			$obj->offense_code			= $cmn->setval(trim($cmn->read_value($_POST['txtoffense_code'],'')));
			$obj->offense_dcescription	= $cmn->setval(trim($cmn->read_value($_POST['txtoffense_dcescription'],'')));
			$obj->court					= $cmn->setval(trim($cmn->read_value($_POST['txtcourt'],'')));			
			$obj->arresting_agency		= $cmn->setval(trim($cmn->read_value($_POST['txtarresting_agency'],'')));			
			$obj->admitted_date			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtadmitted_date'],'')))));
			$obj->release_date			= date(DATE_FORMAT_PHP_2_MYSQL,strtotime($cmn->setval(trim($cmn->read_value($_POST['txtrelease_date'],'')))));			
			$obj->time_served			= $cmn->setval(trim($cmn->read_value($_POST['txttime_served'],'')));
			$obj->web_url				= $cmn->setval(trim($cmn->read_value($_POST['txtweb_urlCriminal'],'')));
			$obj->note					= $cmn->setval(trim($cmn->read_value($_POST['txtnoteCriminal'],'')));
			
			if(isset($obj->id) && $obj->id > 0)
			{
				$obj->update();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
			else
			{
				$obj->add();
				$returnArray	= array('resetMe'=>'yes','pi_id'=>$obj->pi_id);
			}
		}
	}

	echo json_encode($returnArray);
?>