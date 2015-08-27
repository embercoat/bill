ps = {
	myPs : new Array(),
	option : function(){
		option = new Object();
		option.path = '/';
		return option;
	},
	add: function(id){
		found = false;
		var i;
		for(i=0;i<this.myPs.length;i++){
			if(this.myPs[i] == id){
				found = true;
			}
		}
		if(!found){
			this.myPs.push(id);
			$.post('/katalog/json/getCompany', 'cid='+id, function(data, ts, jqXHR){
				data = $.JSON.decode(data);
				
				var newRow = $('<tr class=/>').attr('id', 'minPs_' + id);
				newRow.html(
						'<td class="f"><p><a href="/katalog/foretag/'+id+'">' + data['data'] + '</a></p></td>'
					   +'<td class="x">'
					   +'	<a onclick="ps.remove('+id+');"><img src="/images/katalog/minus-circle.png" title="Ta bort från mina Personliga Samtal" alt="remove" /></a>'
					   +'</td>');
				$('#minPs').append(newRow);
				
			});
		}
		this.save();
	},
	remove : function(id){
		newPs = new Array();
		var i;
		for(i=0;i<this.myPs.length;i++){
			if(this.myPs[i] != id){
				newPs.push(this.myPs[i]);
			}
		}
		$('#minPs_'+id).remove();
		this.myPs = newPs;
		this.save();
	},
	save : function(){
		$.cookie.set('interview', $.JSON.encode(this.myPs), this.option());
	},
	init : function(){
		arr = new Array();
		$.cookie.set('interview', $.JSON.encode(arr), this.option());
	},
	load : function(){
		cookiePs = $.JSON.decode($.cookie.get('interview'));
		var i;
		for(i=0;i<cookiePs.length;i++){
			this.add(cookiePs[i]);
		}
	}
};
$(document).ready(function(){
	if($.cookie.get('interview') == '' || $.cookie.get('interview') == null || $.cookie.get('interview') == "undefined") {
		ps.init();
	} else {
		ps.load();
	}
});
