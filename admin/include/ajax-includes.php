<?php
	//please don't beake sequence of includes and declaration.
	require_once 'include/server-defines.php';
	require_once 'include/global-declarations.php';
	require_once 'include/connect.php';
	require_once 'class/common.class.php';
	require_once 'class/message.class.php';
	require_once 'class/clsvalidation.php';
	require_once 'class/clssite-config.php';
	$GLOBALS["scope"] = 'admin';
	$cmn = new common();
	$msg = new message();
	$objsite_config = new site_config();