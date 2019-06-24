timer=setInterval(verify_pass, 500);
function verify_pass(){
    var pass1=document.getElementById("pass").value;
    var pass2=document.getElementById("ver_pass").value;


    if(pass1==pass2){
        document.getElementById("ver_pass").style.background="white";
        document.getElementById("btn_registar").disabled=false;
    }else{
        document.getElementById("ver_pass").style.background="linear-gradient(to right, #ffeba4 0%,#ffdb58 100%)";
        document.getElementById("btn_registar").disabled=true;

    }
}