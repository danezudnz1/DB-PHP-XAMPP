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

<?php
if(isset($_GET['pid'])){
$i=$_GET['pid'];
echo  $i;

if(isset($_POST['Cod'])){
$Cod=$_POST['Cod'];
/*
$ProdusID="";
$res=mysql_query("Select ProdusID,NumeProdus From Produse Where CodProdus='$Cod'");
$productCount=mysql_num_rows($res);
if($productCount>0){

while($row=mysql_fetch_array($res)){
$ProdusID=$row["ProdusID"];
$NumeProdus=$row["NumeProdus"];
echo $ProdusID." ".$NumeProdus;
}

$Detalii=$_POST['Detalii'];
$sql=mysql_query("INSERT INTO DetaliiPromotii (`PromotieID`, `ProdusID`, `Descriere`) VALUES('$i','$ProdusID','$Detalii')");
}
*/
}
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
    <div align="right" style="margin-right:32px;"><a href="adauga_produse_promotie.php#form">+Adauga produs</a></div>

<?php

if(isset($_GET['pid'])){
$id=$_GET['pid'];
$product_list="";
//$promotie="";
$result = mysql_query("SELECT P.NumePromotie,P.CodPromotie,G.NumeProdus,G.CodProdus FROM Promotii  P INNER JOIN DetaliiPromotii D ON P.PromotieID=D.PromotieID INNER JOIN Produse G ON D.ProdusID=G.ProdusID AND P.PromotieID='$id' ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$NumeProdus=$row["NumeProdus"];
$CodProdus=$row["CodProdus"];
//$CodPromotie=$row["CodPromotie"];
//$NumePromotie=$row["NumePromotie"];

$product_list.="&bull; $NumeProdus - $CodProdus <br/>";

//$promotie.=" $CodProdus - $CodPromotie <br/>";
}
}else{
$product_list="Nu exista produse";
//$promotie="Nu exista observatii";
}

$lista="";
$res = mysql_query("SELECT PromotieID,NumePromotie,CodPromotie,data_adaugarii,TermenLimita,Pret,LimitaStocului FROM Promotii   Where PromotieID='$id' ");
$productCount=mysql_num_rows($res);
if($productCount==0)
echo"Nu exista produse";
else{
while($ro = mysql_fetch_array($res))
  {
$CodPromotie= $ro["CodPromotie"];
$NumePromotie= $ro["NumePromotie"];
 $lista="$NumePromotie - $CodPromotie <br/> Produse adaugate: <br/>$product_list";
  }
  
  }
 
mysql_close($con);
 echo $lista;
}


?>


    <p>&nbsp;</p>
  </div>
  
  <p>&nbsp;</p>
  <p><br/>
  </p>
   <a name="form" id="form"></a>
   
  <div align="center" style="margin-left:24px; ">
 
    <h2>Adauga produs</h2>
    
 <form action="adauga_produse_promotie.php"  method="post" enctype="multipart/form-data">

	<table width="436" border="0" cellpadding="6">
    

	  
	  <tr>
	    <td width="85">Nume produs</td>
	    <td width="315"><input type="text" name="Nume" id="Nume"  size="64"/></td>
	    </tr>
         <tr>
	    <td width="85">CodProdus</td>
	    <td width="315"><input name="Cod" type="text" id="Cod"  size="15" maxlength="7"/></td>
	    </tr>
	  <tr>
	    <td>Detalii</td>
	    <td><label for="Detalii"></label>
	      <textarea name="Detalii" id="Detalii" cols="45" rows="5"></textarea></td>
	    </tr>

	  <tr>
	    <td colspan="2"><p>&nbsp;</p>
	      <p>
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