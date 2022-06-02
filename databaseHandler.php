<?php 

    include 'config.php';

    session_start();

    $user = $_SESSION["user_id"];
    $task = $_GET["task"];
    if(isset($_GET["taakID"])){
        $taakID = $_GET["taakID"];
    }
    if(isset($_GET["taakNaam"])){
        $taakNaam = htmlspecialchars($_GET["taakNaam"]);
    }
    if(isset($_GET["taakBegin"])){
        $taakBegin = $_GET["taakBegin"];
    }
    if(isset($_GET["taakEind"])){
        $taakEind = $_GET["taakEind"];
    }
    
    global $userTaken; 
    $userTaken = array();
    $datum = new DateTime("now");
    $datum = $datum->format("Y-m-d");
    
    //-----UPDATE-----
    function UpdateTaak($data){
        global $database;
        $query = "UPDATE taken SET taak_naam = ?, taak_bdatum = ?, taak_edatum = ? WHERE taak_id = ?";
        $update = $database->prepare($query);
        try{
            $update->execute($data);
        }
        catch(PDOException $e){
            echo "<script> alert('iets ging fout'); </script>";
        }
    }
    //-----AFRONDEN-----
    function TaakAfronden($data){
        global $database;
        $query = "UPDATE taken SET taak_afgerond = ?, taak_afronddatum = ? WHERE taak_id = ?";
        $update = $database->prepare($query);
        try{
            $update->execute($data);
        }
        catch(PDOException $e){
            echo "<script> alert('iets ging fout'); </script>";
        }
    }
    //-----INSERT-----
    function InsertTaak($data){
        global $database;
        $query = "INSERT INTO taken(taak_naam, taak_afgerond, taak_bdatum, taak_edatum, used_id) values (?, ?, ? ,?, ?)";
        $insert = $database->prepare($query);
        try{
            $insert->execute($data);
        }
        catch(PDOException $e){
            echo "<script> alert('iets ging fout'); </script>";
        }
    }
    //-----DELETE-----
    function DeleteData($data){
        global $database;
        $query = "DELETE FROM taken WHERE taak_id = ?";
        $delete = $database->prepare($query);
        try{
            $delete->execute($data);
            echo "<script> alert('taak verwijderd'); </script>";
        }
        catch(PDOException $e){
            echo "<script> alert('iets ging fout'); </script>";
        }
    }

    //-----FETCH DATA-----
    function FetchData($user){
        global $database;
        global $userTaken;
        $userTaken = array();
        $query = "SELECT * FROM taken WHERE used_id = $user";
        $taken = $database->prepare($query);
        try{
            $taken->execute();
            $taken->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($taken as $taak){
                array_push($userTaken, $taak);
            }
        }
        catch(PDOException $e){
            echo "<script> alert('iets ging fout'); </script>";
        }
    }
    
    function GetTaken($user){
        global $userTaken;
        FetchData($user);

        foreach($userTaken as $taak){
            if($taak["taak_afgerond"] == 0){
                ShowTaken($taak["taak_id"], $taak["taak_naam"], $taak["taak_bdatum"], $taak["taak_edatum"], $taak["taak_afronddatum"]);
            } 
        }
        echo" <div class='row mt-4 bg-info rounded-2 border border-dark'> 
                <div class='col-md p-2'><h4>Afgeronde taken:</h4></div>
                <div class='col-md p-2 taak-data'><b>Afrond Datum: </b>  </div>
                <div class='col-md p-2 taak-datums'><b>Start Datum: </b></div>
                <div class='col-md p-2 taak-datums'><b>Eind Datum: </b></div>
                <div class='col-md taak-nobutton btn-group p-0'> </div>  
            </div>";
        foreach($userTaken as $taak){
            if($taak["taak_afgerond"] == 1){
                ShowTaken($taak["taak_id"], $taak["taak_naam"], $taak["taak_bdatum"], $taak["taak_edatum"], $taak["taak_afronddatum"]);
            }
        }
    }

    function ShowTaken($id, $naam, $bdatum, $edatum, $done){
        $color;
        $fdatum = date_create("now");
        $datum = date_create($bdatum);
        $sdatum = date_create($edatum);
        $adatum = date_create($done);
        $dif = date_diff($fdatum, $sdatum);
        $fdatum = $fdatum->format("d-m-Y");
        $sdatum = $sdatum->format("d-m-Y");
        $adatum = $adatum->format("d-m-Y");

        if($dif->format("%R") == "+"){
            $color = "text-success";
            $dif = $dif->format("%a");
            $dif = intval($dif) + 1;
            $dif = $dif." Days left";
        }elseif($dif->format("%a") == "0"){
            $color = "text-warning";
            $dif = "Today";
        }elseif($dif->format("%R") == "-"){
            $color = "text-danger";
            $dif = $dif->format("%a Days overdue");
        }
        if($done != "0000-00-00"){
            $color = "text-success";
            $dif = $adatum;
        }
        echo "<div class='row rounded-2 mt-1 bg-light'>";
            echo "<div class='col-md p-2'>".$naam." </div>";
            echo "<div class='col-md p-2 taak-data'><b class='".$color."'>".$dif."</b></div>";
            echo "<div class='col-md p-2 taak-datums'>".$fdatum."</div>";
            echo "<div class='col-md p-2 taak-datums'>".$sdatum."</div>";
            echo "<div class='col-md taak-button btn-group p-0'>";
                echo "<button type='button' class='btn btn-success' onclick='taakAfronden(".$id.")'>Afronden</button>";
                echo "<button data-bs-toggle='collapse' data-bs-target='#taakwijzigen".$id."' class='btn btn-secondary'>Wijzigen</button> ";
                echo "<button type='button' class='btn btn-danger' onclick='taakVerwijderen(".$id.")'>Verwijderen</button>";
            echo "</div>";
        echo "</div>";
        echo "<div class='row collapse rounded-bottom-2 border-top border-dark mb-2 bg-light' id='taakwijzigen".$id."'> ";
            echo "<div class='col-md p-2'> ";
                echo "<input type='text' value='".$naam."' name='taaknaam' id='edittaaknaam".$id."' required>";
                echo "<input type='date' id='editbegindatum".$id."' value='".$bdatum."'>";
                echo "<input type='date' id='editeinddatum".$id."' value='".$edatum."'>";
                echo "<button id='btntaakadd' class='btn btn-warning' onclick='prepareEditTaak(\"".$id."\")'>Taak Wijzigen</button>";
            echo "</div>";
            echo "<div class='col taak-nobutton'> </div>";
        echo "</div>";    
    }

    switch ($task){
        case "afronden":
            $afrondData = array("1", $datum, $taakID);
            TaakAfronden($afrondData);
            break;
        case "delete":
            $deleteData = array($taakID);
            DeleteData($deleteData);
            break;
        case "edit":
            $updateData = array($taakNaam, $taakBegin, $taakEind, $taakID);
            UpdateTaak($updateData);
            break;
        case "add":
            $insertData = array($taakNaam, "0", $taakBegin, $taakEind, $user);
            InsertTaak($insertData);
            break;  
        
    }
    GetTaken($user);
?>