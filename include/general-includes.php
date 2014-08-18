<?php
	require_once 'admin/include/server-defines.php';
	require_once ADMIN_PANEL_PATH . 'include/global-declarations.php';
	require_once ADMIN_PANEL_PATH . 'include/connect.php';
	require_once ADMIN_PANEL_PATH . 'class/common.class.php';
	require_once ADMIN_PANEL_PATH . 'class/message.class.php';
	require_once ADMIN_PANEL_PATH . 'class/clssite-config.php';
	
	$GLOBALS['scope']	= 'front';
	$site_config_id		= 1;
	
	$cmn				= new common();
	$msg				= new message();
	$objsite_config		= new site_config();
	
	$objsite_config->setallvalues($site_config_id);
	$current_page = strtolower(trim(basename($_SERVER['PHP_SELF'])));