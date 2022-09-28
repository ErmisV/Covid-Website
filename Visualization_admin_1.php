<?php include 'header.php'?>


<div class="scrollmenu">
	<a href="index_admin.php">Home</a>
	<a href="Visualization_admin.php">Visualization a, b, c</a>
	<a class="active" href="Visualization_admin_1.php">Visualization d</a>
	<a href="logout.php">Logout</a>
</div>

<title>Visualization admin</title>
<style>
.pointer       { cursor: pointer; }
</style>

<link rel="stylesheet" href = "table_admin.css">
<div class="table-wrapper">
<table id="Values_table" class="fl-table">
	<thead id = "head" class = "pointer">
		<th class="sortable">Type</th>
		<th class="sortable">Count</th>
		<th class="sortable">Positive Count</th>
	</thead>
	<tbody id = "body"><tr></tr></tbody>
</table>
</div>

<script>
	const ajax_query = $.ajax({
		url: "data_backend_2.php",
		type:"POST",
		dataType:"json"
	});

	const ajax_query_1 = $.ajax({
		url:"data_backend_3.php",
		type:"POST",
		dataType:"json"
	});

ajax_query_1.done(function() {
	ajax_query.done(function() {

		$.ajax({
			url: "data_backend_1.php",
			type:"POST",
			dataType: "json",
			success: function(data){
				//console.log(data);
				//arrays

				var string_array = [];
				var string_array_1 = [];
				var string_array_2 = [];
				var string,string_1,string_2;
				var final_result = [];



				//Create table
				var tr = "";
				var column_3 = "";
				var cell = document.createElement("td");

				//HTML Table
				var myTab = document.getElementById('Values_table');

				for (let i=0;i<data.length;i++){
					string_array.push(data[i].types);
				}

				for (let i=0;i<ajax_query.responseJSON.length;i++){
					string_array_1.push(ajax_query.responseJSON[i].types);
				}

				for(let j=0;j<ajax_query_1.responseJSON.length;j++){
					string_array_2.push(ajax_query_1.responseJSON[j].types);
				}

				string = string_array.toString();
				string_1 = string_array_1.toString();
				string_2 = string_array_2.toString();

				wordArray = string.split(',');
				wordArray_1 = string_1.split(',');
				wordArray_2 = string_2.split(',');


				//https://stackoverflow.com/a/57028486/14749665
				const map = wordArray.reduce((wordArray,e) => wordArray.set(e, (wordArray.get(e) || 0) + 1), new Map());
				const map_1 = wordArray_1.reduce((wordArray_1,e) => wordArray_1.set(e, (wordArray_1.get(e) || 0) + 1), new Map());
				const map_2 = wordArray_2.reduce((wordArray_2,e) => wordArray_2.set(e, (wordArray_2.get(e) || 0) + 1), new Map());

				result=[...map.keys()];
				result_1=[...map_1.entries()];
				result_2=[...map_2.entries()];
				key = [...map.keys()];
				key_1 = [...map_1.keys()];
				key_2 = [...map_2.keys()];

				result.sort(function(a, b){ return b - a});
				result_1.sort(function(a, b){ return b[1] - a[1]});
				result_2.sort(function(a, b){ return b[1] - a[1]});




				for(let i=0;i<result.length;i++){
					final_result[i] = [result[i],0,0];
					for(let j=0;j<result_1.length;j++){
						if(result[i]==(result_1[j][0])){
							final_result[i][1] = result_1[j][1];
						}
					}
				}

				for (let i=0;i<result.length;i++){
					for (let a=0;a<result_2.length;a++){
						if(result[i]==(result_2[a][0])){
							final_result[i][2] = result_2[a][1];
						}
					}
				}

				final_result.sort();

				for(let j=0;j<final_result.length;j++){

							rows = document.getElementById('body');
							tr += '<tr>';
							tr += '<td>'+final_result[j][0]+'</td>' + '<td>' +final_result[j][1]+'</td>'+'<td>'+final_result[j][2]+'</td>';
							tr += '</tr>';

					}

				rows.innerHTML +=tr;

				$(document).ready(function(){
					var sortOrder = 1;
					function getVal(elm, colIndex){
						var td = $(elm).children('td').eq(colIndex).text();

						if(typeof td !== "undefined"){
							var v = td.toUpperCase();
							if($.isNumeric(v)){
								v = parseInt(v,10);
							}
							return v;
						}
					}
					$(document).on('click','.sortable', function(){

						var self=$(this);

						var colIndex = self.prevAll().length;
						console.log(colIndex);
						var o = (sortOrder == 1)? 'asc' : 'desc';
						console.log(o);
						sortOrder *= -1;
						console.log(sortOrder);

							$('.sortable').removeClass('asc').removeClass('desc');
							self.addClass(o);

						var tbody = self.closest("table").find("tbody");
						console.log(tbody);
						var tr = tbody.children('tr');
						//console.log(tr.sort())
						tr.sort(function(a,b){

							var A = getVal(a, colIndex);
							console.log(colIndex);
							var B = getVal(b, colIndex);
							console.log(A);
							console.log(B);

							if(A < B){
								return -1*sortOrder;
							}
							if(A > B){
								return 1*sortOrder;
							}
							return 0;
						});

						$.each(tr, function(index,row){
							tbody.append(row);
						})
					});
				});



			}
		});
	});
});


</script>
