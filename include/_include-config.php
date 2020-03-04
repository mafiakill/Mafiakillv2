<?php
define('DEBUG_MODE', true);
?>
<?php /* ------------------------- */

  

include_once("db.php");
include_once("lang/multitaal.php");
  
  $UPDATE_DB				= 1;

function datum( $format, $timestamp )
{
$wdays = array("Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag", "Zondag");
$months = array(1 => "Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December");

$replace_wdays = array(
date("l", mktime(0, 0, 0, 11, 10, 1991)) => $wdays[0],
date("l", mktime(0, 0, 0, 11, 11, 1991)) => $wdays[1],
date("l", mktime(0, 0, 0, 11, 12, 1991)) => $wdays[2],
date("l", mktime(0, 0, 0, 11, 13, 1991)) => $wdays[3],
date("l", mktime(0, 0, 0, 11, 14, 1991)) => $wdays[4],
date("l", mktime(0, 0, 0, 11, 15, 1991)) => $wdays[5],
date("l", mktime(0, 0, 0, 11, 16, 1991)) => $wdays[6]
);

$replace_short_wdays = array(
date("D", mktime(0, 0, 0, 11, 10, 1991)) => substr($wdays[0], 0, 3),
date("D", mktime(0, 0, 0, 11, 11, 1991)) => substr($wdays[1], 0, 3),
date("D", mktime(0, 0, 0, 11, 12, 1991)) => substr($wdays[2], 0, 3),
date("D", mktime(0, 0, 0, 11, 13, 1991)) => substr($wdays[3], 0, 3),
date("D", mktime(0, 0, 0, 11, 14, 1991)) => substr($wdays[4], 0, 3),
date("D", mktime(0, 0, 0, 11, 15, 1991)) => substr($wdays[5], 0, 3),
date("D", mktime(0, 0, 0, 11, 16, 1991)) => substr($wdays[6], 0, 3)
);

$replace_months = array(
date("F", mktime(0, 0, 0, 1, 1, 2004)) => $months[1],
date("F", mktime(0, 0, 0, 2, 1, 2004)) => $months[2],
date("F", mktime(0, 0, 0, 3, 1, 2004)) => $months[3],
date("F", mktime(0, 0, 0, 4, 1, 2004)) => $months[4],
date("F", mktime(0, 0, 0, 5, 1, 2004)) => $months[5],
date("F", mktime(0, 0, 0, 6, 1, 2004)) => $months[6],
date("F", mktime(0, 0, 0, 7, 1, 2004)) => $months[7],
date("F", mktime(0, 0, 0, 8, 1, 2004)) => $months[8],
date("F", mktime(0, 0, 0, 9, 1, 2004)) => $months[9],
date("F", mktime(0, 0, 0, 10, 1, 2004)) => $months[10],
date("F", mktime(0, 0, 0, 11, 1, 2004)) => $months[11],
date("F", mktime(0, 0, 0, 12, 1, 2004)) => $months[12]
);

$replace_short_months = array(
date("M", mktime(0, 0, 0, 1, 1, 2004)) => substr($months[1], 0, 3),
date("M", mktime(0, 0, 0, 2, 1, 2004)) => substr($months[2], 0, 3),
date("M", mktime(0, 0, 0, 3, 1, 2004)) => substr($months[3], 0, 3),
date("M", mktime(0, 0, 0, 4, 1, 2004)) => substr($months[4], 0, 3),
date("M", mktime(0, 0, 0, 5, 1, 2004)) => substr($months[5], 0, 3),
date("M", mktime(0, 0, 0, 6, 1, 2004)) => substr($months[6], 0, 3),
date("M", mktime(0, 0, 0, 7, 1, 2004)) => substr($months[7], 0, 3),
date("M", mktime(0, 0, 0, 8, 1, 2004)) => substr($months[8], 0, 3),
date("M", mktime(0, 0, 0, 9, 1, 2004)) => substr($months[9], 0, 3),
date("M", mktime(0, 0, 0, 10, 1, 2004)) => substr($months[10], 0, 3),
date("M", mktime(0, 0, 0, 11, 1, 2004)) => substr($months[11], 0, 3),
date("M", mktime(0, 0, 0, 12, 1, 2004)) => substr($months[12], 0, 3)
);

$return = date($format, $timestamp);
$return = strtr($return, $replace_wdays);
$return = strtr($return, $replace_short_wdays);
$return = strtr($return, $replace_months);
$return = strtr($return, $replace_short_months);

return $return;
}

