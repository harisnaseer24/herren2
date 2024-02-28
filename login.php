<?php
require_once("./config/dbconfig.php"); 
if(isset($_POST["register"])){

	   //prevent sql injection real escape string
	   $username= mysqli_real_escape_string($connection, $_POST['name']);// 
	   $email= mysqli_real_escape_string($connection, $_POST['email']);
	   $password= mysqli_real_escape_string($connection, $_POST['password']);
	   $cpassword= mysqli_real_escape_string($connection, $_POST['cpassword']);
	   if($username=="" || $email== "" || $password== "" || $cpassword== ""){
		echo "<script>alert('Feilds Cannot be empty. Please Fill all fields..!')
		
		</script>;";
	   }elseif($password!=$cpassword){
		echo "<script>alert('Passwords does not match..!')
		
		</script>;";
	   }else{
	  $encrypedPassword=password_hash($password, PASSWORD_BCRYPT);
	//  echo  $encrypedPassword=MD5($password);
	$check="SELECT * FROM users WHERE email='$email';";
	$res=mysqli_query($connection,$check) or die("failed");
	
	if(mysqli_num_rows($res) > 0){
		echo "<script>alert('Already registered. Please Login Now..!.')
		window.location.href='login.php';
		</script>;";
	}
	else{
	   $insert="INSERT INTO `users` (`username`, `email`, `password`, `token`, `joined on`) VALUES  ('$username','$email','$encrypedPassword',NULL,current_timestamp());";
	   $result=mysqli_query($connection , $insert) or die("failed to insert query.");
	if($result){
	   echo "<script>alert('Account Succesfully Created.')
	   window.location.href='login.php';
	   </script>;";
	}
	else{
		echo "<script>alert('Failed to Create your account.')</script>";
	}}}
}
?>

<?php 
// header
include('./layout/header.php');
//menu
include('./layout/menu.php');
//cart modal
include('./layout/cart.php');

?>
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Register now to feel the power of Herren
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			
				<div class="bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="post" action="">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Enter your details
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Your Name">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Your Email Address">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

                        <div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="password" placeholder="Your password">
							<img class="how-pos4 pointer-none" src="images/icons/key.png" alt="ICON" height=20>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="cpassword" placeholder="Confirm your password">
							<img class="how-pos4 pointer-none" src="images/icons/key.png" alt="ICON" height=20>
						</div>
                        

						<button type="submit" name="register" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Register
						</button>
					</form>
				</div>

				
			
		</div>
	</section>	
	



	<!-- Footer -->
	<?php 
	//footer
	include('./layout/footer.php');
	//dependencies
	include('./layout/dependencies.php');
	?>
