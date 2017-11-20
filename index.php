<?php
require_once "connect_db.php";
foreach ($sql->query ('select * from sample_tbl') as $row2) {
  echo '<p>';
  echo $row2['id'],':';
  echo $row2['name'],':';
  echo '</p>';
}
$sql = null;

?>