function quote_smart($value) {
if (get_magic_quotes_gpc()) {
$value = stripslashes($value);
}
if(version_compare(phpversion(),"4.3.0") == "-1") {
return mysql_escape_string($value);
} else {
return mysql_real_escape_string($value);
}
}

  $mysqli = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
if ($mysqli->connect_error) {
    die('Error connecting to the Database');




ENDHTML;
    exit;
  }


 error_reporting ( 0 );
session_start();

if (empty($lang)) {
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}
switch ($lang)
    {
    case "nl" :
    include("lang/nl.php");
    break;
    case "en" :
    include("lang/en.php");
    break;
 case "de" :
    include("lang/de.php");
    break;
    default :
    include("lang/en.php");
    break;
}

  include("_include-funcs.php");
  if(isset($_SESSION['login'])) {
    $dbres				= $mysqli->query("SELECT *,UNIX_TIMESTAMP(`signup`) AS `signup`,UNIX_TIMESTAMP(`online`) AS `online` FROM `[users]` WHERE `login`='{$_SESSION[login]}'");
    $data				= $dbres->fetch_object();
    if($data->ip  == '')
    {
$IP = $_SERVER['REMOTE_ADDR'];
$mysqli->query("UPDATE `[users]` SET `IP`='$IP' WHERE `login`='$data->login'");
$mysqli->query("UPDATE `[users]` SET `lang`='$lang' WHERE `login`='$data->login'");

}
  }



  foreach($_POST as $key => $value) {
    if(gettype($_POST[$key]) == "array")
      foreach($_POST[$key] as $key2 => $value2)
        $_POST[$key][$key2]		= addslashes($_POST[$key][$key2]);
    else
      $_POST[$key]			= addslashes($_POST[$key]);
  }
  foreach($_GET as $key => $value) {
    if(gettype($_GET[$key]) == "array")
      foreach($_GET[$key] as $key2 => $value2)
        $_GET[$key][$key2]		= addslashes($_GET[$key][$key2]);
    else
      $_GET[$key]			= addslashes($_GET[$key]);
  }
  foreach($_COOKIE as $key => $value) {
    if(gettype($_COOKIE[$key]) == "array")
      foreach($_COOKIE[$key] as $key2 => $value2)
        $_COOKIE[$key][$key2]		= addslashes($_COOKIE[$key][$key2]);
    else
      $_COOKIE[$key]			= addslashes($_COOKIE[$key]);
  }


  $clientIP				= $_SERVER['REMOTE_ADDR'];
  $forwardedFor				= ($_SERVER['HTTP_X_FORWARDED_FOR'] != "") ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['HTTP_CLIENT_IP'];
  $forwardedFor				= preg_replace('/, .+/','',$forwardedFor);
  $dbres				= $mysqli->query("SELECT `id` FROM `[users]` WHERE `level`='-1' AND `login`='{$data->login}'");

$select = $mysqli->query("SELECT * FROM `instellingen`");

$page = $select->fetch_object();
 

    $mysqli->query("UPDATE `[users]` SET `online2`='ja' WHERE UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`online`) < 500");
    $mysqli->query("UPDATE `[users]` SET `online2`='nee' WHERE UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`online`) >= 500");

    $dbres				= $mysqli->query("SELECT *,UNIX_TIMESTAMP(`signup`) AS `signup`,UNIX_TIMESTAMP(`online`) AS `online` FROM `[users]` WHERE `login`='{$_SESSION['login']}'");
    $data				= $dbres->fetch_object();

