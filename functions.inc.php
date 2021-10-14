<?php
function tanulokListaja($conn)
{
  $sql = "SELECT id, nev, sor, oszlop FROM ulesrend";
  $result = $conn->query($sql);

  return $result;
}
function getIds($tablanev, $conn)
{
  $tomb = array();

  $sql = "SELECT * FROM $tablanev";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $tomb[] = $row['id'];
    }
  }
  return $tomb;
}
?>