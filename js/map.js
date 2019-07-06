var mymap = L.map('map').setView([39.3999, -8.2245], 7);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZ2FtZWxhcyIsImEiOiJjam1qaHdpd2YwZXBnM2ttc2xuN2czYmhoIn0.YUFt9dn3TQCMyvqwp8YE8g', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 14,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiZ2FtZWxhcyIsImEiOiJjam1qaHdpd2YwZXBnM2ttc2xuN2czYmhoIn0.YUFt9dn3TQCMyvqwp8YE8g'
}).addTo(mymap);

function onEachFeature(feature, layer) {
    if (feature.properties.name ) {
        layer.bindPopup("<a class='text-success' href='evento_detail.php?id="+ feature.id + "'>" + feature.properties.name + "</a>");
    }

}

var markers = L.markerClusterGroup();
var pontos = L.geoJSON(locais, {
    onEachFeature: onEachFeature
});
markers.addLayer(pontos);
mymap.addLayer(markers);
$("#todos").css("border-bottom", "solid 2px rgba(98, 210, 162, 1)")

var pontos_futuro = L.geoJSON(locais_futuro, {
    onEachFeature: onEachFeature
});

var pontos_passado = L.geoJSON(locais_passado, {
    onEachFeature: onEachFeature
});



$("#passado").click(function () {
    mymap.removeLayer(markers);
    markers.clearLayers();
    markers.addLayer(pontos_passado);
    mymap.addLayer(markers);

    $(this).css("border-bottom", "solid 2px rgba(98, 210, 162, 1)")
    $("#futuro").css("border", "none")
    $("#todos").css("border", "none")

});

$("#futuro").click(function () {
    mymap.removeLayer(markers);
    markers.clearLayers();
    markers.addLayer(pontos_futuro);
    mymap.addLayer(markers);

    $(this).css("border-bottom", "solid 2px rgba(98, 210, 162, 1)")
    $("#passado").css("border", "none")
    $("#todos").css("border", "none")
});

$("#todos").click(function () {
    mymap.removeLayer(markers);
    markers.clearLayers();
    markers.addLayer(pontos);
    mymap.addLayer(markers);

    $(this).css("border-bottom", "solid 2px rgba(98, 210, 162, 1)")
    $("#futuro").css("border", "none")
    $("#passado").css("border", "none")
});