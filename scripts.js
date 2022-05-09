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

function taakVerwijderen(taakID){
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
//this is useless
function taakToevoegen(taakID){
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