<?php

$xml_string  = '<?xml version="1.0" encoding="UTF-8"?>';
$xml_string .= '<DocSetNodes version="1.0">';
$xml_string .= '<TOC>';
$xml_string .= '<Node type="folder">';

$xml_string .= '<Name>';
$xml_string .= $config['docset_title'];
$xml_string .= '</Name>';

$xml_string .= '<Path>';
$xml_string .= 'docs/'.$config['docset_index_page'];
$xml_string .= '</Path>';

$xml_string .= '</Node>';
$xml_string .= '</TOC>';
$xml_string .= '</DocSetNodes>';

$xml_string = formatXmlString($xml_string);

//Write to Nodes.xml file
$file_path = 'output/'.$config['docset_filename'].'/Contents/Resources/Nodes.xml';
file_put_contents($file_path, $xml_string);