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
/*
if(isset($_POST['CodProdus'])){
$NumeProdus=$_POST['NumeProdus'];
$CodProdus = $_POST['CodProdus'];
$BrandID = $_POST['BrandID'];
$CategorieID = $_POST['CategorieID'];
$UnitatiStoc = $_POST['UnitatiStoc'];
$Pret = $_POST['Pret'];
$Descriere = $_POST['Descriere'];
$Valabilitate = $_POST['Valabilitate'];
$Volum= $_POST['Volum'];
$Poza= $_POST['Poza'];
$sql=mysql_query("INSERT INTO Produse (NumeProdus, CodProdus, BrandID, CategorieID, UnitatiStoc, Pret, Descriere,Valabilitate,Volum,Poza,data_adaugarii)
VALUES
('$NumeProdus','$CodProdus','$BrandID','$CategorieID','$UnitatiStoc','$Pret','$Descriere','$Valabilitate','$Volum','$Poza',now())");
}
*/
?>
<?php

$product_list="";
$result = mysql_query("Select DISTINCT C.NumeClient,C.PrenumeClient,C.ClientID,C.Email From client C INNER JOIN comenzi O ON C.ClientID=O.ClientID Order by O.DataComanda DESC ");
$productCount=mysql_num_rows($result);
if($productCount>0){
while($row=mysql_fetch_array($result)){
$id=$row["ClientID"];
$Nume=$row["NumeClient"];
$Prenume=$row["PrenumeClient"];
$email=$row["Email"];
$product_list.="$id-$Nume $Prenume - $email &nbsp;&nbsp;&nbsp;<a href='trimite_email.php?pid=$id'>Trimite email </a> <br/>";
}
}else{$product_list="Nu exista clienti";}

if(isset($_GET['pid'])){
	$idul=$_GET['pid'];
	$ee="";
     $res = mysql_query("SELECT NumeClient,PrenumeClient,Email  From client Where ClientID='$idul'  ");
$product=mysql_num_rows($res);
if($product>0){
while($ro=mysql_fetch_array($res)){
$Nume=$ro["NumeClient"];
$Prenume=$ro["PrenumeClient"];
$email=$ro["Email"];
$ee.="$Nume $Prenume";
}
}

}


// Verifica daca au fost trimise datele de la formular
if ( isset($_POST['mesaj'])) {
    $to = 'adresa_ta@de.mail';                 // Adresa unde va fi trimis mesajul
    $subiect = 'Mesaj de pe site';
    $mesaj = $_POST['mesaj'];
    $from = 'From: '. $email;

    // PHP trimite datele la serverul de e-mail
    if (mail($to, $subiect, $mesaj, $from)) {
              echo 'Mesajul a fost trimis cu succes.';
    }
    else {
              echo 'Eroare, mesajul nu a putut fi expediat.';
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
 
       <h2 align=>Produse adaugate</h2>
  <?php echo $product_list; ?>
    <p>&nbsp;</p>
  </div>
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><br/>
  </p>

     <a name="form" id="form"></a>
  <div align="center" style="margin-left:24px; ">
    <h3>Trimiteti email clientului</h3>
    
<?php 
if(isset($_GET['pid'])){
	$idul=$_GET['pid'];
	$ee="";
     $res = mysql_query("SELECT NumeClient,PrenumeClient,Email  From client Where ClientID='$idul'  ");
$product=mysql_num_rows($res);
if($product>0){
while($ro=mysql_fetch_array($res)){
$Nume=$ro["NumeClient"];
$Prenume=$ro["PrenumeClient"];
$email=$ro["Email"];
$ee.="$Nume $Prenume";
}
}

}

echo $ee;

?>

<form name="form" method="post" action="trimite_email.php" enctype="multipart/form-data">

 <br /> <br /> <br />
<label>Scrie mesajul : </label> <br /> <br /> 
<textarea name="mesaj" cols="80" rows="10"></textarea> <br />
<input type="submit" value="Trimite" />
</form>


</div>
 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 <?php include_once("template_footer.php");?> 

</div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>