Compress css,js,php
======

##Howto

Download: https://github.com/yui/yuicompressor/downloads
Install java or portable java

Run

	java.exe -jar yuicompressor.jar example.js  -o out.js
	
	
or by php

	$out = file_get_contents('example.js');
	$out .= file_get_contents('another');