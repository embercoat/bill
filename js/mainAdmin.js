function showPasswordBox(){
	$('#changeUserPassword').show();
}
$(document).ready(function(){
	$('.delete').click(function(handle){
		return confirm('Säkert att du vill ta bort saken?');
	});
});