<?php
	require_once 'include/general-includes.php';
	
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));
	require_once 'class/license.class.php';
	$obj = new license();
	$objpaging = new paging();
	require_once 'license-db.php';
	$condition	= '';
	$queryStr	= '';
	
	$cmn->set_page_state();	
	$page_state = $cmn->get_page_state();
	
	if ( isset($_REQUEST['employee_id']) && $_REQUEST['employee_id'] > 0)
	{
		$condition .= ' and employee_id IN ('.$_REQUEST['employee_id'].')';
		$queryStr	= '?employee_id='.$_REQUEST['employee_id'];
	}
	
	if ( is_array($page_state['search']) && count($page_state['search']) ) {
		if ( isset($page_state['search']['private_investigator']) && trim($page_state['search']['private_investigator']) != '' ) {
			$condition .= ' and ( private_investigator like \'%'.$cmn->setval(trim($page_state['search']['private_investigator'])).'%\' )';
		}
	}

	$order_field = 'id';
	$order_type = 'desc';
	
	if ( isset($page_state['order']['order_field']) && isset($page_state['order']['order_type']) && trim($page_state['order']['order_field']) != '' && trim($page_state['order']['order_type']) != '' ) {
		$order_field = $cmn->setval($page_state['order']['order_field']);
		$order_type = $cmn->setval($page_state['order']['order_type']);	
	}
	
	$records_per_page = PAGESIZE;
	if ( isset($page_state['paging']['records_per_page']) && intval($page_state['paging']['records_per_page']) > 0 ) {
		$records_per_page = (int) $page_state['paging']['records_per_page'];
	}
	
	$objpaging->strorderby = $order_field;
	$objpaging->strorder = $order_type;
	$arrw = $objpaging->set_page_details($obj,'license-list.php',$records_per_page,$condition);
	$inttotal_column = 4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ADMIN_PANEL_PAGE_TITLE; ?></title>
