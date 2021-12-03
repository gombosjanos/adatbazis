<?php
$i = 0;
$errors = array();

if (isset($_FILES["fileToUpload"])) {
	$target_dir = "profilkep/";
	$allowed_filetypes = array('image/png', 'image/jpg', 'image/jpeg');

	foreach ($_FILES["fileToUpload"]["name"] as $key => $name) {
		$target_file = $target_dir . basename($name);

		if (!in_array($_FILES["fileToUpload"]["type"][$key], $allowed_filetypes)) {
			$errors[$key][] = "A $name file nem jpg vagy png.";
		}

		if (!isset($errors[$key])) {
			if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
				$i++;
			} else {
				$errors[$key][] = "Hiba történt a $name file mentésekor."; // felhasználónak    
			}
		}
	}
}


function tanulokListaja($conn)
{
	$lista = array();
	$sql = "SELECT id FROM ulesrend";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$lista[] = $row['id'];
			}
		}
	}
	return $lista;
}


?>
<?php

class Felhaszprofkep {
    
    private $id;
    protected $tablaNev;

    public function set_id($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id FROM $this->tablaNev WHERE id = $id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
            }
            else {
                $sql = "INSERT INTO $this->tablaNev VALUES($id) ";
                if($result = $conn->query($sql)) {
                    $this->id = $id;
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // építsük fel az összes get metódust
    public function get_id() {
        return $this->id;
    }

    // id listát ad vissza
    public function lista($conn) {
        $lista = array();
        $sql = "SELECT id FROM $this->tablaNev";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
}

?>


<table>
	<tr>
		<th colspan="1.5">
			<h2>Ülésrend</h2>
		</th>
		<th colspan="3>

			<?php

			if ($i > 0) echo "$i fájl feltöltve";
			if ($errors) {
				foreach ($errors as $error) {
					foreach ($error as $errorMsg) {
						echo "$errorMsg <br>";
					}
				}
			}

			?>
			<form action="index.php?page=ulesrend" method="post" enctype="multipart/form-data">
				Válasszon ki egy képet profilképnek:
				<input type="file" name="fileToUpload[]" id="fileToUpload"><br>
				<input type="submit" value="Feltöltés" name="profilkep">
			</form>
			<br>
			<form action="index.php?page=ulesrend" method="post">
				Kié lesz a profilkép? <select name="profkep_id">
					<?php


					


					if ($tanuloIdk) {
						foreach ($tanuloIdk as $row) {
							$tanulo->set_user($row, $conn);
							if ($tanulo->get_nev()) echo '<option value="' . $row . '">' . $tanulo->get_nev() . '</option>';
						}
					}
					?>

				</select>-é

			</form>

		</th>


		<th colspan="3">

			<?php



			if (!empty($_SESSION["id"])) {
				if (in_array($_SESSION["id"], $adminok)) {
			?>
					<form action="index.php?page=ulesrend" method="post">
						Hiányzó: <select name="hianyzo_id">
							<?php

							if ($tanuloIdk) {
								foreach ($tanuloIdk as $row) {
									$tanulo->set_user($row, $conn);
									if ($tanulo->get_nev() and !in_array($row, $hianyzok)) echo '<option value="' . $row . '">' . $tanulo->get_nev() . '</option>';
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

	<?php

	if ($tanuloIdk) {
		$sor = 0;
		foreach ($tanuloIdk as $row) {
			$tanulo->set_user($row, $conn);
			if ($tanulo->get_sor() != $sor) {
				if ($sor != 0) echo '</tr>';
				echo '<tr>';
				$sor = $tanulo->get_sor();
			}
			if (!$tanulo->get_nev()) echo '<td class="empty"></td>';
			else {
				$plusz = '';
				if (in_array($row, $hianyzok)) $plusz .=  ' class="missing"';
				if ($row == $en) $plusz .=  ' id="me"';
				if ($row == $tanar) $plusz .=  ' colspan="2"';
				echo "<td" . $plusz . ">" . $tanulo->get_nev();
				if (!empty($_SESSION["id"])) {
					if (in_array($_SESSION["id"], $adminok)) {
						if (in_array($row, $hianyzok)) echo '<br><a href="index.php?page=ulesrend&nem_hianyzo=' . $row . '">Nem hiányzó</a>';
					}
				}
				echo "</td>";
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();

	?>
</table>
</body>

</html>