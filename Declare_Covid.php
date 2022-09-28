<?php include 'header.php'?>
<title>Declaration form</title>

<div class="scrollmenu">
	<a href="index.php">Home</a>
	<a href="Visualization.php">Visualization</a>
	<a href="Declare_visit.php">Declare Visit</a>
	<a class="active" href="Declare_Covid.php">Declare Covid-19 Case</a>
	<a href="covid_visit.php">Spot Covid</a>
	<a href="Profile Management.php">Profile Management</a>
	<a href="logout.php">Logout</a>
</div>

<body>
  <link rel="stylesheet" href="log.css">
   <div class="wrapper fadeInDown">
   <div id="formContent">
   <div class="container">
  <h2 for="meeting-time">When you were diagnosed with covid-19:</h2>

<input type="datetime-local" id="covid_date"
       name="meeting-time"
       min="2021-01-01T00:00" max="2022-12-31T00:00">
<button id="Upload_button" onclick="Declare_Covid()">Upload</button>
</body>
<script>

//set time function taken by:https://tecadmin.net/get-current-date-time-javascript/
var now = new Date();
//change
  now.toLocaleString('en-US', { timeZone: 'Europe/Athens' })
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById('covid_date').value = now.toISOString().slice(0,16);

//ajax
function Declare_Covid(){

	//Covid date that the user chose
  let date = document.getElementById('covid_date').value;

	//Send the date to php in order to be uploaded to database
  if(confirm(`Are you sure you want to upload your Covid-Case in ${date.replace("T",' ')}?`)){// to T diaxorizei imerominia k ora

    const confirm = $.ajax({
      url: 'Declare_Covid_backend.php',
      method: 'POST',
      dataType: 'text',
      data: {
          positive: 1,
			date: date
      },
      success: function(response) {
				console.log(response)
				if(response == 1){
					alert("14 days must pass to declare again your covid case");
					//document.location.reload();
				}else if(response == 2){
					Swal.fire({
						text:"Dont put a future date"
					});
					//alert("Dont put a future date");
					//document.location.reload();
				}else{
					
					alert(`Covid case of user with id:${response} Declared!`);
					//document.location.reload();
				}
      }
    });

  }else{
    alert("Ok boomer!");
  }

}

</script>
