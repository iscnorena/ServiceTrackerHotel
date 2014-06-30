<?php
require_once("dompdf_config.inc.php");

$dompdf = new DOMPDF();

$html = '<html><body>'. 
        '<h1>Generar un PDF con PHP</h1>'.
        '<p>Desde un documentoHTML.</p>'.
        '</body></html>'; 

$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream("resultado.pdf");
?>
