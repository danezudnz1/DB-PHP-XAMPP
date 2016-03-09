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
<div align="left">
<?php
$total="";
$result=mysql_query("Select Count(*) AS total From produse Where UnitatiStoc=0 ");
$count=mysql_num_rows($result);
if($count==0){
echo "0 produse";
}
else{
while($row = mysql_fetch_array($result)){
	$total=$row["total"];
	}
	}
  echo "TOTAL: $total produse";  
  ?>
</div>  
<div align="center" style="margin-left:24px; ">
    <h2><strong>Produse low stock</strong></h2>
    
    <p>
 
<?php


	
$res = mysql_query("Select  C.NumeProdus, C.CodProdus,C.Pret, B.NumeBrand, T.NumeCategorie, C.data_adaugarii From produse C INNER JOIN brands B ON C.BrandID=B.BrandID INNER JOIN categorii T ON C.CategorieID=T.CategorieID 
				   Where C.ProdusID IN (Select ProdusID FROM produse Where UnitatiStoc=0)
				   Order by C.data_adaugarii");
$productCount=mysql_num_rows($res);

if($productCount==0)
echo"0";
else{
echo "<table border='1'>
<tr>
<th>NumeProdus</th>
<th>CodProdus</th>
<th>NumeBrand</th>
<th>NumeCategorie</th>
<th>Pret</th>
<th>Data Adaugarii</th>
</tr>";
while($ro = mysql_fetch_array($res))
  {
  echo "<tr>";
   echo "<td>" . $ro["NumeProdus"] . "</td>";
   echo "<td>" . $ro["CodProdus"] . "</td>";
   echo "<td>" . $ro["NumeBrand"] . "</td>";
   echo "<td>" . $ro["NumeCategorie"] . "</td>";
   echo "<td>" . $ro["Pret"] . "</td>";
   echo "<td>" . $ro["data_adaugarii"] . "</td>";
  echo "</tr>";
  }
 
  }
echo "</table>";

mysql_close($con);




?>
<br/>
<br/>

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