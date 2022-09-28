<!DOCTYPE html>
	<html>
		<head>
			 <meta http-equiv="pragma" content="no-cache" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<link
				rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
				integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
				crossorigin="" SameSite=Lax  />
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.css" integrity="sha512-mQ77VzAakzdpWdgfL/lM1ksNy89uFgibRQANsNneSTMD/bj0Y/8+94XMwYhnbzx8eki2hrbPpDm0vD0CiT2lcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.Default.css" integrity="sha512-6ZCLMiYwTeli2rVh3XAPxy3YoR5fVxGdH/pz+KMCzRY2M65Emgkw00Yqmhh8qLGeYQ3LbVZGdmOX9KUjSKr0TA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<script
				src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
				integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
				crossorigin="" SameSite=Lax  ></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/leaflet.markercluster.js" integrity="sha512-OFs3W4DIZ5ZkrDhBFtsCP6JXtMEDGmhl0QPlmWYBJay40TT1n3gt2Xuw8Pf/iezgW9CdabjkNChRqozl/YADmg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.src.js" integrity="sha512-V+GL/y/SDxveIQvxnw71JKEPqV2N+RYrUlf6os3Ru31Yhnv2giUsPadRuFtgmIipiXFBc+nCGMHPUJQc6uxxOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.min.css" integrity="sha512-qI2MrOLvDIUkOYlIJTFwZbDQYEcuxaS8Dr4v+RIFz1LHL1KJEOKuO9UKpBBbKxfKzrnw9UB5WrGpdXQi0aAvSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
				<link rel="stylesheet" href="src/leaflet-search.css" />
				<script src="src/leaflet-search.js"></script>
				<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
				<script src="sweetalert2.min.js"></script>
				<link rel="stylesheet" href="sweetalert.min.css">

				<style>

				html {
				 background-image: url("images/covid.jpg");
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

				</div>


		</body>
	</html>
