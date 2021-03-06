<?php
	require_once 'include/general-includes.php';
	require_once 'class/client.class.php';
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
	if ($strmode=='edit' && !($cmn->is_record_exists('client', 'id', $id, $record_condition)))
		$msg->send_msg('client-list.php','',46);

	//create object of main entity...
	$obj = new client();

	//include db file here...
	require_once 'client-db.php';

	if(isset($_SESSION['err']))
	{
		$obj->id			= (int) $id;
		
		$obj->company_name		= $cmn->getval(trim($cmn->read_value($_POST['txtcompany_name'],'')));
		$obj->main_location		= $cmn->getval(trim($cmn->read_value($_POST['txtmain_location'],'')));
		$obj->address			= $cmn->getval(trim($cmn->read_value($_POST['txtaddress'],'')));
		$obj->street			= $cmn->getval(trim($cmn->read_value($_POST['txtstreet'],'')));
		$obj->city				= $cmn->getval(trim($cmn->read_value($_POST['txtcity'],'')));
		$obj->zip			= $cmn->getval(trim($cmn->read_value($_POST['txtzip'],'')));
		$obj->state			= $cmn->getval(trim($cmn->read_value($_POST['txtstate'],'')));
		$obj->country		= $cmn->getval(trim($cmn->read_value($_POST['txtcountry'],'')));
		$obj->email 		= $cmn->getval(trim($cmn->read_value($_POST["txtemail"],"")));
		$obj->primary_phone	= $cmn->getval(trim($cmn->read_value($_POST['txtprimary_phone'],'')));
		$obj->secondary_phone	= $cmn->getval(trim($cmn->read_value($_POST['txtsecondary_phone'],'')));
		$obj->fax	= $cmn->getval(trim($cmn->read_value($_POST['txtfax'],'')));
		$obj->web_url	= $cmn->getval(trim($cmn->read_value($_POST['txtweb_url'],'')));
		$obj->note		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtnote'],'')));
		$obj->case_policies		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtcase_policies'],'')));
		$obj->invoice_policies		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtinvoice_policies'],'')));
		$obj->active		= $cmn->getval(trim($cmn->read_value($_POST['rdoactive'],'')));
	}
	else
	{
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
		arValidate[index++] = new Array("R", "document.frm.txtcompany_name", "company_name");
		arValidate[index++] = new Array("R", "document.frm.txtmain_location", "main_location");
		arValidate[index++] = new Array("R", "document.frm.txtemail", "email");
		arValidate[index++] = new Array("R", "document.frm.txtprimary_phone", "primary_phone");
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
                          <td align="left" valign="top"width="150"><label>Company name:<?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtcompany_name" class="textbox" id="txtcompany_name" value="<?php echo htmlspecialchars($obj->company_name); ?>" maxlength="100" /></td>
                        </tr>
	                    <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Main location:</label></td>
                          <td align="left" valign="top">
							<input type="text" name="txtmain_location" class="textbox" id="txtmain_location" value="<?php echo htmlspecialchars($obj->main_location); ?>" maxlength="100" />
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
						  <td align="left" valign="top"width="150"><label>Country:</label></td>
						  <td align="left" valign="top">
							<select name="selcountry" class="selectbox">
								<option value="">Please select</option>
								<?php 
									$cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', $obj->country);
								?>
							</select>
						  </td>
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
							  <td align="left" valign="top"width="150"><label>Primary Phone:<?php echo REQUIRED; ?></label></td>
							  <td align="left" valign="top"><input type="text" name="txtprimary_phone" class="textbox" value="<?php echo htmlspecialchars($obj->primary_phone); ?>" maxlength="100" /></td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Secondary Phone:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtsecondary_phone" class="textbox" value="<?php echo htmlspecialchars($obj->secondary_phone); ?>" maxlength="100" /></td>
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
							  <td align="left" valign="top"width="150"><label>Website URL:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtweb_url" class="textbox" value="<?php echo htmlspecialchars($obj->web_url); ?>" maxlength="100" /></td>
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
                          <td align="left" valign="top"width="150"><label>Case policies:</label></td>
                          <td align="left" valign="top">
                          	<textarea class="textbox" name="txtcase_policies" id="txtcase_policies" rows="12"><?php echo $obj->case_policies; ?></textarea>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Invoice policies:</label></td>
                          <td align="left" valign="top">
                          	<textarea class="textbox" name="txtinvoice_policies" id="txtinvoice_policies" rows="12"><?php echo $obj->invoice_policies; ?></textarea>
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
                            <input type="button" name="btncancel" class="cancel-button" id="btncancel" onclick="javascript:window.location.href='client-list.php'" value="" /></td>
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
                          <td align="left" valign="top"width="150"><label>Company name:</label></td>
                          <td align="left" valign="top"><?php echo htmlspecialchars($obj->company_name); ?></td>
                        </tr>
	                    <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Main location:</label></td>
                          <td align="left" valign="top">
							<?php echo htmlspecialchars($obj->main_location); ?>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Address:</label></td>
                          <td align="left" valign="top">
							<?php echo htmlspecialchars($obj->address); ?>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>street:</label></td>
                          <td align="left" valign="top">
							<?php echo htmlspecialchars($obj->street); ?>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>City:</label></td>
						  <td align="left" valign="top">
								<?php 
									echo $obj->city;
								?>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
						  <td align="left" valign="top"><?php echo htmlspecialchars($obj->zip); ?></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>State:</label></td>
						  <td align="left" valign="top">
								<?php 
								echo $obj->state;
								?>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Country:</label></td>
						  <td align="left" valign="top">
								<?php 
									echo $obj->country;
								?>
						  </td>
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
							  <td align="left" valign="top"width="150"><label>Primary Phone:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->primary_phone); ?></td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Secondary Phone:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->secondary_phone); ?></td>
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
							  <td align="left" valign="top"width="150"><label>Website URL:</label></td>
							  <td align="left" valign="top"><?php echo htmlspecialchars($obj->web_url); ?></td>
						</tr>
							
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                          <td align="left" valign="top">
                          	<?php echo $obj->note; ?>
                          </td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Case policies:</label></td>
                          <td align="left" valign="top">
                          	<?php echo $obj->case_policies; ?>
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Invoice policies:</label></td>
                          <td align="left" valign="top">
                          	<?php echo $obj->invoice_policies; ?>
                          </td>
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
                        <td align="left" valign="top"><input type="button" name="btnback" class="button" id="btnback" onclick="javascript:window.location.href='client-list.php'" value="Back" /></td>
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