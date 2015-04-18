<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>    
    <title>Load Current</title>
</head>

<body>

    <?php 

        $path = $_SERVER['DOCUMENT_ROOT'] . "/";

        include($path."header.php");

        ?>

    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="http://solarboat.d1.comp.nus.edu.sg/load/current/graph.php">Graph</a></li>
      <li role="presentation" ><a href="http://solarboat.d1.comp.nus.edu.sg/load/current/table.php">Table</a></li>


    </ul>



    <script src="http://code.highcharts.com/highcharts.js"></script>
    <!-- <script src="http://www.highcharts.com/js/themes/dark-unica.js"></script> -->
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

</body>
<?php

$db = new mysqli("localhost","root", "", "bobodata");

$result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %T'), loadCurrent from y2015m4Current order by time asc;");


?>

<script type="text/javascript">

var options = {
    chart: {
        renderTo: 'container',
    // defaultSeriesType: 'scatter',
    // type: 'scatter'
    type: 'spline'
},
title: {
    text: "Load Current"
},
xAxis: {
    type: 'datetime',
    // categories: []
    title: {
        text: 'Time'
    },
    labels: {
        overflow: 'justify'
    }
},
yAxis: {
    title: {
        text: "Current (A)"
    }
},
plotOptions: {
    scatter: {
        dashstyle: 'Solid',
        lineWidth: 1,
        states: {
            hover: {
                lineWidth: 1
            }
        },
        marker: {
            enabled: false
        },

        
    },
    series: {
        connectNulls: true
    }
    
},

series: []

};

var series =  {
   data: []
};

series.name = "Load Current";

<?php
while ($row = mysqli_fetch_row($result)) {
    ?>




    var row = [];

    var d = new Date("<?php echo $row[0]; ?>");

    row.push(Date.UTC(d.getFullYear(),  d.getMonth(),  d.getDate(), d.getHours(), d.getMinutes()));
    row.push(parseFloat("<?php echo $row[1]; ?>"));

    series.data.push(row);

    <?php }  
//die();
    ?>

    options.series.push(series);

// Highcharts.setOptions({
//         global: {
//             useUTC: false
//         }
//     });

var chart = new Highcharts.Chart(options);

</script>
</html>