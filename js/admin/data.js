function editSkill(id){
	document.getElementById('newname').value = $('#skill_'+id).html();
	document.getElementById('oldname').value = $('#program_'+id).html();
	document.getElementById('desc').value = $('#desc_'+id).html();
	document.getElementById('oldurl').value = $('#url_'+id).html();
	
	document.getElementById('skill_id').value = id;
	$('#editBox').show();
	document.getElementById('newname').focus();
	
}
function editCity(id){
	$('#editBox').show();
	document.getElementById('newname').value = $('#city_'+id).html();
	document.getElementById('city_id').value = id; 
}
function addCity(){
	$('#editBox').show();
	document.getElementById('city_id').value = 'new'; 
}
function editCountry(id){
	$('#editBox').show();
	document.getElementById('newname').value = $('#country_'+id).html();
	document.getElementById('country_id').value = id; 
}
function editBranch(id){
	$('#editBox').show();
	document.getElementById('newname').value = $('#branch_'+id).html();
	document.getElementById('branch_id').value = id; 
}
function addBranch(){
	$('#editBox').show();
	document.getElementById('branch_id').value = 'new'; 
}
function addCountry(){
	$('#editBox').show();
	document.getElementById('country_id').value = 'new'; 
}
function addSkill(){
	$('#editBox').show();
	document.getElementById('skill_id').value = 'new'; 
	document.getElementById('newname').focus();

}
function hideEditBox(){
	$('#editBox').hide();
}
function editSidemenu(id){
	$('#editBox').show();
	document.getElementById('oldid').value = ((id != undefined)?id:'');
	document.getElementById('id').value = (id?id:'');
	document.getElementById('controller').value = (id?$('#controller_'+id).html():'');
	document.getElementById('action').value = (id?$('#action_'+id).html():'');
	document.getElementById('text').value = (id?$('#text_'+id).html():'');
	id?($('#visible_'+id).html() == 'Ja' ? document.getElementById('visible').checked = true : document.getElementById('visible').checked = false):'';
}

jQuery(document).bind('keydown', 'Ctrl+a',function (evt){ addSkill() });
