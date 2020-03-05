<?php
 $datA1            = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS `jail`,0 FROM `[users]` WHERE `login`='{$data->login}'");
      $dataa            = $datA1->fetch_object();

	if($dataa->jail + jailtime > time()){
 echo "<meta http-equiv='refresh' content='0;url=../jail.php'>";}
?>