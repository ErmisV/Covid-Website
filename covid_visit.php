<?php include 'header.php'?>
<title>Spot Covid</title>

<div class="scrollmenu">
	<a href="index.php">Home</a>
	<a href="Visualization.php">Visualization</a>
	<a href="Declare_visit.php">Declare Visit</a>
	<a href="Declare_Covid.php">Declare Covid-19 Case</a>
	<a class="active" href="covid_visit.php">Spot Covid</a>
	<a href="Profile Management.php">Profile Management</a>
	<a href="logout.php">Logout</a>
</div>
<body>
	<h1>COVID VISITS WITHIN 2 HOURS</h1>
	<table id = "table">
	</table>
	<h1>COVID VISITS WITHIN 7 DAYS</h1>
	<table id = "table1">
	</table>
</body>
<script>

const request = $.ajax({
  url:"covid_visit_backend.php",
  method:"POST",
  dataType:"json",
  success: function(data){
    console.log(data);
		 $.ajax({
			 url:"covid_visit_backend_b.php",
			 method:"POST",
			 dataType:"json",
			 success: function(dat){
				 console.log(dat);

				 var table1 = document.getElementById("table1");

			 		let thead1 = document.createElement('thead');
			 		let tbody1 = document.createElement('tbody');

			 		table1.appendChild(thead1);
			 		table1.appendChild(tbody1);

			 		let row_1 = document.createElement('tr');
			 		let heading_1 = document.createElement('th');
			 		heading_1.innerHTML = "Name";
			 		let heading_2 = document.createElement('th');
			 		heading_2.innerHTML = "Date of other user visit";
			 		let heading_3 = document.createElement('th');
			 		heading_3.innerHTML = "Name";
			 		let heading_4 = document.createElement('th');
			 		heading_4.innerHTML = "Date of user visit";


			 		row_1.appendChild(heading_1);
			 		row_1.appendChild(heading_2);
			 		row_1.appendChild(heading_3);
			 		row_1.appendChild(heading_4);
			 		thead1.appendChild(row_1);

			 		for(let i=0;i<dat.length;i++){
			 			let row = document.createElement('tr');
			 			let row_name_users = document.createElement('td');
			 			let row_date_users = document.createElement('td');
			 			let row_name_user = document.createElement('td');
			 			let row_date_user = document.createElement('td');



			 			row_name_users.innerHTML = dat[i].other_users_b.Name;
			 			row_date_users.innerHTML = dat[i].other_users_b.Date_of_upload;
			 			row_name_user.innerHTML = dat[i].user_b.Name;
			 			row_date_user.innerHTML = dat[i].user_b.Date_of_upload;


			 			row.appendChild(row_name_users);
			 			row.appendChild(row_date_users);
			 			row.appendChild(row_name_user);
			 			row.appendChild(row_date_user)
			 			tbody1.appendChild(row);

			 		}
				 }
			 });
		var table = document.getElementById("table");

		let thead = document.createElement('thead');
		let tbody = document.createElement('tbody');

		table.appendChild(thead);
		table.appendChild(tbody);

		let row_1 = document.createElement('tr');
		let heading_1 = document.createElement('th');
		heading_1.innerHTML = "Name";
		let heading_2 = document.createElement('th');
		heading_2.innerHTML = "Date of other user visit";
		let heading_3 = document.createElement('th');
		heading_3.innerHTML = "Name";
		let heading_4 = document.createElement('th');
		heading_4.innerHTML = "Date of user visit";


		row_1.appendChild(heading_1);
		row_1.appendChild(heading_2);
		row_1.appendChild(heading_3);
		row_1.appendChild(heading_4);
		thead.appendChild(row_1);

		for(let i=0;i<data.length;i++){
			let row = document.createElement('tr');
			let row_name_users = document.createElement('td');
			let row_date_users = document.createElement('td');
			let row_name_user = document.createElement('td');
			let row_date_user = document.createElement('td');



			row_name_users.innerHTML = data[i].other_users.Name;
			row_date_users.innerHTML = data[i].other_users.Date_of_upload;
			row_name_user.innerHTML = data[i].user.Name;
			row_date_user.innerHTML = data[i].user.Date_of_upload;


			row.appendChild(row_name_users);
			row.appendChild(row_date_users);
			row.appendChild(row_name_user);
			row.appendChild(row_date_user)
			tbody.appendChild(row);

		}

  }
});


</script>
