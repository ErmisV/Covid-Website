<?php include 'header.php'?>
<div class="scrollmenu">
	<a class="active" href="index_admin.php">Home</a>
	<a href="Visualization_admin.php">Visualization a, b, c </a>
	<a href="Visualization_admin_1.php">Visualization d</a>
	<a href="logout.php">Logout</a>
</div>

<link rel="stylesheet" href="log.css">
 <div class="wrapper fadeInDown">
		<div id="formContent">

<title>Administrator Page</title>
<h2>Choose File to import to database:</h2>
<input type="file" name="inputfile" id="inputfile" accept=".json">
<table>
 <tr>
  <td>
			<button class="myButton" id="delete_btn" >DELETE STORES</button>
  </td>
 </tr>
</table>


<script>
const delete_rows = document.getElementById('delete_btn');

delete_rows.onclick = function(){
	if(confirm("Are you sure you want to delete all stores?")){
		$.ajax({
			type:"POST",
			url:"Delete_rows.php",
			data:{bool_value:true},
			success:function(data){
				console.log(data);
				Swal.fire({
					text:"Insertion of stores completed"
				}).then(function(){
					window.location.assign("index_admin.php");
				});
			}
		});
	} else{
		Swal.fire({
			text:"Deletion cancelled!"
		});
	}

}

const fileSelector = document.getElementById('inputfile');

fileSelector.addEventListener('change', function() {

	//I create a FileReader object in order to get the file choosen
  var fr = new FileReader();

	//Not accepting multiple files
  fr.readAsText(this.files[0]);

	//When it is loaded then do stuff
  fr.onload = function(){
		//JSON form the file data
    parsed_file = JSON.parse(fr.result);

		let array_file = [];
		for (let i=0; i<parsed_file.length; i++){

			 loop_file ={};
			 loop_file.days_name = [];
			 loop_file.days_data = [];
			 loop_file.id= parsed_file[i].id;
			 loop_file.name= parsed_file[i].name;
			 loop_file.address= parsed_file[i].address;
			 loop_file.lat= parsed_file[i].coordinates.lat;
			 loop_file.lng= parsed_file[i].coordinates.lng;
			 loop_file.rating= parsed_file[i].rating;
			 loop_file.rating_n= parsed_file[i].rating_n;
			 loop_file.types = parsed_file[i].types.toString();

			 for (let j=0; j<(parsed_file[i].populartimes).length; j++){
				 loop_file.days_name.push(parsed_file[i].populartimes[j].name);
				 loop_file.days_data.push(parsed_file[i].populartimes[j].data);
			 }
			 array_file.push(loop_file);
		}
    $.ajax({
      type:"POST",
      url: "Upload_stores_backend.php",
      data: {data:JSON.stringify(array_file)},
      success: function(data){
        console.log(data);
				Swal.fire({
					text:"Insertion of stores completed"
				}).then(function(){
					window.location.assign("index_admin.php");
				});

      }
    })
  }
});
</script>
