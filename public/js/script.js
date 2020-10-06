var map;
var myLatLng

$(document).ready(function(){

    geoLocationInit(); // calling the geoLocation function;

    function geoLocationInit() {

        if (navigator.geolocation) {
          // if the navigator is allowed to use the user's location, the success function will be executed
          // if the navigator is not allowed to use the user's location, it will execute the fail function

          navigator.geolocation.getCurrentPosition(success, fail);
        }
        else{
          alert('browser not supported !');
        }

        function success(position) {
          console.log(position);

          var latvalue = position.coords.latitude;
          var lngvalue = position.coords.longitude;

          console.log([latvalue, lngvalue]);

          myLatLng = new google.maps.LatLng(latvalue, lngvalue);
          createMap(myLatLng);
          // nearbySearch(myLatLng, 'places');
          searchLocations(latvalue, lngvalue);

        }

        function fail(){
          alert('could not retrieve position');
        }

    }
   
    // We are creating a function that creates the map;
    function createMap(myLatLng){
          map = new google.maps.Map(document.getElementById('map'),{
          center:myLatLng,
          scrollWheel:false,
          zoom:14
      });

      marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          icon:'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
          title: name
      });
    }
  
    // We are creating a function that creates a marker;

    function createMarker(latLng, icn, name){
        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            icon:icn,
            title: name
          });
    }

    // function that will show the nearby illigal dumping places;

    // function nearbySearch (latLng, type) {
    //     var request = {
    //       location:myLatLng,
    //       radius: '2500',
    //       type: [type]
    //     };

    //     service = new google.maps.places.PlacesService(map);
    //     service.nearbySearch(request, callback);

    //     function callback(results, status) {
    //         console.log(results);

    //       if (status == google.maps.places.PlacesServiceStatus.OK) {
    //         for (var i = 0; i < results.length; i++) {
    //             var place = results[i];
    //             latLng=place.geometry.location;
    //             icn='';
    //             name = place.name;
    //             createMarker(latLng,icn,name);
    //         }
    //       }
    //     } 
    // }

    function searchLocations(latitude, longitude) {

      $.post('http://localhost/api/search_illigal_dumping_places', {latitude:latitude, longitude:longitude}, function (match) {
        console.log(match);
      });


    }
    
});  