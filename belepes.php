<?php

session_start();

require 'db.inc.php';


//form feldolgozása

if (isset($_POST['user']) and isset($_POST['pw'])) {
  $loginError = '';
  if (strlen($_POST['user']) == 0) $loginError .= "Nem írtál be felhasználónevet";
  if (strlen($_POST['pw']) == 0) $loginError .= "Nem írtál be jelszót";
  if ($loginError == '') {
    $sql = "SELECT id, nev, jelszo FROM ulesrend WHERE felhasznalonev='" . $_POST['user'] . "'  ";
    if (!$result = $conn->query($sql)) echo $conn->error;

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        //$hianyzok[]=$row['id'];
        if (md5($_POST['pw']) == $row['jelszo']) {
          //érvényes belépés
          //$loggedUser=$row;
          $_SESSION["id"] = $row['id'];
          $_SESSION["nev"] = $row['nev'];
          header('Location: ulesrend.php');
          exit();
        } else $loginError .= 'Érvénytelen jelszó';
      }
    } else $loginError .= 'Érvénytelen felhasználónév.';
  }
}


?>
<?php

$title="Belépés";

if(!empty($_SESSION["id"])) $szoveg=$_SESSION['nev'].": kilépés";
include 'htmlheader.inc.php';


?>

<body>
  <?php  include 'menu.inc.php'; ?>
  <table >
    <tr>
      <th colspan="3">

        <?php

        if (!empty($_SESSION["id"])) {
          echo "<h1>Üdv " . $_SESSION['nev'] . "!</h1>";
        ?>
          <br>
          <form action="ulesrend.php" method="get" >
            <input type="submit" name="logout" value="Kilépés">
          </form>
        <?php

        } else {
          if (isset($_POST['user'])) {
            echo $loginError;
          } else echo "<h2> Belépés </h2>";


        ?>
          <form action="belepes.php" method="post">
            Felhasználó: <input type="text" name="user">
            <br>
            Jelszó: <input type="password" name="pw">
            <br>
            <input type="submit">
          </form>
        <?php
        }
        ?>



      </th>
      
    </tr>
  </table>
</body>

</html>