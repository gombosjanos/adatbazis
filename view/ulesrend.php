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


echo '<img src="upload/'.$file_name.' "/>';
?>
<table>
	<tr>
		<th colspan="1.5">
			<h2>Ülésrend</h2>
		</th>
		<th colspan="3">
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
				<input type="submit" value="Feltöltés" name="upload">
			</form>
			<br>
			
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