catalogue = {
	myCatalogue : new Array(),
	option : function(){
		option = new Object();
		option.path = '/';
		return option;
	},
	add: function(id){
		found = false;
		var i;
		for(i=0;i<this.myCatalogue.length;i++){
			if(this.myCatalogue[i] == id){
				found = true;
			}
		}
		if(!found){
			this.myCatalogue.push(id);
			$.post('/katalog/json/getCompany', 'cid='+id, function(data, ts, jqXHR){
				data = $.JSON.decode(data);
				
				var newRow = $('<tr class=/>').attr('id', 'minKat_' + id);
				newRow.html(
						'<td class="f"><p><a href="/katalog/foretag/'+id+'">' + data['data'] + '</a></p></td>'
					   +'<td class="x">'
					   +'	<a onclick="catalogue.remove('+id+');"><img src="/images/katalog/minus-circle.png" title="Ta bort från min katalog" alt="remove" /></a>'
					   +'</td>');
				$('#minKat').append(newRow);
			});
		}
		this.save();
	},
	remove : function(id){
		newCat = new Array();
		var i;
		for(i=0;i<this.myCatalogue.length;i++){
			if(this.myCatalogue[i] != id){
				newCat.push(this.myCatalogue[i]);
			}
		}
		$('#minKat_'+id).remove();
		$('[name="foretag[]"][value="'+id+'"]').removeAttr('checked');
		this.myCatalogue = newCat;
		this.save();
	},
	save : function(){
		$.cookie.set('catalogue', $.JSON.encode(this.myCatalogue), this.option());
	},
	init : function(){
		cat = new Array();
		$.cookie.set('catalogue', cat, this.option());
	},
	load : function(){
		cookieCat = $.JSON.decode($.cookie.get('catalogue'))
		var i;
		for(i=0;i<cookieCat.length;i++){
			this.add(cookieCat[i]);
		}
	}
};
$(document).ready(function(){
	if($.cookie.get('catalogue') == '' || $.cookie.get('catalogue') == null || $.cookie.get('catalogue') == "undefined") {
		catalogue.init();
	} else {
		catalogue.load();
	}
	
	$('[name="foretag[]"]').change(function(o){
		switch(o.target.checked) {
			case true:{
				catalogue.add(o.target.value);
				break;
			}
			case false:{
				catalogue.remove(o.target.value);
				break;
			}
		}
	});
});
