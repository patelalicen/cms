<?php 
	require_once 'include/general-includes.php';
	require_once 'class/user.class.php';
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));
		
	$user_id = 0;
	if (isset($_REQUEST['user_id']) && trim($_REQUEST['user_id'])!="")
		$user_id = $_REQUEST['user_id'];

	//set mode...
	$strmode="add";
	if(isset($_REQUEST["mode"]))
		$strmode = trim($_REQUEST["mode"]);

	//code to check record existance in case of edit...
	$record_condition = "";
	if ($mode=="edit" && !($cmn->is_record_exists("user", "user_id", $user_id, $record_condition)))
		$msg->send_msg("user-list.php","",46);

	//create object of main entity...
	$objuser = new user();	
	$objuser->user_active = 'y';

	//include db file here...
	require_once 'user-db.php';

	if(isset($_SESSION["err"]))
	{
		$objuser->user_role_id = $cmn->getval(trim($cmn->read_value($_POST["seluser_role"],"")));
		$objuser->first_name = $cmn->getval(trim($cmn->read_value($_POST["txtfirst_name"],"")));
		$objuser->last_name = $cmn->getval(trim($cmn->read_value($_POST["txtlast_name"],"")));
		$objuser->email = $cmn->getval(trim($cmn->read_value($_POST["txtemail"],"")));
		$objuser->user_name = $cmn->getval(trim($cmn->read_value($_POST["txtuser_name"],"")));
		$objuser->password = $cmn->getval(trim($cmn->read_value($_POST["txtpassword"],"")));
		$objuser->user_active = $cmn->getval(trim($cmn->read_value($_POST["rdouser_active"],"")));
		
		$objuser->middle_name = $cmn->getval(trim($cmn->read_value($_POST["txtmiddle_name"],"")));
		$objuser->job_title = $cmn->getval(trim($cmn->read_value($_POST["txtjob_title"],"")));
		$objuser->report_to = $cmn->getval(trim($cmn->read_value($_POST["txtreport_to"],"")));
		$objuser->office_location = $cmn->getval(trim($cmn->read_value($_POST["txtoffice_location"],"")));
		
		$objuser->address			= $cmn->getval(trim($cmn->read_value($_POST['txtaddress'],'')));
		$objuser->street			= $cmn->getval(trim($cmn->read_value($_POST['txtstreet'],'')));
		$objuser->city				= $cmn->getval(trim($cmn->read_value($_POST['txtcity'],'')));
		$objuser->state				= $cmn->getval(trim($cmn->read_value($_POST['txtstate'],'')));
		$objuser->zip				= $cmn->getval(trim($cmn->read_value($_POST['txtzip'],'')));
		$objuser->country			= $cmn->getval(trim($cmn->read_value($_POST['txtcountry'],'')));
		
		$objuser->company_email = $cmn->getval(trim($cmn->read_value($_POST["txtcompany_email"],"")));
		$objuser->office_phone		= $cmn->getval(trim($cmn->read_value($_POST['txtoffice_phone'],'')));
		$objuser->mobile_phone		= $cmn->getval(trim($cmn->read_value($_POST['txtmobile_phone'],'')));
		$objuser->home_phone		= $cmn->getval(trim($cmn->read_value($_POST['txthome_phone'],'')));
		$objuser->skype				= $cmn->getval(trim($cmn->read_value($_POST['txtskype'],'')));
		$objuser->fax				= $cmn->getval(trim($cmn->read_value($_POST['txtfax'],'')));
		
		$objuser->language = $cmn->getval(trim($cmn->read_value($_POST["chklanguage"],"")));
		$objuser->dob = $cmn->getval(trim($cmn->read_value($_POST["txtdob"],"")));
		
		$objuser->security_clearance = $cmn->getval(trim($cmn->read_value($_POST["selsecurity_clearance"],"")));
		$objuser->note		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['txtnote'],'')));
		
		$objuser->image		= $cmn->getval(trim($cmn->read_value($_FILES['txtimage']['name'],'')));
		$objuser->old_image	= $cmn->getval(trim($cmn->read_value($_POST['txtold_image'],'')));
	}
	else
	{
		if($strmode=="edit")
			$objuser->setallvalues($user_id);
			
			$strfile = USER_UPLOAD_DIR . $obj->image;
            
			if(!(file_exists($strfile) && is_file($strfile))){
                $strfile = '';
            }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>
<script type="text/javascript" language="javascript" src="js/validation.js"></script>
<script language="javascript" type="text/javascript">
	function validate(){
		var index = 0;
		var arValidate = new Array;
		arValidate[index++] = new Array("R", "document.frm.txtfirst_name", "first name");
		arValidate[index++] = new Array("R", "document.frm.txtlast_name", "last name");
		arValidate[index++] = new Array("R", "document.frm.txtemail", "email");
		arValidate[index++] = new Array("E", "document.frm.txtemail", "email");
		arValidate[index++] = new Array("R", "document.frm.txtcompany_email", "company email");
		arValidate[index++] = new Array("E", "document.frm.txtcompany_email", "company email");
		arValidate[index++] = new Array("S", "document.frm.seluser_role", "user role");
		arValidate[index++] = new Array("R", "document.frm.txtuser_name", "user name");
		arValidate[index++] = new Array("R", "document.frm.txtpassword", "password");
		arValidate[index++] = new Array("R", "document.frm.txtoffice_phone", "Office phone");
		arValidate[index++] = new Array("R", "document.frm.txtmobile_phone", "Mobile phone");
		arValidate[index++] = new Array("R", "document.frm.txthome_phone", "Home phone");
		arValidate[index++] = new Array("R", "document.frm.selreport_to", "Report to");
		
		if (!Isvalid(arValidate)){
			return false;
		}
		return true;	
	}
	
	function delete_file(){
		if(confirm('Are you sure, you want to remove this Image?')){
			document.getElementById('frmfiledelete').submit();
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
            <!--<td width="218" class="menu"><?php //require_once 'include/menu.php'; ?></td>
            <td width="17">&nbsp;</td> -->
            <td class="main-content"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td align="left" valign="top" class="box-heading"><h2>Employee</h2></td>
                </tr>
                <tr>
                  <td align="left" valign="top" height="15"></td>
                </tr>
                <?php 
					if ( isset($_SESSION['err']) ) {
				?>
                		<tr>
                          <td align="left" valign="top">
                          	<?php $msg->display_msg(); ?>
                          </td>
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
                          <td align="right" valign="top" class="required-sentence" colspan="2"><?php echo REQUIRED_SENTENCE; ?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>First Name <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" class="textbox" class="textbox" name="txtfirst_name" id="txtfirst_name" maxlength="100" value="<?php echo htmlspecialchars($objuser->first_name); ?>" /></td>
                        </tr>
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>Middle Name</label></td>
                          <td align="left" valign="top"><input type="text" name="txtmiddle_name" class="textbox" id="txtmiddle_name" maxlength="100" value="<?php echo htmlspecialchars($objuser->middle_name); ?>" /></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>Last Name <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtlast_name" class="textbox" id="txtlast_name" maxlength="100" value="<?php echo htmlspecialchars($objuser->last_name); ?>" /></td>
                        </tr>
		
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>Job Title</label></td>
                          <td align="left" valign="top"><input type="text" name="txtjob_title" class="textbox" id="txtjob_title" maxlength="100" value="<?php echo htmlspecialchars($objuser->job_title); ?>" /></td>
                        </tr>
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>Email <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtemail" class="textbox" id="txtemail" maxlength="255" value="<?php echo htmlspecialchars($objuser->email); ?>" /></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>User Role <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top">
							<?php 
								$qryRol = 'SELECT user_role_id, user_role_name FROM ' . DB_PREFIX . 'user_role WHERE user_role_active = \'y\' ORDER BY user_role_name';
								$resRol = mysql_query($qryRol) or die(mysql_error());
	
								if(mysql_num_rows($resRol)>0)
								{
									while ($rowRol = mysql_fetch_array($resRol))
									{
										print '<input type="checkbox" name="seluser_role[]" value="'.$rowRol['user_role_id'].'" /> '.$rowRol['user_role_name'].'<br />';
									}	
									
									mysql_free_result($resRol);
								}
							?>
	                      </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>User Name <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtuser_name" class="textbox" id="txtuser_name" maxlength="100" value="<?php echo htmlspecialchars($objuser->user_name); ?>" /></td>
                        </tr>
						
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>Password <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="password" name="txtpassword" class="textbox" id="txtpassword" maxlength="50" value="<?php echo htmlspecialchars($objuser->password); ?>" /></td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
							<td align="left" valign="top" width="150"><label>Report to</label></td>
							<td align="left" valign="top">
								<select name="selreport_to" id="selreport_to" class="selectbox">
									<option value="">Please select</option>
									<?php 
										$cmn->fillcombo(DB_PREFIX . 'user', 'SELECT user_id, CONCAT(first_name,\' \',middle_name,\' \',last_name) AS name FROM ' . DB_PREFIX . 'user WHERE user_active = \'y\' ORDER BY first_name', 'user_id', 'name', $objuser->report_to);
									?>
								</select>
							</td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" width="150"><label>Office Location <?php echo REQUIRED; ?></label></td>
                          <td align="left" valign="top"><input type="text" name="txtoffice_location" class="textbox" id="txtoffice_location" maxlength="100" value="<?php echo htmlspecialchars($objuser->office_location); ?>" /></td>
                        </tr>
		

		
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Address:</label></td>
                          <td align="left" valign="top">
							<input type="text" name="txtaddress" class="textbox" id="txtaddress" value="<?php echo htmlspecialchars($objuser->address); ?>" maxlength="100" />
                          </td>
                        </tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>street:</label></td>
                          <td align="left" valign="top">
							<input type="text" name="txtstreet" class="textbox" id="txtstreet" value="<?php echo htmlspecialchars($objuser->street); ?>" maxlength="100" />
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
									$cmn->fillcombo(DB_PREFIX . 'city', 'SELECT id, name FROM ' . DB_PREFIX . 'city ORDER BY name', 'id', 'name',$objuser->city);
								?>
							</select>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
						  <td align="left" valign="top"width="150"><label>Zip/Postal Code:</label></td>
						  <td align="left" valign="top"><input type="text" name="txtzip" class="textbox" value="<?php echo htmlspecialchars($objuser->zip); ?>" maxlength="100" /></td>
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
									$cmn->fillcombo(DB_PREFIX . 'state', 'SELECT id, name FROM ' . DB_PREFIX . 'state ORDER BY name', 'id', 'name', $objuser->state);
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
									$cmn->fillcombo(DB_PREFIX . 'country', 'SELECT id, country_name FROM ' . DB_PREFIX . 'country ORDER BY country_name', 'id', 'country_name', $objuser->country);
								?>
							</select>
						  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Company Email:<?php echo REQUIRED; ?></label></td>
							  <td align="left" valign="top"><input type="text" name="txtcompany_email" class="textbox" value="<?php echo htmlspecialchars($objuser->company_email); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Office Phone:<?php echo REQUIRED; ?></label></td>
							  <td align="left" valign="top"><input type="text" name="txtoffice_phone" class="textbox" value="<?php echo htmlspecialchars($objuser->office_phone); ?>" maxlength="100" /></td>
						</tr>
  
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Mobile Phone:<?php echo REQUIRED; ?></label></td>
							  <td align="left" valign="top"><input type="text" name="txtmobile_phone" class="textbox" value="<?php echo htmlspecialchars($objuser->mobile_phone); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Home Phone:<?php echo REQUIRED; ?></label></td>
							  <td align="left" valign="top"><input type="text" name="txthome_phone" class="textbox" value="<?php echo htmlspecialchars($objuser->home_phone); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Skype:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtskype" class="textskype" value="<?php echo htmlspecialchars($objuser->skype); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Fax:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtfax" class="textbox" value="<?php echo htmlspecialchars($objuser->fax); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Language:</label></td>
							  <td align="left" valign="top">
									<input type="checkbox" name="txtlanguage" class="textbox" value="English (US)" maxlength="100" /> English (US)
									<input type="checkbox" name="txtlanguage" class="textbox" value="English (UK)" maxlength="100" /> English (UK)
								</td>
						</tr>
		
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>DOB:</label></td>
							  <td align="left" valign="top"><input type="text" name="txtdob" class="textdob" value="<?php echo htmlspecialchars($objuser->dob); ?>" maxlength="100" /></td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
						<tr>
							  <td align="left" valign="top"width="150"><label>Security Clearance:</label></td>
							  <td align="left" valign="top">
								<select name="selsecurity_clearance" class="selectbox">
									<option value="">Please select</option>
								</select>
							  </td>
						</tr>
						
						<tr>
                          <td align="left" valign="top"height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"width="150"><label>Note:</label></td>
                          <td align="left" valign="top">
                          	<textarea class="textbox" name="txtnote" id="txtnote" rows="12"><?php echo $objuser->note; ?></textarea>
                          </td>
                        </tr>
						
						<!--Image-->
							<tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
							<tr>
							  <td align="left" valign="top"width="150"><label>Photo:</label></td>
							  <td align="left" valign="top">
								<input type="file" name="txtimage" class="textbox" id="txtimage" />
								<!--txtold_image_name-->
								<?php if($strfile != ''){ ?>
									<input type="hidden" name="txtold_image" class="textbox" id="txtold_image" value="<?php echo $strfile; ?>" />
									<a href="#" onClick="javascript:open_window('<?php echo $strfile; ?>','<?php $objuser->image; ?>',500,500);"><strong>(View)</strong></a>
									<a href="#" onClick="javascript:delete_file();"><strong>(Delete)</strong></a>
								<?php } ?>
							  </td>
							</tr>
							<!-- END Image-->
							
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><label>Active?</label></td>
                          <td align="left" valign="top"><input type="radio" name="rdouser_active" id="rdouser_active" value="y" <?php if ( $objuser->user_active == 'y' ) echo 'checked="checked"'; ?> />
                            Yes &nbsp;
                            <input type="radio" name="rdouser_active" id="rdouser_active" value="n" <?php if ( $objuser->user_active == 'n' ) echo 'checked="checked"'; ?> />
                            No </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" height="10"></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top"><input type="submit" value="Submit" class="button" name="btnsubmit" id="btnsubmit" />
                            <input type="button" value="Cancel" class="button" name="btncancel" id="btncancel" onclick="javascript:window.location.href='user-list.php';" /></td>
                        </tr>
                      </table>
                    </form>
                    <script type="text/javascript" language="javascript">
						document.getElementById('txtfirst_name').focus();
					</script>
                    <?php 
						}
						else {
					?>
                    	<table cellpadding="0" cellspacing="0" border="0" align="left" class="frmmn view-table" width="550">
                            <tr>
                              <td align="left" valign="top" height="20"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>First Name</label></td>
                              <td align="left" valign="top"><?php echo htmlspecialchars($objuser->first_name); ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>Last Name</label></td>
                              <td align="left" valign="top"><?php echo htmlspecialchars($objuser->last_name); ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>Email</label></td>
                              <td align="left" valign="top"><?php echo htmlspecialchars($objuser->email); ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>User Role</label></td>
                              <td align="left" valign="top">
                                <?php echo $objuser->user_role_id ?>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>User Name</label></td>
                              <td align="left" valign="top"><?php echo htmlspecialchars($objuser->user_name); ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>Password</label></td>
                              <td align="left" valign="top"><?php echo htmlspecialchars($objuser->password); ?></td>
                            </tr>
							
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" width="150"><label>Active?</label></td>
                              <td align="left" valign="top"><?php echo strtoupper($objuser->user_active); ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top">&nbsp;</td>
                              <td align="left" valign="top">
                                <input type="button" value="Back" class="button" name="btnback" id="btnback" onclick="javascript:window.location.href='user-list.php';" /></td>
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
</body>
</html>