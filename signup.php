<?php /* ------------------------- */

   include("include/_include-config.php");
  
  $login					= $_POST['login5'];
  $pass						= $_POST['pass5'];
  $passconfirm					= $_POST['passconfirm5'];
  $email					= $_POST['email5'];
  $recruiter				= $_POST['recruiter5'];
  $type						= $_POST['type5'];

  ${"select$type"}				= "selected";


  if(isset($_POST['submit5'])) {
    $message					= Array(
	"Your login can only have A-Z, a-z, 0-9, _ and -",
	"The passwords you gave are not identical",
	"Please enter a valid email address",
	"Select a charcater",
	"Someone already exists with that login",
	"Someone already has that e-mail");

    $msgnum					= -1;
    if(preg_match('/^[a-zA-Z0-9_\-]+$/',$login) == 0)
      $msgnum					= 0;
    if($pass == "" || $pass != $passconfirm)
      $msgnum					= 1;
    if(preg_match('/^.+@.+\..+$/',$email) == 0)
      $msgnum					= 2;
    if($type != 1 && $type != 2 && $type != 3)
      $msgnum					= 3;
    else {
      $dbres					= $mysqli->query("SELECT `id` FROM `[users]` WHERE `login`='$login'");
      if($dbres->num_rows > 0)
        $msgnum					= 4;
      $dbres					= $mysqli->query("SELECT `id` FROM `[users]` WHERE `email`='$email'");
      if($dbres->num_rows > 0)
        $msgnum					= 5;

      if($msgnum == -1) {
        $code					= rand(100000,999999);
		$mysqli->query("UPDATE `[users]` SET `recruits`=`recruits`+'1' WHERE `login`='{$recruiter}'");
        
	$mysqli->query("UPDATE `[users]` SET `bank`=`bank`+'1000000' WHERE `login`='{$recruiter}'");
        $mysqli->query("INSERT INTO `[users]`(signup,login,pass,IP,email,type) values(NOW(),'$login',MD5('$pass'),'$IP','$email',$type)");
        $mysqli->query("INSERT INTO `[temp]`(login,IP,code,area,time) values('$login','$IP',$code,'signup',NOW())");
	     
        $id					= $mysqli->insert_id;
        $dbres				     = $mysqli->query("SELECT `login` FROM `[temp]` WHERE `area`='signup' AND `id`='$id' AND `code`='$code'");
		
    if($data = $dbres->fetch_object()) {
      $mysqli->query("UPDATE `[users]` SET `activated`=1,`signup`=NOW() WHERE `login`='{$data->login}'");
      $mysqli->query("DELETE FROM `[temp]` WHERE `id`='$id'");
 $_SESSION['login']		= $data->login;
      $_SESSION['IP']			= $_SERVER['REMOTE_ADDR'];
print " <script language=\"javascript\">setTimeout('parent.window.location.href=\"ingame/index.php\"',1200)</script>\n  \n";
      
    }
        array($email,"Mafiakill.com","Thankyou for signup by mafiakill.com.","From: Mafiakill.com <goodwebbv@gmail.com>\n");
      }
    }
  }

/* ------------------------- */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Mafiakill.com</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="keywords" content="mafia game,mafia,maffia,rpg game,webbased game,gaming,online game,online mafia game,online mafia game,mafia game webbased,mafia games,maffia spel,mmorpg,mmorpg game,mafia rpg game" />
<meta name="description" content="Online webbased mafia game" />
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<meta name="url" content="https://mafiakill.com">
<meta name="identifier-URL" content="https://mafiakill.com">
<meta name="directory" content="games">
<meta name="category" content="rpg games">
<meta name="coverage" content="Worldwide">
<meta http-equiv="Cache-Control" content="no-cache">



