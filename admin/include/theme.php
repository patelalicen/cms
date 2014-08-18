<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_THEME; ?>css/style.css" />
<script src="js/jquery-1.10.2.js"></script>
<script src="js/ui/ui/jquery.ui.core.js"></script>
<script src="js/ui/ui/jquery.ui.widget.js"></script>
<link rel="stylesheet" href="js/ui/themes/blue/jquery.ui.all.css">

<script>
	$(function() {
		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});
</script>
<style>
	#icons {
		margin: 0;
		padding: 0;
		width: 60px;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
</style>
<?php if($isDatePicker) { ?>
<!--<link rel="stylesheet" href="js/date-picker/css/jquery-ui-1.8.20.custom.css">
<script src="js/date-picker/js/jquery.ui.core.js"></script>
<script src="js/date-picker/js/jquery.ui.widget.js"></script>
<script src="js/date-picker/js/jquery.ui.datepicker.js"></script>-->
<script src="js/ui/ui/jquery.ui.datepicker.js"></script>

<script>
$(function() {
	$( ".date-picker, #txtdoi,#txtreport_date" ).datepicker({
		dateFormat: '<?php echo JQUERY_DATE_FORMAT; ?>'
	});
});
</script>
<?php } ?>

<?php if($isValidation) { ?>
	<script language="javascript" type="text/javascript" src="js/validation.js"></script>
<?php } ?>

<?php if($isFancyBox) { ?>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    
    <script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
<?php } ?>

<?php if($isAccordion) { ?>
	<script src="js/ui/ui/jquery.ui.accordion.js"></script>

	<script>
		$(function() {
			$( ".accordion" ).accordion();
		});
	</script>
<?php } ?>

<?php if($isTabs) { ?>
	<script src="js/ui/ui/jquery.ui.tabs.js"></script>
    <link rel="stylesheet" href="js/ui/themes/blue/jquery.ui.tabs.css">
    <script>
		$(function() {
			$( "#tabs" ).tabs({
				//activate: function( event, ui ) {},
				//select: function( event, ui ) {alert(123);$( ".accordion" ).accordion();alert(456);}
			});
		});
	</script>
<?php } ?>

<?php if($isGeneralTabs) { ?>
	<script src="js/form-tab/jquery.tabSlideOut.v1.3.js"></script>
    <link rel="stylesheet" href="js/form-tab/style.css">
    <script>
		$(function(){
			$('#slide-out-div_0').tabSlideOut({
				tabHandle: '#handle_0',                     //class of the element that will become your tab
				imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
				imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
				tabLocation: 'right',                      //side of screen where tab lives, top, right, bottom, or left
				speed: 300,                               //speed of animation
				action: 'click',                          //options: 'click' or 'hover', action to trigger animation
				topPos: '125px',                          //position from the top/ use if tabLocation is left or right
				leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
				fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
			});
		});
	</script>
<?php } ?>

<script language="javascript" type="text/javascript" src="js/common.js"></script>
<script language="javascript" type="text/javascript" src="js/cms.js"></script>