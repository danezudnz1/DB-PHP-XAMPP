
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
    <h2><strong>Lista promotii</strong></h2>
   <?php
 
$con = mysql_connect("localhost","root","mate");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("magazin_de_cosmetice", $con);
$product_list="";
$result = mysql_query("SELECT PromotieID, NumePromotie FROM Promotii  ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$PromotieID=$row["PromotieID"];	
$NumePromotie=$row["NumePromotie"];
//$DataInceperii=$row["DataInceperii"];
//$TermenLimita=strftime("%b %d %Y",strtotime($row["TermenLimita"]));
$product_list.="$PromotieID- $NumePromotie &nbsp;&nbsp;&nbsp;<a href='edit_promotii.php?pid=$PromotieID'>Edit </a> <br/>";
}
}else{$product_list="Nu exista promotii";}

 echo $product_list; 
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