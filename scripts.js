function taakAfronden(taakID){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            document.getElementById("taakdata").innerHTML = result;
        }
    };
    xhttp.open("GET", "databasehandler.php?task=afronden&taakID="+taakID+"&taakData=\"\"", true);
    xhttp.send(); 
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
        xhttp.open("GET", "databasehandler.php?task=delete&taakID="+taakID+"&taakData=\"\"", true);
        xhttp.send(); 
    }
}

function taakToevoegen(taakData){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            document.getElementById("taakdata").innerHTML = result;
        }
    };
    xhttp.open("GET", "databasehandler.php?task=add&taakID=\"\"&taakData="+taakData, true);
    xhttp.send(); 
}
//this is useless plx fix
function taakUpdaten(taakID){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText;
            document.getElementById("taakdata").innerHTML = result;
        }
    };
    xhttp.open("GET", "databasehandler.php?task=afronden&taakID="+taakID+"&taakData=\"\"", true);
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
    xhttp.open("GET", "databasehandler.php?task=get&taakID=0&taakData=\"\"", true);
    xhttp.send(); 
}

function prepareTaak(){
    var taaknaam = document.getElementById("taaknaam").value;
    taakToevoegen(taaknaam);
}