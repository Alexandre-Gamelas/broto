window.onload=function () {

    document.getElementById("pessoas").style.display="block";
    document.getElementById("eventos").style.display="none";

    document.getElementById("btn_pessoas").onclick=function(){
        console.log("ola");
        document.getElementById("pessoas").style.display="block";
        document.getElementById("eventos").style.display="none";
    };
    document.getElementById("btn_eventos").onclick=function(){
        document.getElementById("eventos").style.display="block";
        document.getElementById("pessoas").style.display="none";
        console.log("yo");
    }};