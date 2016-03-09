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
$product_list="";
$result = mysql_query("SELECT PromotieID, NumePromotie FROM Promotii  ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$PromotieID=$row["PromotieID"];	
$NumePromotie=$row["NumePromotie"];
$product_list.="$PromotieID- $NumePromotie &nbsp;&nbsp;&nbsp;<a href='sterge_promotie.php?deleteid=$PromotieID'>Sterge </a> <br/>";
}
}else{$product_list="Nu exista promotii";}

//  
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
echo'Vrei sa stergi promotia cu id-ul '.$_GET['deleteid'].'?<a href="sterge_promotie.php?yesdelete='.$_GET['deleteid'].'"> Yes</a>|<a href="sterge_promotie.php">No</a>';
exit();
	}
if(isset($_GET['yesdelete'])){
	$id=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM Promotii Where PromotieID='$id'") ;
	$sl=mysql_query("DELETE FROM DetaliiPromotii Where PromotieID='$id'") ;
	
	
	}	
	

?>
    <h2><strong>Lista promotii</strong></h2>


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