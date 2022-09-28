<?php include 'header.php'?>
      <title></title>
  <head>
        <style>
             #map { height: 700px; width: 100%; align: "center";}
             input:invalid {
               border: 3px solid red;
             }
        </style>
   </head>
   <body>
     <div class="scrollmenu">
       <a href="index.php">Home</a>
       <a class="active" href="Visualization.php">Visualization</a>
       <a href="Declare_visit.php">Declare Visit</a>
       <a href="Declare_Covid.php">Declare Covid-19 Case</a>
	   <a href="covid_visit.php">Spot Covid</a>
       <a href="Profile Management.php">Profile Management</a>
       <a href="logout.php">Logout</a>
     </div>


   <div id= "map"></div>

 </body>
   <script>

   var markers_array = [];

   //function to calculate average for an array source:https://poopcode.com/calculate-the-average-of-an-array-of-numbers-in-javascript/
   function calculate(array) {
     var arraySum = array.reduce(function (a, b) { return a + b; }, 0);
     return arraySum / array.length;
   }

   //current day
   var date = new Date();
   var today = date.toLocaleString('en-us', {weekday: 'long'});

   //I put markers into layer in order to be able to remove them in the future
   var marker_layer = new L.layerGroup();

   //I put the markers to a cluster for a better display and to fill the needs of the second  question for the initial display
   const markerCluster =  L.markerClusterGroup({
    chunkedLoading: true,
    disableClusteringAtZoom:15,
    spiderfyOnMaxZoom: true
  });

   //Initialize the map
  // var map = L.map('map');
   
  
  var map = new L.Map('map', {
		center: new L.LatLng(38.246361, 21.734966),
		zoom: 15
	})
  
   
   
   const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
   const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
   const tiles = L.tileLayer(tileUrl, {
       attribution
   });

   tiles.addTo(map);
   map.addLayer(marker_layer);
   map.addLayer(markerCluster);

   //green icon
   var greenIcon = L.icon({
     iconUrl: 'images/green-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });


   //orange icon
   var orangeIcon = L.icon({
     iconUrl: 'images/orange-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });

   //red icon
   var redIcon = L.icon({
     iconUrl: 'images/red-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });

   //blue icon
   var blueIcon = L.icon({
     iconUrl: 'images/blue-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });

   //function that determines which icon to choose depending on the popularity of the store
   function iconColor(popularity) {

     let round = Math.round(popularity);

      if (round >= 0 && round <= 32) {
          return greenIcon;
      } else if (round >= 33 && round <= 65) {
          return orangeIcon;
      } else if (round >= 66) {
          return redIcon;
      } else {
          return blueIcon;
      }
    }

   //User location via navigator
   //Code taken from https://www.codeunderscored.com/how-to-get-a-user-location-using-html-and-javascript/
   if (!navigator.geolocation) {
       console.log('Geolocation API not supported by this browser.');
   } else {
       console.log('Checking location...');
       navigator.geolocation.getCurrentPosition(success, error);
       console.log(navigator.geolocation.getCurrentPosition);

       function success(position) {
          //change
           var marker = L.marker([38.246361, 21.734966]);
          
		   position.coords.latitude=38.246361;
		   position.coords.longitude=21.734966;
          
           marker.bindPopup(" My position is:<br>lat: " + 38.246361 + "<br>lng: " + 21.734966);
           marker_layer.addLayer(marker);
		  
          
           map.setView([38.246361, 21.734966], 13);
       }

       //Initialize search bar
       var searchControl = new L.control.search({
           url: 'search.php?q={s}',
           propertyName: 'title',
           textPlaceholder: 'Search in Leaflet Maps...',
           position: "topleft",
           autoType: true,
           moveToLocation: function(latLng, title, map) {
               map.setView([latLng.lat, latLng.lng], 20);
           },
           delayType: 500,
           collapsed: false
       });

       map.addControl(searchControl);



       const ajax_query = $.ajax({
         url:"Visualization_backend.php",
         method:"POST",
         dataType: "json",
         success: function(data){
           console.log(data);


           for(let i=0;i<data.length;i++){
               let estimate =[];


               if(date.getHours() == 22){
                 estimate.push(parseInt(data[i].popular_times[date.getHours()]), parseInt(data[i].popular_times[date.getHours() + 1]), parseInt(data[i].popular_times[0]));
               } else if(date.getHours() == 23){
                 estimate.push(parseInt(data[i].popular_times[date.getHours()]), parseInt(data[i].popular_times[0]), parseInt(data[i].popular_times[1]));
               } else{
                 estimate.push(parseInt(data[i].popular_times[date.getHours()]), parseInt(data[i].popular_times[date.getHours() + 1]), parseInt(data[i].popular_times[date.getHours() + 2]));
               }


               let markers = L.marker(L.latLng(data[i].loc[0], data[i].loc[1]), {icon: iconColor(calculate(estimate))}, {id:data[i].id} );

               markers.bindPopup("Name: "+data[i].name+ "<br> Address: "+data[i].address+"<br>Popularity: "+Math.round(calculate(estimate))).on("popupopen", () => {
                 $(".leaflet-popup-close-button").on("click", (e) => {
                   if(markers._leaflet_id){
                     map.removeLayer(markers);
                     e.preventDefault();
                   }

                });
               });


               markerCluster.addLayer(markers);

           }

			searchControl.on('search:locationfound', function(responseText) {
             console.log(responseText);

             var xhr = JSON.parse(responseText.sourceTarget._curReq.response);

             for(let i=0;i<xhr.length;i++){
               //I do this in order to create the popup
               if(responseText.text == xhr[i].title){

                   let estimate_next = [];

                   if(date.getHours() == 22){
                     console.log("I am here");
                     estimate_next.push(parseInt(xhr[i].popular_times[date.getHours()]), parseInt(xhr[i].popular_times[date.getHours() + 1]), parseInt(xhr[i].popular_times[0]));
                   } else if(date.getHours() == 23){
                     estimate_next.push(parseInt(xhr[i].popular_times[date.getHours()]), parseInt(xhr[i].popular_times[0]), parseInt(xhr[i].popular_times[1]));
                   } else{
                     estimate_next.push(parseInt(xhr[i].popular_times[date.getHours()]), parseInt(xhr[i].popular_times[date.getHours() + 1]), parseInt(xhr[i].popular_times[date.getHours() + 2]));
                   }
                   console.log(estimate_next);
                   let popupContent = '<p>Name:</p> <b>'+responseText.text+'</b><p>Adderss: </p><b>'+xhr[i].address+'</b><p>Popularity: </p><b>'+Math.round(calculate(estimate_next))+'</b>';

                   let marker = L.marker(L.latLng(responseText.latlng.lat, responseText.latlng.lng), {icon:iconColor(calculate(estimate_next))},{draggable:false} );

                   marker._id = xhr[i].id;
                   console.log(marker._id);

                   let myPopup = marker.bindPopup(popupContent);

                   map.addLayer(marker);
                   markers_array.push(marker);

                   myPopup.on("popupopen", () => {
                     $(".leaflet-popup-close-button").on("click", (e) => {
                       if(marker._id == xhr[i].id){
                         map.removeLayer(marker);
                         console.log(map.getZoom());
                         e.preventDefault();
                         window.location.reload();

                       }

                    });
                  });
               }
             }
             console.log(xhr);
             map.removeLayer(markerCluster);
           });
         }
       });



       function error() {
           console.log('Geolocation error!');
       }
   }
 </script>

</html>
