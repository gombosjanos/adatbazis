<?php

session_start();


require 'db.inc.php';
require 'functions.inc.php';



//$loggedUser= NULL;
//form feldolgozása

if (!empty($_POST["hianyzo_id"])) {
  $sql = "INSERT INTO hianyzok VALUES(" . $_POST["hianyzo_id"] . ")";
  $result = $conn->query($sql);
} elseif (!empty($_GET['logout'])) {
  session_unset();
} elseif (!empty($_GET['nem_hianyzo'])) {
  $sql = "DELETE FROM hianyzok WHERE id=" . $_GET['nem_hianyzo'];
  $result = $conn->query($sql);
}

$hianyzok = getIds('hianyzok', $conn);

$sql = "SELECT * FROM hianyzok";

$adminok = getIds('adminok', $conn);

$en = 0;
if (!empty($_SESSION["id"])) $en = $_SESSION["id"];
?>
<!doctype html>
<html lang="HU">

<?php

$title = "Ülésrend";
include 'htmlheader.inc.php';

?>

<body>
  <?php
  include 'menu.inc.php';



  $en = array(
    array(),
    array(),
    array(),
    array(2)
  );
  $osszevon = array(
    array(),
    array(),
    array(),
    array(3, 4)
  );
  $von = array(
    array(1, 2, 3, 4, 5),
    array(1, 2, 3, 4, 5),
    array(),
    array()
  );

  ?>
  <table>
    <tr>
      <th colspan="3">
        <h2>Ülésrend</h2>
        <?php

        /*if (!empty($_SESSION["id"])) {
          echo "Üdv " . $_SESSION['nev'] . "!";
        ?>
          <br>
          
        <?php

        }*/

        ?>




      </th>
      <th colspan="3">
        <form action="ulesrend.php" method="post">
          <?php

          if (!empty($_SESSION["id"])) {
            if (in_array($_SESSION["id"], $adminok)) {
          ?>
              Hiányzó: <select name="hianyzo_id">
                <?php
                $result = tanulokListaja($conn);
                if ($result->num_rows > 0) {
                  // output data of each row
                  $sor = 0;
                  while ($row = $result->fetch_assoc()) {
                    if ($row['nev'] and !in_array($row['id'], $hianyzok)) echo '<option value="' . $row['id'] . '">' . $row['nev'] . '</option>';
                  }
                }

                ?>
              </select>

              <br>
              <input type="submit">

        </form>

    <?php
            }
          }
    ?>
      </th>
    </tr>
    <tr>
      <?php

      $result = tanulokListaja($conn);


      if ($result->num_rows > 0) {
        // output data of each row
        $sor = 0;
        while ($row = $result->fetch_assoc()) {
          if ($row["sor"] != $sor) {

            if ($sor != 0) echo "</tr>";
            echo '<tr>';
            $sor = $row["sor"];
          }
          if (!$row["nev"]) {
            $plusz .= ' class="empty"';
            echo "<td" . $plusz . ">" . $row["nev"] . "</td>";
          } else {
            $plusz = ' ';
            //if(in_array($row["oszlop"]-1,$hianyzok[$sor-1])) $plusz .= ' class="missing"';
            if (in_array($row["id"], $hianyzok)) $plusz .= ' class="missing"';
            if (in_array($row["oszlop"] - 1, $en[$sor - 1])) $plusz .= ' id="me"';
            if (in_array($row["oszlop"] - 1, $osszevon[$sor - 1])) $plusz .= 'colspan="2"';
            if (in_array($row["oszlop"] - 1, $von[$sor - 1])) $plusz .= 'rowspan="2"';
            echo '<td' . $plusz . '>' . $row["nev"];
            if (in_array($row["id"], $hianyzok)) echo '<br><a href=ulesrend.php?nem_hianyzo=' . $row["id"] . '>Nem hiányzó</a>';
            echo '</td>';
          }
        }
      } else {
        echo "0 results";
      }
      $conn->close();

      ?>
    </tr>
  </table>
</body>

</html>