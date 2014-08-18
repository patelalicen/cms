<?php
	require_once 'class/tabs.class.php';
	$objTabs = new tabs();

	$condition = ' AND `case_id` = '.$objCase->id.' ';
	
	$allTabs	= $objTabs->fetchallasarray(null, null, $condition);
?>
<div class="slide-out-div" id="slide-out-div_0">
	<a class="handle" id="handle_0" href="#">Create New Note</a>
	<form name="gt_frm" id="gt_frm" method="post" onsubmit="javascript:return false;" action="tabs-ajax-db.php" enctype="multipart/form-data">
		<input type="hidden" name="id" value="0" />
		<input type="hidden" name="case_id" value="<?php echo $objCase->id; ?>" />
		<table>
			<tr>
				<td>Heading:</td>
			</tr>
			<tr>
				<td><input type="text" name="gt_title" id="gt_title" value="" class="textbox" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Note:</td>
			</tr>
			<tr>
				<td><textarea col="30" rows="10" name="gt_notes" id="gt_notes" class="textbox"></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" class="button saveme-ajax" value="Save"></td>
			</tr>
		</table>
	</form>
</div>
<?php
	$i=1;
	foreach($allTabs as $key => $val)
	{
	?>
	<div class="slide-out-div" id="slide-out-div_<?php echo $val['id']; ?>">
		<a class="handle" id="handle_<?php echo $val['id']; ?>" href="#">Edit "<i><?php echo $val['heading']; ?></i>"</a>
		<form name="gt_frm" id="gt_frm" method="post" onsubmit="javascript:return false;" action="tabs-ajax-db.php" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $val['id']; ?>" />
			<input type="hidden" name="case_id" value="<?php echo $objCase->id; ?>" />
			<table>
				<tr>
					<td>Heading:</td>
				</tr>
				<tr>
					<td><input type="text" name="gt_title" id="gt_title" value="<?php echo $val['heading']; ?>" class="textbox" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Note:</td>
				</tr>
				<tr>
					<td><textarea col="30" rows="10" name="gt_notes" id="gt_notes" class="textbox"><?php echo $val['note']; ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" class="button saveme-ajax" value="Save"></td>
				</tr>
			</table>
		</form>
	</div>
	<?php
		$topPoss	= round(125+($i*75));
	?>
	<script>
		$(function(){
			$('#slide-out-div_<?php echo $val['id']; ?>').tabSlideOut({
				tabHandle: '#handle_<?php echo $val['id']; ?>',                     //class of the element that will become your tab
				imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
				imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
				tabLocation: 'right',                      //side of screen where tab lives, top, right, bottom, or left
				speed: 300,                               //speed of animation
				action: 'click',                          //options: 'click' or 'hover', action to trigger animation
				topPos: '<?php echo $topPoss; ?>px',                          //position from the top/ use if tabLocation is left or right
				leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
				fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
			});
		});
	</script>
	<?php
		/* echo '<pre>';
		print_r($val);
		echo '</pre>'; */
		$i++;
	}
?>