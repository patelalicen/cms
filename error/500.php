<div id="header-sub">
	<h1>500</h1>
	<p class="register">Malformed Header</p>
</div>
<div id="middle-sub"><p>The server encountered an internal error or misconfiguration and was unable
to complete your request.<p>

Please contact the administrator, of 
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php echo $_SERVER['HTTP_REFERER']; ?></a>, 
and inform them of the time the error occurred, and anything you might have 
done that may have caused the error.
<p>

Error: HTTPd: malformed header from script
<b><?php echo $_SERVER['HTTP_REFERER']; ?></b>  
</p></div>