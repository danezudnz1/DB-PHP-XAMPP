
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
    <h2><strong>Lista de produse</strong></h2>
   <?php
 
$con = mysql_connect("localhost","root","mate");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("magazin_de_cosmetice", $con);

$result = mysql_query("SELECT ProdusID, NumeProdus, NumeCategorie,NumeBrand, UnitatiStoc, Pret, Descriere FROM Produse INNER JOIN Categorii ON Produse.CategorieID=Categorii.CategorieID INNER JOIN Brands ON Produse.brandID=Brands.BrandID Order BY data_adaugarii DESC");
$productCount=mysql_num_rows($result);
if($productCount==0)
echo"Nu exista produse";
else{
echo "<table border='1'>
<tr>
<th>Nr</th>
<th>NumeProdus</th>
<th>NumeCategorie</th>
<th>NumeBrand</th>
<th>UnitatiStoc</th>
<th>Pret</th>
<th>Descriere</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
    echo "<td>" . $row['ProdusID'] . "</td>";
  echo "<td>" . $row['NumeProdus'] . "</td>";
  echo "<td>" . $row['NumeCategorie'] . "</td>";
  echo "<td>" . $row['NumeBrand'] . "</td>";
  echo "<td>" . $row['UnitatiStoc'] . "</td>";
  echo "<td>" . $row['Pret'] . "</td>";
  echo "<td>" . $row['Descriere'] . "</td>";
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