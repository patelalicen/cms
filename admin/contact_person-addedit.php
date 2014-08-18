<?php
	require_once 'include/general-includes.php';
	require_once 'class/contact_person.class.php';
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
	if ($strmode=='edit' && !($cmn->is_record_exists('contact_person', 'id', $id, $record_condition)))
		$msg->send_msg('contact_person-list.php','',46);

	//create object of main entity...
	$obj = new contact_person();

	//include db file here...
	require_once 'contact_person-db.php';

	if(isset($_SESSION['err']))
	{
		$obj->id			= (int) $id;
		$obj->client_id		= $cmn->getval(trim($cmn->read_value($_POST['txtclient_id'],$_REQUEST['client_id'])));
		$obj->full_name		= $cmn->getval(trim($cmn->read_value($_POST['txtfull_name'],'')));
		$obj->email 		= $cmn->getval(trim($cmn->read_value($_POST["txtemail"],"")));
		$obj->office_phone	= $cmn->getval(trim($cmn->read_value($_POST['txtoffice_phone'],'')));
		$obj->mobile		= $cmn->getval(trim($cmn->read_value($_POST['txtmobile'],'')));
		$obj->fax			= $cmn->getval(trim($cmn->read_value($_POST['txtfax'],'')));
		$obj->active		= $cmn->getval(trim($cmn->read_value($_POST['rdoactive'],'')));
	}
	else
	{
		$obj->client_id		= (isset($_REQUEST['client_id']) && $_REQUEST['client_id'] > 0) ? $_REQUEST['client_id'] : 0;
		
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
		arValidate[index++] = new Array("R", "document.frm.txtemail", "email");
		arValidate[index++] = new Array("R", "document.frm.txtoffice_phone", "office_phone");
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
                          <td align="left" valign="top"width="150"><label>Company Name:</label></td>
                          <td align="left" valign="top">
							<select name="selclient_id" class="selectbox">
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
                          <td align="left" valign="top"width="150"><label>Full name:</label></td>
                          <td align="left" valign="top"><input type="text" name="txtfull_name" class="textbox" id="txtfull_name" value="<?php echo htmlspecialchars($obj->full_name); ?>" maxlength="100" /></td>
                        </tr>
	                    
						<tr>
							<td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							<td align="left" valign="top"width="150"><label>Email:<?php echo REQUIRED; ?></label></td>
							<td align="left" valign="top"><input type="text" name="txtemail" class="textbox" value="<?php echo htmlspecialchars($obj->email); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Office Phone:<?php echo REQUIRED; ?></label></td>
							  <td align="left" valign="top"><input type="text" name="txtoffice_phone" class="textbox" value="<?php echo htmlspecialchars($obj->office_phone); ?>" maxlength="100" /></td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtmobile" class="textbox" value="<?php echo htmlspecialchars($obj->mobile); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Fax:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfax" class="textbox" value="<?php echo htmlspecialchars($obj->fax); ?>" maxlength="100" /></td>
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
                            <input type="button" name="btncancel" class="cancel-button" id="btncancel" onclick="javascript:window.location.href='contact_person-list.php'" value="" /></td>
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
                          <td align="left" valign="top"width="150"><label>Full name:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->full_name); ?></td>
                        </tr>
	                    
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Email:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->email); ?></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Office Phone:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->office_phone); ?></td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->mobile); ?></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Fax:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->fax); ?></td>
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
							<td align="left" valign="top"><input type="button" name="btnback" class="button" id="btnback" onclick="javascript:window.location.href='contact_person-list.php'" value="Back" /></td>
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