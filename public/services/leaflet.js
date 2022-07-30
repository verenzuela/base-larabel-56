
class leafletApp {

  constructor(div, lat, long, showMarker=false, zoom=18) {
    this.div = div;
    this.lat = lat;
    this.long = long;
    this.showMarker = showMarker;
    this.zoom = zoom;
  }

  initMap() {
    return L.map(this.div, { center: [this.lat, this.long], zoom: this.zoom });
  }

  initMarker(myMap){
    var marker = L.marker(new L.LatLng(this.lat, this.long), {
      draggable: true,
    }).addTo(myMap);

    return marker;
  }

  setMap(myMap, marker, mapBoxToken='') {
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
      attribution: 'OneFlexRoom',
      maxZoom: this.zoom,
      id: 'mapbox.streets',
      accessToken: mapBoxToken
    }).addTo(myMap);
    
    myMap.scrollWheelZoom.disable();

    if(this.showMarker){
      marker.on('dragend', function (e) {
        document.getElementById('latitude').value = marker.getLatLng().lat;
        document.getElementById('longitude').value = marker.getLatLng().lng;
      });
    }

    $("#map").bind('mousewheel DOMMouseScroll', function (event) {
      event.stopPropagation();
      if (event.ctrlKey == true) {
        event.preventDefault();
        myMap.scrollWheelZoom.enable();
        $('#map').removeClass('map-scroll');
        setTimeout(function(){
          myMap.scrollWheelZoom.disable();
        }, 1000);
      } else {
         myMap.scrollWheelZoom.disable();
         $('#map').addClass('map-scroll');
      }

    });

    $(window).bind('mousewheel DOMMouseScroll', function (event) {
      $('#map').removeClass('map-scroll');
    })

    $( "#map" ).click(function() {
      $('#map').removeClass('map-scroll');
    });
    

  }

  setNewLocation(myMap, marker, lat, lon, zoom) {
    myMap.setView(new L.LatLng(lat, lon), zoom);
    marker.setLatLng(new L.LatLng(lat, lon));
  }

}