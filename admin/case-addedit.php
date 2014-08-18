<?php
	require_once 'include/general-includes.php';
	require_once 'class/case.class.php';
	require_once 'fckeditor/fckeditor.php';
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));

	//code to assign primary key to main variable...
	$id = 0;
	if (isset($_REQUEST['id']) && trim($_REQUEST['id'])!='')
		$id = $_REQUEST['id'];

	//set mode...
	$strmode='add';
	if(isset($_REQUEST['mode']))
		$strmode = trim($_REQUEST['mode']);

	//code to check record existance in case of edit...
	$record_condition = '';
	if ($strmode=='edit' && !($cmn->is_record_exists('investigation_case', 'id', $id, $record_condition)))
		$msg->send_msg('case-list.php','',46);

	//create object of main entity...
	$obj = new investigation_case();

	//include db file here...
	require_once 'case-db.php';

	if(isset($_SESSION['err']))
	{
		$obj->id						= (int) $id;
		$obj->client					= $cmn->getval(trim($cmn->read_value($_POST['txtclient'],'')));
		$obj->person_investigated		= $cmn->getval(trim($cmn->read_value($_POST['txtperson_investigated'],'')));		
		$obj->client_matter_number		= $cmn->getval(trim($cmn->read_value($_POST['txtclient_matter_number'],'')));
		$obj->carrier					= $cmn->getval(trim($cmn->read_value($_POST['txtcarrier'],'')));		
		$obj->toonari_client			= $cmn->getval(trim($cmn->read_value($_POST['txttoonari_client'],'')));
		$obj->priority					= $cmn->getval(trim($cmn->read_value($_POST['selpriority'],'')));
		$obj->estimated_completion_date	= $cmn->getval(trim($cmn->read_value($_POST['txtestimated_completion_date'],'')));
		$obj->note						= $cmn->getval(trim($cmn->read_value($_POST['txtnote'],'')));
		$obj->active					= $cmn->getval(trim($cmn->read_value($_POST['rdoactive'],'')));
	}
	else
	{
		if($strmode=='edit')
		{
			$obj->setallvalues($id);
		}
	}
	
	/*$objfck = new FCKeditor("txtnote");
	$objfck->BasePath = "fckeditor/";
	$objfck->Height = "500";
	$objfck->Width = "800";
	$objfck->Value = $obj->note;*/
	
	//set flags for jquery lib
	$isDatePicker	= true;
	$isValidation	= true;
	$isFancyBox		= false;
	$isTabs			= false;
	$isGeneralTabs	= false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>
