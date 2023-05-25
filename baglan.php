
	
<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname= uyelik", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "baglanti hatasi " . $e->getMessage();
}




function filtrele($deger)
{
	$bir=trim($deger);
	$iki=strip_tags($bir);
    $uc=htmlspecialchars($iki,ENT_QUOTES);
	$sonuc=$uc;
	
	  return $sonuc;
	
}
?>
