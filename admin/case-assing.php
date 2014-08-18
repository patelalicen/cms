<?php
	require_once 'include/ajax-includes.php';
	require_once 'class/case.class.php';
	
	//create object of main entity...
	$obj = new investigation_case();
	
	$mode	= isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
	
	if($mode != 'noaction')
	{
		if($mode == 'assing')
		{
			$cases	= isset($_REQUEST['cases']) ? $_REQUEST['cases'] : '';
			$arrw	= $obj->fetchallasarray($cases);
			?>
           	<form name="frm" id="frm" action="<?php echo trim($_SERVER['REQUEST_URI']); ?>" method="post" >
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
        	        <tr>
                        <td align="left" valign="top" height="10"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
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
									  
										<?php 
											if ( $user_rights_array['edit'] )
											{
												$inttotal_column++
										?>
										  <th align="center" valign="top"> Active/Inactive
											<?php $objpaging->_sortimages('active', $cmn->getcurrentpagename()); ?>
										  </th>
										<?php 
											}
										?>
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
									  <?php 
											if ( $user_rights_array['edit'] )
											{
										?>
										<td align="center" valign="middle" height="25"><input type="checkbox" name="activeids[]" value="<?php print trim($rw['id']); ?>" <?php ($rw['status']=='active') ? print "checked=\"checked\"" : "" ?>  /></td>
										<?php 
											}
										?>
                                    </tr>
                                    <?php
									}
									$inactiveids = implode(",",$arid);
									?>
                                    <tr>
                                      <?php 
										if ( $user_rights_array['delete'] ) {
											$inttotal_column--;
										?>
                                      <td align="center" valign="middle" height="25"><input type="button" name="btndelete" class="delete-button" value="" onclick="javascript: set_action_nos('delete','case');"/></td>
                                      <?php 
										}
										if ( $user_rights_array['edit'] ) { 
											$inttotal_column--;
										}
										?>
                                      <td align="left" valign="middle" height="25" colspan="<?php echo $inttotal_column; ?>">
									  	<?php
										if ( $user_rights_array['export'] ) {
										?>
                                        <input type="button" name="btnexport" class="export-button" value="" onclick="javascript: set_action_nos('export','case');"/>
                                        <?php
										}
										?>
                                        <input type="hidden" name="hdnmode" value="" />
                                        <input type="hidden" name="inactiveids" value="<?php print $inactiveids; ?>" />
                                        <input type="hidden" name="cpage" value="<?php print $cpage; ?>"></td>
										<?php 
											if ( $user_rights_array['edit'] )
											{
										?>
											<td align="center" valign="middle" height="25"><input type="button" name="btnactive" class="save-button" value="" onclick="javascript: set_action_nos('active','case');"/></td>
										<?php
											}
										?>
                                    </tr>
                                    <?php
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
                    </table></form>
            <?php
			/*
			<select name="seluser_role" id="seluser_role" class="selectbox">
				<option value="">Please select</option>
				<?php 
					$cmn->fillcombo(DB_PREFIX . 'user_role', 'SELECT user_role_id, user_role_name FROM ' . DB_PREFIX . 'user_role WHERE user_role_active = \'y\' ORDER BY user_role_name', 'user_role_id', 'user_role_name', (int) $objuser->user_role_id);
				?>
			</select>
			*/
			
			echo '<pre>';
			print_r($rows);
		}
	}
?>