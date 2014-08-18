<?php
	require_once 'include/general-includes.php';
	require_once 'class/case.class.php';
	require_once 'class/tv-channel.class.php';
	
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));

	//code to assign primary key to main variable...
	$case_id = 0;
	
	if (isset($_REQUEST['case_id']) && trim($_REQUEST['case_id'])!='')
		$case_id = $_REQUEST['case_id'];
	
	//set mode...
	$strmode='add';
	
	if(isset($_REQUEST['mode']))
		$strmode = trim($_REQUEST['mode']);
	
	if($cmn->is_record_exists('investigated_tv_channel', 'case_id', $case_id, ''))
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
	//$obj = new tv_channel();
		//create object of investigated_tv_channel
		require_once 'class/investigated_tv_channel.class.php';
		$objinvestigated_tv_channel = new investigated_tv_channel();
		//create object of clip_information
		require_once 'class/clip_information.class.php';
		$objclip_information = new clip_information();
		//create object of staff_with_clip
		require_once 'class/staff_with_clip.class.php';
		$objstaff_with_clip = new staff_with_clip();
	//include db file here...
	require_once 'tv-channel-db.php';

	if(isset($_SESSION['err']))
	{
		
			//$obj->title	= $cmn->getval(trim($cmn->read_value($_POST['title'],0)));
	}
	else
	{
		if($strmode=='edit')
		{
			//$obj->setallvalues($case_id);
			
			$objinvestigated_tv_channel->setallvalues(null,' AND case_id = '.$case_id);
			$objclip_information->setallvalues(null,' AND case_id = '.$case_id);
			$objstaff_with_clip->setallvalues(null,' AND case_id = '.$case_id);
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
		$investigated_tv_channel_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>TV Channel:</label></td><td align="left" valign="top"><input type="button" name="btnDeleteinvestigated_tv_channel" class="button" value="Delete" onclick="deleteinvestigated_tv_channel(this,0);" /><input type="hidden" name="txtidinvestigated_tv_channel[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Name of TV Channel:</label></td><td align="left" valign="top"><input type="text" name="txtnameinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>TV Channel Web URL:</label></td><td align="left" valign="top"><input type="text" name="txturlinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>TV Channel:</label></td><td align="left" valign="top"><input type="text" name="txtnewspaperinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Street:</label></td><td align="left" valign="top"><input type="text" name="txtstreetinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>City:</label></td><td align="left" valign="top"><select name="txtcityinvestigated_tv_channel[]" class="selectbox"><option value="">Please select</option>'.$cmn->fillcomboReturn(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', 0).'</select></td></tr><tr><td align="left" valign="top"width="150"><label>Zip:</label></td><td align="left" valign="top"><input type="text" name="txtzipinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>State:</label></td><td align="left" valign="top"><select name="txtstateinvestigated_tv_channel[]" class="selectbox"><option value="">Please select</option>'.$cmn->fillcomboReturn(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0).'</select></td></tr><tr><td align="left" valign="top"width="150"><label>Country:</label></td><td align="left" valign="top"><select name="txtcountryinvestigated_tv_channel[]" class="selectbox"><option value="">Please select</option>'.$cmn->fillcomboReturn(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0).'</select></td></tr></table>';
		$clip_information_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>Clip/Video Information:</label></td><td align="left" valign="top"><input type="button" name="btnDeleteclip_information" class="button" value="Delete" onclick="deleteclip_information(this,0);" /><input type="hidden" name="txtidclip_information[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box URL:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlclip_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Air Date:</label></td><td align="left" valign="top"><input type="text" name="txtair_dateclip_information[]" class="textbox date-picker" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Online Views:</label></td><td align="left" valign="top"><input type="text" name="txtonline_view_countclip_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Duration:</label></td><td align="left" valign="top"><input type="text" name="txtdurationclip_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Clip/Video Content Description:</label></td><td align="left" valign="top"><input type="text" name="txtclip_content_descclip_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Clip/Video Notes:</label></td><td align="left" valign="top"><input type="text" name="txtclip_notesclip_information[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$staff_with_clip_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>Staff Associated with Clip/Video:</label></td><td align="left" valign="top"><input type="button" name="btnDeletestaff_with_clip" class="button" value="Delete" onclick="deletestaff_with_clip(this,0);" /><input type="hidden" name="txtidstaff_with_clip[]" class="textbox" value="0" maxlength="100" /><input type="hidden" name="txtci_idstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Staff:</label></td><td align="left" valign="top"><input type="text" name="txtstaffstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>First Name:</label></td><td align="left" valign="top"><input type="text" name="txtfnamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Middle Name:</label></td><td align="left" valign="top"><input type="text" name="txtmnamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Last Name:</label></td><td align="left" valign="top"><input type="text" name="txtlnamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Email:</label></td><td align="left" valign="top"><input type="text" name="txtemailstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Phone:</label></td><td align="left" valign="top"><input type="text" name="txtphone_numberstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Mobile:</label></td><td align="left" valign="top"><input type="text" name="txtmobile_numberstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Twitter Username:</label></td><td align="left" valign="top"><input type="text" name="txttwitter_usernamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Twitter Profile Page:</label></td><td align="left" valign="top"><input type="text" name="txttwitter_urlstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Facebook Username:</label></td><td align="left" valign="top"><input type="text" name="txtfb_usernamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Facebook Profile Page:</label></td><td align="left" valign="top"><input type="text" name="txtfb_urlstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Linkedin Username:</label></td><td align="left" valign="top"><input type="text" name="txtlinkedin_usernamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Linkedin Profile Page:</label></td><td align="left" valign="top"><input type="text" name="txtlinkedin_urlstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Street:</label></td><td align="left" valign="top"><input type="text" name="txtstreetstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>City:</label></td><td align="left" valign="top"><select name="txtcitystaff_with_clip[]" class="selectbox"><option value="">Please select</option>'.$cmn->fillcomboReturn(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', 0).'</select></td></tr><tr><td align="left" valign="top"width="150"><label>Zip:</label></td><td align="left" valign="top"><input type="text" name="txtzipstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>State:</label></td><td align="left" valign="top"><select name="txtstatestaff_with_clip[]" class="selectbox"><option value="">Please select</option>'.$cmn->fillcomboReturn(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0).'</select></td></tr><tr><td align="left" valign="top"width="150"><label>Country:</label></td><td align="left" valign="top"><select name="txtcountrystaff_with_clip[]" class="selectbox"><option value="">Please select</option>'.$cmn->fillcomboReturn(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0).'</select></td></tr><tr><td align="left" valign="top" width="150"><label>Author Notes:</label></td><td align="left" valign="top"><input type="text" name="txtauthor_notestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
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
	
	
		function addMoreinvestigated_tv_channel()
		{
			var html	= '<?php echo $investigated_tv_channel_html; ?>';
			$('#investigated_tv_channel_container').append(html);
		}
		
		function deleteinvestigated_tv_channel(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this TV Channel?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deleteinvestigated_tv_channel", id: id }
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
		
		function addMoreclip_information()
		{
			var html	= '<?php echo $clip_information_html; ?>';
			$('#clip_information_container').append(html);
		}
		
		function deleteclip_information(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this Clip/Video Information?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deleteclip_information", id: id }
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
		
		function addMorestaff_with_clip()
		{
			var html	= '<?php echo $staff_with_clip_html; ?>';
			$('#staff_with_clip_container').append(html);
		}
		
		function deletestaff_with_clip(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this Staff Associated with Clip/Video?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletestaff_with_clip", id: id }
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
                  <td align="left" valign="top" class="box-heading"><h2>TV Channel</h2></td>
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
                          <td align="right" valign="top" class="required-sentence" colspan="2">
							<table width="100%">
								   <tr>
										<td align="left" valign="middle" height="25" >
													<a href="personal-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Personal Information</a>&nbsp;&nbsp;
													<a href="social-media-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Social
													Media Information</a>&nbsp;&nbsp;
													<a href="newspaper-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Newspaper</a>&nbsp;&nbsp;
													<a href="tv-channel-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="active">Manage TV Channel</a>&nbsp;&nbsp;
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
						
						<tr>
                          <td align="left" valign="top" colspan="2">
                          	<fieldset>
							    <legend>TV Channel</legend>
                                <div id="investigated_tv_channel_container">
                                	<?php
                                    	if(count($objinvestigated_tv_channel->id) > 0)
										{
											$i=0;
											
											foreach($objinvestigated_tv_channel->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>TV Channel:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoreinvestigated_tv_channel" class="button" id="btnaddmoreinvestigated_tv_channel" value="Add More" onclick="addMoreinvestigated_tv_channel();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeleteinvestigated_tv_channel" class="button" value="Delete" onclick="deleteinvestigated_tv_channel(this,<?php echo htmlspecialchars($objinvestigated_tv_channel->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidinvestigated_tv_channel[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_tv_channel->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Name of TV Channel:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnameinvestigated_tv_channel[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_tv_channel->name[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>TV Channel's Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlinvestigated_tv_channel[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_tv_channel->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>TV Channel:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnewspaperinvestigated_tv_channel[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_tv_channel->newspaper[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetinvestigated_tv_channel[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_tv_channel->street[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top">
								  <select name="txtcityinvestigated_tv_channel[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', $objinvestigated_tv_channel->city[$key]);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtzipinvestigated_tv_channel[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_tv_channel->zip[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top">
									<select name="txtstateinvestigated_tv_channel[]" class="selectbox">
                                                <option value="">Please select</option>
                                                <?php 
                                                    $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', $objinvestigated_tv_channel->state[$key]);
                                                ?>
                                            </select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top">
								  <select name="txtcountryinvestigated_tv_channel[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', $objinvestigated_tv_channel->country[$key]);
										?>
									</select>
								</td>
							</tr>
						</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>TV Channel:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoreinvestigated_tv_channel" class="button" id="btnaddmoreinvestigated_tv_channel" value="Add More" onclick="addMoreinvestigated_tv_channel();" /><input type="hidden" name="txtidinvestigated_tv_channel[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Name of TV Channel:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnameinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>TV Channel's Web URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>TV Channel:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnewspaperinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top">
								<select name="txtcityinvestigated_tv_channel[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', 0);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtzipinvestigated_tv_channel[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top">
								<select name="txtstateinvestigated_tv_channel[]" class="selectbox">
                                                <option value="">Please select</option>
                                                <?php 
                                                    $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0);
                                                ?>
                                            </select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top">
								<select name="txtcountryinvestigated_tv_channel[]" class="selectbox">
									<option value="">Please select</option>
									<?php 
										$cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0);
									?>
								</select>
							</td>
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
							    <legend>Clip/Video Information</legend>
                                <div id="clip_information_container">
                                	<?php
                                    	if(count($objclip_information->id) > 0)
										{
											$i=0;
											
											foreach($objclip_information->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Clip/Video Information:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoreclip_information" class="button" id="btnaddmoreclip_information" value="Add More" onclick="addMoreclip_information();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeleteclip_information" class="button" value="Delete" onclick="deleteclip_information(this,<?php echo htmlspecialchars($objclip_information->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidclip_information[]" class="textbox" value="<?php echo htmlspecialchars($objclip_information->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlclip_information[]" class="textbox" value="<?php echo htmlspecialchars($objclip_information->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Air Date:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtair_dateclip_information[]" class="textbox date-picker" value="<?php echo htmlspecialchars($objclip_information->air_date[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Online Views:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtonline_view_countclip_information[]" class="textbox" value="<?php echo htmlspecialchars($objclip_information->online_view_count[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Duration:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtdurationclip_information[]" class="textbox" value="<?php echo htmlspecialchars($objclip_information->duration[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Clip/Video Content Description:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtclip_content_descclip_information[]" class="textbox" value="<?php echo htmlspecialchars($objclip_information->clip_content_desc[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Clip/Video Notes:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtclip_notesclip_information[]" class="textbox" value="<?php echo htmlspecialchars($objclip_information->clip_notes[$key]); ?>" maxlength="100" /></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Clip/Video Information:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoreclip_information" class="button" id="btnaddmoreclip_information" value="Add More" onclick="addMoreclip_information();" /><input type="hidden" name="txtidclip_information[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlclip_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Air Date:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtair_dateclip_information[]" class="textbox date-picker" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Online Views:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtonline_view_countclip_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Duration:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtdurationclip_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Clip/Video Content Description:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtclip_content_descclip_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Clip/Video Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtclip_notesclip_information[]" rows="12"></textarea></td>
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
							    <legend>Staff Associated with Clip/Video</legend>
                                <div id="staff_with_clip_container">
                                	<?php
                                    	if(count($objstaff_with_clip->id) > 0)
										{
											$i=0;
											
											foreach($objstaff_with_clip->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Staff Associated with Clip/Video:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorestaff_with_clip" class="button" id="btnaddmorestaff_with_clip" value="Add More" onclick="addMorestaff_with_clip();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletestaff_with_clip" class="button" value="Delete" onclick="deletestaff_with_clip(this,<?php echo htmlspecialchars($objstaff_with_clip->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->id[$key]); ?>" maxlength="100" /><input type="hidden" name="txtci_idstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->ci_id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Staff:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstaffstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->staff[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>First Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfnamestaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->fname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmnamestaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->mname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Last Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlnamestaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->lname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Email:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtemailstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->email[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Phone:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtphone_numberstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->phone_number[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmobile_numberstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->mobile_number[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_usernamestaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->twitter_username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_urlstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->twitter_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_usernamestaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->fb_username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_urlstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->fb_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_usernamestaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->linkedin_username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_urlstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->linkedin_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->street[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top">
									<select name="txtcitystaff_with_clip[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', $objstaff_with_clip->city[$key]);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtzipstaff_with_clip[]" class="textbox" value="<?php echo htmlspecialchars($objstaff_with_clip->zip[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top">
								<select name="txtstatestaff_with_clip[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', $objstaff_with_clip->state[$key]);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top">
									<select name="txtcountrystaff_with_clip[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', $objstaff_with_clip->country[$key]);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Author Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtauthor_notestaff_with_clip[]" rows="12"><?php echo $objstaff_with_clip->author_note[$key]; ?></textarea></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Staff Associated with Clip/Video:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorestaff_with_clip" class="button" id="btnaddmorestaff_with_clip" value="Add More" onclick="addMorestaff_with_clip();" /><input type="hidden" name="txtidstaff_with_clip[]" class="textbox" value="0" maxlength="100" /><input type="text" name="txtci_idstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Staff:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstaffstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>First Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfnamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmnamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Last Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlnamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Email:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtemailstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Phone:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtphone_numberstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmobile_numberstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_usernamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_urlstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_usernamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_urlstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_usernamestaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_urlstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top">
									<select name="txtcitystaff_with_clip[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name', 0);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtzipstaff_with_clip[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top">
								<select name="txtstatestaff_with_clip[]" class="selectbox">
                                                <option value="">Please select</option>
                                                <?php 
                                                    $cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', 0);
                                                ?>
                                            </select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top">
									<select name="txtcountrystaff_with_clip[]" class="selectbox">
										<option value="">Please select</option>
										<?php 
											$cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', 0);
										?>
									</select>
								</td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Author Notes:</label></td>
							  <td align="left" valign="top"><textarea name="txtauthor_notestaff_with_clip[]" rows="12"></textarea></td>
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
</body>
</html>