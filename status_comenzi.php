
<?php
error_reporting(E_ALL);;
ini_set('display_errors','1');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Area</title>
<link rel="stylesheet" href="http://localhost/ADMIN/style/style.css" type="text/css" media="screen"/>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="http://localhost/ADMIN/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center" id="mainWrapper">

 <?php include_once("template_header.php");?> 
<div id="pageContent"><br/>
    <div align="center" style="margin-left:24px; ">
    <h2><strong>Comenzi</strong></h2>
   <?php
 
$con = mysql_connect("localhost","root","mate");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db("magazin_de_cosmetice", $con);
$com=""; 
$res = mysql_query("SELECT  C.ClientID,C.NumeClient,C.PrenumeClient,O.DataComanda,O.CodComanda FROM client C INNER JOIN comenzi O ON C.ClientID=O.ClientID Where O.Status='Trimisa' " );
$prom=mysql_num_rows($res);
if($prom==0)
echo"Nu exista clienti";
else{
while($ro = mysql_fetch_array($res)){
$id=$ro["ClientID"];	
$nume=$ro["NumeClient"];
$prenume=$ro["PrenumeClient"];
$data=$ro["DataComanda"];
$cod=$ro["CodComanda"];
 $com.="$id - $nume $prenume - $data - $cod&nbsp;&nbsp;&nbsp;<a href='detalii_comenzi.php?pid=$id'>Detalii </a> <br/>";
}
}
$net=""; 
$res = mysql_query("SELECT  C.ClientID,C.NumeClient,C.PrenumeClient,O.DataComanda,O.CodComanda FROM client C INNER JOIN comenzi O ON C.ClientID=O.ClientID Where O.Status='Netrimisa' " );
$prom=mysql_num_rows($res);
if($prom==0)
echo"Nu exista clienti";
else{
while($ro = mysql_fetch_array($res)){
$id=$ro["ClientID"];	
$nume=$ro["NumeClient"];
$prenume=$ro["PrenumeClient"];
$data=$ro["DataComanda"];
$cod=$ro["CodComanda"];
 $net.="$id - $nume $prenume - $data - $cod&nbsp;&nbsp;&nbsp;<a href='detalii_comenzi.php?pid=$cod'>Detalii </a> <br/>";
}
}
?>
</div>
  <table width="987" border="0">
      <tr>
        <td width="480"><div class="trimise" align="center"><strong>Comenzi trimise</strong></div></td>
        <td width="491"><div class="netrimise" align="center"><strong>Comenzi netrimise</strong></div></td>
      </tr>
      <tr>
        <td><div class="client1" align="center"><?php echo "$com"; ?></div></td>
        <td><div class="client2" align="center"><?php echo "$net"; ?></div></td>
      </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <?php include_once("template_footer.php");?> 

</div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>