<?php

include('functions.php');
include('docset.config.php');

//Create DOCSET_NAME.docset  & other need Directories
//mkdir($config['docset_filename']);
mkdir('output/'.$config['docset_filename']);
mkdir('output/'.$config['docset_filename'].'/Contents');
mkdir('output/'.$config['docset_filename'].'/Contents/Resources');
mkdir('output/'.$config['docset_filename'].'/Contents/Resources/Documents');
mkdir('output/'.$config['docset_filename'].'/Contents/Resources/Documents/docs');

//Create Info.plist
include('create-info.php');

//Create Tokens.xml
include('create-tokens.php');

//Create Nodes.xml
include('create-nodes.php');

//Copy Icon file to docset root
copy('icon_goes_in_here/icon.png', 'output/'.$config['docset_filename'].'/icon.png');

//Copy all files from "files" dir to "docs" dir
foreach($files as $filename) {
	copy('files_go_here/'.$filename, 'output/'.$config['docset_filename'].'/Contents/Resources/Documents/docs/'.$filename);
}

//Create Indexes with XCodes docseutil script
///Applications/Xcode.app/Contents/Developer/usr/bin/docsetutil index laravel.docset
$command = $config['docset_docseutil_path'].' index '.'output/'.$config['docset_filename'];
if (shell_exec($command)) {
	echo 'Docset Created Successfully !';
} else {
	echo 'docseutil Error!';
}

