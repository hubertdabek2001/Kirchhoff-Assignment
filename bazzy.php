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
    $i=0;
    $k=0;
    $j=0;
    $sql2 = "select 
    h.subkey1 as machine
    ,ab.artikel as KA
    ,h.gut_pri
    ,getdate() as durrent_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit-h.dauer, 0) as start
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+h.dauer, 0) as 'end' from 
    hydadm.hybuch h
    left join hydadm.maschinen m on h.subkey1=m.masch_nr
    left join hydadm.auftrags_bestand ab on h.subkey2=ab.auftrag_nr
    where 
    key_type='A'
    and ab.auftrag_art='0'
    and m.mgruppe='PAUT'";
    
    $stmtt = sqlsrv_query($conn, $sql2, $parms, $options);
    while($row = sqlsrv_fetch_array($stmtt)){
        
       }

    $sql3 = "select 
    h.subkey1 as machine
    ,ab.artikel as KA
    ,h.gut_pri
    ,getdate() as durrent_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit-h.dauer, 0) as start
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+h.dauer, 0) as 'end' from 
    hydadm.hybuch h
    left join hydadm.maschinen m on h.subkey1=m.masch_nr
    left join hydadm.auftrags_bestand ab on h.subkey2=ab.auftrag_nr
    where 
    key_type='A'
    and ab.auftrag_art='0'
    and m.mgruppe='PAUT'";
    
    $stmt1 = sqlsrv_query($conn, $sql3, $parms, $options);

    $sql4 = "select 
    h.subkey1 as machine
    ,ab.artikel as KA
    ,h.gut_pri
    ,getdate() as durrent_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit-h.dauer, 0) as start
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+h.dauer, 0) as 'end' from 
    hydadm.hybuch h
    left join hydadm.maschinen m on h.subkey1=m.masch_nr
    left join hydadm.auftrags_bestand ab on h.subkey2=ab.auftrag_nr
    where 
    key_type='A'
    and ab.auftrag_art='0'
    and m.mgruppe='PAUT'";
    
    $stmt2 = sqlsrv_query($conn, $sql4, $parms, $options);
   
    
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
                {
                    "start": "2022/8/15 00:00:00",
                    "end": "2022/8/21 23:59:59",
                    "label": "Dni",
                    "align": "middle",
                    "fontcolor": "#ffffff",
                    "fontsize": "12"
                }
            ]
        },
        {
            "bgcolor": "#999999",
            "align": "middle",
            "fontcolor": "#ffffff",
            "fontsize": "12",
            "category": [
                {
                    "start": "2022/8/15",
                    "end": "2022/8/16",
                    "label": "Poniedziałek"
                },
                {
                    "start": "2022/8/16 ",
                    "end": "2022/8/17 ",
                    "label": "Wtorek"
                },
                {
                    "start": "2022/8/17 ",
                    "end": "2022/8/18 ",
                    "label": "Środa"
                },
                {
                    "start": "2022/8/18 ",
                    "end": "2022/8/19 ",
                    "label": "Czwartek"
                },
                {
                    "start": "2022/8/19 ",
                    "end": "2022/8/20 ",
                    "label": "Piątek"
                },
                {
                    "start": "2022/8/20 ",
                    "end": "2022/8/21 ",
                    "label": "Sobota"
                },
                {
                    "start": "2022/8/21 ",
                    "end": "2022/8/21 23:59:59 ",
                    "label": "Niedziela"
                }
            ]
        },
        {
            "bgcolor": "#ffffff",
            "fontcolor": "#333333",
            "fontsize": "11",
            "align": "center",
            "category": [
                {
                    "start": "2022/8/15 00:00:00",
                    "end": "2022/8/15 ",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/15 7:00:00",
                    "end": "2022/8/15 15:00:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/15 14:45:00",
                    "end": "2022/8/15 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/8/15 22:45:00",
                    "end": "2022/8/16 6:45:00",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/16 6:45:00",
                    "end": "2022/8/16 14:45:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/16 14:45:00",
                    "end": "2022/8/16 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/8/16 22:45:00",
                    "end": "2022/8/17 6:45:00",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/17 6:45:00",
                    "end": "2022/8/17 14:45:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/17 14:45:00",
                    "end": "2022/8/17 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/8/17 22:45:00",
                    "end": "2022/8/18 6:45:00",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/18 6:45:00",
                    "end": "2022/8/18 14:45:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/18 14:45:00",
                    "end": "2022/8/18 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/8/18 22:45:00",
                    "end": "2022/8/19 6:45:00",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/19 6:45:00",
                    "end": "2022/8/19 14:45:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/19 14:45:00",
                    "end": "2022/8/19 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/8/19 22:45:00",
                    "end": "2022/8/20 6:45:00",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/20 6:45:00",
                    "end": "2022/8/20 14:45:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/20 14:45:00",
                    "end": "2022/8/20 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/8/20 22:45:00",
                    "end": "2022/8/21 6:45:00",
                    "label": "Zmiana 3"
                },
                {
                    "start": "2022/8/21 6:45:00",
                    "end": "2022/8/21 14:45:00",
                    "label": "Zmiana 1"
                },
                {
                    "start": "2022/8/21 14:45:00",
                    "end": "2022/8/21 22:45:00",
                    "label": "Zmiana 2"
                },
                {
                    "start": "2022/21 22:45:00",
                    "end": "2022/8/21 23:59:59",
                    "label": "Zmiana 3"
                }
                
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
            while ($row = sqlsrv_fetch_array($stmt)){
                $machine_name = '{"label": '.json_encode($row[0]).', "id": "'.$i++.'"},';
                echo $machine_name;
            }
                    ?>
        ]
    },
    "tasks": {
        "task": [
            
            <?php

while($row = sqlsrv_fetch_array($stmt1)){
    $start = json_encode($row['start']);
        $end = json_encode($row['end']);
        $zmiana_start = str_replace("date","start", $start); 
        $zmiana_end = str_replace("date","end", $end);
        $nawiasy1 = str_replace("{","",$zmiana_start);
        $nawiasy11 = str_replace("}","",$nawiasy1);
        $nawiasy2 = str_replace("{","",$zmiana_end);
        $nawiasy22 = str_replace("}","",$nawiasy2);
        $log = json_encode($row['logon_time']);
    $replace1 = str_replace("date", "start",$log);
    $repalce2 = str_replace("}","",$replace1);
    $data1 = '{'.$nawiasy11.', '.$nawiasy22.', "label":"Actual","processid": "'.$k++.'" ,"color": "#008ee4",
        "height": "32%", "toppadding": "56%", "id": "1-1"},';
        echo $data1;
        $data2 = $repalce2.', '.$nawiasy22.', "label":"planned","processid": "'.$j++.'" ,"color": "#6baa01",
        "height": "32%","id": "1"},';
        echo $data2;
    }


?>


           
            
            
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
<p>


       
</p>
</body>
</html>