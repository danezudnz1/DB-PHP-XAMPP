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
if(isset($_POST['CodPromotie'])){
$NumePromotie=$_POST['NumePromotie'];
$CodPromotie = $_POST['CodPromotie'];
$TermenLimita = $_POST['TermenLimita'];
$Pret = $_POST['Pret'];
$LimitaStocului = $_POST['LimitaStocului'];
$sql=mysql_query("INSERT INTO Promotii (NumePromotie, CodPromotie,data_adaugarii, TermenLimita,Pret,LimitaStocului)
VALUES
('$NumePromotie','$CodPromotie',now(),'$TermenLimita','$Pret','$LimitaStocului')");
}
?>

<?php
$product_list="";
$result = mysql_query("SELECT PromotieID,NumePromotie,data_adaugarii FROM Promotii");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$PromotieID=$row["PromotieID"];
$NumePromotie=$row["NumePromotie"];
$data_adaugarii=$row["data_adaugarii"];
$product_list.="&bull; $PromotieID - $NumePromotie - $data_adaugarii &nbsp;&nbsp;&nbsp;<a href='adauga_produse_promotie.php?pid=$PromotieID'>Adauga produse </a><br/>";

}
}else{
$product_list="Nu exista promotii";
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
<div id="pageContent">
  <div align="left" style="margin-left:24px;">
    <div align="right" style="margin-right:32px;"><a href="adauga_promotie.php#form">+Adauga promotie</a></div>
   
    <h2 align=>Promotii adaugate</h2>
    <?php echo $product_list; ?>
    <p>&nbsp;</p>
  </div>
  
  <p>&nbsp;</p>
  <p><br/>
  </p>
   <a name="form" id="form"></a>
  <div align="center" style="margin-left:24px; ">
 
    <h2>Adauga promotie</h2>
    
 <form action="adauga_promotie.php"  method="post" enctype="multipart/form-data">

	<table width="436" border="0" cellpadding="6">
    
	  <tr>
	    <td width="85">Nume promotie</td>
	    <td width="315"><input type="text" name="NumePromotie" id="NumePromotie"  size="64"/></td>
	    </tr>
	  <tr>
	    <td>CodPromotie</td>
	    <td><input type="text" name="CodPromotie" id="CodPromotie" /></td>
	    </tr>
	  <tr>
	    <td>TermenLimita</td>
	    <td><input type="text" name="TermenLimita" id="TermenLimita" /></td>
	    </tr>
	  <tr>
	    <td>Pret</td>
	    <td><label for="categorieID"></label>
	      <input type="text" name="Pret" id="Pret" /></td>
	    </tr>
	  <tr>
	    <td>LimitaStocului</td>
	    <td><label for="LimitaStocului"></label>
	      <input type="text" name="LimitaStocului" id="LimitaStocului" /></td>
	    </tr>
	  <tr>
	    <td colspan="2"><p>
	      <label for="submit"></label>
	        <input type="submit" name="Submit" id="Submit" value="Adauga promotie" />
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