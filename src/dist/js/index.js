let map;

$(document).ready(function() {


let test = callAPI()
     .then(result => {
           console.log(result);
       })
});


let callAPI = async () => {
   return await fetch('https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson')
        .then(response => response.json())
        .then(result => result);
}


let initMap =() => {

    //map properties
    map = new google.maps.Map(document.getElementById("map"), {
        // center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });
}

window.initMap = initMap;