<script language="javascript" type="text/javascript">
	function validate(){
		var index = 0;
		var arValidate = new Array;
				
		if (!Isvalid(arValidate)){
			return false;
		}
		return true;
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
                  <td align="left" valign="top" class="box-heading"><h2>Cases</h2></td>
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
                      <table cellpadding="0" cellspacing="0" border="0" align="left" class="frmmn" width="100%">
                        <tr>
                          <td align="right" valign="top" class="required-sentence" colspan="2"><?php echo REQUIRED_SENTENCE; ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>UID:</label></td>
                          <td align="left" valign="top"><?php if($obj->id > 0) { ?><b><?php echo sprintf('%08d',$obj->id); ?></b><?php } else { echo 'UID will generate after submiting case.'; } ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Client:<?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top">
							<select name="selclient_id" id="selclient_id" class="selectbox">
								<option value="">Please select</option>
								<?php 
									$cmn->fillcombo(DB_PREFIX . 'client', 'SELECT id, company_name FROM ' . DB_PREFIX . 'client ORDER BY company_name', 'id', 'company_name',$obj->client_id);
								?>
							</select>
						  </td>
                        </tr>
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Main location</label></td>
                          <td align="left" valign="top" id="client_detail">
							<input type="text" name="txtmain_location" class="textbox" id="txtmain_location" value="<?php echo htmlspecialchars($obj->getClientLocation($obj->client_id)); ?>" maxlength="100" readonly="readonly" disabled="disabled" />
						  </td>
                        </tr>
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Case Type:<?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top">
							<select name="selcase_type" class="selectbox">
								<option value="">Please select</option>
								<option value="Personal Injury">Personal Injury</option>
								<option value="Worker's Compensation">Worker's Compensation</option>
								<option value="List of Type will be provided">List of Type will be provided</option>
							</select>
						  </td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Assign To:<?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top">
							<select name="selassing_to" class="selectbox">
								<option value="0">Please select</option>
								<?php 
									$cmn->fillcombo(DB_PREFIX . 'user', 'SELECT user_id, CONCAT(first_name, \' \',last_name) AS fullname FROM ' . DB_PREFIX . 'user WHERE user_active = \'y\' AND user_role_id = 2 ORDER BY first_name, last_name', 'user_id', 'fullname', $obj->assing_to);
								?>
							</select>
						  </td>
                        </tr>

						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Created On:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtcreated_on" class="textbox" id="txtcreated_on" value="<?php echo htmlspecialchars($obj->created_on); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Due Date:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtdue_date" class="textbox" id="txtdue_date" value="<?php echo htmlspecialchars($obj->due_date); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Salesperson/Affiliate:</label></td>
                          <td align="left" valign="top">
							<select name="selsalesperson_affiliate" class="selectbox">
								<option value="">Please select</option>
								<option value="Fixed">Fixed</option>
								<option value="Percentage">Percentage</option>
							</select>
						  </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Case Services:</label></td>
                          <td align="left" valign="top">
							<input type="checkbox" id="chkcase_services" name="chkcase_services[]" value="Service - 1"> Service - 1<BR />
							<input type="checkbox" id="chkcase_services" name="chkcase_services[]" value="Service - 2"> Service - 2
						  </td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Client Mater #:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtclient_matter_number" class="textbox" id="txtclient_matter_number" value="<?php echo htmlspecialchars($obj->client_matter_number); ?>" maxlength="100" /></td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>DOI:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtdoi" class="textbox" id="txtdoi" value="<?php echo htmlspecialchars($obj->doi); ?>" maxlength="100" /></td>
                        </tr>
                        
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Report date:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtreport_date" class="textbox" id="txtreport_date" value="<?php echo htmlspecialchars($obj->report_date); ?>" maxlength="100" /></td>
                        </tr>
                        
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Carrier:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtcarrier" class="textbox" id="txtcarrier" value="<?php echo htmlspecialchars($obj->carrier); ?>" maxlength="100" /></td>
                        </tr>
                        
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>End Client:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtend_client" class="textbox" id="txtend_client" value="<?php echo htmlspecialchars($obj->end_client); ?>" maxlength="100" /></td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Toonari Client:</label></td>
                          <td align="left" valign="top"><input type="text" name="txttoonari_client" class="textbox" id="txttoonari_client" value="<?php echo htmlspecialchars($obj->toonari_client); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Budget:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtbudget" class="textbox" id="txtbudget" value="<?php echo htmlspecialchars($obj->budget); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Hours:</label></td>
                          <td align="left" valign="top"><input type="text" name="txthours" class="textbox" id="txthours" value="<?php echo htmlspecialchars($obj->hours); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Hourly Rate:</label></td>
                          <td align="left" valign="top"><input type="text" name="txthourly_rate" class="textbox" id="txthourly_rate" value="<?php echo htmlspecialchars($obj->hourly_rate); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>First Name:<?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtperson_investigated_fname" class="textbox" id="txtperson_investigated_fname" value="<?php echo htmlspecialchars($obj->person_investigated_fname); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtperson_investigated_mname" class="textbox" id="txtperson_investigated_mname" value="<?php echo htmlspecialchars($obj->person_investigated_mname); ?>" maxlength="100" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Last Name:<?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtperson_investigated_lname" class="textbox" id="txtperson_investigated_lname" value="<?php echo htmlspecialchars($obj->person_investigated_lname); ?>" maxlength="100" /></td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Client Notes:</label></td>
                          <td align="left" valign="top">
                          	<textarea class="textbox" name="txtclientnote" id="txtclientnote" rows="12"><?php echo $obj->clientnote; ?></textarea>
                          </td>
                        </tr>

						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>                        
                        <tr>
                          <td align="left" valign="top"width="150"><label>Case policies:</label></td>
                          <td align="left" valign="top">
                          	<pre class="textbox" style="width: 250px; margin:0; min-height:20px;"><?php echo $obj->getClientCasePolicies($obj->client_id); ?></pre>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>                        
                        <tr>
                          <td align="left" valign="top"width="150"><label>Case Info:</label></td>
                          <td align="left" valign="top">
                          	<pre class="textbox" style="width: 250px; margin:0; min-height:20px;"><?php ($obj->id > 0) ? '<a class="edit button" target="_blank" href="case-info-list.php?case_id='.$obj->id.'">Case Info</a>' : 'To Manage Case Info first you need to save this case'; ?></pre>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Address:</label></td>
                          <td align="left" valign="top">
							<input type="text" name="txtaddress" class="textbox" id="txtaddress" value="<?php echo htmlspecialchars($obj->address); ?>" maxlength="100" />
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>street:</label></td>
                          <td align="left" valign="top">
							<input type="text" name="txtstreet" class="textbox" id="txtstreet" value="<?php echo htmlspecialchars($obj->street); ?>" maxlength="100" />
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>City:</label></td>
						  <td align="left" valign="top">
							<select name="selcity" class="selectbox">
								<option value="">Please select</option>
								<?php 
									$cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name',$obj->city);
								?>
							</select>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
						  <td align="left" valign="top"><input type="text" name="txtzip" class="textbox" value="<?php echo htmlspecialchars($obj->zip); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>State:</label></td>
						  <td align="left" valign="top">
							<select name="selstate" class="selectbox">
								<option value="">Please select</option>
								<?php 
									$cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', $obj->state);
								?>
							</select>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Race:</label></td>
						  <td align="left" valign="top">
							<select name="selstate" class="selectbox">
								<option value="Race - 1">Race - 1</option>
								<option value="Race - 2">Race - 2</option>
							</select>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Sex:</label></td>
						  <td align="left" valign="top">
							<input type="radio" name="txtsex" class="textbox" value="Male" <?php ($obj->sex == 'Male') ? 'checked="checked"' : ''; ?> maxlength="100" /> Male 
							<input type="radio" name="txtsex" class="textbox" value="Female" <?php ($obj->sex == 'Female') ? 'checked="checked"' : ''; ?> maxlength="100" /> Female
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Date of Birth:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtdob" class="textbox" value="<?php echo htmlspecialchars($obj->dob); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Height:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtheight" class="textbox" value="<?php echo htmlspecialchars($obj->height); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Weight:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtweight" class="textbox" value="<?php echo htmlspecialchars($obj->weight); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Build:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtbuild" class="textbox" value="<?php echo htmlspecialchars($obj->build); ?>" maxlength="100" />
						  </td>
						</tr>

						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Other Characteristics:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtother_characteristics" class="txtother_characteristics" value="<?php echo htmlspecialchars($obj->other_characteristics); ?>" maxlength="100" />
						  </td>
						</tr>

						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Cell Phone:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtcell_phone" class="textbox" value="<?php echo htmlspecialchars($obj->cell_phone); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Email:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtemail" class="textbox" value="<?php echo htmlspecialchars($obj->email); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>facebook:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtfacebook" class="textbox" value="<?php echo htmlspecialchars($obj->facebook); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>twitter:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txttwitter" class="textbox" value="<?php echo htmlspecialchars($obj->twitter); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>myspace:</label></td>
						  <td align="left" valign="top">
							<input type="text" name="txtmyspace" class="textbox" value="<?php echo htmlspecialchars($obj->myspace); ?>" maxlength="100" />
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                          <td align="left" valign="top">
                          	<textarea class="textbox" name="txtnote" id="txtnote" rows="12"><?php echo $obj->note; ?></textarea>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Photo & Document:</label></td>
						  <td align="left" valign="top">
							<input type="file" name="txtdocs" class="textbox" value="<?php echo htmlspecialchars($obj->myspace); ?>" multiple="multiple" />
						  </td>
						</tr>
			
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Priority:</label></td>
                          <td align="left" valign="top">
                          	<select name="selpriority" id="selpriority" class="selectbox">
                                <option value="Normal" <?php if($obj->priority=='Normal') echo 'selected="selected"'; ?>>Normal</option>
                                <option value="High" <?php if($obj->priority=='High') echo 'selected="selected"'; ?>>High</option>
                                <option value="Low" <?php if($obj->priority=='Low') echo 'selected="selected"'; ?>>Low</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        
                        <tr>
                          <td align="left" valign="top"width="150"><label>Estimated completion date:</label></td>
                          <td align="left" valign="top">
                          	<input type="text" name="txtestimated_completion_date" class="textbox" id="txtestimated_completion_date" value="<?php echo htmlspecialchars($obj->estimated_completion_date); ?>" maxlength="100" />
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        
                        
                        <tr>
                          <td align="left" valign="top"width="150"><label>Active?:</label></td>
                          <td align="left" valign="top"><input checked="checked" type="radio" name="rdoactive" id="rdoactive" value="y" <?php if($obj->active=='y') echo 'checked="checked"'; ?>/>
                            Yes
                            <input type="radio" name="rdoactive" id="rdoactive" value="n" <?php if($obj->active=='n') echo 'checked="checked"'; ?>/>
                            No </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
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
                    <table cellpadding="0" cellspacing="0" border="0" align="left" class="frmmn view-table" width="550">
                    	<tr>
                          <td align="left" valign="top"width="150"><label>UID:</label></td>
                          <td align="left" valign="top"><b><?php echo sprintf('%08d',$obj->id); ?></b></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Client:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->client); ?></td>
                        </tr>
                      <tr>
                        <td align="left" valign="top"height="10"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"width="150"><label>Person investigated:</label></td>
                        <td align="left" valign="top"><?php echo htmlspecialchars($obj->person_investigated); ?></td>
                      </tr>
                      <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Client Mater #:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->client_matter_number); ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        
					  
					  <tr>
                          <td align="left" valign="top"width="150"><label>DOI:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->doi); ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Carrier:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->carrier); ?></td>
                        </tr>
                        
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Toonari Client:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->toonari_client); ?></td>
                        </tr>

                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
                          <td align="left" valign="top"width="150"><label>Report date:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->report_date); ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						
                      <tr>
                        <td align="left" valign="top"width="150"><label>Note:</label></td>
                        <td align="left" valign="top"><?php echo $obj->note; ?></td>
                      </tr>
					  
                      <tr>
                        <td align="left" valign="top"height="10"></td>
                      </tr>
                      <tr>
                          <td align="left" valign="top"width="150"><label>Priority:</label></td>
                          <td align="left" valign="top"><?php echo $obj->priority; ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        
                        <tr>
                          <td align="left" valign="top"width="150"><label>Estimated completion date:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->estimated_completion_date); ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"height="10"></td>
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
<?php //include_once 'tabs-addedit.php'; ?>
<script type="text/javascript" language="javascript">
	document.getElementById('selclient_id').focus();
</script>
</body>
</html>