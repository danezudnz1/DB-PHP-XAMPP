<?php
error_reporting(E_ALL);;
ini_set('display_errors','1');
?>
     <?php
$con = mysql_connect("localhost","root","mate");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("magazin_de_cosmetice", $con);
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
<div id="pageContent">
 
<div align="center" style="margin-left:24px; ">
    <h2><strong>Detalii comanda</strong></h2>
    
    <p>
 
<?php

if(isset($_GET['pid'])){
$id=$_GET['pid'];

$product_list="";
$result = mysql_query("SELECT P.NumeProdus,P.CodProdus,P.Volum,D.PretUnitar,D.Cantitate From Produse P INNER JOIN detaliicomanda D ON P.ProdusID=D.ProdusID INNER JOIN comenzi C ON D.ComandaID=C.ComandaID  Where C.ComandaID='$id' ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$NumeProdus=$row["NumeProdus"];
$CodProdus=$row["CodProdus"];
$volum=$row["Volum"];
$pretunitar=$row["PretUnitar"];
$cantitate=$row["Cantitate"];

$product_list.="&bull; $NumeProdus -Cod: $CodProdus - $volum - $pretunitar RON - $cantitate prod<br/>";
}
}else{
$product_list="Nu exista produse";
}

$desc="";
$result = mysql_query("SELECT P.NumePromotie, P.CodPromotie, P.Pret From promotii P INNER JOIN comenzipromotii D ON P.PromotieID=D.PromotieID Where D.ComandaID='$id' ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$numepromotie=$row["NumePromotie"];
$codpromotie=$row["CodPromotie"];
$pret=$row["Pret"];
$desc.=" &bull; $numepromotie -Cod: $codpromotie - $pret RON  <br/>";
}
}else{
$desc="0";
}
$totalprom="";
$result = mysql_query("SELECT SUM(Pretunitar)+(Select SUM(Pret) FROM comenzipromotii Where ComandaID='$id') AS total From detaliicomanda  Where ComandaID='$id'  ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$tot=$row["total"];
if($tot==0){
	$totalprom="0 RON";
	}else{
$totalprom="  $tot RON";
}
}
}else{
$totalprom="0";
}

$total="";
$result = mysql_query("SELECT SUM(Pretunitar) AS total From detaliicomanda Where ComandaID='$id' ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$tot=$row["total"];

$total="  $tot RON";
}
}else{
$total="0";
}

$res = mysql_query("SELECT  CodComanda,DataComanda,NumeDestinatar,PrenumeDestinatar,AdresaDestinatarComanda,CodPostal, ModalitatePlata,ModalitateTransport From comenzi Where ComandaID='$id' ");
$productCount=mysql_num_rows($res);
if($productCount==0)
echo"Nu mai exista comanda";
else{
echo "<table border='1'>
<tr>
<th>CodComanda</th>
<th>DataComanda</th>
<th>NumeDestinatar</th>
<th>AdresaDestinatarComanda</th>
<th>ProduseComandate</th>
<th>PromotiiComandate</th>
<th>ModaliateTransport</th>
<th>ModaliatePlata</th>
<th>Total</th>
</tr>";
while($ro = mysql_fetch_array($res))
  {
  echo "<tr>";
   echo "<td>" . $ro["CodComanda"] . "</td>";
   echo "<td>" . $ro["DataComanda"] . "</td>";
  echo "<td>" . $ro['NumeDestinatar']." ".$ro["PrenumeDestinatar"]."</td>";
  echo "<td>" . $ro['AdresaDestinatarComanda'] .",CodPostal ".$ro['CodPostal']. "</td>";
  echo "<td>" . $product_list . "</td>";
 echo "<td>" .   $desc . "</td>";
   echo "<td>" . $ro['ModalitateTransport'] . "</td>";
     echo "<td>" . $ro['ModalitatePlata'] . "</td>";
	 echo "<td>" .   $totalprom. "</td>";
  echo "</tr>";
  }
  
  }
echo "</table>";

mysql_close($con);
}


?>
      <br/>
    </p>
    <p>&nbsp;</p>
    <p><br/>
      <br/>
    </p>
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