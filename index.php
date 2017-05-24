<?php

    include("bootstrap.php");
	
	if (!isset($_SESSION['loggedIn'])){		
		$_SESSION['loggedIn']=false;
	}
	
	if (isset($_POST['username'])){
		logIn($_POST['username'], $_POST['password']);
	}

	if (isloggedIn()) {
		header("Location: /cms/Skolica/user.php");
	}
	
?>
<!DOCTYPE html>
<html>	
	<head>
	<title>Skolica</title>
	<meta charset="UTF-8">
	<link rel="styleseet" type="text/css" href="log_in.css">
	</head>
<?php
	
	if(isset($_GET['msg']) && (strlen($_GET['msg'])> 0 )) {
		echo 'Nemate Pristup Stranicii !!!';
	}
?>

<form action="" method="POST">

<input type="text" name="username" />
<input type="password" name="password" />

<input type="submit" value="Login" />

</form>
</body>
</html>