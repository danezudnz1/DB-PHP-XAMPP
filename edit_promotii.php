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
if(isset($_POST['NumePromotie'])){
$PromotieID = $_POST['thisID'];
$NumeProdus = $_POST['NumePromotie'];
$CodProdus = $_POST['CodPromotie'];
$TermenLimita = $_POST['TermenLimita'];
$Pret = $_POST['Pret'];
$LimitaStocului = $_POST['LimitaStocului'];
$sql =mysql_query( "UPDATE Promotii SET  NumePromotie='$NumePromotie',CodPromotie='$CodPromotie',TermenLimita='$TermenLimita',Pret='$Pret',LimtaStocului='$LimitaStocului',data_adaugarii='now()' Where PromotieID='$PromotieID'");
header("location:lista_promotii.php");

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
$sql=mysql_query("Select * FROM Promotii Where PromotieID='$targetID' LIMIT 1");
$productCount=mysql_num_rows($sql);
if($productCount>0){
while($row=mysql_fetch_array($sql)){
//$id=$row["ProdusID"];
$NumePromotie=$row["NumePromotie"];
$CodPromotie = $row["CodPromotie"];
$TermenLimita = $row["TermenLimita"];
$Pret = $row["Pret"];
$LimitaStocului = $row["LimitaStocului"];
}
}else
echo "sorry";

//  
	}	
?>
    <h2><strong>Modifica promotie</strong></h2>
<form action="edit_promotii.php" method="post" enctype="multipart/form-data">

	<table width="436" border="0" cellpadding="6">
	  <tr>
	    
	    <td><input name="thisID" type="hidden" id="PromotieID" value="<?php echo $targetID; ?>" /></td>
	    </tr>
	  <tr>
	    <td width="85">Nume promotie</td>
	    <td width="315"><input name="NumePromotie" type="text" id="NumePromotie" size="64" value="<?php echo $NumePromotie; ?>"/></td>
	    </tr>
	  <tr>
	    <td>CodPromotie</td>
	    <td><input type="text" name="CodProdus" id="Codprodus"value="<?php echo $CodPromotie; ?>" /></td>
	    </tr>
	  <tr>
	    <td>TermenLimita</td>
	    <td><input type="text" name="TermenLimita" id="BrandID" value="<?php echo $TermenLimita; ?>" /></td>
	    </tr>
	 
	  <tr>
	    <td>Pret</td>
	    <td><label for="pret"></label>
	      <input type="text" name="Pret" id="Pret" value="<?php echo $Pret; ?>"/></td>
	    </tr>
        <tr>
           <td>LimitaStocului</td>
	    <td><label for="unitatistoc"></label>
	      <input type="text" name="LimitaStocului" id="LimitaStocului" value="<?php echo $LimitaStocului; ?>"/></td>
	    </tr>
		  <tr>
	    <td colspan="2"><p>&nbsp;</p>
	      <p>
	        <label for="submit"></label>
	        <input type="submit" name="Submit" id="Submit" value="Salveaza promotie" />
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