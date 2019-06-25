window.onload = function (ev) {
    console.log("Ola");
    registerSW();
    var deferredPrompt;

    window.addEventListener('beforeinstallprompt', function (e) {
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;

        //showAddToHomeScreen();

    });


    //tapar o menu bot quando o keyboard aparece, solução um bocado improvisada, se houver tempo procurar algo melhor
    $("form > *").focus(function () {
        $("#menu-bot").hide();
        $("#menu-bot").css("opacity", 0)
    });

    $("form > *").focusout(function () {
        $("#menu-bot").show();
        $("#menu-bot").animate({
            opacity: 1
        }, 600)
    });
};

