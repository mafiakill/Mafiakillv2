<link rel="stylesheet" type="text/css" href="css/css-v1.css">
<?php
include_once("include/_include-config.php");



design_boven('Mafiakill');
 if(!($_SESSION))
  {
     echo "<script>top.window.location = '/index.php'</script>";
    exit;
  }

$dbres= $mysqli->query("SELECT *,UNIX_TIMESTAMP(`signup`) AS `signup`,UNIX_TIMESTAMP(`online`) AS `online` FROM `[users]` WHERE `login`='{$_SESSION['login']}'");
$data= $dbres->fetch_object();
?>


<body onLoad="ajax_update('_gevangenis.inc.php','updaten',1000);">
<table width="100%">


<tr>
  <td colspan="6" width="96%" class="subTitle"><?=$jailtitle?></td>
</tr><tr>
<td class="mainTxt"><img src="/images/prison.jpg"></td>
<td class="mainTxt"><?=$jailtxt?>

</td>

</td>
</tr>

</table>
<table width="100%">
<tr>
  <td class="mainTxt">
</tr><tr>

<?php   


 
    $man1              = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS `jail` FROM `[users]` WHERE `jailtime` > '0' ORDER BY jailtime ASC");



if(isset($_POST['KO'])) {
      $id      = $mysqli -> real_escape_string($_POST['id']);
      $man1    = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS `jail`,0 FROM `[users]` WHERE `id`='$id' ORDER BY jailtime ASC");
      $man     = $man1->fetch_object();
      $borg    = $_GET['borg'];
      print "<tr><td class=\"mainTxt\" align=\"center\">";
      if(empty($man->login))
	  {
	  ?>
      <?=$jailtxt1?>
      <?php
      }
		
		if ($man->jailtime == 0) 
		{
		?>
		<?=$man->login?> is already free!
		<?php
        exit;
		}

      if($data->cash <= $borg)
	  {
      ?>

<?=$jailtxt2?> $ <?=$borg?> <?=$jailtxt3?>



    
      <?php
        ;
      }
      $mysqli->query("UPDATE `[users]` SET `cash`=`cash`-'" . $borg . "'WHERE `login`='$data->login'");
      $mysqli->query("UPDATE `[users]` SET `jailtime`='0' WHERE `login`='$man->login'");
$mysqli->query("UPDATE `[users]` SET `buyouts`=`buyouts`+'1'WHERE `login`='$data->login'");
	  if ($data->login==$man->login)
	  {
	  
	  }
	  else
	  {

$language=$man->lang;
$sql = "INSERT INTO `[messages]`(`time`,`IP`,`from`,`to`,`read`,`subject`,`message`) VALUES (
 NOW(),
 '".$_SERVER['REMOTE_ADDR']."',
 'Mafiakill team',
 '".$man->login."',
 '0',
 '$koopuittitle[$language]',
 '$koopuit[$language] $data->login $koopuit1[$language]'
)";
$mysqli->query($sql);
}
	  ?>


