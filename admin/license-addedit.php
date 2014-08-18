<?php
	require_once 'include/general-includes.php';
	require_once 'class/license.class.php';
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
	if ($strmode=='edit' && !($cmn->is_record_exists('license', 'id', $id, $record_condition)))
		$msg->send_msg('license-list.php','',46);

	//create object of main entity...
	$obj = new license();

	//include db file here...
	require_once 'license-db.php';

	if(isset($_SESSION['err']))
	{
		$obj->id			= (int) $id;
		$obj->employee_id		= $cmn->getval(trim($cmn->read_value($_POST['selemployee_id'],$_REQUEST['employee_id'])));
		$obj->private_investigator		= $cmn->getval(trim($cmn->read_value($_POST['txtprivate_investigator'],'')));
		$obj->expiration_date 		= $cmn->getval(trim($cmn->read_value($_POST["txtexpiration_date"],"")));
		$obj->valid_region	= $cmn->getval(trim($cmn->read_value($_POST['txtvalid_region'],'')));
		$obj->license_number		= $cmn->getval(trim($cmn->read_value($_POST['txtlicense_number'],'')));
		$obj->fax			= $cmn->getval(trim($cmn->read_value($_POST['txtfax'],'')));
		$obj->active		= $cmn->getval(trim($cmn->read_value($_POST['rdoactive'],'')));
	}
	else
	{
		$obj->employee_id		= (isset($_REQUEST['employee_id']) && $_REQUEST['employee_id'] > 0) ? $_REQUEST['employee_id'] : 0;
		
		if($strmode=='edit')
		{
			$obj->setallvalues($id);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>

<link rel="stylesheet" href="js/date-picker/css/jquery-ui-1.8.20.custom.css">
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/date-picker/js/jquery.ui.core.js"></script>
<script src="js/date-picker/js/jquery.ui.widget.js"></script>
<script src="js/date-picker/js/jquery.ui.datepicker.js"></script>
<script>
$(function() {
	$( "#txtdate" ).datepicker({
		dateFormat: '<?php echo JQUERY_DATE_FORMAT; ?>'
	});
});
</script>

<script language="javascript" type="text/javascript" src="js/common.js"></script>
<script language="javascript" type="text/javascript" src="js/validation.js"></script>
<script language="javascript" type="text/javascript">
	function validate(){
		var index = 0;
		var arValidate = new Array;
		arValidate[index++] = new Array("R", "document.frm.txtlicense_number", "License Number");
		if (!Isvalid(arValidate)){
			return false;
		}
		return true;
	}
</script>
</head>
<body>
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
                  <td align="left" valign="top" class="box-heading"><h2>Client Account</h2></td>
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
                          <td align="left" valign="top"width="150"><label>Employee:</label></td>
                          <td align="left" valign="top">
							<select name="selemployee_id" class="selectbox">
								<option value="">Please select</option>
								<?php 
									$cmn->fillcombo(DB_PREFIX . 'user', 'SELECT user_id, CONCAT(first_name, \' \',last_name) AS fullname FROM ' . DB_PREFIX . 'user WHERE user_active = \'y\' ORDER BY first_name, last_name', 'user_id', 'fullname', $obj->employee_id);
								?>
							</select>
						  </td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Private Investigator:</label></td>
                          <td align="left" valign="top">
							<select name="txtprivate_investigator">
								<option value="">Please select</option>
							</select>
						  </td>
                        </tr>
	                    
						<tr>
							<td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							<td align="left" valign="top"width="150"><label>Expiration Date:<?php echo REQUIRED; ?></label></td>
							<td align="left" valign="top"><input type="text" name="txtexpiration_date" class="textbox" value="<?php echo htmlspecialchars($obj->expiration_date); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							<td align="left" valign="top"width="150"><label>Valid Region:<?php echo REQUIRED; ?></label></td>
							<td align="left" valign="top">
								<select name="txtvalid_region">
									<option value="">Please select</option>
								</select>
							</td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>License Number:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtlicense_number" class="textbox" value="<?php echo htmlspecialchars($obj->license_number); ?>" maxlength="100" /></td>
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
                            <input type="button" name="btncancel" class="cancel-button" id="btncancel" onclick="javascript:window.location.href='license-list.php'" value="" /></td>
                        </tr>
                      </table>
                    </form>
                    <?php 
						}
					else {
					?>
					<table cellpadding="0" cellspacing="0" border="0" align="left" class="frmmn" width="100%">
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Private Investigator:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->private_investigator); ?></td>
                        </tr>
	                    
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Expiration Date:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->expiration_date); ?></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Valid Region:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->valid_region); ?></td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>License Number:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->license_number); ?></td>
						</tr>
						
						<tr>
							<td align="left" valign="top"height="10"></td>
						  </tr>
						  <tr>
							<td align="left" valign="top"width="150"><label>Active?:</label></td>
							<td align="left" valign="top"><?php echo strtoupper(htmlspecialchars($obj->active)); ?></td>
						  </tr>
						  <tr>
							<td align="left" valign="top"height="10"></td>
						  </tr>
						  <tr>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top"><input type="button" name="btnback" class="button" id="btnback" onclick="javascript:window.location.href='license-list.php'" value="Back" /></td>
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
<script type="text/javascript" language="javascript">
	document.getElementById('txttitle').focus();
</script>
</body>
</html>