<?php
include ("includes/config.php");

//anslut
$db= new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if($db->connect_errno > 0  ){
    diw("Fel vid anslutning:" . $db->connect_errno);
}

//sql-frågot 
$sql = "DROP TABLE IF EXISTS buckelist;";    // ta bort tabellen om den redan finns 
$sql .= "
CREATE TABLE buckelist(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(128) NOT NULL, 
beskrivning TEXT NOT NULL,
prioritet INT(11),
created timestamp NOT NULL DEFAULT current_timestamp()

);
";
echo "<pre>$sql</pre>";

//skicka sql fråga till server 
if($db->multi_query($sql)){
    echo "Tabell installerad!";
} else {
    echo "Fel vid ansltning av tabell...";
}