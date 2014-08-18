<?php
	require_once 'include/general-includes.php';
	require_once 'class/case.class.php';
	require_once 'class/newspaper.class.php';
	
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));

	//code to assign primary key to main variable...
	$case_id = 0;
	
	if (isset($_REQUEST['case_id']) && trim($_REQUEST['case_id'])!='')
		$case_id = $_REQUEST['case_id'];
	
	//set mode...
	$strmode='add';
	
	if(isset($_REQUEST['mode']))
		$strmode = trim($_REQUEST['mode']);
	
	if($cmn->is_record_exists('investigated_newspaper', 'case_id', $case_id, ''))
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
	$obj = new newspaper();
	//create object of investigated_newspaper
	require_once 'class/investigated_newspaper.class.php';
	$objinvestigated_newspaper = new investigated_newspaper();
	//create object of article_information
	require_once 'class/article_information.class.php';
	$objarticle_information = new article_information();
	
	//include db file here...
	require_once 'newspaper-db.php';

	if(isset($_SESSION['err']))
	{
		
			$obj->title	= $cmn->getval(trim($cmn->read_value($_POST['title'],0)));
	}
	else
	{
		if($strmode=='edit')
		{
			$obj->setallvalues($case_id);
			
			
		$objinvestigated_newspaper->setallvalues(null,' AND case_id = '.$obj->id);
		$objarticle_information->setallvalues(null,' AND case_id = '.$obj->id);
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

		$investigated_newspaper_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>investigated_newspaper:</label></td><td align="left" valign="top"><input type="button" name="btnDeleteinvestigated_newspaper" class="button" value="Delete" onclick="deleteinvestigated_newspaper(this,0);" /><input type="hidden" name="txtidinvestigated_newspaper[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Case_id:</label></td><td align="left" valign="top"><input type="text" name="txtcase_idinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Name:</label></td><td align="left" valign="top"><input type="text" name="txtnameinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Newspaper:</label></td><td align="left" valign="top"><input type="text" name="txtnewspaperinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Street:</label></td><td align="left" valign="top"><input type="text" name="txtstreetinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>City:</label></td><td align="left" valign="top"><input type="text" name="txtcityinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Zip:</label></td><td align="left" valign="top"><input type="text" name="txtzipinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>State:</label></td><td align="left" valign="top"><input type="text" name="txtstateinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Country:</label></td><td align="left" valign="top"><input type="text" name="txtcountryinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
		$article_information_html	= '<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375"><tr><td align="left" valign="top"width="150"><label>article_information:</label></td><td align="left" valign="top"><input type="button" name="btnDeletearticle_information" class="button" value="Delete" onclick="deletearticle_information(this,0);" /><input type="hidden" name="txtidarticle_information[]" class="textbox" value="0" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Case_id:</label></td><td align="left" valign="top"><input type="text" name="txtcase_idarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Url:</label></td><td align="left" valign="top"><input type="text" name="txturlarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Box_url:</label></td><td align="left" valign="top"><input type="text" name="txtbox_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Publish_date:</label></td><td align="left" valign="top"><input type="text" name="txtpublish_datearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Note:</label></td><td align="left" valign="top"><input type="text" name="txtnotearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Fname:</label></td><td align="left" valign="top"><input type="text" name="txtfnamearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Mname:</label></td><td align="left" valign="top"><input type="text" name="txtmnamearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Lname:</label></td><td align="left" valign="top"><input type="text" name="txtlnamearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Email:</label></td><td align="left" valign="top"><input type="text" name="txtemailarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Phone_number:</label></td><td align="left" valign="top"><input type="text" name="txtphone_numberarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Mobile_number:</label></td><td align="left" valign="top"><input type="text" name="txtmobile_numberarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Twitter_username:</label></td><td align="left" valign="top"><input type="text" name="txttwitter_usernamearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Twitter_url:</label></td><td align="left" valign="top"><input type="text" name="txttwitter_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Fb_username:</label></td><td align="left" valign="top"><input type="text" name="txtfb_usernamearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Fb_url:</label></td><td align="left" valign="top"><input type="text" name="txtfb_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Linkedin_username:</label></td><td align="left" valign="top"><input type="text" name="txtlinkedin_usernamearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Linkedin_url:</label></td><td align="left" valign="top"><input type="text" name="txtlinkedin_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Street:</label></td><td align="left" valign="top"><input type="text" name="txtstreetarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>City:</label></td><td align="left" valign="top"><input type="text" name="txtcityarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Zip:</label></td><td align="left" valign="top"><input type="text" name="txtziparticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>State:</label></td><td align="left" valign="top"><input type="text" name="txtstatearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Country:</label></td><td align="left" valign="top"><input type="text" name="txtcountryarticle_information[]" class="textbox" value="" maxlength="100" /></td></tr><tr><td align="left" valign="top"width="150"><label>Author_note:</label></td><td align="left" valign="top"><input type="text" name="txtauthor_notearticle_information[]" class="textbox" value="" maxlength="100" /></td></tr></table>';
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
	
	
		function addMoreinvestigated_newspaper()
		{
			var html	= '<?php echo $investigated_newspaper_html; ?>';
			$('#investigated_newspaper_container').append(html);
		}
		
		function deleteinvestigated_newspaper(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this investigated_newspaper?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deleteinvestigated_newspaper", id: id }
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
		
		function addMorearticle_information()
		{
			var html	= '<?php echo $article_information_html; ?>';
			$('#article_information_container').append(html);
		}
		
		function deletearticle_information(obj,id)
		{
			if(confirm('Are you sure you wnat to delete this article_information?'))
			{
				if(id > 0)
				{
					$.ajax({
						type: "POST",
						url: "general-actions.php",
						data: { mode: "deletearticle_information", id: id }
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
                  <td align="left" valign="top" class="box-heading"><h2>Newspaper</h2></td>
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
										<td align="left" valign="middle" height="25">
													<a href="personal-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Personal Information</a>&nbsp;&nbsp;
													<a href="social-media-information-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="button">Manage Social
													Media Information</a>&nbsp;&nbsp;
													<a href="newspaper-addedit.php?case_id=<?php echo (int) $case_id; ?>" class="active">Manage Newspaper</a>&nbsp;&nbsp;
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
						
                        <!-- Newspaper start -->
                        <tr>
                          <td align="left" valign="top" colspan="2">
	                          	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="100%">
                                    <tr>
                                    	<td valign="top">
                                        	<fieldset>
                                                <legend>Newspaper</legend>
                                                <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                                    
			<tr>
			  <td align="left" valign="top"><label>Title:</label></td>
			  <td align="left" valign="top"><input type="text" name="txttitle" class="textbox" id="txttitle" value="<?php echo htmlspecialchars($obj->title); ?>" maxlength="100" /></td>
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
							    <legend>Investigated_newspaper</legend>
                                <div id="investigated_newspaper_container">
                                	<?php
                                    	if(count($objinvestigated_newspaper->id) > 0)
										{
											$i=0;
											
											foreach($objinvestigated_newspaper->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Investigated_newspaper:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmoreinvestigated_newspaper" class="button" id="btnaddmoreinvestigated_newspaper" value="Add More" onclick="addMoreinvestigated_newspaper();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeleteinvestigated_newspaper" class="button" value="Delete" onclick="deleteinvestigated_newspaper(this,<?php echo htmlspecialchars($objinvestigated_newspaper->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Name of Newspaper:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnameinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->name[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Website URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Newspaper:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnewspaperinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->newspaper[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->street[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcityinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->city[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtzipinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->zip[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstateinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->state[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountryinvestigated_newspaper[]" class="textbox" value="<?php echo htmlspecialchars($objinvestigated_newspaper->country[$key]); ?>" maxlength="100" /></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Investigated_newspaper:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmoreinvestigated_newspaper" class="button" id="btnaddmoreinvestigated_newspaper" value="Add More" onclick="addMoreinvestigated_newspaper();" /><input type="hidden" name="txtidinvestigated_newspaper[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                        
						<tr>
							  <td align="left" valign="top"width="150"><label>Name of Newspaper:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnameinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Website URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Newspaper:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtnewspaperinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcityinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtzipinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstateinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountryinvestigated_newspaper[]" class="textbox" value="" maxlength="100" /></td>
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
							    <legend>Article Information</legend>
                                <div id="article_information_container">
                                	<?php
                                    	if(count($objarticle_information->id) > 0)
										{
											$i=0;
											
											foreach($objarticle_information->id AS $key => $val)
											{
									?>
                                    <table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Article Information:</label></td>
                                          <td align="left" valign="top">
                                          	<?php
												if($i==0)
												{
											?>
                                          <input type="button" name="btnaddmorearticle_information" class="button" id="btnaddmorearticle_information" value="Add More" onclick="addMorearticle_information();" />
                                          <?php } else { ?>
                                          <input type="button" name="btnDeletearticle_information" class="button" value="Delete" onclick="deletearticle_information(this,<?php echo htmlspecialchars($objarticle_information->id[$key]); ?>);" />
                                          <?php } ?>
											<input type="hidden" name="txtidarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->id[$key]); ?>" maxlength="100" />
                                          </td>
                                        </tr>
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Article URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->box_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Published Date:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtpublish_datearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->publish_date[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Article Notes:</label></td>
							  <td align="left" valign="top"><textarea class="textbox" name="txtnotearticle_information[]" rows="12"><?php echo htmlspecialchars($objarticle_information->note[$key]); ?></textarea>
                              </td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>First Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfnamearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->fname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmnamearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->mname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Last Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlnamearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->lname[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Email:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtemailarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->email[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Phone:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtphone_numberarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->phone_number[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmobile_numberarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->mobile_number[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_usernamearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->twitter_username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_urlarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->twitter_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_usernamearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->fb_username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_urlarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->fb_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_usernamearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->linkedin_username[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_urlarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->linkedin_url[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->street[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcityarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->city[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtziparticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->zip[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstatearticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->state[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountryarticle_information[]" class="textbox" value="<?php echo htmlspecialchars($objarticle_information->country[$key]); ?>" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Author Notes:</label></td>
							  <td align="left" valign="top"><textarea class="textbox" name="txtauthor_notearticle_information[]" rows="12"><?php echo htmlspecialchars($objarticle_information->note[$key]); ?></textarea></td>
							</tr>
			</table>
                                    <?php
											$i++;
                                    	}
										} else { ?>
                                	<table cellpadding="1" cellspacing="1" border="0" align="left" class="frmmn" width="375">
                                        <tr>
                                          <td align="left" valign="top"width="150"><label>Article Information:</label></td>
                                          <td align="left" valign="top"><input type="button" name="btnaddmorearticle_information" class="button" id="btnaddmorearticle_information" value="Add More" onclick="addMorearticle_information();" /><input type="hidden" name="txtidarticle_information[]" class="textbox" value="0" maxlength="100" /></td>
                                        </tr>
                                        
						
						<tr>
							  <td align="left" valign="top"width="150"><label>Article URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txturlarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Box URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtbox_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Published Date:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtpublish_datearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Article Notes:</label></td>
							  <td align="left" valign="top"><textarea class="textbox" name="txtnotearticle_information[]" rows="12"></textarea></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>First Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfnamearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Middle Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmnamearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Last Name:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlnamearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Email:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtemailarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Phone:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtphone_numberarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmobile_numberarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_usernamearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Twitter Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txttwitter_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_usernamearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Facebook Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfb_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Username:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_usernamearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Linkedin Profile Page:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlinkedin_urlarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Street:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstreetarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>City:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcityarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Zip:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtziparticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>State:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtstatearticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Country:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtcountryarticle_information[]" class="textbox" value="" maxlength="100" /></td>
							</tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Author Notes:</label></td>
							  <td align="left" valign="top"><textarea class="textbox" name="txtauthor_notearticle_information[]" rows="12"></textarea></td>
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
	//document.getElementById('txtfname').focus();
</script>
</body>
</html>