let scanner = new Instascan.Scanner(
    {
        video: document.getElementById('preview'),
        mirror: false
    }
);

$('#qrcode').click(function () {
    $("section, div").not("#janelaQr, #janelaQr > *").css("filter", "blur(2px)");
    $("#blurModal").removeClass("d-none");
    $('#janelaQr').removeClass('d-none');

    scanner.addListener('scan', function(content) {
        alert('Scannou com sucesso!');
        window.location.assign('scripts/check_in.php?check_in=' + content)
    });

    Instascan.Camera.getCameras().then(cameras =>
    {
        if(cameras.length > 1){
            if(IsSafari()){
                scanner.start(cameras[1]); //1 para telemovel, 0 para computador
            } else {
                scanner.start(cameras[1]); //1 para telemovel, 0 para computador

            }
        } else if(cameras.length == 1){
        scanner.start(cameras[1]);
    } else {
            console.error("Não existe câmera no dispositivo!");
        }
    });
});

$('#qrClose').click(function () {
    $("section, div").not("#janelaQr, #janelaQr > *").css("filter", "blur(0)");

    $("#blurModal").addClass("d-none");
    animClose();
    setTimeout(function () {
        scanner.stop()
    }, 450);
});

function animClose() {
    setTimeout(function () {
        $('#janelaQr').addClass('d-none');
    }, 400)
}

function IsSafari() {

    var is_safari = navigator.userAgent.toLowerCase().indexOf('safari/') > -1;
    return is_safari;

}