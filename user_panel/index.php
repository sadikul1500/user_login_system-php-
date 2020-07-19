<?php
	session_start();
	$id = 0;
	
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_GET['userName']);
	}
	
	elseif(isset($_GET['id'])){
		$id = 1; //echo 'no';
		//echo '<script type="text/javascript">','error();','</script>';
	}
	
?>


<html>
	<head>
		<title>Index Page</title>
		<script src="javascript.js"></script>
	</head>
	
	<body>
		<?php include('template/header.php') ?>
		<?php include('template/footer.php') ?>
		<!-- <script> alert('')</script> -->
		<?php
			if($id==1){
				echo '<script type="text/javascript">','error("Access denied to home page");','</script>';
				//$id = 1;
			}
			else{
				header('location:home.php');
			}
			
		?>
	</body>
</html>
