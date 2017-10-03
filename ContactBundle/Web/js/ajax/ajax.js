
function JQueryAjax(div,lien,form,displayLoadStatusText) {

	//FORM
	if (form != "")
	{
		var type = "POST";
		var data = $("form[name='"+form+"']").serialize();
		//var data = $("#"+form).serialize();
		var file_present = false;
		//Champ file present?
		$("form[name='"+form+"'] :file").each( function() { file_present = true; } );
	}
	//GET
	else
	{
		var type = "GET";
		var data = "";
	}
	
	if (type == "POST" && file_present) {
	
		var nom_iframe = form+'_postiframe';
	
	} else {
	
		if (displayLoadStatusText && div) $("#"+div).html('<div class="validation-temp">'+LoadStatusText+'</div>');
		
		currentAjaxRequest = $.ajax({
			type: type,
			url: lien,
			data: data,
			success: function(msg){
				if (div) {
					$("#"+div).html(msg);
				} else {
					return msg;
				}
			}
		});
	
	}

}