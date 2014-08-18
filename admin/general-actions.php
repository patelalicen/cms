<?php
	require_once 'include/ajax-includes.php';
	
	$mode	= isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
	
	if($mode == 'deleteAlias')
	{
		require_once 'class/alias.class.php';
		
		//create object of main entity...
		$obj = new alias();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0)
		{
			$obj->checkedids = $_REQUEST['id'];
			$obj->delete();
		}
	}
	
	
	
	if($mode == 'deletePreviousAddresses')
	{
		require_once 'class/previous_addresses.class.php';
		
		//create object of main entity...
		$obj = new previous_addresses();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0)
		{
			$obj->checkedids = $_REQUEST['id'];
			$obj->delete();
		}
	}
	
	if($mode == 'deletePreviousPhoneNumbers')
	{
		require_once 'class/previous_phone_numbers.class.php';
		
		//create object of main entity...
		$obj = new previous_phone_numbers();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0)
		{
			$obj->checkedids = $_REQUEST['id'];
			$obj->delete();
		}
	}
	
	
	if($mode == 'deleteEmail')
	{
		require_once 'class/email_addresses.class.php';
		
		//create object of main entity...
		$obj = new email_addresses();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0)
		{
			$obj->checkedids = $_REQUEST['id'];
			$obj->delete();
		}
	}
	
	
	if($mode == 'deleteBusiness')
	{
		require_once 'class/business.class.php';
		
		//create object of main entity...
		$obj = new business();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0)
		{
			$obj->checkedids = $_REQUEST['id'];
			$obj->delete();
		}
	}
	
		if($mode == 'deleteRecord')
	{
		require_once 'class/criminal_traffic.class.php';
		
		//create object of main entity...
		$obj = new criminal_traffic();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0)
		{
			$obj->checkedids = $_REQUEST['id'];
			$obj->delete();
		}
	}

	
?>