<?php $title = "Buckelist info" ;
include("includes/header.php"); 
?>
    <div class="bucketlist_content">
      
        <h2>Lägg till en Bucketlist-post</h2>


<?php 
$bucke = new Bucke();
//radera bucke
if(isset($_GET['deleteid'])){
    $deleteid =intval($_GET['deleteid']);
    if($bucke-> deleteBucke($deleteid)){
        echo "<p class= 'message'> Din Bucke har raderats ! </p>";
    } else {
        echo "<p class= 'error'> Fel vid radering! </p>";
    }
}





//defoult värde

$name = "";
$beskrivning= "";
$prioritet = ""; 
if(isset($_POST['name'])){
$name = $_POST['name'];
$beskrivning = $_POST['beskrivning'];
$prioritet = $_POST['prioritet'];

$success = true;
if(!$bucke-> setName($name)){
    $success = false;
    echo "<p class= 'error'> Denna fält får inte vara tomt! Du måste ange namn! </p>";
}
if(!$bucke-> setBeskrivning($beskrivning)){
    $success = false;
    echo "<p class= 'error'> Denna fält får inte vara tomt! Du måste ange beskrivning </p>";
}
if(!$bucke-> setPrioritet($prioritet)){
    $success = false;
    echo "<p class= 'error'> Denna fält får inte vara tomt! Du måste ange siffra mellan 1 till 10 </p>";
}

if ($success) {

if($bucke->addBucke($name, $beskrivning, $prioritet)){
    echo "<p class= 'message'> Din Bucke har lagts in! </p>";
    //rensa värde

$name = "";
$beskrivning= "";
$prioritet = ""; 
} else {
     echo "<p class= 'error'> Fel vid lagering! </p>";
}  
    
} else {
    echo "<p class= 'error'> kontrollera värden och försök igen! </p>";
}
              
}

?>


        <form method="POST">  
            <label for="name">Namn:</label><br>
            <input type="text" id="name" name="name" value= "<?=$name;?>" ><br><br>
        
            <label for="beskrivning">beskrivning:</label><br>
            <textarea id="beskrivning" name="beskrivning"> <?=$beskrivning;?></textarea><br><br>
        
            <label for="prioritet">Prioritet (1 = högsta):</label><br>
            <input type="number" id="prioritet" name="prioritet" min="1"  max="10" ><br><br>
        
            <button type="submit" name="add_bucketlist">Lägg till</button>
        </form>
        <h3>Bucketlist</h3>
        <table >
            <thead>
                <tr>
                    <th>Namn</th>
                    <th>beskrivning</th>
                    <th>Prioritet</th>
                    <th>Created</th>  
                    <th>Radera</th>  
                    <th>Ändra</th>  
                </tr>
            </thead>

 <tbody>
             <?php
$bucke_List = $bucke ->getBuckelist();
foreach($bucke_List as $c){
    ?> 
<tr>
    <td class ="namn"><?=$c['name']; ?></td>
    <td class ="beskrivning"><?=$c['beskrivning']; ?></td>
    <td class="priorite"><?=$c['prioritet']; ?>  </td>
    <td><?=$c['created']; ?></td> 
    <td><a href="Buckelist.php?deleteid=<?= $c['id'];?> " class ="knapp"> Radera </a> </td> 
    <td><a href="edit.php?id=<?= $c['id'];?> "  class ="knapp"> Ändra </a> </td>     
</tr>

    <?php
}


?>
           </tbody>
        </table>
        
    </div>
<?php include("includes/footer.php"); ?>