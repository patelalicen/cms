<?php
	require_once 'include/ajax-includes.php';
	
	$tab_id	= isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$case_id= isset($_REQUEST['case_id']) ? $_REQUEST['case_id'] : 0;
	
	$returnArray	= array();
	
	require_once 'class/tabs.class.php';
		
	//create object of main entity...
	$obj = new tabs();
	
	if($case_id > 0)
	{
		if(isset($tab_id) && $tab_id > 0)
		{
			$obj->setallvalues($tab_id);
			$obj->case_id	= $cmn->setval(trim($cmn->read_value($case_id,0)));
			$obj->heading	= $cmn->setval(trim($cmn->read_value($_POST['gt_title'],'')));
			$obj->note		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['gt_notes'],'')));
			
			$obj->update();
			
			$returnArray	= array('tab_id'=>$obj->id);
		}
		else
		{
			$obj->case_id	= $cmn->setval(trim($cmn->read_value($case_id,0)));
			$obj->heading	= $cmn->setval(trim($cmn->read_value($_POST['gt_title'],'')));
			$obj->note		= $cmn->store_db_compatiblevalue(trim($cmn->read_value($_POST['gt_notes'],'')));
			
			$obj->add();
			
			$returnArray	= array('reloadMe'=>'yes');
		}
	}
	
	echo json_encode($returnArray);