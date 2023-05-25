<?php
session_start();

if(isset($_SESSION["kullanici_adi"]))
{
	
	echo "<h3>".$_SESSION["kullanici_adi"]."hosgelidin";
	echo "<h3>".$_SESSION["email"]."</h3>";
	echo "<a href='cikis.php' style='color:red; background-color:yellow;Border:px solid red;  padding: 5px 5px '>Cikis Yap </a>";
	
}
else{
	echo "Bu sayfayı Goruntulme Yetkiniz Yoktur";
}


?>