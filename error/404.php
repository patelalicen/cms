<div id="header-sub">
	<h1>404</h1>
	<p class="register">Not Found</p>
</div>
<div id="middle-sub"><p>The requested object or URL, &nbsp; <b><?php echo $_SERVER['HTTP_REFERER']; ?></b>   
was not found on this server.<P>

The link you followed is either outdated, inaccurate, or the server has been
instructed not to let you have it.<P>

Please inform the administrator of the referring page, 
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php echo $_SERVER['HTTP_REFERER']; ?></a>.</p></div>