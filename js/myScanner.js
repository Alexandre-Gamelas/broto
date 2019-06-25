let scanner = new Instascan.Scanner(
    {
        video: document.getElementById('preview'),
        mirror: false
    }
);

$('#qrcode').click(function () {
    console.log("ola");
    $('#janelaQr').removeClass('fadeOutDown');
    $('#janelaQr').removeClass('d-none');
    $('#janelaQr').addClass('fadeInDown');

    scanner.addListener('scan', function(content) {
        alert('Scannou com sucesso! ' + content);
    });

    Instascan.Camera.getCameras().then(cameras =>
    {
        if(cameras.length > 1){
            if(IsSafari()){
                scanner.start(cameras[0]); //1 para telemovel, 0 para computador
            } else {
                scanner.start(cameras[1]); //1 para telemovel, 0 para computador

            }
        } else if(cameras.length == 1){
        scanner.start(cameras[0]);
    } else {
            console.error("Não existe câmera no dispositivo!");
        }
    });
});

$('#qrClose').click(function () {
    console.log("ola");
    animClose();
    setTimeout(function () {
        scanner.stop()
    }, 450);
});

function animClose() {
    $('#janelaQr').removeClass('fadeInDown');
    $('#janelaQr').addClass('fadeOutDown');
    setTimeout(function () {
        $('#janelaQr').addClass('d-none');
    }, 400)
}

function IsSafari() {

    var is_safari = navigator.userAgent.toLowerCase().indexOf('safari/') > -1;
    return is_safari;

}