<?php /* ------------------------- */
  $OMNILOG				= 1;
  include("include/_include-config.php");

  include("include/_include-gevangenis.php");
    
 if(!($_SESSION))
  {
     echo "<script>top.window.location = '/index.php'</script>";
    exit;
  }

  $mysqli->query("UPDATE `[users]` SET `online`=NOW() WHERE `login`='{$data->login}'");

$ontvanger1                    	= $mysqli->query("SELECT * FROM `[users]` WHERE `login`='{$_POST['to']}'");
$ontvanger			= $ontvanger1->num_rows;
$cash1                                 = $data->cash;
$cash                                 = $data->cash;
  $cash                                 = number_format(round($cash),0,",",".");
  $bank                                 = $data->bank;
  $bank1                                 = $data->bank;
$bank                               = number_format(round($bank),0,",",".");
 $dbres2                                = $mysqli->query("SELECT `id` FROM `[users]` WHERE UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`online`) < 300");
  $online                                = $dbres2->num_rows;
$dbres                = $mysqli->query("SELECT id FROM `[messages]` WHERE `read`=0 AND `inbox`=1 AND `to`='{$data->login}'");
  $inboxnew                = $dbres->num_rows;
/* ------------------------- */ ?>
<html>


<head>

<title></title>
<link rel="stylesheet" type="text/css" href="css/css-v1.css">

<style>
#bank {  width: 100%;  height: auto; } 
</style>
</head>


<body style="margin: 5px;">
<table width=100%>
  <tr><td class="subTitle"><b><?=$banktitle?></b></td></tr>
<table  width=100%>

<td class="subTitle"><img src="../images/bank.jpg" id="bank" width="1280"></td>
<tr><td class="mainTxt" align="center"><table width="300"><td align="left"> <a href="?x=bank"><?=$bankdepwit?></a></td><td align="right"> <a href="?x=sent"><?=$banksent?></a></td></table></td></tr>
<?php /* ------------------------- */
$bankmax = number_format(1000000000000000000, 0, '.' , '.');
$bankleft = number_format(1000000000000000000, 0, '.' , '.');
$cash = number_format($data->cash, 0, '.' , '.');
$bank = number_format($data->bank, 0, '.' , '.');
$amount = number_format($_POST['amount'], 0, '.' , '.');
$rente  =round($data->bank*0.05);
$rente = number_format($data->bank*0.05, 0, '.' , '.');
$renteba = number_format($data->bank*0.10, 0, '.' , '.');
  if(isset($_POST['out']) && preg_match('/^[0-9]+$/',$_POST['amount'])) {
    if($_POST['amount'] <= $data->bank) {
      $data->cash			+= $_POST['amount'];
      $data->bank			-= $_POST['amount'];
      $mysqli->query("UPDATE `[users]` SET `bank`={$data->bank},`cash`={$data->cash} WHERE `login`='{$data->login}'");
        print "        <tr><td class=\"mainTxt\" align=\"center\"> $bankop1  <b>$amount</b>  $bank2 </td></tr>\n";
    }
    else
      print "  <tr><td class=\"mainTxt\" align=\"center\">$bank3</td></tr>\n";
  }
  else if(isset($_POST['in']) && preg_match('/^[0-9]+$/',$_POST['amount'])) {
    if($_POST['amount'] <= $data->cash) {
      if($_POST['amount'] <= 99999999999999999999) {
        if($bankleft > 0) {
          $data->cash			-= $_POST['amount'];
          $data->bank			+= $_POST['amount'];
          $data->bankleft= 25;
          $mysqli->query("UPDATE `[users]` SET `bank`={$data->bank},`cash`={$data->cash} WHERE `login`='{$data->login}'");
        print "        <tr><td class=\"mainTxt\" align=\"center\"> $bank4  <b>$amount</b> $bank5 </td></tr>\n";

        }
        else
          print "  <tr><td class=\"mainTxt\">You can no longer deposit today</td></tr>\n";
      }
      else
        print "  <tr><td class=\"mainTxt\">Je mag maar €{$data->bankmax},- per keer storten</td></tr>\n";
    }
    else
      print "  <tr><td class=\"mainTxt\" align=\"center\"> $bank6 </td></tr>\n";
  }
