
<!doctype html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<script src="sweetalert2.min.js"></script>
			<link rel="stylesheet" href="sweetalert.min.css">

			<style>

				html {
				background-color: #F08080;
				}

				body {
				margin:0;
				font-family: Arial, Helvetica, sans-serif;
				}

				div.scrollmenu {
				  background-color: #333;
				  overflow: auto;
				  white-space: nowrap;
				}


				.scrollmenu {
				overflow:hidden;
				font-size:30px;
				background-color:#000000;
				-webkit-box-shadow: 0 30px 50px 0
				rgba(95,186,233,0.4);
				box-shadow: 0 40px 40px 0 rgba(0,0,0,0.3);
				-webkit-border-radius: 6px 6px 6px 6px;
				border-radius: 5px 5px 5px 5px;
				margin: 5px 7px 30px 7px;
				height:53px;
				}

				.Welcome{
					position:absolute;
					top:90px;
					left:15px;
				}

				.scrollmenu a{
                float: rght;
                color:#999999;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
				}

				.scrollmenu a:hover {
                background-color:#eeccff;
                color: black;
				}

				.scrollmenu a.active {
                background-color: #cc66ff;
                color: white;
				}

				.Background{
					color:white;
					position:absolute;
					top:100px;
					width:100px;
					z-index: 5;
				}


			</style>
		</head>
	<title>Profile Management</title>
	<body>
	<div class="scrollmenu">
		<a href="index.php">Home</a>
		<a href="Visualization.php">Visualization</a>
		<a href="Declare_visit.php">Declare Visit</a>
		<a href="Declare_Covid.php">Declare Covid-19 Case</a>
		<a href="covid_visit.php">Spot Covid</a>
		<a class="active" href="Profile Management.php">Profile Management</a>
		<a href="logout.php">Logout</a>
	</div>


		<link rel="stylesheet" href="log.css">
		<link rel="stylesheet" href="table_admin.css">
		<div class="wrapper fadeInDown">
		<div id="formContent">
		<div class="container">

	   <h1>Profile Management</h1>


		  <form accept-charset="utf-8">




                <div>

                    <label for="username"> </label>
                    <input type="text" class="form-control" name="user_PM" placeholder="Username..." required>

                </div>

                <div>

                    <label for="password"></label>
                    <input type="password" class="form-control" name="old_pass" placeholder="Old Password..." required>

                </div>

                <div>

                    <label for="password"></label>
                    <input type="password" class="form-control" name="pass_PM" placeholder="Password..." required>

                </div>

                <div>

                    <label for="password"></label>
                    <input type="password" class="form-control" name="repeat_pass_PM" placeholder="Confirm Password..." required>

                </div>

               <button type="submit"  name="reg_user_PM" onclick = "profile_manage()"> Submit </button>

            </form>

						<p id="count"></p><p id="covid_date"></p>
							<table id="Values_table">
								<thead>
									<th>Name</th>
									<th>Address</th>
									<th>Location</th>
									<th>Date of visit</th>
								</thead>
								<tbody id="rows"></tbody>
							</table>

            <script type="text/javascript" src="Profile_Management_check.js?newversion"></script>
						<script>
							const values_0 = $.ajax({
								url:"Profile_Management_values_0.php",
								type:"POST",
								dataType:"json",
								success: function(data){
									console.log(data);
								}
							});


							values_0.done(onsuccess_0)

							function onsuccess_0(responseText){
								let count = responseText.pop();
								let date = responseText.pop();
								document.getElementById("count").innerHTML='Covid positive: '+count.count;
								if(date.covid_date == null){
									document.getElementById("covid_date").innerHTML = "Date of Covid: None";
								}else{
									document.getElementById("covid_date").innerHTML='Date of Covid: '+date.covid_date.Covid_date;
								}


								let rows = document.getElementById('rows');
								rows.innerHTML="";
								var tr="";


								responseText.forEach(x=>{
									tr+='<tr>';
									tr+='<td>'+x.name+'</td>'+'<td>'+x.Address+'</td>'+'<td>'+x.loc.join(",")+'</td>'+'<td>'+x.Date_of_visit+'</td>';
									tr+='</tr>';
								})
								rows.innerHTML+=tr;
							}

						</script>


    </body>

	
	
</html>