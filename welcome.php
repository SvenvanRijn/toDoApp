<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkcome</title>
</head>
<body>
    <?php echo "<h1>Welkcome " . $_SESSION['username'] . "</h1>"; ?>
    <a href="logout.php">Afmelden</a>
</body>
</html>