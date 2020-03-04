<?php
include_once("include/scripts.js.php");	
?>
<body onLoad="ajax_update('_gevangenis.inc.php','updaten',1000);">
<form method="post">
<table width="100%">

<?php

 $gn1            = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS `jail`,0 FROM `[users]` WHERE `login`='{$_SESSION['login']}' ORDER BY jailtime ASC");
  $gn             = $gn1->fetch_object();  if($gn->jail + $gn->jaltime > time()  && $data->login != Timo && $data->login != Freek){
  $verschil1             = $gn->jail + $gn->jailtime;
  $verschil              = $verschil1-time();

	

 print "<tr><td class=Maintxt colspan=7 align=center><b>$gevangtxt $verschil $gevangtxt1 <br><img src=\"https://mafiakill.com/images/jail.jpg\"></td></tr>"; Exit;} ?>

<tr>
<td class="subTitle" align="center" width="25%"><?=$gevanguser?></td>  <td class="subTitle" align="center" width="25%"><?=$gevangclan?></td>  <td class="subTitle" align="center" width="25%"><?=$gevangtijd?></td><td class="subTitle" align="center" width="25%"><?=$gevangguarantee?></td><td class="subTitle" align="center" width="25%"><?=$gevangbprice?></td><td class="subTitle" align="center" width="25%"><?=$gevangbreakout?></td><td class="subTitle" align="center" width="25%"><?=$gevangbuyout?></td>
<?php
  
 


    $man1              = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS`jail` FROM `[users]` WHERE `jailtime` > '0' ORDER BY jailtime ASC");
    while($man = $man1->fetch_object()) 
		{
      $tijd     = $man->jailtime+$man->jail;
      $borg      =  ($man->jaltime - (time() - $man->jail)) * 250;
 
 
      if($tijd >= time()){
        if(empty($man->clan)){
          $man->clan   = "(-)";
        }
$data1 = $mysqli->query("SELECT *,UNIX_TIMESTAMP(`jail`) AS`jail` FROM `[users]` WHERE `login`='{$man->login}' ORDER BY jailtime ASC")or die($mysqli->error);
$data2 = $data1->fetch_object();
$tijd3 =$data2->gevangenistijd+$data2->gevangenis;
$tijd2 =$tijd3-time();
?>


<tr>
<td class="mainTxt" width="25%"><input type="hidden" name="" value="">
<input type="hidden" name="hidden" value=""><a href="profile.php?x=<?=$data2->login?>"><?=$man->login?></a></td>
<td class="mainTxt" width="25%"><?php if ($man->clan!="(-)"){?> <a href="clan.php?x=<?=$man->clan?>"><?=$man->clan?></a><?php }else{?><?=$man->clan?><?php }?></td>
<td class="mainTxt" width="25%"><?=timeInterval(time(),$tijd);?></td>
<td class="mainTxt" width="25%" borg="Gevangenis_<?=$man->id?>">$<?=$borg?></a></td>
<td class="mainTxt" width="25%">$<?=$man->breakoutprice?></a></td>
<td class="mainTxt" width="25%"><input type="submit" value="<?=$gevangbreakout?>" name="BU"></td>
<td class="mainTxt" width="25%"><input type="submit" value="<?=$gevangbuyout?>" name="KO"></td>

</tr>
</form>
<?php  }

    } 
	?>
	<tr>
    <td class="subTitle" colspan="7"><?=$gevanglegend?>
    </td>
    </tr>
    <tr>
    <td  class="mainTxt" colspan="7">
    <center>

	
    X = <?=$gevangtextx?>
    <br />
    - = <?=$gevangtextxx?>
    </center>
    </td>
    </tr>
     </table>

         </center>

