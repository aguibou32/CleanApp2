<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      CleanApp dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
</head>
   
<body>
    <style>
        #map{
            height: 90%;;
            width: 90%;
        } 
    </style>

    <h1>Route Map</h1>
    <a href="https://www.google.co.za/maps/@-26.2023995,28.0596417,14z"><button class="btn btn-primary">Go to Google Map</button></a>
    <div id="map">

    </div>

    <script>
        function initMap(){

            // declaring the map options
            var options = {
                zoom:15,
                center:{lat:-26.2041, lng:28.0473}
            }
            // Im creating the map
            var map = new google.maps.Map(document.getElementById('map'), options);
        
            var markers = [
                    
                {
                    coords:{lat:-26.2047, lng:28.075 }, 
                    content:'<h3>Your position</h3>'
                },
                {
                    coords:{lat:-26.1949, lng:28.0552},
                    content:"<h3>Resident location</h3>"
                }

            ];

            // looping through the markers

            for (var i = 0; i < markers.length; i++) {
                addMarker(markers[i]);
            }
            // Add Marker function
            function addMarker(props){

                var marker = new google.maps.Marker({
                    position:props.coords,
                    map:map,
                }
            );
            if (props.content) {
                    var infoWindow = new google.maps.InfoWindow({
                        content:props.content
                    });

                    marker.addListener('click', function(){
                        infoWindow.open(map, marker);
                    });
                }
            }
        }
    </script>
    
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANrsKzpVrZCHD0SAcBN-vNEx7f7ARF_g0&callback=initMap">
    </script>

</body>
</html>