
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
    <h2><strong>Clienti</strong></h2>
   <?php
 
$con = mysql_connect("localhost","root","mate");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("magazin_de_cosmetice", $con);
$result = mysql_query("SELECT O.ComandaID, C.NumeClient,C.PrenumeClient,COUNT(O.ClientID) AS NR FROM client C INNER JOIN comenzi O ON C.ClientID=O.ClientID GROUP BY O.ClientID" );

$productCount=mysql_num_rows($result);
if($productCount==0)
echo"Nu exista clienti";
else{
echo "<table border='1'>
<tr>

<th>NumeClient</th>
<th>NrComenziProduse</th>
<th>NrComenziPromotii</th>
</tr>";

while($row = mysql_fetch_array($result))
  {$comanda=$row["ComandaID"];
  $promotii="";
$res = mysql_query("SELECT ComandaID, COUNT(*) AS PROM FROM  comenzipromotii  Where ComandaID='$comanda'" );
$prom=mysql_num_rows($res);
if($prom==0)
echo"Nu exista clienti";
else{
while($ro = mysql_fetch_array($res)){
$com=$ro["ComandaID"];
$prom=$ro["PROM"];	
$promotii="$prom ";
}
}
  echo "<tr>";
    echo "<td>" . $row['NumeClient']." " .$row['PrenumeClient']. "</td>";
	echo "<td>" . $row['NR']. "</td>";
	echo "<td >" .$promotii. "</td>";
	

  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
}
?>
  <br/><br/><br/>
 
</div>

 <?php include_once("template_footer.php");?> 

</div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>