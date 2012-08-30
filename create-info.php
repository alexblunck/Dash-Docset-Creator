<?php

$xml_string  = '<?xml version="1.0" encoding="UTF-8"?>';
$xml_string .= '<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">';
$xml_string .= '<plist version="1.0">';

$xml_string .= '<dict>';

$xml_string .= '<key>CFBundleIdentifier</key>';
$xml_string .= '<string>';
$xml_string .= strtolower($config['docset_prettyname']);
$xml_string .= '</string>';

$xml_string .= '<key>CFBundleName</key>';
$xml_string .= '<string>';
$xml_string .= ucfirst($config['docset_prettyname']);
$xml_string .= '</string>';

$xml_string .= '<key>DocSetPlatformFamily</key>';
$xml_string .= '<string>';
$xml_string .= strtolower($config['docset_prettyname']);
$xml_string .= '</string>';

$xml_string .= '<key>dashIndexFilePath</key>';
$xml_string .= '<string>';
$xml_string .= 'docs/'.$config['docset_index_page'];
$xml_string .= '</string>';

$xml_string .= '</dict>';
$xml_string .= '</plist>';

$xml_string = formatXmlString($xml_string);

//Write DOCSET_NAME.docset/Info.plist
$file_path = 'output/'.$config['docset_filename'].'/Contents/Info.plist';
file_put_contents($file_path, $xml_string);