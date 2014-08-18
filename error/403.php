<div id="header-sub">
	<h1>403</h1>
	<p class="register">Permission Denied</p>
</div>
<div id="middle-sub"><p>You do not have permission to retrieve the URL or link you requested, 
&nbsp;&nbsp; <b><?php echo $_SERVER['HTTP_REFERER']; ?></b><p>

Please inform the administrator of the referring page, <b>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php echo $_SERVER['HTTP_REFERER']; ?></a>
</b> if you think this was a mistake.</p></div>