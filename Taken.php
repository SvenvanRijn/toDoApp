<?php 

include 'config.php';

error_reporting(0);

session_start();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta http-equiv="Content-type" content="text/html"
    charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="taakstyle.css">
    <script src="scripts.js"></script>
    <title>ToDo-app</title>
    
</head>
<header>
    <h1><a href="logout.php"> Project ToDo-app</a></h1>
</header>
<body>
  <div class="container">
    <h2>Takenlijst</h2>           
    <table class="table table-bordered">
      <div class="td">
      <thead>
        <tr>
          <th>Taak</th>
          <th>Begindatum</th>
          <th>Einddatum</th>
        </tr>
      </thead>
      <tbody id="taakdata">
        <tr>
          <td class="taaknaam">John</td>
          <td class="begindatum">Doe</td>
          <td class="einddatum">john@example.com</td>
          <td><button type="button" class="btn btn-success">Afgerond</button></td>
          <td><button type="button" class="btn btn-secondary">Wijzigen</button></td>
          <td><button type="button" class="btn btn-danger">Verwijderen</button></td>
        </tr>
        <tr>
          <td class="taaknaam">Mary</td>
          <td class="begindatum">Moe</td>
          <td class="einddatum">mary@example.com</td>
          <td class="afgerond"><button type="button" class="btn btn-success">Afgerond</button></td>
          <td class="wijzigen"><button type="button" class="btn btn-secondary">Wijzigen</button></td>
          <td class="verwijderen"><button type="button" class="btn btn-danger">Verwijderen</button></td>
        </tr>
        <tr>
          <td class="taaknaam">July</td>
          <td class="begindatum">Dooley</td>
          <td class="einddatum">july@example.com</td>
          <td><button type="button" class="btn btn-success">Afgerond</button></td>
          <td><button type="button" class="btn btn-secondary">Wijzigen</button></td>
          <td><button type="button" class="btn btn-danger">Verwijderen</button></td>
        </tr>
      
      </tbody>
    </table>
  </div>
</body>
<script> taakGet(); </script>
<footer>
    <p>Copyright&copy: Project ToDo-app</p>
</footer>
</html>