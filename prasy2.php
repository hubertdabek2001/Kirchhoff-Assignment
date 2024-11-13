<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kirchhoff-Auomotive: Czas pracy pras</title>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="60">
	<script type="text/javascript" src="js\fusioncharts.js"></script>
	<script type="text/javascript" src="js\themes\fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="js\fusioncharts.gantt.js"></script>

	</head>
<body>
<?php
    $serverName = "miesrv915.mes.kautomotive.local\\Hydms8";
    $connectionInfo = array( "Database"=>"hydra1", "UID"=>"plan_user", "PWD"=>"GyFAZn5m");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $sql = "select 
    h.subkey1 as machine
    ,ab.artikel as KA
    ,h.gut_pri
    ,getdate() as durrent_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as planned_start_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+7200, 0) as planned_end_time from 
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

    $current_date = date('Y-m-d');
    $last_day = date("Y-m-d", strtotime("7 day"));

    ?>
<script type="text/javascript">
        
		FusionCharts.ready(function(){
			var chartObj = new FusionCharts({
    type: 'gantt',
    renderAt: 'chart-container',
    width: '100%',
    height: '800',
    dataFormat: 'json',
    dataSource: {
    "chart": {
        "caption": "Prasy mechaniczne w firmie Kirchhoff-Automotive",
        "subcaption": "Zaplanowany, a właściwy czas pracy",
        "dateformat": "yyyy-mm-dd",
        "outputdateformat": "hh:mn:ss",
        "ganttwidthpercent": "40",
        "ganttPaneDuration": "3",
        "ganttPaneDurationUnit": "d",
        "plottooltext": "$processName{br} $label starting date $start{br}$label ending date $end",
        "legendBorderAlpha": "0",
        "flatScrollBars": "1",
        "gridbordercolor": "#333333",
        "gridborderalpha": "20",
        "slackFillColor": "#e44a00",
        "taskBarFillMix": "light+0",
        "theme": "fusion"
    },
    "categories": [
        {
            "bgcolor": "#999999",
            "category": [
                <?php
                    echo '"start": "'.$current_date.' 00:00:00", 
                        "end": "'.$last_day.' 23:59:59",
                        "label": "Dni",
                        "align": "middle",
                        "fontcolor": "#ffffff",
                        "fontsize": "12"}';
                ?>
                 ]
        },
        {
            "bgcolor": "#999999",
            "align": "middle",
            "fontcolor": "#ffffff",
            "fontsize": "12",
            "category": [
                <?php

$k = 1;
    for($i=0;$i<=6;$i++){
        
        echo '{"start": "'.($increasing_date = (date("Y-m-d"), strtotime("+$i day"))).'", "end": "'.($increasing_tommorrows_date = (date("Y-m-d"), strtotime("+$k day"))).'", "label": "'.(date('l', strtotime($increasing_date))).'"},';
        $k++;
    }

                ?>
                
                 ]
        },
        {
            "bgcolor": "#ffffff",
            "fontcolor": "#333333",
            "fontsize": "11",
            "align": "center",
            "category": [
                
                 ]
        }
    ],
    "processes": {
        "headertext": "Task",
        "fontcolor": "#000000",
        "fontsize": "11",
        "isanimated": "1",
        "bgcolor": "#6baa01",
        "headervalign": "bottom",
        "headeralign": "left",
        "headerbgcolor": "#999999",
        "headerfontcolor": "#ffffff",
        "headerfontsize": "12",
        "align": "left",
        "isbold": "1",
        "bgalpha": "25",
        "process": [
            <?php
            $l=0;
            while ($row = sqlsrv_fetch_array($stmt)){
                $machine_name = '{"label": "'.json_encode($row['machine']).'", "id": "'.$l++.'"},';
                echo $machine_name;
            }
			?>
        ]
    },
    "tasks": {
        "task": [

            ]
    },
    "legend": {
        "item": [
            {
                "label": "Zaplanowany czas pracy maszyny",
                "color": "#008ee4"
            },
            {
                "label": "Czas pracy maszyny",
                "color": "#6baa01"
            },
            {
                "label": "Opóźnienie czasu pracy maszyny ",
                "color": "#e44a00"
            }
        ]
    }
    
}


    
});
			chartObj.render();
});

	</script>
    <div class="chart" id="chart-container">FusionCharts XT will load here!</div>
    </body>
</html>