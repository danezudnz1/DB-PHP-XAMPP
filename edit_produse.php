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
if(isset($_POST['NumeProdus'])){
$ProdusID = $_POST['thisID'];
$NumeProdus = $_POST['NumeProdus'];
$CodProdus = $_POST['CodProdus'];
$BrandID = $_POST['BrandID'];
$CategorieID = $_POST['CategorieID'];
$UnitatiStoc = $_POST['UnitatiStoc'];
$Pret = $_POST['Pret'];
$Descriere = $_POST['Descriere'];
$Valabilitate = $_POST['Valabilitate'];
$Volum= $_POST['Volum'];
//$Poza = $_POST['Poza'];
$sql =mysql_query( "UPDATE Produse SET 
				  NumeProdus='$NumeProdus',CodProdus='$CodProdus',BrandID='$BrandID',CategorieID='$CategorieID',UnitatiStoc='$UnitatiStoc',Pret='$Pret',Descriere='$Descriere',Valabilitate='$Valabilitate',Volum='$Volum',data_adaugarii='now()' Where ProdusID='$ProdusID'");
header("location:lista_produse.php");

}
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
    <?php
if(isset($_GET['pid'])){
$targetID=$_GET['pid'];
$sql=mysql_query("Select * FROM Produse Where ProdusID='$targetID' LIMIT 1 ORDER BY data_adaugarii");
$productCount=mysql_num_rows($sql);
if($productCount>0){
while($row=mysql_fetch_array($sql)){

$NumeProdus=$row["NumeProdus"];
$CodProdus = $row["CodProdus"];
$BrandID = $row["BrandID"];
$CategorieID = $row["CategorieID"];
$UnitatiStoc = $row["UnitatiStoc"];
$Pret = $row["Pret"];
$Descriere = $row["Descriere"];
$Valabilitate = $row["Valabilitate"];
$Volum= $row["Volum"];
}
}else
echo "sorry";

//  
	}	
	

?>
    <h2><strong>Modifica produs</strong></h2>
<form action="edit_produse.php" method="post" enctype="multipart/form-data">

	<table width="436" border="0" cellpadding="6">
	  <tr>
	    
	    <td><input name="thisID" type="hidden" id="ProdusID" value="<?php echo $targetID; ?>" /></td>
	    </tr>
	  <tr>
	    <td width="85">Nume produs</td>
	    <td width="315"><input name="NumeProdus" type="text" id="NumeProdus" size="64" value="<?php echo $NumeProdus; ?>"/></td>
	    </tr>
	  <tr>
	    <td>CodProdus</td>
	    <td><input type="text" name="CodProdus" id="Codprodus"value="<?php echo $CodProdus; ?>" /></td>
	    </tr>
	  <tr>
	    <td>BrandID</td>
	    <td><input type="text" name="BrandID" id="BrandID" value="<?php echo $BrandID; ?>" /></td>
	    </tr>
	  <tr>
	    <td>CategorieID</td>
	    <td><label for="categorieID"></label>
	      <input type="text" name="CategorieID" id="CategorieID"value="<?php echo $CategorieID; ?>" /></td>
	    </tr>
	  <tr>
	    <td>UnitatiStoc</td>
	    <td><label for="unitatistoc"></label>
	      <input type="text" name="UnitatiStoc" id="UnitatiStoc" value="<?php echo $UnitatiStoc; ?>"/></td>
	    </tr>
	  <tr>
	    <td>Pret</td>
	    <td><label for="pret"></label>
	      <input type="text" name="Pret" id="Pret" value="<?php echo $Pret; ?>"/></td>
	    </tr>
	  <tr>
	    <td>Descriere</td>
	    <td><label for="descriere"></label>
	      <textarea name="Descriere" id="Descriere" cols="45" rows="5" value="<?php echo $Descriere; ?>"></textarea></td>
	    </tr>
	  <tr>
	    <td>Valabilitate</td>
	    <td><label for="valabilitate"></label>
	      <input type="text" name="Valabilitate" id="Valabilitate"value="<?php echo $NumeProdus; ?>" /></td>
	    </tr>
	  <tr>
	    <td>Volum</td>
	    <td><label for="volum"></label>
	      <input type="text" name="Volum" id="Volum" value="<?php echo $Valabilitate; ?>"/></td>
	    </tr>
	 
	  <tr>
	    <td colspan="2"><p>&nbsp;</p>
	      <p>
	        <label for="submit"></label>
	        <input type="submit" name="Submit" id="Submit" value="Salveaza produs" />
	      </p></td>
	    </tr>
	  </table>
	<p>    
 </form

  ><br/><br/><br/>
 
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