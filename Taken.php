<?php 

include 'config.php';

error_reporting(0);

session_start();

$vandaag = new DateTime("now");
$nextWeek = new DateTime("now");
$nextWeek = date_modify($nextWeek, "+7 days");
$diff = date_diff($vandaag, $nextWeek);
$vandaag = $vandaag->format("Y-m-d");
$nextWeek = $nextWeek->format("Y-m-d");


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta http-equiv="Content-type" content="text/html"
    charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="taakstyle.css?v=1">
    <script src="scripts.js"></script>
    <title>ToDo-app</title>
</head>
<body>
<nav class="navbar bg-info p-2">
  <div class="container-fluid">
    <h1 class="navbar-brand">Project ToDo-app</h1>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><button class="btn btn-primary" >Logout</button> </a>
      </li>
    </ul>
  </div>
</nav>
  <div class="container-lg pb-5 taakcontainer">
    <h2>Takenlijst</h2> 
    
    
    
    
    <div class='row'> 
        <div class='col-md'><b>Nieuwe taak:</b> <input type="text" placeholder="Taaknaam" name="taaknaam" id="taaknaam" required></div>
        <div class='col-md taak-data'><input type="date" id="begindatum" value=<?php echo date("Y-m-d") ?>> </div>
        <div class='col-md taak-data'><input type="date" id="einddatum" value=<?php echo $nextWeek;?>></div>
        <div class='col-md taak-nobutton p-0'><button id="btntaakadd" class="btn btn-success" onclick="prepareTaak()">Taak toevoegen</button> </div>  
      </div>

    <div class='container-lg rounded-3'>
      <div class='row bg-info rounded-2 border border-dark'> 
        <div class='col-md p-2'><h4>Taaknaam </h4></div>
        <div class='col-md p-2 taak-data'><b>Days left/overdue: </b>  </div>
        <div class='col-md p-2 taak-datums'><b>Start Datum:</b> </div>
        <div class='col-md p-2 taak-datums'><b>Eind Datum: </b></div>
        <div class='col-md taak-nobutton btn-group p-0'> </div>  
      </div>

      <div id="taakdata"> </div>

    </div>
    
   
  </div>
  <footer>
    <p>Copyright&copy: Project ToDo-app</p>
</footer>
</body>
<script> taakGet(); </script>

</html>