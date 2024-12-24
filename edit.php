<?php 
$title = "Editera bucke" ;

include("includes/header.php"); 

$bucke= new Bucke();

if(isset ($_GET['id'])){
    $id = intval($_GET['id']);

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
        
        if($bucke->updateBucke($id, $name, $beskrivning, $prioritet)){
        
            header ("Location: Buckelist.php ");
        } else {
             echo "<p class= 'error'> Fel vid uppdatering! </p>";
        }  
            
        } else {
            echo "<p class= 'error'> kontrollera värden och försök igen! </p>";
        }
                      
        }



    //read info about bucke
    $details = $bucke->getBuckeByID($id);
}else{
    header ("Location: Buckelist.php");
}

?>
    <div class="bucketlist_content">
      
        <h2>Ändra Bucke <?= $details['name'];?> </h2>


<?php 


?>


        <form method="POST" action ="edit.php?id=<?= $id; ?>">  
            <label for="name">Namn:</label><br>
            <input type="text" id="name" name="name" value= "<?=$details['name'];?>" ><br><br>
        
            <label for="beskrivning">Beskrivning:</label><br>
            <textarea id="beskrivning" name="beskrivning"> <?=$details['beskrivning'];?></textarea><br><br>
        
            <label for="prioritet">Prioritet (1 = högsta):</label><br>
            <input type="number" id="prioritet" name="prioritet" min="1"  max="10"  ><br><br>
        
            <button type="submit" name="add_bucketlist" >Uppdatera Bucke</button>
        </form>
       
    </div>
<?php include("includes/footer.php"); ?>