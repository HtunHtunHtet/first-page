//let map;
let locations = [];
let infowindow = null;

const image = {
    //get marker
    url: "https://developers.google.com/static/maps/documentation/javascript/images/default-marker.png ",
    // This marker is 20 pixels wide by 37 pixels high.
    size: new google.maps.Size(26, 37),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // set the default anchor point
    anchor: new google.maps.Point(0, 37),
};

//define shapes of the marker, for the purpose of clickable event, in other words, setting surrounding
const shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: "poly",
};

document.addEventListener("DOMContentLoaded", function(event) {
    callAPI()
     .then(result => {
        //locations
         result.features.map((feature,index) => {
             let long = feature.geometry.coordinates[0];
             let lat = feature.geometry.coordinates[1];
             let place = feature.properties.place;
             let type = feature.properties.type;
             let time = new Date(feature.properties.time).toUTCString();

             // order is lat, long , z-index, location , datetime , type for the order in which these markers should display on top of each others
             locations.push({
                 lat: lat,
                 long: long,
                 z: index,
                 place: `<div><strong>Place: </strong>${place}</div><div><strong>Time: </strong>${time}</div>`,
                 type: type,
             })
         })

         //redraw map
         initMap();
       })
});

//api call
let callAPI = async () => {
   return await fetch('https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson')
        .then(response => response.json())
        .then(result => result);
}

//render map
let initMap = () => {
    //map properties
   const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 3,
        minZoom: 1
    });

    //set markers
    setMarkers(map);
}

let setMarkers = (map) => {

    console.log(locations);
    //create locations
    locations.map((location) => {


        //create markers
        let marker = new google.maps.Marker({
            position: { lat: location.lat, lng: location.long },
            map,
            icon: image,
            shape: shape,
            title: location.type, // mouse hover event
            zIndex: location.z,
        });

        //marker event listener from google
        marker.addListener("click", () => {
            //close other infowindow if the current info window is open
            if (infowindow) {
                infowindow.close();
            }

            //create information window
            infowindow = new google.maps.InfoWindow({
                content: location.place,
                ariaLabel: "hello label",
            });

            infowindow.open({
                anchor: marker,
                map,
            });
        });
    })
}
