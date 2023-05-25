	<?php
include("baglan.php");
?>
<!doctype html>
<html lang ="tr-TR">
<head>
<meta http-equiv="content-Type" content="text/html";charset="utf-8">
<meta http-equiv="Content-Language" content="tr">
<meta charset="utf-8">
<title>Uye Giris Sayfasi</title>
</head>
<body>
	
	<link rel="stylesheet" href="a.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
		<?php
	
	$username_err="";

	
	
    $parola2_err="";
	
	if(isset($_POST["giris"]))
	{
		
		// username sorgusu
		if(empty($_POST["kullaniciadi"])){
			$username_err="kullanici adi bos geçilemez";
		}
          else if(strlen($_POST["kullaniciadi"])<6){
			     $username_err="kullanici adi en az 6 karkaterden olusmalıdır.";
		  }
		else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullaniciadi"])) {
			$username_err="kullanici  buyuk kucuk harf ve rakamdan olusmalidir";
				} 
		else{
			 $username=$_POST["kullaniciadi"];
		}

		
		//parola dogrulama kısmı
		
		
		 if(empty($_POST["parola"])){
		$parola_err="sifre bos gecilemez";	 
			 
			 
		 }
		else{
			$parola=$_POST["parola"];
		}
		
		
		// parola tekrar 
		
		 if(empty($_POST["parolatkr"]))
		 {
			 $parola2_err="parola tekrar ksımı bos gecilemez";
		 }
		else if( $_POST["parola"]!=$_POST["parolatkr"])
		{
			$parola2_err="parolalar uyusmuyor";
			
		}
		
		else{
			
			$parolatkr=$_POST["parolatkr"];
		}
		
		
		
		if(isset($username)&&isset($parola))
		{
	    $secim=$conn->prepare("Select * From  kullanicilar WHERE kullanici_adi ='$username',parola= '$parola'");
		$calistir=$secim->execute();
	    $kayitsayisi=$conn->rowCount();// 0 veya 1
			
			
					//$sorgukayitlari=$sorgu->fetchall(PDO::FETCH_ASSOC);
			if($kayitsayisi>0){
		  $ilgilikayit= $secim->FETCH(PDO::FETCH_ASSOC);
		  $hashlisifre=$ilgilikayit["parola"];
				
				
				
				if(password_verify($parola,$hashlisifre))
				   {
					
					  session_start();
				$_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
				$_SESSION["email"]=$ilgilikayit["email"];
				header("location:profile.php");	
	
					
					
					
								   
				   }
				
				else{
					echo'<div class="alert alert-Danger" role="alert">
parola yanlis
</div>';
		
					 
				}
				
				
				
				
				
				
			}
			else{
				 		  echo'<div class="alert alert-Danger" role="alert">
 Kullanici Adi yanlis
</div>';
			}
			
			
			
			
			
		}	
	}
	
	?>

	

	<div class=	"container p-5"> </div>
	<div class="card p-5">
	<form action="login.php" method="post">
		
		
		  <div class="mb-3">
			<label for="exampleInputEmail1" class="form-label">Kullanıcı Adı </label>
			<input type="text" class="form-control 
								<?php 
									  if(!empty($username_err)){
										  echo " is-invalid";
									  }
									  
							      ?>
									 
									 " id="exampleInputEmail1" name="kullaniciadi">
			    <div id="validationServer03Feedback" class="invalid-feedback">
     <?php  echo $username_err ?>
    </div>
		  </div>

		
		
		  <div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Sifre</label>
			<input type="password" class="form-control <?php 
										          if(!empty($parola_err))
													 {
													  
													  echo "is-invalid";
														 
													 }
										  
										  
										     
										                  ?>  " id="exampleInputPassword1" name="parola">
			      <div id="validationServer03Feedback" class="invalid-feedback">
  <?php echo $parola_err; ?>
    </div>
		  </div>
		
		
		 
		  <button type="submit" name="giris"class="btn btn-primary">Giris Yap</button>
</form>
</div>	
	
	
</body>
</html>
	
