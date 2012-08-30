<?php

//Create array holding all file names
$files = scandir('files_go_here');
unset($files[0]);
unset($files[1]);
$files = array_values($files);

//Array to hold arbitarty token object with:
//prettyname
//filename
$token_array = array();

foreach ($files as $filename) {
	//Take name apart without file ending
	$filname_raw = pathinfo($filename, PATHINFO_FILENAME);
	$filename_parts = explode('-', $filname_raw);
	
	//Capitalize filenmae parts and construct name
	$filename_pretty = NULL;
	$itr_count = 0;
	foreach ($filename_parts as $filename_part) {
		$filename_part = ucfirst($filename_part);
		$space = ($itr_count == 0) ? '' : ' ';
		$filename_pretty .= $space.$filename_part;
	
		$itr_count++;
	}
	
	$token = new stdClass;
	$token->prettyname = $filename_pretty;
	$token->filename = $filename;
	
	$token_array[] = $token;
}

//Create single token xml string and add it to an array
$token_xml_string_array = array();
foreach ($token_array as $token) {
	
	$string  = '<File path="docs/'.$token->filename.'">';
	
	$string .= '<Token><TokenIdentifier>';
	$string .= '//apple_ref/cpp/cl/'.$token->prettyname;
	$string .= '</TokenIdentifier></Token>';
	
	$string .= '</File>';
	
	$token_xml_string_array[] = $string;
}

//Contruct full xml string
$xml_string  = '<?xml version="1.0" encoding="UTF-8"?>';
$xml_string .= '<Tokens version="1.0">';

//Insert all tokens
foreach ($token_xml_string_array as $token_string) {
	$xml_string .= $token_string;
}

$xml_string .= '</Tokens>';

$xml_string = formatXmlString($xml_string);

//Write to Tokens.xml file
$file_path = 'output/'.$config['docset_filename'].'/Contents/Resources/Tokens.xml';
file_put_contents($file_path, $xml_string);