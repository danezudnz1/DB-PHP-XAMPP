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
    <h2><strong>Produse cumparate</strong></h2>
    
    <p>
 
<?php
$res = mysql_query("Select C.NumeProdus,C.CodProdus,C.Pret,B.NumeBrand,T.NumeCategorie,(Select SUM(D.Cantitate) From DetaliiComanda D Where C.ProdusID=D.ProdusID  )AS Nr
 FROM Produse C,Brands B,Categorii T
Where C.BrandID=B.BrandID AND C.CategorieID=T.CategorieID AND
 C.ProdusID IN (Select ProdusID From DetaliiComanda) ");
$productCount=mysql_num_rows($res);

if($productCount==0)
echo"Nu s-a cumparat niciun produs";
else{
echo "<table border='1'>
<tr>
<th>NumeProdus</th>
<th>CodProdus</th>
<th>NumeBrand</th>
<th>NumeCategorie</th>
<th>Pret</th>
<th>NrProduse</th>
</tr>";
while($ro = mysql_fetch_array($res))
  {
  echo "<tr>";
   echo "<td>" . $ro["NumeProdus"] . "</td>";
   echo "<td>" . $ro["CodProdus"] . "</td>";
  echo "<td>" . $ro['NumeBrand']."</td>";
  echo "<td>" . $ro['NumeCategorie'] . "</td>";
    echo "<td>" . $ro['Pret'] . " RON</td>";
  echo "<td>" . $ro['Nr'] . "</td>";

  echo "</tr>";
  }
  
  }
echo "</table>";

mysql_close($con);




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