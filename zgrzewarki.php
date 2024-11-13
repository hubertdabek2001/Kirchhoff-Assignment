<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kirchhoff-Auomotive: Czas pracy zgrzewarek</title>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="60">
	<script type="text/javascript" src="js\fusioncharts.js"></script>
	<script type="text/javascript" src="js\themes\fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="js\fusioncharts.gantt.js"></script>

	</head>
	<body>
        <div>
        <div class="container-fluid">
            <a href="index.php"><img class="imgg" src="kirchhoff_logo.png" ></a>
            <div id="clock" onload="currentTime"><h2>
    <script type="text/javascript">
             function currentTime() {
  let date = new Date();
  
  let hh = date.getHours();
  let mm = date.getMinutes();
  let ss = date.getSeconds();
  let session = "AM";
  let day = date.getDate();
  let month = date.getMonth();
  let year = date.getFullYear();

   month = month + 1;
   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = day + "/" + month + "/" + year +  " " + hh + ":" + mm + ":" + ss;

  document.getElementById("clock").innerText = time; 
  let t = setTimeout(function(){ currentTime() }, 1000);
}
currentTime();
        </script>
    </h2>
</div>
<script type="text/javascript">
        
		FusionCharts.ready(function(){
			var chartObj = new FusionCharts({
    type: 'gantt',
    renderAt: 'chart-container',
    width: '100%',
    height: '800',
    dataFormat: 'jsonurl',
    dataSource: 'baz1.json'

    
});
			chartObj.render();
});

	</script>
    </div>
    <div class="chart" id="chart-container">FusionCharts XT will load here!</div>
    <div class="container-md">
    <h7><p>Kontakt:</p>
            hubert.dabek@kirchhoff-automotive.com
        </h7>
</div>
	
       
	</body>
</html>