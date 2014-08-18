<div id="header-sub">
	<h1>401</h1>
	<p class="register">Authentication Failed</p>
</div>
<div id="middle-sub">
	<p>The URL you've requested,    <b><?php echo $_SERVER['HTTP_REFERER']; ?></b>
	requires a correct username and password. Either you entered 
	an incorrect username/password, or your browser doesn't support 
	this feature.<p>

	Please inform the administrator of the referring page, 
	<b><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php echo $_SERVER['HTTP_REFERER']; ?></a></b> if you think this was a mistake.
</div>