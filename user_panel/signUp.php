<?php
	
	session_start();
	include('db_connect.php');
	//include('home.php');
	
	function validate_username($name){
		$allowed = array(".", "-", "_", '%'); 
		if(ctype_alnum(str_replace($allowed, '', $name ))) {
			return 1;
		} else {
			//$str = "Invalid Username";
			return 0;
		}
	}
	
	function validate_password($pass){
		if (strlen($pass) < '3') {
			echo "Your Password Must Contain At Least 3 Characters!";
			return 0;
		}
		if(!preg_match("#[0-9]+#",$pass)) {
			echo "Your Password Must Contain At Least 1 Number!";
			return 0;
		}
		
		return 1;
	}
	
	
	$userName = $password = $confirm_password = "";
	$errors = array('userName'=> '', 'password'=> '', 'confirm_password'=> '');
	
	
	if(isset($_POST['submit'])){
		//session_start();
		$userName = mysqli_real_escape_string($conn, $_POST['userName']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
		//echo $confirm_password;
		
		if (empty($userName)){
			$errors['userName'] = 'a username is required<br>';
		}
		
		if (empty($password)){
			$errors['password'] = 'a password is required<br>';
		}
		
		if($password != $confirm_password){
			$errors['confirm_password'] = 'please retype the same password<br>';
		}
		
		//echo count($errors);
		
		if (array_filter($errors)){
			echo 'wrong submission<br>';
		}
		
		else{
			if(!validate_username($userName))
			{
				echo "username can contain only alphanumeric values and ['.', '_', '-', '%']";
				//header('location:SignUp.php');
			}
			
			if(!validate_password($password))
			{
				//echo 'username can contain only alphanumeric values and ['.', '_', '-', '%' ]'
				//header('location:SignUp.php');
			}
			
			else{
				$sql = "select * from users where user_name='$userName'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) == 0){
				
					$sql = "insert into users(user_name, password) values('$userName', '$password')";
					$result = mysqli_query($conn, $sql);
					//echo 'okay';
				
					if($result){
						//echo 'submitted<br>';
						$_SESSION['message'] = "new account created successfully";
						$_SESSION['userName'] = $userName;
						
						mysqli_free_result($result);
						header('location:home.php');
					
						//header('Location: index.php');
					}
				}
				else{
					echo 'registration error: The username already exists' ;
				}
			}
			
			
				//$password = md5($password);
				
			
			
		}
		
		
	
	}
	mysqli_close($conn);
	
?>

<html>
	<head>
		<title>sign up.php</title>
	</head>
	<body>
		<?php include('template/header.php');?>
		
		<section class="container grey-text">
			<h4 class="center">Create an account</h4>
			<form class="white" action="SignUp.php" method="POST"> 
			
				<label> UserName:</label>
				<input type="text" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
				<div class="red-text"><?php echo $errors['userName']; ?></div>
				<!--<?php $errors['email'] = ''; $email= ' ';?> -->
			
			
			
				<label> Password:</label>
				<input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
				<div class="red-text"><?php echo $errors['password'];?></div>
			
			
			
				<label> Confirm Password:</label>
				<input type="password" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>">
				<div class="red-text"><?php echo $errors['confirm_password'];?></div>			
			
				<div class="center">
					<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
				</div>
				<p>
					Has an account? <a href="SignIn.php">Sign_In</a>
				</p>
				
			</form>
		</section>
		<?php include('template/footer.php');?>
	</body>


</html>