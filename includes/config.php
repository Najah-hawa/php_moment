<?php 

//aktivera stöd för att inkuldera klassfiler automatisk
spl_autoload_register(function($class_name){
    include 'classes/' . $class_name . '.class.php';
});

//starta session 
session_start();

$devMode = false;  // utvecklar läge eller ej

if($devMode){
//aktivera felmeddelande 
error_reporting(-1);
ini_set("display_errors", 1);
//databas inställningar -lokalt

define("DBHOST", "localhost");
define("DBUSER", "buckelistdb");
define("DBPASS", "password");
define("DBDATABASE", "buckelistdb");
}else {
//databas inställningar -poplcering
define("DBHOST", "studentmysql.miun.se");
define("DBUSER", "naha2204");
define("DBPASS", "6337PJNrZr");
define("DBDATABASE", "naha2204");
}