if($_GET['x'] == "bank") {
	$cash = number_format($data->cash, 0, '.' , '.');
$bank = number_format($data->bank, 0, '.' , '.');
?>
  <tr><td class="mainTxt" align="center">


	<table align="center">
	  <tr><td width=100><?=$bankcash?>:</td>	<td align="right"><?=$cash?></td></tr>
	  <tr><td width=100><?=$bankbank?>:</td>	<td align="right"><?=$bank?> <a href="#" onClick="document.getElementById('amount_put').value='<?=$bank1?>'; document.getElementById('radio_off').checked='true'">[<?=$banktakeall?>]</a></td></tr>

	</table>
	<form method="post"><table align="center">
	  <tr><td align="center">$<input type="text" id="amount_put" name="amount" maxlength="10" value="<?=$cash1?>">,-
		<input type="submit" name="out"  value="<?=$bank7?>" style="width: 100;">
		<input type="submit" name="in" value="<?=$bank8?>"  style="width: 100;"></td></tr>
	</table></form>
  </td></tr>
<?php
} else if($_GET['x'] == "sent") {

    print "  <tr><td class=\"subTitle\"><b>$banksent</b></td></tr>\n";
    if(isset($_POST['to'])) {
      if(preg_match('/^[0-9]+$/',$_POST['amount'])) {
	if($ontvanger < 1) {
          print "  <tr><td class=\"mainTxt\">$bank9</td></tr>\n";
}
         else if($_POST['amount'] <= $data->cash) {
      $data->cash-= $_POST['amount'];
      $mysqli->query("UPDATE `[users]` SET `cash`={$data->cash},`cash`={$data->cash} WHERE `login`='{$data->login}'");
        if($member = $mysqli->query("SELECT `login` FROM `[users]` WHERE `login`='{$_POST['to']}'")) {
          $mysqli->query("UPDATE `[users]` SET `cash`=`cash`+{$_POST['amount']} WHERE `login`='{$member->login}'");
          $mysqli->query("INSERT INTO `[logs]`(`time`,`IP`,`login`,`person`,`code`,`area`) values(NOW(),'{$_SERVER['REMOTE_ADDR']}','{$data->login}','{$member->login}',{$_POST['amount']},'donate')");
          print "  <tr><td class=\"mainTxt\"> $bank10 {$_POST['amount']} $bank11 {$member->login}</td></tr>\n";
        }

      }
else
          print "  <tr><td class=\"mainTxt\"> $bank12 </td></tr>\n";

    }
  }

    print <<<ENDHTML
  <tr><td class="mainTxt" align="center">
	<form method="post"><table>
	<tr><td width=100> $bank11 :</td>  <td><input type="text" name="to" value="{$_REQUEST['to']}"></td></tr>
	<tr><td width=100> $bank13 :</td>  <td><input type="text" value="$cash1" name="amount" maxlength="7"></td></tr>
	<tr><td></td>  <td align="right"><input type="submit" value="$bank14" style="width: 75px;"></td></tr>
	</table></form>
  </td></tr>
ENDHTML;
if ($data->clan != "" ){
 print <<<ENDHTML
<tr><td class="subTitle"><b>$bank15</b></td></tr>
  <tr><td class="mainTxt" align="center">
        <form method="post" action="clandonate.php"><table align="center">
          <tr><td width=60> $bank11 :</td>  <td>{$data->clan}</td></tr>
                <tr><td width=60> $bank13 :</td>  <td><input type="text" name="amount" maxlength="11" onkeypress="onlyNumeric(arguments[0])" value="$cash1"></td></tr>
                <tr><td></td>  <td align="right"><input type="submit" name="submit" value="$bank14"  style="width: 100;"></td></tr>
        </table></form>
  </td></tr>
ENDHTML;
}
}
/* ------------------------- */ ?>
</body>
</html>