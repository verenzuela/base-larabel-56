// http://photon.komoot.de/
class photonApp {

  constructor() {
    this.url = 'https://photon.komoot.de/api/';
  }


  search(location) {
    let url = this.url+'?q='+location+'&limit=1';

    $.ajax({
      url:url,
      method:"GET",
      success:function(data){
        document.getElementById('latitude').value = data.features[0].geometry.coordinates[1];
        document.getElementById('longitude').value = data.features[0].geometry.coordinates[0];
      }
    });

  }

}