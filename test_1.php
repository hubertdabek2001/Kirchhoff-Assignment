<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kirchhoff-Auomotive: Czas pracy pras</title>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="60">
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="js\fusioncharts.gantt.js"></script>

</head>
<body>

<?php

    $serverName = "miesrv915.mes.kautomotive.local\\Hydms8";
    $connectionInfo = array( "Database"=>"hydra1", "UID"=>"plan_user", "PWD"=>"GyFAZn5m");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if($conn){
        echo "Polaczono do bazy.<br/>";
    }
    else{
        echo "Nie polaczono do bazy.<br/>";
        die(print_r(sqlsrv_errors(), true));
    }

    $sql = "select 
    h.subkey1 as machine
    ,ab.artikel as KA
    ,h.gut_pri
    ,getdate() as durrent_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit-h.dauer, 0) as planned_start_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+h.dauer, 0) as planned_end_time from 
    hydadm.hybuch h
    left join hydadm.maschinen m on h.subkey1=m.masch_nr
    left join hydadm.auftrags_bestand ab on h.subkey2=ab.auftrag_nr
    where 
    key_type='A'
    and ab.auftrag_art='0'
    and m.mgruppe='PAUT'";
    $params = array();
    $options = array("Scrollable" =>SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn, $sql, $params, $options );

    $row_count = sqlsrv_num_rows($stmt);

    if($row_count === false)
    echo "Blad danych.<br/>";
    else
    echo "Dobrze.<br/>";


?>
</p>

</body>
</html>