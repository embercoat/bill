function updatePDF(cid){
	$('#progress').show();
	rpc = new XmlRpc('/xmlrpc');
	rpc.call('rpc.genCompanyPDF', cid);
	$('#progress').hide();
}