if($data->rankvord >= 100 && $data->rank <16) {
$rank	                  	= array("Empty-Suit","Deliveryboy","Picciotto","Shoplifter","Pickpocket","Thief","Associate","Mobster","Soldier","Swindler","Assassin","Local Chief","Chief","Bruglione","Godfather","Legendary Godfather");
$rank = $rank[$data->rank];

$mysqli->query("UPDATE `[users]` SET `rank`=`rank`+'1',`rankvord`=`rankvord`-'100' WHERE `login`='".$data->login."'");
$mysqli->query("INSERT INTO `[messages]`(`time`,`from`,`to`,`subject`,`message`)VALUES(NOW(),'Mafiakill team','".$data->login."','Promoted','You have been promoted to ".$rank.".')");

}
if($data->cristalvord >= 100) {
$cristal	                  	= array("Empty-Suit","Deliveryboy","Picciotto","Shoplifter","Pickpocket","Thief","Associate","Mobster","Soldier","Swindler","Assassin","Local Chief","Chief","Bruglione","Godfather","Legendary Godfather");
$cristal = $cristal[$data->cristal];

$mysqli->query("UPDATE `[users]` SET `cristalvord`='0' WHERE `login`='".$data->login."'");
$mysqli->query("UPDATE `[users]` SET `cristallen`=`cristallen`+'1' WHERE `login`='{$_SESSION['login']}'");
$mysqli->query("INSERT INTO `[messages]`(`time`,`from`,`to`,`subject`,`message`) VALUES(NOW(),'Mafiakill team','".$data->login."',' Crystals','You have get 1 crystal')");

}
if($data->rijbewijsmissie == 10 && $data->rijbewijsauto > 4){

$mysqli->query("UPDATE `tunegarage`  SET `banden`=`banden`+'1',`motor`=`motor`+'1',`interieur`=`interieur`+'1',`uitlaat`=`uitlaat`+'1',`remmen`=`remmen`+'1',`body`=`body`+'1',`velgen`=`velgen`+'1',`nitro`=`nitro`+'1' WHERE `eigenaar`='{$data->login}' AND `rijbewijs`='1'");
$mysqli->query("UPDATE `[users]` SET `rijbewijsmissie`='11',`Rijbewijsvordering`=100  WHERE `login`='{$data->login}'");
$mysqli->query("INSERT INTO `[messages]`(`time`,`from`,`to`,`subject`,`message`) VALUES(NOW(),'Mafiakill team','".$data->login."','Drivers license','Congratulations You have obtained the driver's license Your getuned car have got +1  tire levels  +1  Engine levels +1 Interior levels +1 Exhaust pipe levels +1 Brakes levels +1 Body levels +1 Rims levels +1  Nitro levels. We congratulate you on behalf of the Mafiakill team.')");
}

$gelderaf = $data->werknemers*50+$data->bewakers*50;
if($data->fabrieksgeld < $gelderaf AND $data->staking == 0 AND $data->nietstaken == 0){

$mysqli->query("UPDATE `[users]` SET `staking`='3' WHERE `login`='{$data->login}'");
$mysqli->query("UPDATE `[users]` SET `fabrieksgeld`='0' WHERE `login`='{$data->login}'");
$mysqli->query("INSERT INTO `[messages]`(`time`,`from`,`to`,`subject`,`message`) values(NOW(),'Mafiakill team','{$data->login}','Strike','We went on strike for 3 days because you do not have enough money to pay us. ')");
}

      if($data->dagenwerken == 1){
$mysqli->query("UPDATE `[users]` SET `werklevel`=`werklevel`+1 WHERE `login`='{$data->login}'");
$mysqli->query("UPDATE `[users]` SET `baan`='0' WHERE `login`='{$data->login}'");
$mysqli->query("INSERT INTO `[messages]`(`time`,`from`,`to`,`subject`,`message`) values(NOW(),'Mafiakill team','{$data->login}','You have been promoted','Congratulations, you have passed the last 5 days. Your work level has risen by 1!')");
$mysqli->query("UPDATE `[users]` SET `dagenwerken`='0' WHERE `login`='{$data->login}'");
    }

  $dbres				= $mysqli->query("SELECT `id` FROM `rechtbankusers` WHERE `leven`<'1' AND `login`='{$data->login}'");


#
$select = $mysqli->query("SELECT * FROM `instellingen`");
#
$page = $select->fetch_object();

	

/* ------------------------- */ ?>

  
<?php
include("_header.php");


$mysqli->query("UPDATE `instellingen` SET `tijd`=NOW()  WHERE `id`='1'")or die("Add 1.1 ".$mysqli->error);


/* ------------------------- */ ?>