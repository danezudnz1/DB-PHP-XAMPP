<?php
$con = mysql_connect("localhost","root","mate");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("magazin_de_cosmetice", $con);
?>
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
<div id="pageContent">
  <div align="left" style="margin-left:24px;">
   <div align="right" style="margin-right:32px;"><a href="cauta_produs.php#form">+Cauta produse</a></div>
<?php

if(isset($_POST['Submit'])){
//$NumeProdus=$_POST['NumeProdus'];
$NumeBrand = $_POST['brand'];
$NumeCategorie = $_POST['categorie'];
$Pret = $_POST['Pret'];
$bran="";
$result=mysql_query("Select BrandID From brands Where NumeBrand='$NumeBrand' ");
$count=mysql_num_rows($result);
if($count==0){
echo "0 ";
}
else{
while($row = mysql_fetch_array($result)){
	$bran=$row["BrandID"];
	}
	}
	
	$cat="";
$result=mysql_query("Select CategorieID From categorii Where NumeCategorie='$NumeCategorie' ");
$count=mysql_num_rows($result);
if($count==0){
echo "0 ";
}
else{
while($row = mysql_fetch_array($result)){
	$cat=$row["CategorieID"];
	}
	}


$result = mysql_query("SELECT ProdusID, NumeProdus,data_adaugarii, UnitatiStoc,Pret,Descriere FROM Produse Where CategorieID='$cat' OR BrandID='$bran' Order by Pret DESC ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
echo "<table border='1'>
<tr>

<th>ProdusID</th>
<th>NumeProdus</th>
<th>DataAdaugarii</th>
<th>UnitatiStoc</th>
<th>Pret</th>
<th>Descriere</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
    echo "<td>" . $row['ProdusID'] . "</td>";
  echo "<td>" . $row['NumeProdus'] . "</td>";
  echo "<td>" . $row['data_adaugarii'] . "</td>";
  echo "<td>" . $row['UnitatiStoc'] . "</td>";
  echo "<td>" . $row['Pret'] . "</td>";
  echo "<td>" . $row['Descriere'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
}
}else{$product_list="Nu exista produse";}
}

?>
   
    
    <p>&nbsp;</p>
  </div>
  
  <p>&nbsp;</p>
  <p><br/>
  </p>
   <a name="form" id="form"></a>
  <div align="center" style="margin-left:24px; ">
 
    <h2>Cauta produse</h2>
    
 <form action="cauta_produs.php"  method="post" enctype="multipart/form-data">

	<table width="436" border="0" cellpadding="6">

	  <tr>
	    <td>Brand</td>
	    <td><label for="brand"></label>
	      <select name="brand" id="brand">
	        <option value="Max Factor">Max Factor</option>
	        <option value="Gerovital Plant">Gerovital Plant</option>
	        <option value="L'oreal">L'Oreal</option>
	        <option value="Mirlans">Mirlans</option>
	        <option value="deborah Milano">Deborah Milano</option>
	        <option value="Revlon">Revlon</option>
	        <option value="Farmec">Farmec</option>
	        <option value="Maybelline">Maybelline</option>
	        <option value="Calvin Klein">Calvin Klein</option>
          </select></td>
	    </tr>
	  <tr>
	    <td>Categorie</td>
	    <td><label for="categorieID">
	      <select name="categorie" id="categorie">
	        <option value="Buze">Buze</option>
	        <option value="Fata">Fata</option>
	        <option value="Ochi">Ochi</option>
	        <option value="Crema">Crema</option>
	        <option value="Unghii">Unghii</option>
	        <option value="Ingrijire Corporala">Ingrijire Corporala</option>
	        <option value="Par">Par</option>
	        <option value="Parfum">Parfum</option>
	        <option value="Barbati">Barbati</option>
	        <option value="Accesorii Cosmetice">Accesorii Cosmetice</option>
          </select>
	    </label></td>
	    </tr>
	 
	  <tr>
	    <td colspan="2"><p>&nbsp;</p>
	      <p>
	        <label for="submit"></label>
	        <input type="submit" name="Submit" id="Submit" value="Cauta" />
	      </p></td>
	    </tr>
	  </table>
	<p>    
 </form>


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