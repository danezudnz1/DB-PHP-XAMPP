<?php
error_reporting(E_ALL);;
ini_set('display_errors','1');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Log In</title>
<link rel="stylesheet" href="http://localhost/ADMIN/style/style.css" type="text/css" media="screen"/>
<script src="http://localhost/ADMIN/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="http://localhost/ADMIN/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center" id="mainWrapper">

 <?php include_once("header_autentificare.php");?> 
<div id="pageContent"><br/>
 <div align="center" style="margin-left:24px; ">
  <h2>Please Log In To Manage the store</h2>
<?php
  require_once('config.php');

if(!isset($_GET['actiune'])) $_GET['actiune'] = '';

switch($_GET['actiune'])
{
case '':
echo '<form action="admin_login.php?actiune=validare" method="post">
    <table width="100%" border="0" cellpadding="0" cellspacing="7">
        <tr>
            <td width="40%" align="right">Username</td>
            <td><p>
              <input type="text" name="user" value="" />
            </p></td>
        </tr>
        <tr>
            <td align="right">Parola</td>
            <td><input type="password" name="parola" value="" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Login" value="Login" /></td>
        </tr>
    </table>
</form>';
break;

case 'validare':

$_SESSION['user'] = $_POST['user'];
//$_SESSION['parola'] = $_POST['parola'];
if(($_POST['user'] == '') || ($_POST['parola'] == ''))
{
echo 'Completeaza casutele. <Br> 
      Apasati <a href="admin_login.php">aici</a> pentru a va intoarce la pagina precedenta.';
}
else
{//$user=$_POST['user'];
//$parola=md5($_POST['parola']);
//$cerereSQL = "SELECT * FROM admin WHERE utilizator='$user' AND parola='$parola'LIMIT 1";
$cerereSQL = "SELECT * FROM `admin` WHERE utilizator='".htmlentities($_POST['user'])."' AND parola='".md5($_POST['parola'])."'";
$rezultat = mysql_query($cerereSQL);
if(mysql_num_rows($rezultat) == 1)
{
  while($rand = mysql_fetch_array($rezultat))
  {//$id=$row["id"];
 
 
//$_SESSION['id']=$id;
//$_SESSION['utilizator']=$user;
//$_SESSION['parola']=$password;
$_SESSION['logat'] = 'Da';
    echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin_login.php">';
  }
}
else
{
echo '<strong>Date incorecte. </strong><br> 
      Apasati <a href="admin_login.php">aici</a> pentru a incerca din nou.';
}

}
break;
}
?>
    <p>&nbsp;</p>
    </div>
    <br/><br/><br/>
    </div>

 <?php include_once("../template_footer.php");?> 

</div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>