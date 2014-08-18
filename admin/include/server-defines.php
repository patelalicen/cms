<?php
	define('SITE_MODE', 'LOCAL'); //LOCAL, STAGGING, LIVE
	
	$LIVE_SERVER_SETTINGS = array (
								'DATABASE_HOST' => ''
								, 'DATABASE_USER' => ''
								, 'DATABASE_PASSWORD' => ''
								, 'DATABASE_NAME' => ''
								, 'MAILER' => 'SMTP' //SIMPLE, SMTP, SENDMAIL
								, 'SMTP_SERVER' => '' //MAIL SERVER ADDRESS
								, 'SMTP_PORT' => '25' //MAIL SERVER PORT
								, 'SMTP_AUHTENTICAION' => '0' //WHETHER MAIL SERVER REQUIRE AUTHENTICATION?
								, 'SMTP_USER_NAME' => '' //IF AUTHENTICATION IS REQUIRED, SPECIFY ITS USERNAME
								, 'SMTP_USER_PASSWORD' => '' //IF AUTHENTICATION IS REQUIRED, SPECIFY ITS PASSWORD
							);
	
	
	$STAGGING_SERVER_SETTINGS = array (
                                    'DATABASE_HOST' => '76.74.158.144'
                                    , 'DATABASE_USER' => 'A<project #>'
                                    , 'DATABASE_PASSWORD' => '<password here>'
                                    , 'DATABASE_NAME' => 'a<project #>'
                                    , 'MAILER' => 'SMTP' //SIMPLE, SMTP, SENDMAIL
                                    , 'SMTP_SERVER' => '192.168.52.2' //MAIL SERVER ADDRESS
                                    , 'SMTP_PORT' => '25' //MAIL SERVER PORT
                                    , 'SMTP_AUHTENTICAION' => '0' //WHETHER MAIL SERVER REQUIRE AUTHENTICATION?
                                    , 'SMTP_USER_NAME' => '' //IF AUTHENTICATION IS REQUIRED, SPECIFY ITS USERNAME
                                    , 'SMTP_USER_PASSWORD' => '' //IF AUTHENTICATION IS REQUIRED, SPECIFY ITS PASSWORD
                            );
													
	$LOCAL_SERVER_SETTINGS = array (
                                    'DATABASE_HOST' => 'localhost'
                                    , 'DATABASE_USER' => 'root'
                                    , 'DATABASE_PASSWORD' => ''
                                    , 'DATABASE_NAME' => 'cms'
                                    , 'MAILER' => 'SIMPLE' //SIMPLE, SMTP, SENDMAIL
                                    , 'SMTP_SERVER' => '' //MAIL SERVER ADDRESS
                                    , 'SMTP_PORT' => '25' //MAIL SERVER PORT
                                    , 'SMTP_AUHTENTICAION' => '0' //WHETHER MAIL SERVER REQUIRE AUTHENTICATION?
                                    , 'SMTP_USER_NAME' => '' //IF AUTHENTICATION IS REQUIRED, SPECIFY ITS USERNAME
                                    , 'SMTP_USER_PASSWORD' => '' //IF AUTHENTICATION IS REQUIRED, SPECIFY ITS PASSWORD
                            );
							
	$server_settings_array = array();
	
	switch ( SITE_MODE ) {
			case 'LIVE':
				$server_settings_array = $LIVE_SERVER_SETTINGS;
				break;
			case 'STAGGING':
				$server_settings_array = $STAGGING_SERVER_SETTINGS;
				break;
			case 'LOCAL':
				$server_settings_array = $LOCAL_SERVER_SETTINGS;
				break;
	}

	if (is_array($server_settings_array) && count($server_settings_array)) {
		foreach ($server_settings_array as $constant_name => $constant_value) {
			define($constant_name, $constant_value);
		}
	}
	
	define("DB_PREFIX","cms_");
	define('ADMIN_PANEL_PATH', 'admin/');
	define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/cms/');
	define('SITE_URL_HTTPS', 'http://'.$_SERVER['HTTP_HOST'].'/cms/');