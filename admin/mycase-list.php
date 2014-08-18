<?php
	require_once 'include/general-includes.php';
	
	$cmn->is_authorized('index.php', trim($_SERVER['REQUEST_URI']));
	require_once 'class/case.class.php';
	$obj = new investigation_case();
	$objpaging = new paging();
	require_once 'case-db.php';
	$condition = 'AND `id` IN (SELECT DISTINCT case_id FROM '.DB_PREFIX.'assign_transfer WHERE `status` = \'active\' AND `assign_to` = \''.$cmn->get_session(ADMIN_USER_ID).'\')';
	
	$cmn->set_page_state();	
	$page_state = $cmn->get_page_state();
			
	if ( is_array($page_state['search']) && count($page_state['search']) ) {
		if ( isset($page_state['search']['person_investigated']) && trim($page_state['search']['person_investigated']) != '' ) {
			$condition .= ' and ( person_investigated like \'%'.$cmn->setval(trim($page_state['search']['person_investigated'])).'%\' )';
		}
	}
	if(isset($_REQUEST['search_doc_person_investigated']))
	{
		$condition .= ' and ( person_investigated like \'%'.$cmn->setval(trim($_REQUEST['search_doc_person_investigated'])).'%\' )';
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
	$arrw = $objpaging->set_page_details($obj,'case-list.php',$records_per_page,$condition);
	$inttotal_column = 6;
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
                  <td style="padding:20px;">
					<form name="frm" id="frm" action="<?php echo trim($_SERVER['REQUEST_URI']); ?>" method="post" >
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <td align="left" valign="top" class="search-panel"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                              <td align="left" valign="middle">
                                  <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="middle"><strong style="font-size:13px;">Person investigated:</strong> &nbsp; </td>
                                      <td align="left" valign="top" width="5"></td>
                                      <td align="left" valign="top"><input type="text" name="search_doc_person_investigated" class="textbox" id="search_doc_person_investigated" value="<?php echo $_REQUEST['search_doc_person_investigated']; ?>" maxlength="200" /></td>
                                      <td align="left" valign="top" width="5"></td>
                                      <td align="left" valign="top"><input type="submit" name="btnsearch" class="search-button" id="btnsearch" value="" /></td>
                                      <td align="left" valign="top" width="5"></td>
                                      <td align="left" valign="top"><input type="button" name="btnreset" class="reset-button" id="btnreset" value="" onclick="javascript:window.location.href='case-list.php?search=reset';" /></td>
                                    </tr>
                                  </table>
                                </td>
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
                                    <th align="left" valign="top"> UID
                                        <?php $objpaging->_sortimages('id', $cmn->getcurrentpagename()); ?>
                                      </th>

                                      <th align="left" valign="top"> Person investigated
                                        <?php $objpaging->_sortimages('person_investigated', $cmn->getcurrentpagename()); ?>
                                      </th>
									  <th align="left" valign="top"> DOI
                                        <?php $objpaging->_sortimages('doi', $cmn->getcurrentpagename()); ?>
                                      </th>
									  <th align="left" valign="top"> Report Date
                                        <?php $objpaging->_sortimages('report_date', $cmn->getcurrentpagename()); ?>
                                      </th>
									  <th align="left" valign="top"> Note </th>
									  <th align="left" valign="top" width="275"> Manage Data </th>
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
                                      	<a  class="edit" href="case-addedit.php?mode=edit&id=<?php echo (int) $rw['id']; ?>">
											<?php echo $cmn->getval(sprintf('%08d',$rw['id'])); ?>
                                        </a>
                                      </td>
                                      <td align="left" valign="middle" height="25">
                                      	<a  class="edit" href="case-addedit.php?mode=edit&id=<?php echo (int) $rw['id']; ?>">
											<?php echo $cmn->getval($rw['person_investigated']); ?>
                                        </a>
                                      </td>
									  
									  <td align="left" valign="middle" height="25">
                                      	<?php echo $cmn->getval(date(DATE_FORMAT,strtotime($rw['doi']))); ?>
                                      </td>
									  
									  <td align="left" valign="middle" height="25">
                                      	<?php echo $cmn->getval(date(DATE_FORMAT,strtotime($rw['report_date']))); ?>
                                      </td>
									  
									  <td align="left" valign="middle" height="25">
                                      	<?php echo $cmn->getval($rw['note']); ?>
                                      </td>
                                      
                                      <td align="left" valign="middle" height="25">
                                      	<a href="personal-information-addedit.php?case_id=<?php echo (int) $rw['id']; ?>" class="button">Manage Personal Information</a><br /><br />
										<a href="social-media-information-addedit.php?case_id=<?php echo (int) $rw['id']; ?>" class="button">Manage Social
										Media Information</a><br /><br />
										<a href="newspaper-addedit.php?case_id=<?php echo (int) $rw['id']; ?>" class="button">Manage Newspaper</a><br /><br />
										<a href="tv-channel-addedit.php?case_id=<?php echo (int) $rw['id']; ?>" class="button">Manage TV Channel</a><br /><br />
										<a href="sequence-addedit.php?case_id=<?php echo (int) $rw['id']; ?>" class="button">Manage Sequence</a>
                                      </td>
                                    </tr>
                                    <?php
									}
									$inactiveids = implode(",",$arid);
									
										}
										else {
										?>
                                    <tr class="background1">
                                      <td align="center" valign="middle" height="25" colspan="<?php echo $inttotal_column; ?>"><em>No document(s) found.</em></td>
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
		document.getElementById('search_doc_person_investigated').focus();
	</script>
</html>