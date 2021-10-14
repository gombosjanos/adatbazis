<?php
    require 'db.inc.php';
    $osztaly = array(
        array("Kulhanek László","Bakcsányi Dominik","Füstös Lóránt","Orosz Zsolt","Harsányi László",NULL),
        array("Molnár Gergő",NULL),
        array("Kereszturi Kevin","Juhász Levente","Szabó László","Sütő Dániel","Détári Klaudia",NULL),
        array("Fazekas Miklós",NULL,"Gombos János","Bicsák József")
    
    );
    foreach($osztaly as $sor=> $tomb){
      foreach($tomb as $oszlop => $tanulo){
        $sql = "INSERT INTO ulesrend (nev, sor, oszlop) VALUES ('$tanulo', $sor + 1, $oszlop +1)";
    if ($conn->query($sql) === TRUE) {
      echo "$tanulo beszúrásra került.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
      }
    }
    $conn->close();

?>