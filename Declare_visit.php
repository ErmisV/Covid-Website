<?php include 'header.php'?>

<body>
  <title>Declare your visit</title>
  <div class="scrollmenu">
    <a href="index.php">Home</a>
    <a href="Visualization.php">Visualization</a>
    <a class="active" href="Declare_visit.php">Declare Visit</a>
    <a href="Declare_Covid.php">Declare Covid-19 Case</a>
	<a href="covid_visit.php">Spot Covid</a>
    <a href="Profile Management.php">Profile Management</a>
    <a href="logout.php">Logout</a>
  </div>

  <h1>Store Information</h1>
  <p>How many people are currently in the store?</p>
  <table id="Values_table">
    <thead>
      <th>Name</th>
      <th>Address</th>
      <th>Location</th>
      <th></th>
      <th></th>
    </thead>
    <tbody id="rows"></tbody>
  </table>
<script>

// Navigator API:https://developer.mozilla.org/en-US/docs/Web/API/Navigator
if (!navigator.geolocation) {
    console.log('Geolocation API not supported by this browser');
} else {
    console.log('Checking location...');

    navigator.geolocation.getCurrentPosition(success, error);

    function success(position) {

        const stores_in_20_m = $.ajax({
            url: 'Declare_visit_backend.php',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                //Initialize arrays
                var JSON_array = [];

                //Get the table
                var table = document.getElementById('Values_table');

                //Create table
                rows.innerHTML = "";
                var tr = "";
                var cell = document.createElement("td");

                //Counter of how many elements got into the table eventually
                let count = 0;

                //Iterate through all data and then if meets the condition it creates the html table and the JSON with data of html table
                for (let i = 0; i < data.length; i++) {
                    if (getDistanceFromLatLonInKm(position.coords.latitude, position.coords.longitude, data[i].loc[0], data[i].loc[1]) < 400000) { //It needs to be 20 meters and not 400
                        var JSON = {};
                        let rows = document.getElementById('rows');

                        tr += '<tr id="">';
                        tr += '<td>' + data[i].name + '</td>' + '<td>' + data[i].address + '</td>' + '<td>' + data[i].loc.join(',') + '</td><td><input id=input_user'+count+' " type="number" /></td><td id='+count+'></td>';
                        tr += '</tr>';


                        JSON.name = data[i].name;
                        JSON.address = data[i].address;
                        JSON.id = data[i].id;
                        JSON.loc = data[i].loc;


                        JSON_array.push(JSON);
                        count=count+1;
                    }
                }
                rows.innerHTML += tr;
                console.log(JSON_array);

                //We need this extra loop because table is created after rows.innerHTML i put extra count because it doesnt increase linearly
                for(let j=0;j<count;j++){

                  //Create button
                  let btn = document.createElement("button");
                  btn.setAttribute("id", j);
                  btn.innerText = "Upload";

                  //Get user input
                  //user_input[j].push(document.getElementById("input_user"+j));


                  //Add onclick event
                  btn.onclick = function(){
                    user_input = document.getElementById("input_user"+this.id).value;
                    ajax_upload(JSON_array[this.id],user_input);
                  };

                  //Add button to html table
                  let selectPanel = document.getElementById(j);
                  selectPanel.appendChild(btn);
                }
            }
        });
    }

    function error() {
        console.log('Geolocation error!');
    }
}

//function that calculates the distance between two coordinates taken by https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
function getDistanceFromLatLonInKm(lat_1, lon_1, lat_2, lon_2) {
    //The Radius of the earth
    var Radius = 6371;

    var dLat = deg2rad(lat_2 - lat_1); // deg2rad below
    var dLon = deg2rad(lon_2 - lon_1);

    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(deg2rad(lat_1)) * Math.cos(deg2rad(lat_2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);

    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = Radius * c; // Distance in km
    return parseInt(d * 1000);
}

//function that calculates the arc length
function deg2rad(deg) {
    return deg * (Math.PI / 180)
}

function ajax_upload(JSON, user_est){
  console.log(user_est);
  console.log(JSON);
  if(isInt(user_est) == true){
    if(confirm(`You are uploading your visit to '${JSON.name}' with ${user_est} people. Are you sure?`)) {
      JSON.estimation = parseInt(user_est);

      const user_visit = $.ajax({
        url: 'Declare_visit_upload_backend.php',
        method: 'POST',
        dataType: 'text',
        data:{json:JSON},
        success: function(answer){
          alert("Upload done!");
        }
      })
    }else{
      alert("Upload failed!");
      window.location.reload();
    }
  }else{
    alert("You have to put your estimation!Must be integer.")
  }
}

function isInt(value) {
  console.log(value);
  console.log(typeof(value));
  return !isNaN(value) && (function(x) {
       return (x | 0) === x;
   })(parseFloat(value))
  }

  function boldString(str, substr) {
  var strRegExp = new RegExp(substr, 'g');
  return str.replace(strRegExp, '<b>'+substr+'</b>');
  }

</script>
</body>
