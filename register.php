<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		global $database;
		$query = "SELECT * FROM users WHERE email='$email'";
		$sql = $database->prepare($query);
		$result;
		try{
			$sql->execute($data);
            $sql->setFetchMode(PDO::FETCH_ASSOC);
			foreach ($sql as $data){
				$result = $data;
			}
		}
		catch(PDOException $e){
			echo "<script> alert('iets ging fout'); </script>";
		}
		if ($result == 0) {
			$query = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$insert = $database->prepare($query);
			try{
				$insert->execute($data);
			}
			catch(PDOException $e){
				echo "<script> alert('iets ging fout'); </script>";
			}
			if ($insert) {
				echo "<script>alert('! Welkom bij onze App.')</script>";
				$_SESSION["username"] = $username;
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert(' Er ging iets mis.')</script>";
			}
		} else {
			echo "<script>alert(' E-mail bestaat al.')</script>";
		}
		
	} else {
		echo "<script>alert('Wachtwoord komt niet overeen.')</script>";
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
            <p class="login-text" style="font-size: 1rem; font-weight: 600;">TaDo App</p>
			<div class="input-group">
				<input type="text" placeholder="Gebruiknaam" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="wachtwoord" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Herhaal wachtwoord" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Registeren</button>
			</div>
			<p class="login-register-text">Heeft u al account? <a href="index.php">Loggin Hier</a>.</p>
		</form>
	</div>
</body>
</html>