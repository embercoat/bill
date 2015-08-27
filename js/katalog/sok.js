$(document).ready(function(){
	$('#selectAllBox').click(function(element){
		
		switch($('#selectAllBox').attr('checked')){
			case 'checked':{
				
				$('input[name="foretag[]"][type=checkbox]').each(function(index, element){
					catalogue.add(element.value);
					$(element).attr('checked', 'checked');
				});
				break;
			}
			case undefined:{
				$('input[name="foretag[]"][type=checkbox]').each(function(index, element){
					catalogue.remove(element.value);
					$(element).removeAttr('checked');
				});
				break;
			}
		}
	});
});