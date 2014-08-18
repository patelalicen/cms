<?php
	error_reporting(0);
	require_once 'include/general-includes.php';
	require_once 'class/case.class.php';
	require_once 'class/personal-information.class.php';
	require_once 'class/sequence.class.php';
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
	
	
	//code to check record existance in case of edit...
	$record_condition = '';
	if (!($cmn->is_record_exists('investigation_case', 'id', $case_id, $record_condition)))
		$msg->send_msg('mycase-list.php','',46);

	//create object of main entity...
	$objCase = new investigation_case();
	
	$objCase->setallvalues($case_id);
	
	//create object of main entity...
	$obj = new personal_information();
	
	//create object of sequence
	$objSeq = new sequence();
	
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
	require_once 'sequence-db.php';

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
		
			$obj->setallvalues(null,' AND case_id = '.$case_id);
			if($obj->id != ''){
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>
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
                  <td align="left" valign="top" class="box-heading"><h2>Manage Sequence</h2></td>
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
					 <form name="frm" id="frm" method="post" action="<?php echo trim($_SERVER['REQUEST_URI']); ?>" onsubmit="javascript: return validate();">
                    	<table cellpadding="0" cellspacing="0" border="0" align="left" class="frmmn" width="100%">
                        <tr>
                          <td align="right" valign="top" class="required-sentence" colspan="3">
							<table width="100%">
								   <tr>
										<td align="left" valign="middle" height="25">
													<a href="personal-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Personal Information</a>&nbsp;&nbsp;
													<a href="social-media-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Social
													Media Information</a>&nbsp;&nbsp;
													<a href="newspaper-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Newspaper</a>&nbsp;&nbsp;
													<a href="tv-channel-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage TV Channel</a>&nbsp;&nbsp;
													<a href="sequence-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="active">Manage Sequence</a>
												  </td>
									  <td align="right" valign="top" class="required-sentence" ><?php echo REQUIRED_SENTENCE; ?></td>
									</tr>
							</table>
						  </td>
                        </tr>
						
						<tr>
							<td colspan="2" height="10px">
							</td>
						</tr>
						<?php if($obj->id != ''){ ?>
						
						<tr>
						<?php 
							if($obj->fname != "" || $obj->mname != "" || $obj->lname != "")
							{
							$table_name='personal_info';		
							$per_info = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\'' ); 
							if(count($per_info) > 0)
							{ ?>
								<input type="hidden" name="pi_mode" class="textbox" id="pi_mode" value="edit" maxlength="100" />
							<?php 	
							}else{ ?>
								<input type="hidden" name="pi_mode" class="textbox" id="pi_mode" value="add" maxlength="100" />
							<?php }
						?>	
							<td align="left" valign="top"width="200"><label>Name:<?php echo REQUIRED; ?></label></td>
							<td width="20%">
								<table>
									<tr>
									  <td align="left" valign="top"><label>First Name:</label></td>
									  <td align="left" valign="top"><?php echo htmlspecialchars($obj->fname); ?></td>
									</tr>
									<tr>
									  <td align="left" valign="top"><label>Middle Name:</label></td>
									  <td align="left" valign="top"><?php echo htmlspecialchars($obj->mname); ?></td>
									</tr>
									<tr>
									  <td align="left" valign="top"><label>Last Name:</label></td>
									  <td align="left" valign="top"><?php echo htmlspecialchars($obj->lname); ?></td>
									</tr>
								</table>
							</td>
							<td align="left" valign="top"><input type="text" name="txtname_seq" class="textbox" id="txtname_seq" value="<?php echo $per_info[0]['sequence_no']; ?>" maxlength="100" /></td>
							<input type="hidden" name="txtname_table_id" class="textbox" id="txtname_table_id" value="<?php echo $obj->id; ?>" maxlength="100" />
							<input type="hidden" name="txtname_id" class="textbox" id="txtname_id" value="<?php echo $per_info[0]['id']; ?>" maxlength="100" />
							<input type="hidden" name="txtname_table_name" class="textbox" id="txtname_table_name" value="<?php echo $table_name; ?>" maxlength="100" />	
						<?php } ?>
						</tr>
						<tr>
							<td colspan="2" height="10">
							</td>
						</tr>
							<?php
								if(count($objDob->id) > 0)
								{
									$i=0;	
									$table_name='pi_dob';	
									foreach($objDob->id AS $key => $val)
									{
										$dob = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
										?>
										<tr>
											<td align="left" valign="top"width="200"><label>Date of Birth <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>Birth Date:</label></td>
													  <td align="left" valign="top"><?php echo htmlspecialchars($objDob->dob[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Age:</label></td>
													  <td align="left" valign="top"><?php echo htmlspecialchars($objDob->age_b[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo htmlspecialchars($objDob->web_url_dob[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objDob->note_dob[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtdob_seq[<?php echo $val; ?>]" class="textbox" id="txtdob_seq" value="<?php echo $dob[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtdob_id[<?php echo $val; ?>]" class="textbox" id="txtdob_id" value="<?php echo $dob[0]['id']; ?>" maxlength="100" />
										</tr>
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>
							<?php
										$i++;
									}
								}
							?> 
								<input type="hidden" name="txtdob_table_name" class="textbox" id="txtdob_table_name" value="<?php echo $table_name; ?>" maxlength="100" />	
							<?php
								if(count($objDod->id) > 0)
								{
									$i=0;
									$table_name='pi_dod';
									foreach($objDod->id AS $key => $val)
									{
										$dod = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
										?>
										<tr>
											<td align="left" valign="top"width="150"><label>Date of Death <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													 <tr>
														  <td align="left" valign="top"><label>Death Date:</label></td>
														  <td align="left" valign="top"><?php echo htmlspecialchars($objDod->dod[$key]); ?></td>
														</tr>
														<tr>
														  <td align="left" valign="top"><label>Age:</label></td>
														  <td align="left" valign="top"><?php echo htmlspecialchars($objDod->age_d[$key]); ?></td>
														</tr>
														<tr>
														  <td align="left" valign="top"><label>Web URL:</label></td>
														  <td align="left" valign="top"><?php echo htmlspecialchars($objDod->web_url_dod[$key]); ?></td>
														</tr>
														<tr>
															  <td align="left" valign="top"><label>Note:</label></td>
															  <td align="left" valign="top"><?php echo nl2br($objDod->note_dod[$key]); ?></td>
														</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtdod_seq[<?php echo $val; ?>]" class="textbox" id="txtdod_seq" value="<?php echo $dod[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtdod_id[<?php echo $val; ?>]" class="textbox" id="txtdod_id" value="<?php echo $dod[0]['id']; ?>" maxlength="100" />
										</tr>   
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>	
							<?php
										$i++;
									}
								}
							?>
							<input type="hidden" name="txtdod_table_name" class="textbox" id="txtdod_table_name" value="<?php echo $table_name; ?>" maxlength="100" />	
							<?php
								if(count($objAlias->id) > 0)
								{
									$i=0;
									$table_name='pi_aliases';
									foreach($objAlias->id AS $key => $val)
									{	
										$aliases = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
										?>
										<tr>
											<td align="left" valign="top"width="200"><label>Aliases <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>First Name:</label></td>
													  <td align="left" valign="top"><?php echo $objAlias->fname[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Middle Name:</label></td>
													  <td align="left" valign="top"><?php echo $objAlias->mname[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Last Name:</label></td>
													  <td align="left" valign="top"><?php echo $objAlias->lname[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $objAlias->web_url[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objAlias->note[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtalias_seq[<?php echo $val; ?>]" class="textbox" id="txtalias_seq" value="<?php echo $aliases[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtalias_id[<?php echo $val; ?>]" class="textbox" id="txtalias_id" value="<?php echo $aliases[0]['id']; ?>" maxlength="100" />
										</tr>
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>				
							<?php
										$i++;
									}
								}
							?>
						   <input type="hidden" name="txtalias_table_name" class="textbox" id="txtalias_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
							<?php
								if(count($objPreviousAddresses->id) > 0)
								{
									$i=0;
									$table_name='previous_addresses';
									foreach($objPreviousAddresses->id AS $key => $val)
									{
										$previous_addresses = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
										?>
										<tr>
											<td align="left" valign="top"width="200"><label>Previous Address <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>Location Type:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousAddresses->location_type[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Street:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousAddresses->streetpa[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Country:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCountryName($objPreviousAddresses->country[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>State:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getStateName($objPreviousAddresses->state[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>City:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCityName($objPreviousAddresses->city[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Zip/Postal Code:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousAddresses->zip[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Start Date:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousAddresses->start_date[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>End Date:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousAddresses->end_date[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousAddresses->web_url[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objPreviousAddresses->note[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtpre_add_seq[<?php echo $val; ?>]" class="textbox" id="txtpre_add_seq" value="<?php echo $previous_addresses[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtpre_add_id[<?php echo $val; ?>]" class="textbox" id="txtpre_add_id" value="<?php echo $previous_addresses[0]['id']; ?>" maxlength="100" />
										</tr>      	
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>
							<?php
										$i++;
									}
								}
							?>
							<input type="hidden" name="txtpre_add_table_name" class="textbox" id="txtpre_add_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
							<?php
								if(count($objPreviousPhoneNumbers->id) > 0)
								{
									$i=0;
									$table_name='previous_phone';
									foreach($objPreviousPhoneNumbers->id AS $key => $val)
									{
										$previous_phone = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
							?>
										<tr>
											<td align="left" valign="top"width="200"><label>Previous Phone <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>Line Type:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->line_type[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Carrier:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->carrier[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>First Name:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->fname[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Middle Name:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->mname[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Last Name:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->lname[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Address:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->address[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Street:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->street[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Country:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCountryName($objPreviousPhoneNumbers->country[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>State:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getStateName($objPreviousPhoneNumbers->state[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>City:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCityName($objPreviousPhoneNumbers->city[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Zip/Postal Code:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->zip[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Start Date:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->start_date[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>End Date:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->end_date[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $objPreviousPhoneNumbers->web_url[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objPreviousPhoneNumbers->note[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtprevious_phone_seq[<?php echo $val; ?>]" class="textbox" id="txtprevious_phone_seq" value="<?php echo $previous_phone[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtpre_ph_id[<?php echo $val; ?>]" class="textbox" id="txtpre_ph_id" value="<?php echo $previous_phone[0]['id']; ?>" maxlength="100" />
										</tr>       
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>
							<?php
										$i++;
									}
								}
							?>
							<input type="hidden" name="txtpre_ph_table_name" class="textbox" id="txtpre_ph_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
							<?php
								if(count($objEmailAddresses->id) > 0)
								{
									$i=0;
									$table_name='emails'; 
									foreach($objEmailAddresses->id AS $key => $val)
									{
										$email = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );	
										?>
										<tr>
											<td align="left" valign="top"width="200"><label>Emails <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>Email:</label></td>
													  <td align="left" valign="top"><?php echo $objEmailAddresses->email[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $objEmailAddresses->web_url[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objEmailAddresses->note[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtemail_seq[<?php echo $val; ?>]" class="textbox" id="txtemail_seq" value="<?php echo $email[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtemail_id[<?php echo $val; ?>]" class="textbox" id="txtemail_id" value="<?php echo $email[0]['id']; ?>" maxlength="100" />
										</tr> 
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>		
							<?php
										$i++;
									}
								}
							?> 
							<input type="hidden" name="txtemail_table_name" class="textbox" id="txtemail_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
							<?php
								if(count($objVoterRegistration->id) > 0)
								{
									$i=0;
									$table_name='voter_registration';
									foreach($objVoterRegistration->id AS $key => $val)
									{
										$voter_reg = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );	
									?>
										 <tr>
											<td align="left" valign="top"width="200"><label>Voter Registration <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>Political Affiliation:</label></td>
													  <td align="left" valign="top"><?php echo $objVoterRegistration->political_affiliation[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Registration Date:</label></td>
													  <td align="left" valign="top"><?php echo $objVoterRegistration->registration_date[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>State:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getStateName($objVoterRegistration->state[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $objVoterRegistration->web_url[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objVoterRegistration->note[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtvoter_reg_seq[<?php echo $val; ?>]" class="textbox" id="txtvoter_reg_seq" value="<?php echo $voter_reg[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtvoter_reg_id[<?php echo $val; ?>]" class="textbox" id="txtvoter_reg_id" value="<?php echo $voter_reg[0]['id']; ?>" maxlength="100" />
										</tr>
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>		
							<?php
										$i++;
									}
								}
							?>
							<input type="hidden" name="txtvoter_reg_table_name" class="textbox" id="txtvoter_reg_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
							<?php
								if(count($objBusiness->id) > 0)
								{
									$i=0;
									$table_name='businesses';
									foreach($objBusiness->id AS $key => $val)
									{
										$business = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
									?>
										 <tr>
											<td align="left" valign="top"width="200"><label>Business <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<td width="20%">
												<table>
													<tr>
													  <td align="left" valign="top"><label>Business Type:</label></td>
													  <td align="left" valign="top"><?php echo $objBusiness->business_type[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Number of Employees:</label></td>
													  <td align="left" valign="top"><?php echo $objBusiness->number_of_employees[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Annual Revenue:</label></td>
													  <td align="left" valign="top"><?php echo $objBusiness->annual_revenue[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Business Category:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCategoryName($objBusiness->category[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Business Address (Street):</label></td>
													  <td align="left" valign="top"><?php echo $objBusiness->street[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Business Country:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCountryName($objBusiness->country[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Business State:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getStateName($objBusiness->state[$key]); ?></td>
													</tr> 
													<tr>
													  <td align="left" valign="top"><label>Business City:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCityName($objBusiness->city[$key]); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Business Zip/Postal Code:</label></td>
													  <td align="left" valign="top"><?php echo $objBusiness->zip[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $objBusiness->web_url[$key]; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($objBusiness->note[$key]); ?></td>
													</tr>
												</table>
											</td>
											<td align="left" valign="top"><input type="text" name="txtbusiness_seq[<?php echo $val; ?>]" class="textbox" id="txtbusiness_seq" value="<?php echo $business[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtbusiness_id[<?php echo $val; ?>]" class="textbox" id="txtbusiness_id" value="<?php echo $business[0]['id']; ?>" maxlength="100" />
										</tr>
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>	
							<?php
										$i++;
									}
								}
							?>
							<input type="hidden" name="txtbusiness_table_name" class="textbox" id="txtbusiness_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
							<?php
								if(count($objCriminalTraffic->id) > 0)
								{
									$i=0;
									$table_name='criminal_traffic';
									foreach($objCriminalTraffic->id AS $key => $val)
									{
										$criminal_traffic = $objSeq->fetchallasarray(null,null,' case_id = '.$case_id. ' AND table_name=\''.$table_name.'\' AND table_id=\''.$val.'\'' );
									?>
										<tr>
											<td align="left" valign="top"width="200"><label>Criminal/Traffic Record <?php echo $i+1; ?>:<?php echo REQUIRED; ?></label></td>
											<?php
												$caseList	= $objCriminalTraffic->fetchallasarray(null,null,' AND parent_id = '.$objCriminalTraffic->id[$key].' OR id = '.$objCriminalTraffic->id[$key]);
												
												foreach($caseList AS $key2 => $val2)
												{
											?>
											<td width="20%">
												<table>
													<tr>
														<td align="left">
															<label>Case: </label>	
														</td>
														<td>
															<?php echo $key2+1; ?>
														</td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Offense Date:</label></td>
													  <td align="left" valign="top"><?php echo $val2['offense_date']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Category:</label></td>
													  <td align="left" valign="top"><?php echo $cmn->getCategoryName($val2['category']); ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Offense Code:</label></td>
													  <td align="left" valign="top"><?php echo $val2['offense_code']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Offense Description:</label></td>
													  <td align="left" valign="top"><?php echo $val2['offense_dcescription']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Court:</label></td>
													  <td align="left" valign="top"><?php echo $val2['court']; ?></td>
													</tr>

													<tr>
													  <td align="left" valign="top"><label>Arresting Agency:</label></td>
													  <td align="left" valign="top"><?php echo $val2['arresting_agency']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Admitted Date:</label></td>
													  <td align="left" valign="top"><?php echo $val2['admitted_date']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Release Date:</label></td>
													  <td align="left" valign="top"><?php echo $val2['release_date']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Time Served:</label></td>
													  <td align="left" valign="top"><?php echo $val2['time_served']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Web URL:</label></td>
													  <td align="left" valign="top"><?php echo $val2['web_url']; ?></td>
													</tr>
													<tr>
													  <td align="left" valign="top"><label>Note:</label></td>
													  <td align="left" valign="top"><?php echo nl2br($val2['note']); ?></td>
													</tr>
												</table>
											</td>
											<?php } ?>
											<td align="left" valign="top"><input type="text" name="txtcriminal_traffic_seq[<?php echo $val; ?>]" class="textbox" id="txtcriminal_traffic_seq" value="<?php echo $criminal_traffic[0]['sequence_no']; ?>" maxlength="100" /></td>
											<input type="hidden" name="txtcriminal_id[<?php echo $val; ?>]" class="textbox" id="txtcriminal_id" value="<?php echo $criminal_traffic[0]['id']; ?>" maxlength="100" />
										</tr>
										<tr>
											<td colspan="2" height="10px">
											</td>
										</tr>		
							<?php
										$i++;
									}
								}
							?>
							<input type="hidden" name="txtcriminal_table_name" class="textbox" id="txtcriminal_table_name" value="<?php echo $table_name; ?>" maxlength="100" />
                       <tr>
						  <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top"><input type="submit" name="btnsubmit" class="save-button" id="btnsubmit" value=""/>
                            <input type="button" name="btncancel" class="cancel-button" id="btncancel" onclick="javascript:window.location.href='mycase-list.php'" value="" /></td>
                        </tr>
						<?php }else{ ?>
						
						<tr class="background1">
							  <td align="center" valign="middle" height="25" colspan="<?php echo $inttotal_column; ?>"><em>No Record(s) found.</em></td>
						</tr>
						<tr>
                  <td align="left" valign="top" height="25"></td>
                </tr>
						<tr>
							<td align="center" valign="top" colspan="2">
                            <input type="button" name="btncancel" class="back-button" id="btncancel" onclick="javascript:window.location.href='mycase-list.php'" value="" /></td>
						</tr>
						
						<?php } ?>
                      </table>
                    
                    <?php 
						}
					else {
					?>
					
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
<script type="text/javascript" language="javascript">
	document.getElementById('txtfname').focus();
</script>
</body>
</html>