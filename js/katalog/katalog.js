function exportKat(){
	if(catalogue.myCatalogue.indexOf('286') >= 0){
		alert('På grund av tekniska problem kan vi inte exportera norrbottensrummet.');
	}
	document.location = '/katalog/export/katalog';
}