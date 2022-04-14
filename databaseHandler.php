<?php 

    include 'config.php';

    $user = $_SESSION["username"];
    $task = $_GET["task"];
    $taakID = $_GET["taakID"];
    $taakData = $_GET["taakData"];
    $datum = new DateTime("now");
    $datum = $datum->format("Y-m-d");
    
    //-----UPDATE-----
    function UpdateTaak($data){
        global $database;
        $query = "UPDATE taken SET taak_naam = ?, taak_afgerond = ?, taak_edatum = ? WHERE taak_id = ?";
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
        $query = "UPDATE taken SET taak_afgerond = ?, taak_edatum = ? WHERE taak_id = ?";
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
        $query = "INSERT INTO taken(taak_naam, taak_afgerond, taak_bdatum, taak_edatum, username) values (?, ?, ? ,?, $username)";
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
    function FetchData(){
        global $database;
        $query = "SELECT * FROM taken WHERE username = $user";
        $taken = $database->prepare($query);
        try{
            $taken->execute();
            $taken->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($taken as $taak){
                if($taak["taak_afgerond"] == 0){
                echo "<tr id=taaknr".$taak["taak_id"].">";
                echo "<td class='taaknaam'>".$taak["taak_naam"]."</td>";
                echo "<td class='begindatum'>".$taak["taak_bdatum"]."</td>";
                echo "<td class='einddatum'>".$taak["taak_edatum"]."</td>";
                echo "<td class='afgerond'><button type='button' class='btn btn-success' onclick='taakAfronden(".$taak["taak_id"].")'>Afronden</button></td>                          
                    <td class='wijzigen'><button type='button' class='btn btn-secondary' onclick='taakWijzigen()'>Wijzigen</button></td> 
                    <td class='verwijderen'><button type='button' class='btn btn-danger' onclick='taakVerwijderen()'>Verwijderen</button></td>";
                echo " </tr> <br>";
                }
            }
            $taken->execute();
            $taken->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($taken as $taak){
                if($taak["taak_afgerond"] == 1){
                echo "<tr id=taaknr".$taak["taak_id"].">";
                echo "<td class='taaknaam'>".$taak["taak_naam"]."</td>";
                echo "<td class='begindatum'>".$taak["taak_bdatum"]."</td>";
                echo "<td class='einddatum'>".$taak["taak_edatum"]."</td>";
                echo "<td class='afgerond'><button type='button' class='btn btn-success' onclick='taakAfronden(".$taak["taak_id"].")'>Afronden</button></td>                          
                    <td class='wijzigen'><button type='button' class='btn btn-secondary' onclick='taakWijzigen()'>Wijzigen</button></td> 
                    <td class='verwijderen'><button type='button' class='btn btn-danger' onclick='taakVerwijderen()'>Verwijderen</button></td>";
                echo " </tr> <br>";
                }
            }
        }
        catch(PDOException $e){
            echo "<script> alert('iets ging fout'); </script>";
        }
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
            $updateData = array($taakData, $datum, $taakID);
            UpdateTaak($updateData);
            break;
        case "add":
            $insertData = array($taakData, "0", $datum, "" );
            InsertTaak($insertData);
            break;
        
    }
    FetchData();
?>