<?php require_once 'include/theme.php'; ?>
<script type="text/javascript" src="js/common.js" language="javascript"></script>
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
                  <td align="left" valign="top" class="box-heading"><h2>Licenses</h2></td>
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
                  <td style="padding:20px;">
					<form name="frm" id="frm" action="<?php echo trim($_SERVER['REQUEST_URI']); ?>" method="post" >
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <td align="left" valign="top" class="search-panel"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                              <td align="left" valign="middle">
								<table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="middle"><strong style="font-size:13px;">Private Investigator:</strong> &nbsp; </td>
                                      <td align="left" valign="top" width="5"></td>
                                      <td align="left" valign="top"><input type="text" name="search_doc_title" class="textbox" id="search_doc_title" value="<?php if ( isset($page_state['search']['private_investigator']) && trim($page_state['search']['private_investigator']) ) echo htmlspecialchars($page_state['search']['private_investigator']); ?>" maxlength="200" /></td>
                                      <td align="left" valign="top" width="5"></td>
                                      <td align="left" valign="top"><input type="submit" name="btnsearch" class="button" id="btnsearch" value="Search" /></td>
                                      <td align="left" valign="top" width="5"></td>
                                      <td align="left" valign="top"><input type="button" name="btnreset" class="button" id="btnreset" value="Reset" onclick="javascript:window.location.href='license-list.php?search=reset';" /></td>
                                    </tr>
                                  </table>
                                </td>
								<?php
									if ( $user_rights_array['add'] )
									{
								?>
								  <td align="right" valign="middle"><a href="license-addedit.php<?php echo $queryStr; ?>" class="new-record-button">New License</a></td>
								  <?php
								}
								?>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" height="10"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                              <tr>
                                <td align="left" valign="top" class="paging-panel"><?php print $objpaging->draw_panel('panel1');?></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" height="10"></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top"><table cellpadding="0" cellspacing="0" border="0" width="100%" class="listmn">
                                    <tr>
										<?php 
										if ( $user_rights_array['delete'] ) {
											$inttotal_column++;
									?>
                                      <th align="center" valign="top" width="10%"> <input type="checkbox" name="chkselect_unselect_all" id="chkselect_unselect_all" value="" onclick="javascript:setdelete_checkbox(this.checked);" />
                                      </th>
                                      <?php 
									}
									?>
                                      <th align="left" valign="top"> Private Investigator
                                        <?php $objpaging->_sortimages('private_investigator', $cmn->getcurrentpagename()); ?>
                                      </th>
									  <th align="left" valign="top"> Expiration Date
                                        <?php $objpaging->_sortimages('expiration_date', $cmn->getcurrentpagename()); ?>
                                      </th>
									  <th align="left" valign="top"> Valid Region
                                        <?php $objpaging->_sortimages('valid_region', $cmn->getcurrentpagename()); ?>
                                      </th>
									  <th align="left" valign="top"> License Number
                                        <?php $objpaging->_sortimages('license_number', $cmn->getcurrentpagename()); ?>
                                      </th>
                                    </tr>
                                    <?php 
									if (count($arrw)>0)
									{
										$rowclass="background2";
										for($i=0;$i<count($arrw);$i++)
											{
												if ($rowclass=="background1")
													$rowclass="background2";
												else
													$rowclass="background1";
												$rw=$arrw[$i];
												$arid[] = $rw['id'];
									?>
                                    <tr class="<?php echo $rowclass; ?>">
                                      <?php 
										if ($user_rights_array['delete']) {
										?>
                                      <td align="center" valign="middle" height="25"><input type="checkbox" name="deletedids[]" id="deletedids" value="<?php echo (int) $rw[id]; ?>" /></td>
                                      <?php 
									}
									?>
                                      <td align="left" valign="middle" height="25">
                                      	<a  class="edit" href="license-addedit.php?mode=edit&id=<?php echo (int) $rw['id']; ?>">
											<?php echo $cmn->getval($rw['private_investigator']); ?>
                                        </a>
                                      </td>
									  <td align="left" valign="middle" height="25">
                                      	<a  class="edit" href="license-addedit.php?mode=edit&id=<?php echo (int) $rw['id']; ?>">
											<?php echo $cmn->getval($rw['expiration_date']); ?>
                                        </a>
                                      </td>
									  <td align="left" valign="middle" height="25">
                                      	<a class="edit" href="license-addedit.php?mode=edit&id=<?php echo (int) $rw['id']; ?>">
											<?php echo $cmn->getval($rw['valid_region']); ?>
                                        </a>
                                      </td>
									  <td align="left" valign="middle" height="25">
                                      	<a  class="edit" href="license-addedit.php?mode=edit&id=<?php echo (int) $rw['id']; ?>">
											<?php echo $cmn->getval($rw['license_number']); ?>
                                        </a>
                                      </td>
                                    </tr>
                                    <?php
									}
									$inactiveids = implode(",",$arid);
									?>
                                    <tr>
                                      <?php 
										if ( $user_rights_array['delete'] ) {
										?>
                                      <td align="center" valign="middle" height="25"><input type="button" name="btndelete" class="button" value="Delete" onclick="javascript: set_action('delete','license');"/></td>
                                      <?php 
										}
										?>
                                    <td align="left" valign="middle" height="25" colspan="<?php echo $inttotal_column; ?>">
									  	<?php
											if ( $user_rights_array['export'] ) {
										?>
                                        <input type="button" name="btnexport" class="button" value="Export" onclick="javascript: set_action('export','license');"/>
                                        <?php
											}
										?>
                                        <input type="hidden" name="hdnmode" value="" />
                                        <input type="hidden" name="inactiveids" value="<?php print $inactiveids; ?>" />
                                        <input type="hidden" name="cpage" value="<?php print $cpage; ?>">
									</td>
                                    </tr>
                                    <?php
										}
										else {
										?>
                                    <tr class="background1">
                                      <td align="center" valign="middle" height="25" colspan="<?php echo $inttotal_column; ?>"><em>No record(s) found.</em></td>
                                    </tr>
                                    <?php
										}
										?>
                                  </table></td>
                              </tr>
                            </table>
                          </td>
                      </tr>
                    </table></form></td>
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
<script type="text/javascript" language="javascript">
	document.getElementById('search_doc_title').focus();
</script>
</html>