<?=$jailtxt4?> <?=$man->login?> <?=$jailtxt5?> $<?=$borg?> 
      <?php
	unset($_POST['KO']);
      ;
    }

    if(isset($_POST['BU'])) {
      $id      = $mysqli -> real_escape_string($_POST['id']);
      $man1    = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS `jail`,0 FROM `[users]` WHERE `id`='$id' ORDER BY jailtime ASC");
      $man     = $man1->fetch_object();


print "<tr><td class=\"mainTxt\" align=\"center\">";
 if($man->bank < $man->uitbreek){
 print "$jailtxt6";
;
 }

		
		
      print "<tr><td class=\"mainTxt\" align=\"center\">";

      if(empty($man->login)){
        $gtijd6       = $man->jailtime+$man->jail;
        $gtijd7       = $gtijd6-time();
        $gtijd1       = $gtijd7/2;
        $gtijd        = round($gtijd1);
        $gtijd3       = $gtijd1-3600;
        $gtijd2       = date("i:s", "$gtijd3");
		?>


       <?=$jailtxt7?>
        <?php
        $mysqli->query("UPDATE `[users]` SET `jail`=NOW(), `jailtime`='20' WHERE `login`='$data->login'");
        unset($_POST['BU']);
        exit;
      }
	  else if($man->login == $data->login)
	  {
	  ?>
       <?=$jailtxt8?>
        <?php
        $mysqli->query("UPDATE `[users]` SET `jail`=NOW(), `jailtime`=`jailtime`*2 WHERE `login`='$data->login'");
		unset($_POST['BU']);
	  }
 else{

        if($data->gvu >= $man->jailtime){
          $getal       = 1;
        }
        else{
          $getal2       = 6;
        }
        if(empty($getal)){
          $getal        = rand(1,$getal2);
        }

        $mysqli->query("UPDATE `[users]` SET `power`=`power`+'50' WHERE `login`='$data->login'");

        if($getal == 1){
		?>
        <?=$jailtxt9?> <?=$man->login?> <?=$jailtxt9n?>
        <?php
          $mysqli->query("UPDATE `[users]` SET `jailtime`='0',`bank`=`bank`-'$man->breakoutprice' WHERE `login`='$man->login'");
          $mysqli->query("UPDATE `[users]` SET `bustouts`=`bustouts`+'1'WHERE `login`='$data->login'");
		$mysqli->query("UPDATE `[users]` SET `cash`=`cash`+'$man->breakoutprice' WHERE `login`='$data->login'");
$language=$man->lang;
$sql = "INSERT INTO `[messages]`(`time`,`IP`,`from`,`to`,`read`,`subject`,`message`) VALUES (
 NOW(),
 '".$_SERVER['REMOTE_ADDR']."',
 'Mafiakill team',
 '".$man->login."',
 '0',
 '$breakouttitle[$language]',
 '$breakout[$language] $data->login $breakout1[$language]'
)";
$mysqli->query($sql);

          unset($_POST['BU']);
          ;
        }
        else{
          $gtijd6       = $man->jailtime+$man->jail;
          $gtijd7       = $gtijd6-time();
          $gtijd1       = $gtijd7/2;
          $gtijd        = round($gtijd1);
          $gtijd3       = $gtijd1-3600;
          $gtijd2       = date("i:s", "$gtijd3");
		  ?>
          <?=$jailtxt10?>
          <?php
          $mysqli->query("UPDATE `[users]` SET `jail`=NOW(), `jailtime`='20' WHERE `login`='$data->login'");

          unset($_POST['BU']);

          ;
        }
      }
      print "</td></tr>";
    }








?>

  


	</td>
 </tr>
</form>
</table>

<div id="updaten">

<?php include("_gevangenis.inc.php"); ?>
</div>    
<?php
if(isset($_POST['profile'])) {
 print" <table width=100%><tr><td class=\"subTitle\"><b>$jailtxt11</b></td></tr>";
 $bel				= preg_replace('/\</','&#60;',substr($_POST['bel'],0,500));
if($bel <= 0){
print "<tr><td class=\"mainTxt\">ongeldig getal.</td></tr>";
exit;
}


if ($data->bank < $bel){
print "<tr><td class=\"mainTxt\">$jailtxt12</td></tr>";
exit;
}
$mysqli->query("UPDATE `[users]` SET `breakoutprice`='$bel' WHERE `login`='$data->login'");

print "<tr><td class=\"mainTxt\">$jailtxt13</td></tr>";
exit;
}



 print <<<ENDHTML
 <table width=100%>
	<form method="post">
<tr><td class="subTitle"><b>$jailtxt11</b></td></tr>
   <tr><td class="mainTxt">$jailtxt14<br>
 $ <input type="text" name="bel" value="$data->breakoutprice" onkeypress="onlyNumeric(arguments[0])" size="10">
<input type="submit" name="profile" value="$jailtxt15"></td></tr></form>
    	</table>

ENDHTML;
design_onder('1');
     ?>
