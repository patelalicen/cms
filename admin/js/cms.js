function assingCases(url)
{
	var mycount = 0;
	var iDs	= '';
	
	for(i=0;i<document.frm.elements.length;i++)
	{
		if(document.frm.elements[i].name=="deletedids[]" && document.frm.elements[i].checked)
		{
			if(iDs == '')
			{
				iDs	= document.frm.elements[i].value;
			}
			else
			{
				iDs	= iDs+','+document.frm.elements[i].value;
			}
			
			mycount++;	
		}
	}

	if(mycount==0)
	{
		alert("You must check atleast one checkbox.");
		return false;
	}
	
	url	= url+'?cases='+iDs+'&mode=assing';
	
	$(".fancybox").trigger('click');
	
	$.ajax({
		type		: "POST",
		cache	: false,
		url		: url,
		success: function(data) {
			$.fancybox(data);
		}
	});
}