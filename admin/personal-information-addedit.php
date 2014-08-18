<?php
	require_once 'include/general-includes.php';
	require_once 'class/case.class.php';
	require_once 'class/personal-information.class.php';
	require_once 'fckeditor/fckeditor.php';
	
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));

	//code to assign primary key to main variable...
	$case_id = 0;
	
	if (isset($_REQUEST['case_id']) && trim($_REQUEST['case_id'])!='')
		$case_id = $_REQUEST['case_id'];
	
	//set mode...
	$strmode='add';
	
	if(isset($_REQUEST['mode']))
		$strmode = trim($_REQUEST['mode']);
	
	if($cmn->is_record_exists('personal_info', 'case_id', $case_id, ''))
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
	$obj = new personal_information();
	
	//create object of Alias
	require_once 'class/pi_dob.class.php';
	$objDob = new dob();
	
	//create object of Alias
	require_once 'class/pi_dod.class.php';
	$objDod = new dod();
	
	//create object of Alias
	require_once 'class/alias.class.php';
	$objAlias = new alias();
	
	//create object of previous addresses
	require_once 'class/previous_addresses.class.php';
	$objPreviousAddresses = new previous_addresses();
	
	//create object of previous phone numbers
	require_once 'class/previous_phone_numbers.class.php';
	$objPreviousPhoneNumbers = new previous_phone_numbers();
	
	//create object of email addresses
	require_once 'class/email_addresses.class.php';
	$objEmailAddresses = new email_addresses();
	
	//create object of voter registration
	require_once 'class/voter_registration.class.php';
	$objVoterRegistration = new voter_registration();
	
	//create object of business
	require_once 'class/business.class.php';
	$objBusiness = new business();
	
	//create object of business
	require_once 'class/criminal_traffic.class.php';
	$objCriminalTraffic = new criminal_traffic();
	
	//include db file here...
	require_once 'personal-information-db.php';

	if(isset($_SESSION['err']))
	{
		$obj->case_id		= $cmn->getval(trim($cmn->read_value($_POST['case_id'],0)));
		$obj->fname			= $cmn->getval(trim($cmn->read_value($_POST['fname'],'')));
		$obj->mname			= $cmn->getval(trim($cmn->read_value($_POST['mname'],'')));
		$obj->lname			= $cmn->getval(trim($cmn->read_value($_POST['lname'],'')));
		$obj->dob			= $cmn->getval(trim($cmn->read_value($_POST['dob'],'')));
		$obj->age_b			= $cmn->getval(trim($cmn->read_value($_POST['age_b'],0)));
		$obj->web_url_dob	= $cmn->getval(trim($cmn->read_value($_POST['web_url_dob'],'')));
		$obj->dod			= $cmn->getval(trim($cmn->read_value($_POST['dod'],'')));
		$obj->age_d			= $cmn->getval(trim($cmn->read_value($_POST['age_d'],0)));
		$obj->web_url_dod	= $cmn->getval(trim($cmn->read_value($_POST['web_url_dod'],'')));
		
		$obj->active		= $cmn->getval(trim($cmn->read_value($_POST['rdoactive'],'')));
	}
	else
	{
		if($strmode=='edit')
		{
			$obj->setallvalues(null,' AND case_id = '.$case_id);
			
			$objDob->setallvalues(null,' AND pi_id = '.$obj->id);
			$objDod->setallvalues(null,' AND pi_id = '.$obj->id);
	
			$objAlias->setallvalues(null,' AND pi_id = '.$obj->id);
			$objPreviousAddresses->setallvalues(null,' AND pi_id = '.$obj->id);
			$objPreviousPhoneNumbers->setallvalues(null,' AND pi_id = '.$obj->id);
			$objEmailAddresses->setallvalues(null,' AND pi_id = '.$obj->id);
			$objVoterRegistration->setallvalues(null,' AND pi_id = '.$obj->id);
			$objBusiness->setallvalues(null,' AND pi_id = '.$obj->id);
			$objCriminalTraffic->setallvalues(null,' AND pi_id = '.$obj->id.' AND parent_id = 0');
		}
	}
	
	/*$objfck = new FCKeditor("txtnote");
	$objfck->BasePath = "fckeditor/";
	$objfck->Height = "500";
	$objfck->Width = "800";
	$objfck->Value = $objCase->note;*/
	
	//set flags for jquery lib
	$isDatePicker	= true;
	$isValidation	= true;
	$isFancyBox		= false;
	$isTabs			= true;
	$isAccordion	= true;
	$isGeneralTabs	= true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>
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
	
	$(document).ready(function() {
		$("a[href=#<?php echo $_SESSION['mode']; ?>]").trigger( "click" );
		
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
					if(data.resetMe	== 'yes')
					{
						$(form)[0].reset();
					}
					
					if(data.pi_id > 0)
					{
						$('.pi_id').val(data.pi_id);
					}
					
					if(data.mode != '')
					{
						$(form).find('input[name=mode]').val(data.mode);
					}
					
					window.location.reload();
				});
			}
		});
		
		$('#record_number').html($('#totrecords').val());
		$('.ui-accordion-content').css('height','auto');
	});
	
	function edit_me(mode,id)
	{
		if(confirm('Are you sure you want to edit this info?'))
		{
			$.ajax({
				type: "POST",
				url: 'personal-information-ajax-db.php',
				data: {mode:mode, id:id, mode2:'edit'},
				dataType: "json"
			})
			.done(function( data ) {
				$.each(data, function(messageIndex, message) {
					$('#'+messageIndex).val(message);
				});
			});
		}
	}
	
	function delete_me(mode,id)
	{
		if(confirm('Are you sure you want to delete this info?'))
		{
			$.ajax({
				type: "POST",
				url: 'personal-information-ajax-db.php',
				data: {mode:mode, id:id, mode2:'delete'},
				dataType: "json"
			})
			.done(function( data ) {
				window.location.reload();
			});
		}
	}
	
	function add_me_as_child(mode, id, index)
	{
		if(confirm('Are you sure you want to add new case in record # '+index+'?'))
		{
			$('#parent_id').val(id);
			$('#record_number').html(index);
		}
	}
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
                  <td align="left" valign="top" class="box-heading"><h2>Personal Information</h2></td>
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
                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="100%">
                        <tr>
							<td align="left" valign="middle" height="25" width="80%">
                                      	<a href="personal-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="active">Manage Personal Information</a>&nbsp;&nbsp;
										<a href="social-media-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Social
										Media Information</a>&nbsp;&nbsp;
										<a href="newspaper-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Newspaper</a>&nbsp;&nbsp;
										<a href="tv-channel-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage TV Channel</a>&nbsp;&nbsp;
										<a href="sequence-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Sequence</a>
                                      </td>
                          <td align="right" valign="top" class="required-sentence" ><?php echo REQUIRED_SENTENCE; ?></td>
                        </tr>
						<tr>
							<td colspan="2" height="10px">
							</td>
						</tr>
                        <tr>
                          <td align="left" valign="top" colspan="2">
                                <div id="tabs">
                                    <ul>
                                        <li><a href="#case-info">Case Info</a></li>
                                        <li><a href="#name">Name</a></li>
                                        <li><a href="#date-of-birth">Date of Birth</a></li>
                                        <li><a href="#date-of-dath">Date of Death</a></li>
                                        <li><a href="#aliases">Aliases</a></li>
                                        <li><a href="#previous-addresses">Previous Addresses</a></li>
                                        <li><a href="#previous-phone-numbers">Previous Phone #</a></li>
                                        <li><a href="#email-addresses">Emails</a></li>
                                        <li><a href="#voter-registration">Voter Registration</a></li>
                                        <li><a href="#businesses">Businesses</a></li>
                                        <li><a href="#criminal-traffic">Criminal/Traffic</a></li>
                                    </ul>
                                    <div id="case-info">
                                        <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="100%">
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
                                        </table>
                                    </div>
                                    <div id="name">
                                    	<form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" onsubmit="javascript: return validate();" enctype="multipart/form-data">
                                            <input type="hidden" name="case_id" class="textbox" id="case_id" value="<?php echo htmlspecialchars($objCase->id); ?>" />
                                            <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                            <input type="hidden" name="mode" class="textbox" id="mode" value="pi_name" />
                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                <tr>
                                                  <td align="left" valign="top"><label>First Name:</label></td>
                                                  <td align="left" valign="top"><input type="text" name="txtfname" class="textbox" id="txtfname" value="<?php echo htmlspecialchars($obj->fname); ?>" maxlength="100" /></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="top"><label>Middle Name:</label></td>
                                                  <td align="left" valign="top"><input type="text" name="txtmname" class="textbox" id="txtmname" value="<?php echo htmlspecialchars($obj->mname); ?>" maxlength="100" /></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="top"><label>Last Name:</label></td>
                                                  <td align="left" valign="top"><input type="text" name="txtlname" class="textbox" id="txtlname" value="<?php echo htmlspecialchars($obj->lname); ?>" maxlength="100" /></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top">&nbsp;</td>
                                                    <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                  
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    <div id="date-of-birth">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-date-of-birth" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="date-of-birth" />
                                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Birth Date:</label></td>
                                                          <td align="left" valign="top"><input type="text" name="txtdob" class="textbox date-picker" id="txtdob" value="" maxlength="100" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Age:</label></td>
                                                          <td align="left" valign="top"><input type="text" name="txtage" class="textbox" id="txtage" value="" maxlength="100" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                          <td align="left" valign="top"><input type="text" name="txtweb_url_dob" class="textbox" id="txtweb_url_dob" value="" maxlength="256" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote_dob" id="txtnote_dob" rows="12"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                              </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objDob->id) > 0)
														{
															$i=0;
															
															foreach($objDob->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Date of Death<?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('date-of-birth','<?php echo $objDob->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('date-of-birth','<?php echo $objDob->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Birth Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo htmlspecialchars($objDob->dob[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Age:</label></td>
                                                                  <td align="left" valign="top"><?php echo htmlspecialchars($objDob->age_b[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo htmlspecialchars($objDob->web_url_dob[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objDob->note_dob[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                                  </td>
                                                </tr>
                                         </table>
                                    </div>
                                    <div id="date-of-dath">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                    <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" class="textbox" id="id-date-of-dath" value="0" />
                                                        <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                        <input type="hidden" name="mode" class="textbox" id="mode" value="date-of-dath" />
                                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Death Date:</label></td>
                                                          <td align="left" valign="top"><input type="text" name="txtdod" class="textbox date-picker" id="txtdod" value="" maxlength="100" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Age:</label></td>
                                                          <td align="left" valign="top"><input type="text" name="txtage_d" class="textbox" id="txtage_d" value="" maxlength="100" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                          <td align="left" valign="top"><input type="text" name="txtweb_url_dod" class="textbox" id="txtweb_url_dod" value="" maxlength="256" /></td>
                                                        </tr>
                                                        <tr>
                                                              <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                              <td align="left" valign="top"><textarea name="txtnote_dod" id="txtnote_dod" rows="12"></textarea></td>
                                                            </tr>
                                                        <tr>
                                                                <td align="left" valign="top">&nbsp;</td>
                                                                <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                              </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objDod->id) > 0)
														{
															$i=0;
															
															foreach($objDod->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Date of Death <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('date-of-dath','<?php echo $objDod->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('date-of-dath','<?php echo $objDod->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Death Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo htmlspecialchars($objDod->dod[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Age:</label></td>
                                                                  <td align="left" valign="top"><?php echo htmlspecialchars($objDod->age_d[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo htmlspecialchars($objDod->web_url_dod[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                      <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                      <td align="left" valign="top"><?php echo nl2br($objDod->note_dod[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <div id="aliases">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-aliases" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="aliases" />
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>First Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtfnamealias" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtmnamealias" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Last Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtlnamealias" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtweb_urlalias" class="textbox" value="" maxlength="256" /></td>
                                                    </tr>
                                                    <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                                    <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objAlias->id) > 0)
														{
															$i=0;
															
															foreach($objAlias->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Aliases <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('aliases','<?php echo $objAlias->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('aliases','<?php echo $objAlias->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>First Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objAlias->fname[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objAlias->mname[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Last Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objAlias->lname[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objAlias->web_url[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objAlias->note[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <div id="previous-addresses">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                    	<form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                        	<input type="hidden" name="id" class="textbox" id="id-previous-addresses" value="0" />
                                            <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                            <input type="hidden" name="mode" class="textbox" id="mode" value="previous-addresses" />
                                        <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="30%">
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>Location Type:</label></td>
                                              <td align="left" valign="top"><input type="text" name="txtlocation_type" class="textbox" value="" maxlength="100" /></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>Street:</label></td>
                                              <td align="left" valign="top"><input type="text" name="txtstreetpa" class="textbox" value="" maxlength="100" /></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>Country:</label></td>
                                              <td align="left" valign="top">
                                                <select name="selCountrypa" class="selectbox">
                                                    <option value="">Please select</option>
                                                    <?php 
                                                        $cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0);
                                                    ?>
                                                </select>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>State:</label></td>
                                              <td align="left" valign="top">
                                                <select name="selStatepa" class="selectbox">
                                                    <option value="">Please select</option>
                                                    <?php 
                                                        $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0);
                                                    ?>
                                                </select>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>City:</label></td>
                                              <td align="left" valign="top">
                                                <select name="selCitypa" class="selectbox">
                                                    <option value="">Please select</option>
                                                    <?php 
                                                        $cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name',0);
                                                    ?>
                                                </select>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
                                              <td align="left" valign="top"><input type="text" name="txtzippa" class="textbox" value="" maxlength="100" /></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>Start Date:</label></td>
                                              <td align="left" valign="top"><input type="text" name="txtstart_date" class="textbox date-picker" value="" maxlength="100" /></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>End Date:</label></td>
                                              <td align="left" valign="top"><input type="text" name="txtend_date" class="textbox date-picker" value="" maxlength="100" /></td>
                                            </tr>
                                            <tr>
                                              <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                              <td align="left" valign="top"><input type="text" name="txtweb_url_pa" class="textbox" value="" maxlength="256" /></td>
                                            </tr>
                                            <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                            <tr>
                                                    <td align="left" valign="top">&nbsp;</td>
                                                    <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                </tr>
                                            </table>
                                    	</form>
                                        </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objPreviousAddresses->id) > 0)
														{
															$i=0;
															
															foreach($objPreviousAddresses->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Previous Addresses <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('previous-addresses','<?php echo $objPreviousAddresses->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('previous-addresses','<?php echo $objPreviousAddresses->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Location Type:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousAddresses->location_type[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Street:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousAddresses->streetpa[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Country:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCountryName($objPreviousAddresses->country[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>State:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getStateName($objPreviousAddresses->state[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>City:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCityName($objPreviousAddresses->city[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousAddresses->zip[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Start Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousAddresses->start_date[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>End Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousAddresses->end_date[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousAddresses->web_url[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objPreviousAddresses->note[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>                             
                                    <div id="previous-phone-numbers">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-previous-phone-numbers" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="previous-phone-numbers" />
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="30%">
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Line Type:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selline_type" class="selectbox">
                                                            <option value="landline">Landline</option>
                                                            <option value="mobile">Mobile</option>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Carrier:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtcarrier" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>First Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtfnameppn" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtmnameppn" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Last Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtlnameppn" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Address:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtaddress" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Street:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtstreetppn" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Country:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selCountryppn" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>State:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selStateppn" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>City:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selCityppn" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtzipppn" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Start Date:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtstart_dateppn" class="textbox date-picker" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>End Date:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtend_dateppn" class="textbox date-picker" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtweb_urlppn" class="textbox" value="" maxlength="256" /></td>
                                                    </tr>
                                                    <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                                    <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objPreviousPhoneNumbers->id) > 0)
														{
															$i=0;
															
															foreach($objPreviousPhoneNumbers->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Previous Phone # <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('previous-phone-numbers','<?php echo $objPreviousPhoneNumbers->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('previous-phone-numbers','<?php echo $objPreviousPhoneNumbers->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Line Type:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->line_type[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Carrier:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->carrier[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>First Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->fname[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->mname[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Last Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->lname[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Address:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->address[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Street:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->street[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Country:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCountryName($objPreviousPhoneNumbers->country[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>State:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getStateName($objPreviousPhoneNumbers->state[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>City:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCityName($objPreviousPhoneNumbers->city[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->zip[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Start Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->start_date[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>End Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->end_date[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->web_url[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objPreviousPhoneNumbers->note[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <div id="email-addresses">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-email-addresses" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="email-addresses" />
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="30%">
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Email:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtemail" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtweb_urlemail" class="textbox" value="" maxlength="256" /></td>
                                                    </tr>
                                                    <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                                    <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objEmailAddresses->id) > 0)
														{
															$i=0;
															
															foreach($objEmailAddresses->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Emails <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('email-addresses','<?php echo $objEmailAddresses->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('email-addresses','<?php echo $objEmailAddresses->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Email:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objEmailAddresses->email[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objEmailAddresses->web_url[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objEmailAddresses->note[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <div id="voter-registration">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-voter-registration" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="voter-registration" />
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="30%">
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Political Affiliation:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtpolitical_affiliation" class="textbox" value="" maxlength="100" /><input type="hidden" name="txtidvr" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Registration Date:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtregistration_date" class="textbox date-picker" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>State:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selStatevr" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtvr_web_url" class="textbox" id="txtvr_web_url" value="" maxlength="256" /></td>
                                                    </tr>
                                                    <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                                    <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objVoterRegistration->id) > 0)
														{
															$i=0;
															
															foreach($objVoterRegistration->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Voter Registration <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('voter-registration','<?php echo $objVoterRegistration->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('voter-registration','<?php echo $objVoterRegistration->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Political Affiliation:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objVoterRegistration->political_affiliation[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Registration Date:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objVoterRegistration->registration_date[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>State:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getStateName($objVoterRegistration->state[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objVoterRegistration->web_url[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objVoterRegistration->note[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>                                    
                                    <div id="businesses">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-businesses" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="businesses" />
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="30%">
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business Name:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtbusiness_name" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business Type:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtbusiness_type" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Number of Employees:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtnumber_of_employees" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Annual Revenue:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtannual_revenue" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business Category:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selcategory" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'category', 'SELECT id, title FROM ' . DB_PREFIX . 'category ORDER BY title', 'id', 'title',0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business Address (Street):</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtstreetbus" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business Country:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selCountrybus" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business State:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selStatebus" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business City:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selCitybus" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Business Zip/Postal Code:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtzipBusiness" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtweb_urlBusiness" class="textbox" value="" maxlength="256" /></td>
                                                    </tr>
                                                    <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                                    <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objBusiness->id) > 0)
														{
															$i=0;
															
															foreach($objBusiness->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Businesses <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('businesses','<?php echo $objBusiness->id[$key]; ?>');"></span></li>
                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('businesses','<?php echo $objBusiness->id[$key]; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business Name:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->business_name[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business Type:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->business_type[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Number of Employees:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->number_of_employees[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Annual Revenue:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->annual_revenue[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business Category:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCategoryName($objBusiness->category[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business Address (Street):</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->street[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business Country:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCountryName($objBusiness->country[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business State:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getStateName($objBusiness->state[$key]); ?></td>
                                                                </tr> 
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business City:</label></td>
                                                                  <td align="left" valign="top"><?php echo $cmn->getCityName($objBusiness->city[$key]); ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Business Zip/Postal Code:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->zip[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                  <td align="left" valign="top"><?php echo $objBusiness->web_url[$key]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                  <td align="left" valign="top"><?php echo nl2br($objBusiness->note[$key]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                              </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <div id="criminal-traffic">
                                    	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn">
                                            <tr>
                                              <td align="left" valign="top">
                                                <form name="frm" id="frm" method="post" action="personal-information-ajax-db.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" class="textbox" id="id-criminal-traffic" value="0" />
                                                    <input type="hidden" name="pi_id" class="textbox pi_id" value="<?php echo htmlspecialchars($obj->id); ?>" />
                                                    <input type="hidden" name="parent_id" class="textbox" id="parent_id" value="0" />
                                                    <input type="hidden" name="mode" class="textbox" id="mode" value="criminal-traffic" />
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="30%">
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Record # :</label></td>
                                                      <td align="left" valign="top"><span id="record_number"></span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Offense Date:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtoffense_date" class="textbox date-picker" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Category:</label></td>
                                                      <td align="left" valign="top">
                                                        <select name="selcategoryCriminal" class="selectbox">
                                                            <option value="">Please select</option>
                                                            <?php 
                                                                $cmn->fillcombo(DB_PREFIX . 'category', 'SELECT id, title FROM ' . DB_PREFIX . 'category ORDER BY title', 'id', 'title', 0);
                                                            ?>
                                                        </select>
                                                      </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Offense Code:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtoffense_code" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Offense Description:</label></td>
                                                      <td align="left" valign="top"><textarea name="txtoffense_dcescription"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Court:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtcourt" class="textbox" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Arresting Agency:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtarresting_agency" class="textbox" value="" maxlength="255" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Admitted Date:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtadmitted_date" class="textbox date-picker" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Release Date:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtrelease_date" class="textbox date-picker" value="" maxlength="100" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Time Served:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txttime_served" class="textbox" value="" maxlength="25" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                      <td align="left" valign="top"><input type="text" name="txtweb_urlCriminal" class="textbox" value="" maxlength="256" /></td>
                                                    </tr>
                                                    <tr>
                                                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                          <td align="left" valign="top"><textarea name="txtnote" id="txtnote" rows="12"></textarea></td>
                                                        </tr>
                                                    <tr>
                                                            <td align="left" valign="top">&nbsp;</td>
                                                            <td align="left" valign="top"><input type="button" name="btnsubmit" class="save-button saveme-ajax" id="btnsubmit" value=""/></td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                </td>
                                              <td align="left" valign="top">
                                              	<div class="accordion">
		                                            <?php
														if(count($objCriminalTraffic->id) > 0)
														{
															$i=0;
															
															foreach($objCriminalTraffic->id AS $key => $val)
															{
													?>
                                                    	<h3><a href="#">Criminal/Traffic Record <?php echo $i+1; ?></a></h3>
                                                        <div>
                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                            	<tr>
                                                                  <td align="right" valign="top" colspan="2">
                                                                  	<ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                    	<li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-plusthick" onclick="add_me_as_child('criminal-traffic','<?php echo $objCriminalTraffic->id[$key]; ?>','<?php echo $i+1; ?>');"></span></li>
                                                                    </ul>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" valign="top" colspan="2">
                                                                  	<div class="accordion">
                                                                  	<?php
                                                                    	$caseList	= $objCriminalTraffic->fetchallasarray(null,null,' AND parent_id = '.$objCriminalTraffic->id[$key].' OR id = '.$objCriminalTraffic->id[$key]);
																		
																		foreach($caseList AS $key2 => $val2)
																		{
																	?>
                                                                    	<h3><a href="#">Case # <?php echo $key2+1; ?></a></h3>
                                                                        <div>
                                                                            <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                                                <tr>
                                                                                  <td align="right" valign="top" colspan="2">
                                                                                    <ul id="icons" class="ui-widget ui-helper-clearfix">
                                                                                        <li class="ui-state-default ui-corner-all" title="Edit this record"><span class="ui-icon ui-icon-pencil" onclick="edit_me('criminal-traffic','<?php echo $val2['id']; ?>');"></span></li>
                                                                                        <li class="ui-state-default ui-corner-all" title="Delete this record"><span class="ui-icon ui-icon-trash" onclick="delete_me('criminal-traffic','<?php echo $val2['id']; ?>');"></span></li>
                                                                                    </ul>
                                                                                  </td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Offense Date:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['offense_date']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Category:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $cmn->getCategoryName($val2['category']); ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Offense Code:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['offense_code']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Offense Description:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['offense_dcescription']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Court:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['court']; ?></td>
                                                                                </tr>
                
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Arresting Agency:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['arresting_agency']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Admitted Date:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['admitted_date']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Release Date:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['release_date']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Time Served:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['time_served']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Web URL:</label></td>
                                                                                  <td align="left" valign="top"><?php echo $val2['web_url']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                  <td align="left" valign="top"width="150"><label>Note:</label></td>
                                                                                  <td align="left" valign="top"><?php echo nl2br($val2['note']); ?></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    <?php
																		}
																	?>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                            </table>
                                                        </div>
													<?php
																$i++;
															}
														}
													?>
                                                    </div>
                                                    <input type="hidden" value="<?php echo $i+1; ?>" id="totrecords" />
                                              </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                        	</td>
                       </tr>
                       <tr>
                          <td align="left" valign="top"><input type="button" name="btncancel" class="cancel-button" id="btncancel" onclick="javascript:window.location.href='mycase-list.php'" value="" /></td>
                          <td align="left" valign="top">&nbsp;</td>
                        </tr>
                      </table>
                    
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