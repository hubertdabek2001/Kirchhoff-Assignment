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
    $i=0;
    $k=0;
    $j=0;
    
    $sql3 = "select 
    h.subkey1 as machine
    ,ab.artikel as KA
    ,h.gut_pri
    ,getdate() as durrent_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as start
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
    ,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+7200, 0) as 'end' from 
    hydadm.hybuch h
    left join hydadm.maschinen m on h.subkey1=m.masch_nr
    left join hydadm.auftrags_bestand ab on h.subkey2=ab.auftrag_nr
    where 
    key_type='A'
    and ab.auftrag_art='0'
    and m.mgruppe='PAUT'";
    
    $stmt1 = sqlsrv_query($conn, $sql3, $parms, $options);

    $sql2 = "SELECT GETDATE() from hydadm.maschinen";

    $stmt2 = sqlsrv_query($conn, $sql2, $parms, $options);

    while($rows = sqlsrv_fetch_array($stmt2)){
        $dzisiejsza_data = json_encode($rows[0]);
        $dataf = str_replace('","timezone_type":3,"timezone":"Europe\/Belgrade"}', "",$dzisiejsza_data);
        $dataf1 = str_replace('{"date":"', "", $dataf);
            $dzien = $dataf1[8].$dataf1[9];
            $dzien1 = $dzien+7;
            $miesiac = $dataf1[5].$dataf1[6];
            $rok = $dataf1[0].$dataf1[1].$dataf1[2].$dataf1[3];
            $cdate = $rok."-".$miesiac."-".$dzien;
            $cdate7 = $rok."-".$miesiac."-".$dzien1;
           
    }
 
 $dni_tygodnia = array( 'Niedziela', 'Poniedzialek', 'Wtorek', 'Sroda', 'Czwartek', 'Piatek', 'Sobota' );
 $date = date( "w" );

  $z=0;
  $x=1;
  /*for ($d=1;$d<=7;$d++){
    echo "<br>";
     $tomorrow = date("Y-m-d", strtotime("+$d day"));
     echo $tomorrow;
     
     }*/
     $end_date = date(('Y-m-d'));
     echo $end_date;
    
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
echo '{"start":"'.$cdate.' 00:00:00",
    "end": "'.$cdate7.' 23:59:59",
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



for($l = 0; $l<=7; $l++){
    if(($date+$z)>=7)
    {
        echo '{"start": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).'", "end": "'.$rok.'-'.$miesiac.'-'.($dzien+$x).'", "label": "'.$dni_tygodnia[ ($date+$z)-7 ] .'"},';
    }
    else
    echo '{"start": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).'", "end": "'.$rok.'-'.$miesiac.'-'.($dzien+$x).'", "label": "'.$dni_tygodnia[ $date+$z ] .'"},';
    $z++;
    $x++;
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
                <?php
                 echo '{"start": "'.$rok.'-'.$miesiac.'-'.$dzien.' 00:00:00" , "end": "'.$rok.'-'.$miesiac.'-'.$dzien.' 6:45:00", "label": "Zmiana 3"},';
                $z=0;
                $x=1;
        for($l = 0; $l<=7; $l++){
           
            echo '{"start": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).' 6:45:00" , "end": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).' 14:45:00", "label": "Zmiana 1"},';
            
            echo '{"start": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).' 14:45:00" , "end": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).' 22:45:00", "label": "Zmiana 2"},';

            echo '{"start": "'.$rok.'-'.$miesiac.'-'.($dzien+$z).' 22:45:00" , "end": "'.$rok.'-'.$miesiac.'-'.($dzien+$x).' 6:45:00", "label": "Zmiana 3"},';
            $z++;
            $x++;
        }
      ?>
                
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
            $i=0;
            while ($row = sqlsrv_fetch_array($stmt)){
                $machine_name = '{"label": '.json_encode($row['machine']).', "id": "'.$i++.'"},';
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