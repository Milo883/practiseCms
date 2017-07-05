<?php

    include("bootstrap.php");
	
	if (!isset($_SESSION['loggedIn'])){		
		$_SESSION['loggedIn']=false;
	}
	
	if (isset($_POST['username'])){
		logIn($_POST['username'], $_POST['password']);
	}

	if (isloggedIn()) {
		header("Location: /practiceCms/user.php");
	}
	
?>
<!DOCTYPE html>
<html>	
	<head>
	<title>Skolica</title>
	<meta charset="UTF-8">
	<link rel="styleseet" type="text/css" href="log_in.css" >
	</head>
    <body>
<?php
	
	if(isset($_GET['msg']) && (strlen($_GET['msg'])> 0 )) {
		echo 'Nemate Pristup Stranicii !!!';
	}
?>

<form action="" method="POST">

<input type="text" name="username" /><br>
<input type="password" name="password" /><br>

<input type="submit" value="Login" />

</form>
</body>
</html>