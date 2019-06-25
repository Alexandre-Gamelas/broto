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


    $("form > *").focus(function () {
        $("#menu-bot").hide();
    });

    $("form > *").focusout(function () {
        $("#menu-bot").show();
    });
};

