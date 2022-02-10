<?php

require 'includes/db.inc.php';




if (isset($_REQUEST['keres'])) {

  

    /*mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    $stmt = $mysqli->prepare("SELECT nev FROM ulesrend WHERE nev LIKE ?");
   
    $szar="%".$_REQUEST['keres']."%";
    $stmt->bind_param("s",$szar);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($value) ;

    printf("%d rows found.\n", $stmt->num_rows());


    if ($stmt->num_rows > 0) {
        while ($row = $stmt->fetch()) {
            echo $value . "<br>";
        }
    } else echo "Nincs ilyen név";


    */

    

    $sql = 'SELECT nev FROM ulesrend WHERE nev LIKE ?';

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('s', $like); 
    
    $like = '%'.$_REQUEST['keres'].'%';
    
    $stmt->execute();

    if($result = $stmt->get_result()) {

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo $row['nev']."<br>";
            }
        }
        else echo 'Nincs ilyen név';        
    } 

}