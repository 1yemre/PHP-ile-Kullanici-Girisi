

<!doctype html>
<html lang ="tr-TR">
<head>
<meta http-equiv="content-Type" content="text/html";charset="utf-8">
<meta http-equiv="Content-Language" content="tr">
<meta charset="utf-8">
<title>Anasayfa</title>
</head>
<body>
	<?php
	
	if(isset($_POST["kaydet"]))
	{
		$name=$_POST["kullaniciadi"];
		$email=$_POST["email"];
		$password=$_POST["parola"];
		$ekle=$conn->prepare("INSERT INTO uye SET  ad='$name',email='$email',parola='$password'");
		$sonuc=$ekle->execute();
		
		if($sonuc){
			echo'<div class="alert alert-success" role="alert">
  Kayıt başarılı şekilde eklendi.
</div>';
		}
		else{'<div class="alert alert-danger" role="alert">
  kayıt eklenirken bir hata oluştu.
</div>';
			
		}
	}
	?>
	
	
	
</body>
</html>