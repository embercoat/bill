var current_company = 0;

$(document).ready(function() {
    $("#progressbar").progressbar({ value: 0 });
});
function doIt(){
	$("#progress").show();
	rpc = new XmlRpc('/xmlrpc');
    companies = rpc.call('rpc.getCompanies', 1,3);
	$("#companies").html(companies.length);
	scale = 100 / companies.length;
	
	for(i=0;i<companies.length;i++){
		$('#current').html((i+1)+' '+companies[i]['name']);
		rpc.call('rpc.genCompanyPDF', companies[i]['company_id']);
		$("#progressbar").progressbar({ value: (i+1)*scale });
	}
	$('#current').html('Klar!');
}