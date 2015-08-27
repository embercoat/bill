function editRoom(id){
	$('#editBox').show();
	document.getElementById('newname').value = $('#room_'+id).html();
	document.getElementById('room_id').value = id; 
}
function addRoom(){
	$('#editBox').show();
	document.getElementById('room_id').value = 'new'; 
}
function hideEditBox(){
	$('#editBox').hide();
}
function editPeriod(id){
	$('#editBox').show();
	document.getElementById('newstart').value = $('#start_'+id).html();
	document.getElementById('newend').value = $('#end_'+id).html();
	document.getElementById('period_id').value = id; 
}
function addPeriod(){
	$('#editBox').show();
	document.getElementById('period_id').value = 'new'; 
}
function editInterview(user, company, room, period){
	$('#editBox').show();
	document.getElementById('user_id').value = user;
	document.getElementById('company_id').value = company;
	document.getElementById('newroom').value = room;
	document.getElementById('newperiod').value = period;
}