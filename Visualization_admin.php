<?php include 'header.php'?>
<div class="scrollmenu">
	<a href="index_admin.php">Home</a>
	<a class="active" href="Visualization_admin.php">Visualization a, b, c</a>
	<a href="Visualization_admin_1.php">Visualization d</a>
	<a href="logout.php">Logout</a>
</div>

<title>Visualization admin</title>

<div class = "container">
  <canvas id = "lineChart" width="400" height="200" aria-label="Hello ARIA World" role="img"></canvas>
</div>

<script>
var data = $.ajax({
    url: "data_backend.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
        console.log(data);
    }
});

data.done(success)


function success(responseText) {
		let chart_data = [];
		chart_data.push(parseInt(responseText[0].user_visits), parseInt(responseText[1].covid_case), responseText[2].positive);
		console.log(chart_data);


    const CHART1 = document.getElementById("lineChart").getContext('2d');

    let lineChart = new Chart(CHART1, {
        type: 'bar',
        data: {
            labels: ["No. of Users visits","No. of Covid cases","No. of positive visits"],
            datasets: [{
										fill: false,
                    data: chart_data,
                    backgroundColor: ['yellow','red','green'],
                    borderWidth: 1,
                    borderColor: '#777',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }
            ]
        },
				options: {
					plugins: {
						legend: {
							display: false
						}
					}
				}
    });

}
</script>