<meta name="og:title" content="Mafiakill.com mafia webbased game"/>
<meta name="og:type" content="game"/>
<meta name="og:url" content="https://mafiakill.com"/>
<meta name="og:image" content="https://mafiakill.com/mafia.jpg"/>
<meta name="og:site_name" content="Mafiakill.com"/>
<meta name="og:description" content="Online webbased mafia game"/>


<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@goodwebbv" />
<meta name="twitter:creator" content="@goodwebbv" />
<meta property="og:url" content="https://mafiakill.com" />
<meta property="og:title" content="Mafiakill.com" />
<meta property="og:description" content="Online webbased mafia game" />
<meta property="og:image" content="https://mafiakill.com/mafia.jpg" />
<link rel="stylesheet" type="text/css" href="/ingame/css/css-v1.css">
</head>
<table width="100%">
              <tr><td class="subtitle" colspan="4">Signup</td></tr>
 <?php /* ------------------------- */

  if(isset($_GET['id'],$_GET['code'])) {
    print "  <tr><td class=\"subTitle\"><b>Activatie</b></td></tr>\n";

    $id						= $_GET['id'];
    $code					= $_GET['code'];
    $dbres					= $mysqli->query("SELECT `login` FROM `[temp]` WHERE `area`='signup' AND `id`='$id' AND `code`='$code'");

    if($data = $dbres->fetch_object()) {
      $mysqli->query("UPDATE `[users]` SET `activated`=1,`signup`=NOW() WHERE `login`='{$data->login}'");
      $mysqli->query("DELETE FROM `[temp]` WHERE `id`='$id'");
      print "  <tr><td class=\"mainTxt\"></td></tr>\n";
    }
    else
      print "  <tr><td class=\"mainTxt\">Incorrecte activatie-code...</td></tr>\n";
  }
  else {
    if($msgnum != -1) {
      print "  <tr><td class=\"subTitle\"></td></tr>\n";
      if(isset($msgnum) && $msgnum != -1)
        print "  <tr><td class=\"mainTxt\">\n	{$message[$msgnum]}\n  </td></tr>\n";
		$rec = $_GET['rec'];
		
?>
  <tr><td class="mainTxt">

	<form method="post"><table align="center">
	  <tr><td width=100>Username:</td>		<td><input type="text"Style="Color: gold" name="login5" maxlength=16 style="width: 150;" value="<?php echo $login ?>"><b></b></td></tr>
	  <tr><td width=100>Password:</td>	<td><input type="password" Style="Color: gold" name="pass5" maxlength=16 style="width: 150;"></td></tr>
	  <tr><td width=100>Password again:</td>	<td><input type="password" Style="Color: gold"name="passconfirm5" maxlength=16 style="width: 150;"></td></tr>
	  <tr><td width=100>E-Mail:</td>	<td><input type="text" Style="Color: gold"name="email5" maxlength=64 style="width: 150;" value="<?php echo $emaill ?>"></td></tr>
	  <tr><td width=100>Character:</td>		<td><select name="type5" style="width: 150;">
							<option value="1" $select1>Criminal</option>
							<option value="2" $select2>Scientist</option>
							<option value="3" selected $select3>Police</option>
						</select> </td></tr>
						<?php
						if($rec == "") {
						?>
		<tr><td width=100>Referal:</td>	<td><input type="text" Style="Color: gold" name="recruiter5" maxlength=64 style="width: 150;" value="<?php echo $rec; ?>">*Dont know? Leave blank</td></tr>
		<?php
		}
		else
		{
		?>
		<tr><td widrh=100>Referal:</td>	<td><?php echo $rec; ?>
		  <input name="recruiter5" type="hidden" value="<?php echo $rec; ?>"></td></tr>
		<?php
		}
		?>
	  <tr><td></td><td align="right"><input type="submit" name="submit5" style="width: 100;" Style="Color: white"  value="Signup"></td></tr>
	</table></form><br>
	
  </td></tr>
<?php
    }
    else
      print "  <tr><td class=\"mainTxt\">You registerd!</td></tr>\n";
  }

/* ------------------------- */ ?>