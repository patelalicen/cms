<?php 
	require_once 'include/general-includes.php';
	require_once ADMIN_PANEL_PATH . 'class/cms.class.php';

	$objcms = new cms();
	
	$condition	= ($_REQUEST['cms_seo_url'] != '') ? " AND `seo_url` = '".$_REQUEST['cms_seo_url']."'" : " AND `seo_url` = 'home'";
	$arcms = $objcms->fetchallasarray(null,null,$condition);
?>
<?php include 'include/header.php'; ?>
<?php
	//var_dump((($_REQUEST['cms_seo_url'] == '' or $_REQUEST['cms_seo_url'] == 'home') and $_REQUEST['file'] == 'cms'));
	if(!(($_REQUEST['cms_seo_url'] == '' or $_REQUEST['cms_seo_url'] == 'home')))
	{
		if($_REQUEST['file'] != '' and file_exists($_REQUEST['file'].'.php'))
		{
			if($_REQUEST['file'] == 'cms' and count($arcms) <= 0)
			{
				include 'error/404.php';
			}
			else
			{
				include $_REQUEST['file'].'.php';
			}
		}
		else
		{
			include 'error/404.php';
		}
	}
?>
<?php include 'include/footer.php'; ?>