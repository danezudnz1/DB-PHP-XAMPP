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
<?php
if(isset($_GET['deleteid'])){
	echo'do you really '.$_GET['deleteid'].'?<a href="index.php">YES</a>|<a href="sterge_produse.php">NO</a>';
	exit();
	}
?>

<?php

if(isset($_POST['Submit'])){
$NumeProdus=$_POST['NumeProdus'];
$CodProdus = $_POST['CodProdus'];
$NumeBrand = $_POST['brand'];
$NumeCategorie = $_POST['categorie'];
$UnitatiStoc = $_POST['UnitatiStoc'];
$Pret = $_POST['Pret'];
$Descriere = $_POST['Descriere'];
$Valabilitate = $_POST['Valabilitate'];
$Volum= $_POST['Volum'];

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

$sql=mysql_query("INSERT INTO Produse (NumeProdus, CodProdus, BrandID, CategorieID, UnitatiStoc, Pret, Descriere,Valabilitate,Volum,data_adaugarii)
VALUES
('$NumeProdus','$CodProdus','$bran','$cat','$UnitatiStoc','$Pret','$Descriere','$Valabilitate','$Volum',now())");
}

?>
<?php

$product_list="";
$result = mysql_query("SELECT ProdusID, NumeProdus, NumeCategorie,NumeBrand,data_adaugarii, UnitatiStoc, Pret, Descriere FROM Produse INNER JOIN Categorii ON Produse.CategorieID=Categorii.CategorieID INNER JOIN Brands ON Produse.brandID=Brands.BrandID Order by data_adaugarii DESC LIMIT 10");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$id=$row["ProdusID"];
$NumeProdus=$row["NumeProdus"];
$data_adaugarii=strftime("%b %d %Y",strtotime($row["data_adaugarii"]));
$product_list.="$id-$NumeProdus - $data_adaugarii d&nbsp;&nbsp;&nbsp;<a href='edit_produse.php?pid=$id'>edit </a>&bull; <a href='sterge_produse.php?deleteid=$id'>sterge</a> <br/>";
}
}else{$product_list="Nu exista produse";}

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
    <div align="right" style="margin-right:32px;"><a href="adauga_produse.php#form">+Adauga produs</a></div>
   
    <h2 align=>Produse adaugate</h2>
    <?php echo $product_list; ?>
    <p>&nbsp;</p>
  </div>
  
  <p>&nbsp;</p>
  <p><br/>
  </p>
   <a name="form" id="form"></a>
  <div align="center" style="margin-left:24px; ">
 
    <h2>Adauga produse</h2>
    
 <form action="adauga_produse.php"  method="post" enctype="multipart/form-data">

	<table width="436" border="0" cellpadding="6">
	  <tr>
	    <td width="85">Nume produs</td>
	    <td width="315"><input type="text" name="NumeProdus" id="NumeProdus"  size="64"/></td>
	    </tr>
	  <tr>
	    <td>CodProdus</td>
	    <td><input type="text" name="CodProdus" id="CodProdus" /></td>
	    </tr>
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
	    <td>UnitatiStoc</td>
	    <td><label for="unitatistoc"></label>
	      <input type="text" name="UnitatiStoc" id="UnitatiStoc" /></td>
	    </tr>
	  <tr>
	    <td>Pret</td>
	    <td><label for="pret"></label>
	      <input type="text" name="Pret" id="Pret" /></td>
	    </tr>
	  <tr>
	    <td>Descriere</td>
	    <td><label for="descriere"></label>
	      <textarea name="Descriere" id="Descriere" cols="45" rows="5"></textarea></td>
	    </tr>
	  <tr>
	    <td>Valabilitate</td>
	    <td><label for="valabilitate"></label>
	      <input type="text" name="Valabilitate" id="Valabilitate" /></td>
	    </tr>
	  <tr>
	    <td>Volum</td>
	    <td><label for="volum"></label>
	      <input type="text" name="Volum" id="Volum" /></td>
	    </tr>
	 
	  <tr>
	    <td colspan="2"><p>&nbsp;</p>
	      <p>
	        <label for="submit"></label>
	        <input type="submit" name="Submit" id="Submit" value="Adauga produs" />
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