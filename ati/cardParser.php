<?php
error_reporting(E_ALL);
require_once ('simple_html_dom.php');

$html = file_get_html('261664.html');
$firmName= $html->find('#lblName');

var_dump($firmName->outertext);