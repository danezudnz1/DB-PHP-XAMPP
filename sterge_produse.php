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
<div id="pageContent"><br/>
    <div align="center" style="margin-left:24px; ">
    <?php
if(isset($_GET['deleteid'])){
echo'Vrei sa stergi produsul cu id-ul '.$_GET['deleteid'].'?<a href="sterge_produse.php?yesdelete='.$_GET['deleteid'].'"> Yes</a>|<a href="sterge_produse.php">No</a>';
exit();
	}
if(isset($_GET['yesdelete'])){
	$id=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM Produse Where ProdusID='$id'") ;
		
	}	
?>
<?php
$product_list="";
$sql=mysql_query("Select * FROM Produse ORDER BY data_adaugarii DESC LIMIT 10");
$productCount=mysql_num_rows($sql);
if($productCount>0){
while($row=mysql_fetch_array($sql)){
$id=$row["ProdusID"];
$NumeProdus=$row["NumeProdus"];
//$data_adaugarii=strftime("%b %d %Y",strtotime($row["data_adaugarii"]));
$product_list.="$id- $NumeProdus &nbsp;&nbsp;&nbsp;<a href='sterge_produse.php?deleteid=$id'>Sterge </a> <br/>";
}
}else{$product_list="Nu exista produse";}

//  
?>
    <h2><strong>Lista produse</strong></h2>


<?php echo $product_list;?>
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