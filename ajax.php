<?php

require 'includes/db.inc.php';

if(isset($_REQUEST['keres'])) {
   
    $sql="SELECT nev FROM ulesrend WHERE nev LIKE '%".$_REQUEST['keres']."%'";
    if(!$result = $conn->query($sql))  echo $conn->error;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo $row['nev']."<br>";
        }
    }else echo "Nincs ilyen név";
    
}



?> 