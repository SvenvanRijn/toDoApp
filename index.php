<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	global $database;
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$sql = "SELECT id, username FROM users WHERE email='$email' AND password='$password'";
	$result = $database->prepare($sql);
	$userdata;
	try{
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		foreach ($result as $data){
			$userdata = $data;
		}
	}
	catch(PDOException $e){
		echo "<script> alert('iets ging fout'); </script>";
	}
	if ($userdata["id"] != 0) {
		$_SESSION['user_id'] = $userdata["id"];
		$_SESSION['username'] = $userdata['username'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert('E-mail of wachtwoord is fout.')</script>";
	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="welkomstyle.css">

	<title>TaDo App</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 600;">TaDo App</p>
			<div class="input-group">
				<input type="email" placeholder="Email-adres" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Wachtwoord" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Loggin</button>
			</div>
		<label>
        <input type="checkbox" checked="checked" name="remember"> Wachtwoord opslaan
      </label>
	  
			<p class="login-register-text">Heeft u geen account? <a href="register.php">Registeren Hier</a>.</p>
		</form>
	</div>
</body>
</html>