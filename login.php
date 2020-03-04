<?php /* ------------------------- */

  include("include/_include-config.php");

   if(isset($_POST['login'],$_POST['pass'])) {
    $dbres				= $mysqli->query("SELECT `login`,`activated`,`accban` FROM `[users]` WHERE `login`='{$_POST['login']}' AND `pass`=MD5('{$_POST['pass']}')");
    if(($data = $dbres->fetch_object()) && $data->activated == 1 && $data->accban == 1) {
      $validate				= md5(rand(0,1000));
      setcookie("login",$data->login,time()+60*60*24,"/",".mafiakill.com");
      setcookie("validate",$validate,time()+60*60*24,"/",".mafiakill.com");
      $mysqli->query("REPLACE INTO `[online]`(`time`,`login`,`IP`,`validate`) values(NOW(),'{$_SERVER['REMOTE_ADDR']}','{$data->login}','$validate')");
      $_SESSION['login']		= $data->login;
      $_SESSION['IP']			= $_SERVER['REMOTE_ADDR'];
      $dbres				= $mysqli->query("SELECT *,UNIX_TIMESTAMP(`signup`) AS `signup` FROM `[users]` WHERE `login`='{$_SESSION['login']}'");
      $_SESSION['data']			= $dbres->fetch_object();
    }
  }
  else if($_GET['x'] == "logout") {
    $mysqli->query("DELETE FROM `[online]` WHERE `login`='{$_COOKIE['login']}' AND `validate`='{$_COOKIE['validate']}' AND `IP`='{$_SERVER['REMOTE_ADDR']}'");

    unset($_SESSION['login']);
    unset($_SESSION['IP']);
    unset($_SESSION['data']);
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

<link rel="stylesheet" type="text/css" href="css/css-v1.css">


 </head>
<table width="100%">
              <tr><td class="subtitle" colspan="4">Login</td></tr>
<center>

   
<?php /* ------------------------- */


  if($_GET['x'] == "logout")
    print "  <tr><td class=\"subTitle\"><b>Login</b></td></tr>\n  <tr><td class=\"mainTxt\">Je bent nu uitgelogd\n	<script language=\"javascript\">setTimeout('parent.window.location.href=\"index.php\"',1200)</script></td></tr>\n";
  else if($_GET['x'] == "lostpass") {
    print "  <tr><td class=\"subTitle\"><b>Lost password?</b></td></tr>\n";
    if(isset($_GET['id'],$_GET['code'])) {
      $dbres				= $mysqli->query("SELECT `login` FROM `[temp]` WHERE `id`='{$_GET['id']}' AND `code`='{$_GET['code']}' AND `area`='lostpass'");
      if($data = $dbres->fetch_object()) {
        $dbres				= $mysqli->query("SELECT `login`,`email` FROM `[users]` WHERE `login`='{$data->login}'");
        $data				= $dbres->fetch_object();

        $newpass			= rand(100000,999999);
        $mysqli->query("UPDATE `[users]` SET `pass`=MD5('$newpass') WHERE `login`='{$data->login}'");
        $mysqli->query("DELETE FROM `[temp]` WHERE `id`='{$_GET['id']}'");
        mail($data->email,"Mafiakill password","Your new passaord is: $newpass","From: Mafiakill.com<noreplay@mafiakill.com>\n");
        print "  <tr><td class=\"mainTxt\">Your new passwordt is sent to {$data->email}</td></tr>\n";
      }
    }
    else if(isset($_POST['email'],$_POST['login'])) {
      $dbres				= $mysqli->query("SELECT `login`,`email` FROM `[users]` WHERE `login`='{$_POST['login']}' AND `email`='{$_POST['email']}'AND `activated`=1");
      if($data = $dbres->fetch_object()) {
        $code				= rand(100000,999999);
        $mysqli->query("INSERT INTO `[temp]`(`login`,`code`,`area`,`time`) values('{$data->login}',$code,'lostpass',NOW())");
        $id				= $mysqli->insert_id;
        mail($data->email,"mafiakill password","Ther is a request for new passaord. if you dont request this delete email. if you request it click link \nhttps://mafiakill.com/login.php?x=lostpass&id=$id&code=$code","From: Mafiakill.com <noreplay@mafiakill.com>");
        print "  <tr><td class=\"mainTxt\">Ther is sent a email to {$data->email} with more information.</td></tr>\n";
      }
      else
        print "  <tr><td class=\"mainTxt\">Ther is no account with this email and password</td></tr>\n";
    }

    print <<<ENDHTML
  <tr><td class="mainTxt" align="center"><br>
	<form method="post"><table>
	  <tr><td width=100>Username:</td>  <td><input type="text" name="login"></td></tr>
	  <tr><td width=100>E-Mail:</td>  <td><input type="text" name="email"></td></tr>
	  <tr><td></td>  <td align="right"><input type="submit" value="Sent" style="width: 100"></td></tr>
	</form></table></td></tr>
ENDHTML;
  }
  else if($data) {
    if($data->activated == 0)
      print "  <tr><td class=\"mainTxt\">Je account is nog niet geactiveerd</td></tr>\n";
    else
      print "  <tr><td class=\"subTitle\"><b>Login</b></td></tr>\n  <tr><td class=\"mainTxt\">You logged in now.\n	<script language=\"javascript\">setTimeout('parent.window.location.href=\"crime.php\"',1200)</script>\n  </td></tr>\n";
  }
  else {
    print "  <tr><td class=\"subTitle\"><b></b></td></tr>\n";
    if(isset($_POST['login'],$_POST['pass']))
      print "  <tr><td class=\"mainTxt\">Wrong password or username</td></tr>\n";

    print <<<ENDHTML

  <tr><td class="mainTxt">


<form method="post">
 
	<center><table width=100%>
  
<tr><td class="mainTxt">
	  <tr><td width=100>Username:</td>		<td><input class"Form" type="text" name="login" maxlength=16 style="width: 150;"></td></tr>
	  <tr><td width=100>Password:</td>	<td><input type="password" name="pass" maxlength=16 style="width: 150;"></td></tr>
	  <tr><td align="right"><input class="btn-grid" type="submit" name="submit" style="width: 100;" value="Login">
	  </td></tr>
	</table></form>
  </td></tr>
 
ENDHTML;
  }

/* ------------------------- */ ?>