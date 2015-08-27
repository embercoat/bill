<?php
include 'PDFMerger.php';

$pdf = new PDFMerger;

$files = scandir('pdf/katalog');
foreach($files as $f){
    if(substr($f, -3) == 'pdf'){
        $pdf->addPDF('pdf/katalog/'.$f);
    }
}

//~ $pdf->addPDF('samplepdfs/bae.pdf', '2')
	//~ ->addPDF('samplepdfs/centigo.pdf', '2')
	//~ ->addPDF('samplepdfs/deloitte.pdf', '2')
	//~ ->merge('file', 'samplepdfs/TEST2.pdf');
    $pdf->merge('browser', 'samplepdfs/katalog.pdf');
	
	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
