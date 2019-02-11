<?php
namespace Cubo;

// These define defaults
Configuration::set('_Default',[
	'route'=>'',
	'controller'=>'article',
	'method'=>'view',
	'article'=>'home'
]);

// These define allowed routes
//   Apart from a default (empty) route, you can have an admin route, an api route, etc.
//   Note that this can also be used for languages
Configuration::set('_Route',[
	''=>['path'=>''],
	'admin'=>['path'=>'admin','default-method'=>'all','default-format'=>'admin'],
	'api'=>['path'=>'api','default-method'=>'all','default-format'=>'json'],
	'en'=>['path'=>'en'],
	'en'=>['path'=>'es'],
	'nl'=>['path'=>'nl']
]);

// These define the database connection properties
Configuration::set('database',[
	'dsn'=>"mysql:host=localhost;dbname=cubo_cubo",
	'user'=>"cubo_cubo",
	'password'=>"cL>7_C2.E`3;r(_G#8v34U*"
]);
?>