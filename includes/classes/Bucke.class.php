<?php
class Bucke{
//properties
private $db;
private $name;
private $beskrivning;
private $prioritet;

//construktor with db-connection 
function __construct(){
    $this->db= new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
    if($this->db->connect_errno >0){
        die("error connecting:" . $this->db->connect_errno);
    }
}
//lägg bucke
public function addBucke(string $name, string $beskrivning, int $prioritet ): bool{
//check with set methods 
if(!$this->setName($name)) return false;
if(!$this->setBeskrivning($beskrivning)) return false;
if(!$this->setPrioritet($prioritet)) return false;
//sql query 
$sql = "INSERT INTO buckelist (name, beskrivning, prioritet) VAlUES ('" . $this->name ."','" . $this->beskrivning ."' ,'" . $this->prioritet ."' ); ";
//send query 
return mysqli_query($this->db, $sql);
}


// get buckelist 
public function getBuckelist() :array {
    //sql query 
    $sql = "SELECT * FROM buckelist; ";
    $result = mysqli_query($this->db, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


//update bucke

public function updateBucke(int $id,  string $name, string $beskrivning, int $prioritet ) :bool {
//check with set methods 
if(!$this->setName($name)) return false;
if(!$this->setBeskrivning($beskrivning)) return false;
if(!$this->setPrioritet($prioritet)) return false;
//sql query 
$sql = "UPDATE buckelist SET name = '" . $this->name ."', beskrivning =  '" . $this->beskrivning ."' , prioritet =  '" . $this->prioritet ."'  WHERE id = $id; ";
//send query 
return mysqli_query($this->db, $sql);
}


//delet bucke  

public function deleteBucke(int $id): bool {

    $id= intval($id);
    //sql query 
    $sql = "DELETE FROM buckelist WHERE id=$id;";
    // send query
    return mysqli_query($this->db, $sql);

}


//get specific bucke from id
public function getBuckeByID (int $id): array{
    $id = intval ($id);
    $sql= "SELECT * FROM buckelist WHERE id=$id;";
    $result = mysqli_query($this->db,$sql);
    $row = $result ->fetch_assoc();
    return $row;
}









//set methods
public function setName(string $name) : bool {
    if($name !== "") {
$this ->name = $name;
return true;

} else{
    return false;
}
    }
    

public function setBeskrivning(string $beskrivning) : bool {
    if($beskrivning !== "") {
$this ->beskrivning = $beskrivning;
return true;

} else{
    return false;
}
    }
    
public function setPrioritet(string $prioritet) : bool {
    if($prioritet > 0 ) {
$this ->prioritet = $prioritet;
return true;

} else{
    return false;
}
}


 
//desctructor
function __destruct(){
    mysqli_close($this->db);
}
  
}