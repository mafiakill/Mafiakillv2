<?php  
$select = $mysqli->query("SELECT * FROM `instellingen`");
#
$page = $select->fetch_object();
 	 $data2				= $mysqli->query("SELECT * FROM `[users]` WHERE `login`='{$_SESSION['login']}'");
    $data				= $data2->fetch_object();
	if ($data->vermoord !=0){?>
	<link rel="stylesheet" type="text/css" href="<?php echo $sitelink;?>/layout/layout<?php echo $page->layout; ?>/css/css.css"> 
  <table width=100%>
    <tr><td class="subTitle"><b>You been killed</b></td></tr>
    <tr><td class="mainTxt">Go to hospital and try to find the person that kills you <a href="../heal.php">Click here to go hospital</a>
	<center>
	</center>
    </td></tr>
  </table>
	<?php	exit;
	}
function check_login() {
    if(isset($_COOKIE['login'],$_COOKIE['validate'])) {
        $login			= $_COOKIE['login'];
        $validate		= $_COOKIE['validate'];
        $query			= $mysqli->query("SELECT * FROM `[online]` WHERE `login`='$login' AND `validate`='$validate' AND `IP`='{$_SERVER['REMOTE_ADDR']}' AND UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`time`) < 60*60*24");
        if($user = $query->fetch_object()) {
          $mysqli->query("UPDATE `[online]` SET `time`=NOW() WHERE `login`='$login' AND `validate`='$validate' AND `IP`='{$_SERVER['REMOTE_ADDR']}' AND UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`time`) < 60*60*24");
          setcookie("login",$user->login,time()+60*60*24,"/");
          setcookie("validate",$validate,time()+60*60*24,"/");

          $_SESSION['login']	= $user->login;
          $_SESSION['IP']	= $_SERVER['REMOTE_ADDR'];
          return TRUE;

      }
      else
        $validate		= $_COOKIE['validate'];
      $mysqli->query("REPLACE INTO `[online]`(`time`,`IP`,`login`,`validate`) values(NOW(),'{$_SERVER['REMOTE_ADDR']}','{$_SESSION['login']}','$validate')");
      return TRUE;
    }
    else {
      if(isset($_COOKIE['login'],$_COOKIE['validate'])) {
        $login			= $_COOKIE['login'];
        $validate		= $_COOKIE['validate'];
        $query			= $mysqli->query("SELECT * FROM `[online]` WHERE `login`='$login' AND `validate`='$validate' AND `IP`='{$_SERVER['REMOTE_ADDR']}' AND UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`time`) < 60*60*24");
        if($user = $query->fetch_object()) {
          $mysqli->query("UPDATE `[online]` SET `time`=NOW() WHERE `login`='$login' AND `validate`='$validate' AND `IP`='{$_SERVER['REMOTE_ADDR']}' AND UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`time`) < 60*60*24");
          setcookie("login",$user->login,time()+60*60*24,"/");
          setcookie("validate",$validate,time()+60*60*24,"/");

          $_SESSION['login']	= $user->login;
          $_SESSION['IP']	= $_SERVER['REMOTE_ADDR'];
          return TRUE;
        }
        else {
          unset($_SESSION['login']);
          unset($_SESSION['IP']);
          setcookie("login",'',time()-100,"/","");
          setcookie("validate",'',time()-100,"/","");
          return FALSE;
        }
      }
      else {
        unset($_SESSION['login']);
        unset($_SESSION['IP']);
        setcookie("login",'',time()-100,"/","");
        setcookie("validate",'',time()-100,"/","");
        return FALSE;
      }
    }
  }



 
/* ------------------------- */ ?>
