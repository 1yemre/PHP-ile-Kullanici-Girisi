<?php
include("baglan.php");
?>
<!doctype html>
<html lang="tr-TR">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="Content-Language" content="tr">
<meta charset="utf-8">
<title>index</title>
	<link rel="stylesheet" href="a.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
		<?php
	
	$username_err="";
	$email_err="";
	$parola_err=""
	;
    $parola2_err="";
	
	if(isset($_POST["kaydet"]))
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
		// email sorgusu
		
		if(empty($_POST["email"]))
		{
			$email_err="email alanı bos gecilemez";
		}
		/*
		else if (!preg_match("/^[a-zA-Z-' ]*$/",$email)) {
        $email_err = "gecersiz  email formati";

			
		}
		*/
		else{
			
			$email=$_POST["email"];
		}
		
		//parola dogrulama kısmı
		
		
		 if(empty($_POST["parola"])){
		$parola_err="sifre bos gecilemez";	 
			 
			 
		 }
		else{
			$parola=password_hash($_POST["parola"],PASSWORD_DEFAULT);
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
		
		
		
		if(isset($username)&&isset($email)&&isset($parola))
		{
		//$name=$_POST["kullaniciadi"];
		//$email=$_POST["email"];
	 //$password=password_hash($_POST["parola"],PASSWORD_DEFAULT);
		$ekle=$conn->prepare("INSERT INTO kullanicilar SET  kullanici_adi='$username',email='$email',parola='$parola'");
		$sonuc=$ekle->execute();
		
		if($sonuc){
			echo'<div class="alert alert-success" role="alert">
  Kayıt başarılı şekilde eklendi.
</div>';
		}
		else{
			echo '<div class="alert alert-danger" role="alert">
  kayıt eklenirken bir hata oluştu.
</div>';
			
		}	
	}
	}
	?>

	

	<div class=	"container p-5"> </div>
	<div class="card p-5">
	<form action="kayit.php" method="post">
		
		
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
			<label for="exampleInputEmail1" class="form-label">Email address</label>
			<input type="text" class="form-control
									      <?php
	                                       if(!empty($email_err))
											  {
												  echo "is-invalid";
											  }
	                                           
	                                       ?>
			 " id="exampleInputEmail1" name="email">
			      <div id="validationServer03Feedback" class="invalid-feedback">
     <?php  echo $email_err; ?>
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
		
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Sifre 2</label>
			<input type="password" class="form-control <?php
				                   if(!empty($parola2_err))
									  {
										  echo " is-invalid"; 
									  }
				   
				                    
				        ?>
							" id="exampleInputPassword1" name="parolatkr">
			      <div id="validationServer03Feedback" class="invalid-feedback">
   <?php  echo $parola2_err;?>
    </div>
		  </div>
		 
		 
		  <button type="submit" name="kaydet"class="btn btn-primary">KAYDET</button>
</form>
</div>	
	

	
</body>
</html>