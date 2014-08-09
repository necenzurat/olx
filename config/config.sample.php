<?php

$dbname			= "";
$dbuser			= "";
$dbpass			= "";


/* meh */
$dbhost			= "";


if (!$dbname){
	R::setup('sqlite:database.sqlite', 'user','password'); //sqlite fallback	
} else {
	R::setup('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass); 
}

