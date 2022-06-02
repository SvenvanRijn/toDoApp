function taakAfronden(taakID){
    if(confirm("Weet u zeker dat deze taak afgerond moet worden?")){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
                document.getElementById("taakdata").innerHTML = result;
            }
        };
        xhttp.open("GET", "databasehandler.php?task=afronden&taakID="+taakID, true);
        xhttp.send(); 
    }
}
//this is useless plz fix
function taakVerwijderen(taakID){
    if (confirm("Weet u zeker dat deze taak verwijderd moet worden?")){
        var xhttp;  
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
                document.getElementById("taakdata").innerHTML = result;
            }
        };
        xhttp.open("GET", "databasehandler.php?task=delete&taakID="+taakID, true);
        xhttp.send(); 
    }
}

function taakToevoegen(taaknaam, taakbegin, taakeind){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            document.getElementById("taakdata").innerHTML = result;
        }
    };
    xhttp.open("GET", "databasehandler.php?task=add&taakNaam="+taaknaam+"&taakBegin="+taakbegin+"&taakEind="+taakeind, true);
    xhttp.send(); 
}

function taakUpdaten(taakID, taaknaam, taakbegin, taakeind){
    var xhttp;
    
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            document.getElementById("taakdata").innerHTML = result;
        }
    };
    xhttp.open("GET", "databasehandler.php?task=edit&taakID="+taakID+"&taakNaam="+taaknaam+"&taakBegin="+taakbegin+"&taakEind="+taakeind, true);
    xhttp.send(); 
}

function taakGet(){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            document.getElementById("taakdata").innerHTML = result;
        }
    };
    xhttp.open("GET", "databasehandler.php?task=get", true);
    xhttp.send(); 
}

function prepareTaak(){
    var taaknaam = document.getElementById("taaknaam").value;
    var taakbegin = document.getElementById("begindatum").value;
    var taakeind = document.getElementById("einddatum").value;
    taakToevoegen(taaknaam, taakbegin, taakeind);
}
function prepareEditTaak(id){
    if(confirm("Weet u zeker dat u deze taak wilt wijzigen?")){
        var taaknaam = document.getElementById("edittaaknaam"+id).value;
        var taakbegin = document.getElementById("editbegindatum"+id).value;
        var taakeind = document.getElementById("editeinddatum"+id).value;
        taakUpdaten(id, taaknaam, taakbegin, taakeind);
    }
}