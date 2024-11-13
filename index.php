<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<title>Kirchhoff-Auomotive</title>
    <meta http-equiv="refresh" content="3600">
	<script type="text/javascript" src="js\fusioncharts.js"></script>
	<script type="text/javascript" src="js\themes\fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="js\fusioncharts.gantt.js"></script>
	</head>
	<body>
        <div class="container-fluid">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
            <a href="index.php"><img class="imgg" src="kirchhoff_logo.png" ></a>
            <div id="clock" onload="currentTime" class="clock"><h2>
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
</div>
    <div class="card">
        <h5 class="card-header">Prasy</h5>
            <div class="card-body">
                <h5 class="card-title">Zobacz jak...</h5>
                <p class="card-text">... działają prasy hydrauliczne w trakcie pracy!</p>
                <a href="index2.php" class="btn btn-primary">Przejdź dalej!</a>
    </div>
    <div class="card">
         <h5 class="card-header">Zgrzewarki</h5>
          <div class="card-body">
                <h5 class="card-title">Zobacz jak...</h5>
                <p class="card-text">... działają zgrzewarki w trakcie pracy!</p>
                <a href="zgrzewarki.php" class="btn btn-primary">Przejdź dalej!</a>
    </div>
        <div class="card">
            <h5 class="card-header">Roboty</h5>
            <div class="card-body">
                <h5 class="card-title">Zobacz jak...</h5>
                    <p class="card-text">... działają roboty mechaniczne w trakcie pracy!</p>
                    <a href="roboty.php" class="btn btn-primary">Przejdź dalej!</a>
    </div> 
    <div class="card">
            <h5 class="card-header">Komputery</h5>
            <div class="card-body">
                <h5 class="card-title">Zobacz jak...</h5>
                    <p class="card-text">... działają komputery w firmie!</p>
                    <a href="komputery.php" class="btn btn-primary">Przejdź dalej!</a>
    </div> 
          
             
              </div>
              </div>
            

        
        </div>
        <div class="container-md">
            <h7><p>Kontakt:</p>
            hubert.dabek@kirchhoff-automotive.com
        </h7>

        </div>

	</body>
</html>