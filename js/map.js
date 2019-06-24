var mymap = L.map('map').setView([39.3999, -8.2245], 7);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZ2FtZWxhcyIsImEiOiJjam1qaHdpd2YwZXBnM2ttc2xuN2czYmhoIn0.YUFt9dn3TQCMyvqwp8YE8g', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 14,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiZ2FtZWxhcyIsImEiOiJjam1qaHdpd2YwZXBnM2ttc2xuN2czYmhoIn0.YUFt9dn3TQCMyvqwp8YE8g'
}).addTo(mymap);

var marker = L.marker([39.3999, -8.2245]).addTo(mymap);
marker.bindPopup("<a class='font-weight-bold text-success' href='evento_detail.php?id=1'>Reflorestar Aveiro e Porque</a><br>Reflorestar Zonas Ardidas de Aveiro");