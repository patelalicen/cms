<?php
	defined('PAGE_EXECUTE') or die( 'Restricted access.' );
	
	if ( isset($_POST['btnsubmit'])){
		
		$objvalidation = new validation();

		if($objvalidation->validate())
		{
			/*Add Edit Action of Name*/
			$objSeq->case_id	= $case_id;
			$pi_mode = $_POST['pi_mode'];
			$objSeq->id			= $cmn->setval(trim($cmn->read_value($_POST['txtname_id'],'')));	
			$objSeq->seq_no		= $cmn->setval(trim($cmn->read_value($_POST['txtname_seq'],'')));
			$objSeq->table_id	= $cmn->setval(trim($cmn->read_value($_POST['txtname_table_id'],'')));
			$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtname_table_name'],'')));
			if ($pi_mode == 'add'){	$objSeq->add(); }else{ $objSeq->update(); }
			
			/*Add Edit Action of Date of Birth*/
			// print_r ($_POST['txtdob_seq']);
			foreach($_POST['txtdob_seq'] as $key => $value)
			{
				
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtdob_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtdob_table_name'],'')));
				// echo $cmn->is_record_exists('pi_sequence', 'table_id',$key, ' AND table_name =\''.$objSeq->table_name.'\'');
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, ' AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }		
			}
	
			/*-----------------Add/Edit Action of Date of Death ---------------*/
			foreach($_POST['txtdod_seq'] as $key => $value)
			{
			
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtdod_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtdod_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }
			}
			/*------------------ Add/Edit Action of Aliases ----------------*/
			foreach($_POST['txtalias_seq'] as $key => $value)
			{	
				
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtalias_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtalias_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ 
				$objSeq->update(); }else{ $objSeq->add(); }	
			}
			/*------------------ Add/Edit Action of Previous Address ----------------*/
			foreach($_POST['txtpre_add_seq'] as $key => $value)
			{	
				
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtpre_add_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtpre_add_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }
			}
			
			/*------------------ Add/Edit Action of Previous Phone ----------------*/
			foreach($_POST['txtprevious_phone_seq'] as $key => $value)
			{	
					
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtpre_ph_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtpre_ph_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }
			}
			
			/*------------------ Add/Edit Action of Email ----------------*/
			foreach($_POST['txtemail_seq'] as $key => $value)
			{	
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtemail_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtemail_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }
			}
			
			/*------------------ Add/Edit Action of Voter Registration ----------------*/
			foreach($_POST['txtvoter_reg_seq'] as $key => $value)
			{	
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtvoter_reg_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtvoter_reg_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }
			}
			
			/*------------------ Add/Edit Action of Business ----------------*/
			foreach($_POST['txtbusiness_seq'] as $key => $value)
			{	
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtbusiness_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtbusiness_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }	
			}
			
			/*------------------ Add/Edit Action of Crminal Traffic ----------------*/
			foreach($_POST['txtcriminal_traffic_seq'] as $key => $value)
			{	
				$objSeq->id		= $cmn->setval(trim($cmn->read_value($_POST['txtcriminal_id'][$key],'')));	
				$objSeq->seq_no	= $value;
				$objSeq->table_id	= $key;
				$objSeq->table_name = $cmn->setval(trim($cmn->read_value($_POST['txtcriminal_table_name'],'')));
				if($cmn->is_record_exists('pi_sequence', 'table_id',$key, '  AND table_name =\''.$objSeq->table_name.'\'')){ $objSeq->update(); }else{ $objSeq->add(); }
			}
			
			//Code to add record.
			if ($strmode == 'add')
			{
				
				$msg->send_msg('mycase-list.php','Personal Information ',3);
			}
						
			//Code to edit record
			if ($strmode == 'edit')
			{
				
				//echo 'I am ehre';
				//exit;
				$msg->send_msg('mycase-list.php','Personal Information ',4);
			}
		}
	}
