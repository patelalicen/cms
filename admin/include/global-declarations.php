<?php
	define('PAGE_EXECUTE', true);
	
	define('ADMIN_PANEL_PAGE_TITLE', 'Case Management System :: Admin Panel');
	
	define('SITE_NAME', 'Case Management System');
	define('SITE_DESCRIPTION', 'Case Management System');
	define('SITE_KEYWORD', 'Case Management System');
	
	date_default_timezone_set ( "Asia/Colombo" );
	
	define('ADMIN_THEME'			,'themes/blue/');

	define('SESSION_ADMIN_PREFIX'	,"CMS_ADMIN_SESSION_");
	define('SESSION_CLIENT_PREFIX'	,"CMS_CLIENT_SESSION_");
	define('PAGE_STATE'				,SESSION_ADMIN_PREFIX . 'PAGE_STATE');
	define('REDIRECT_PAGE'			,'REDIRECT_PAGE_ADMIN');
	define('CLIENT_REDIRECT_PAGE'	,'REDIRECT_PAGE_CLIENT');
	
	define('ADMIN_USER_ID'			,"admin_userid");
	define('ADMIN_NAME'				,"admin_name");
	define('ADMIN_USER_NAME'		,"admin_username");
	define('ADMIN_USER_ROLE'		,"admin_user_role");
	
	define('CLIENT_USERID'			,"client_userid");
	define('CLIENT_USERNAME'		,"client_username");
	define('CLIENT_USER_TYPE'		,"client_user_type");

	define('PAGESIZE'				,50);
	define('REQUIRED'				,'<span class="red-text">*</span>');
	define('REQUIRED_SENTENCE'		,'<span class="red-text">*</span> = required fields.');
	
	define("SITE_CURRENCY_SYMBOL"	,"$");
	define('NO_OF_DECIMAL_POINT'	,2);
	
	define('DATE_FORMAT'			,'m/d/Y');
	define('DATE_FORMAT_PHP_2_MYSQL','Y-m-d h:i:s');
	define('DATE_FORMAT_NEWS'		,'jS M, Y');
	define('JQUERY_DATE_FORMAT'		,'mm/dd/yy');
	
	define('MYSQL_DATE_FORMAT'		,'%m-%d-%Y');
	define('MYSQL_WEEKDAY_FORMAT'	,'%W');
	define('MYSQL_FULL_DATE_FORMAT'	,'%a %D %M %Y %h:%i:%s %p');
	
	define('USER_UPLOAD_DIR'			, 'images/user/');
	define('USER_UPLOAD_DIR_ADMIN'		, '../images/user/');
	
	define('NO_IMAGE_DIR'			, 'images/no-images/');
	define('NO_IMAGE_AVAILABLE'		, NO_IMAGE_DIR.'no-image.gif');
	define('NO_IMAGE_AVAILABLE1'	, NO_IMAGE_DIR.'no-image-1.png'); //kit image
	define('NO_IMAGE_AVAILABLE2'	, NO_IMAGE_DIR.'no-image-2.png'); //big image
	define('NO_IMAGE_AVAILABLE3'	, NO_IMAGE_DIR.'no-image-3.png'); //product image
	
	define('NO_IMAGE_DIR_ADMIN'			, '../images/no-images/');
	define('NO_IMAGE_AVAILABLE_ADMIN'	, NO_IMAGE_DIR_ADMIN.'no-image.gif');
	define('NO_IMAGE_AVAILABLE1_ADMIN'	, NO_IMAGE_DIR_ADMIN.'no-image-1.png'); //kit image
	define('NO_IMAGE_AVAILABLE2_ADMIN'	, NO_IMAGE_DIR_ADMIN.'no-image-2.png'); //big image
	define('NO_IMAGE_AVAILABLE3_ADMIN'	, NO_IMAGE_DIR_ADMIN.'no-image-3.png'); //product image
	
	define('COOKIE_NAME'		, 'siteAuth');
	define('COOKIE_TIME'		, (3600 * 24 * 30));
	
	$isDatePicker	= false;
	$isValidation	= false;
	$isFancyBox		= false;
	$isTabs			= false;
	$isAccordion	= false;
	$isGeneralTabs	= false;