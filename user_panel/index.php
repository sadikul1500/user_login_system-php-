<?php
	session_start();
	
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_GET['userName']);
	}
?>


<html>
	<head>
		<title>Index Page</title>
	</head>
	
	<body>
		<?php include('template/header.php') ?>
		<?php include('template/footer.php') ?>
		
		
	</body>
</html>