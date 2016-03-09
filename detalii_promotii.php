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
  <div align="right" style="margin-right:32px;"><a href="sterge_promotie">Sterge promotie</a></div>
  <div align="right" style="margin-right:32px;"><a href="modifica_promotie.php#form">Modifica promotie</a><br/>
  </div>
<div align="center" style="margin-left:24px; ">
    <h2><strong>Detalii promotie</strong></h2>
    
    <p>
 
<?php
if(isset($_GET['pid'])){
$id=$_GET['pid'];

$product_list="";
$desc="";
$result = mysql_query("SELECT P.PromotieID,G.ProdusID,G.NumeProdus,G.CodProdus,D.Descriere FROM Promotii  P INNER JOIN DetaliiPromotii D ON P.PromotieID=D.PromotieID INNER JOIN Produse G ON D.ProdusID=G.ProdusID AND P.PromotieID='$id' ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$NumeProdus=$row["NumeProdus"];
$CodProdus=$row["CodProdus"];
$descriere=$row["Descriere"];
$product_list.="&bull; $NumeProdus - $CodProdus <br/>";
$desc.=" &bull; $descriere <br/>";
}
}else{
$product_list="Nu exista produse";
$desc="Nu exista observatii";
}


$res = mysql_query("SELECT PromotieID,NumePromotie,CodPromotie,data_adaugarii,TermenLimita,Pret,LimitaStocului FROM Promotii   Where PromotieID='$id' ");
$productCount=mysql_num_rows($res);
if($productCount==0)
echo"Nu exista produse";
else{
echo "<table border='1'>
<tr>
<th>PromotieID</th>
<th>NumePromotie</th>
<th>CodPromotie</th>
<th>DataAdaugarii</th>
<th>TermenLimita</th>
<th>Produse</th>
<th>Pret</th>
<th>LimitaStocului</th>
<th>Observatii</th>
</tr>";
while($ro = mysql_fetch_array($res))
  {
  echo "<tr>";
   echo "<td>" . $ro["PromotieID"] . "</td>";
   echo "<td>" . $ro["NumePromotie"] . "</td>";
  echo "<td>" . $ro['CodPromotie'];
  echo "<td>" . $ro['data_adaugarii'] . "</td>";
  echo "<td>" . $ro['TermenLimita'] . "</td>";
 echo "<td>" .   $product_list . "</td>";
   echo "<td>" . $ro['Pret'] . "</td>";
     echo "<td>" . $ro['LimitaStocului'] . "</td>";
	 echo "<td>" .   $desc. "</td>";
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