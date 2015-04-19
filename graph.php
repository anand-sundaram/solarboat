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
  <title>Graphs</title>
</head>
 
<body>
<?php 

        $path = $_SERVER['DOCUMENT_ROOT'] . "/";

        include($path."header.php");
?>

<script src="http://code.highcharts.com/highcharts.js"></script>
<!-- <script src="http://www.highcharts.com/js/themes/dark-unica.js"></script> -->
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

</body>

<script type="text/javascript">
var chartNames = ["Panel Voltage", "Panel Power", "Battery Voltage", "Battery Current"];
var axisNames = ["Voltage (mV)", "Power (W)", "Voltage (mV)", "Current (mA)"];

var containerNames = ['container1', 'container2', 'container3', 'container4'];

var chartNumber = 0;

var options;

function getOptions(count) {
   return {
        chart: {
            renderTo: containerNames[count],
            // defaultSeriesType: 'scatter',
            // type: 'scatter'
            type: 'spline'
        },
        title: {
            text: chartNames[count]
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
                text: axisNames[count]
            }
        },
        series: [],

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
            
        }
    };
}

function getSeries(count) {
    var obj = {
                    data: []
                };
    obj.name = chartNames[count];
    return obj;
}

var options0 = getOptions(0);
var options1 = getOptions(1);
var options2 = getOptions(2);
var options3 = getOptions(3);

//theme = 'dark-unica';
$(function () {

    

    var series0 = getSeries(0);
    var series1 = getSeries(1);
    var series2 = getSeries(2);
    var series3 = getSeries(3);



    <?php

    $db = new mysqli("localhost","root", "", "bobodata");

    $result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), panel_voltage, panel_power, battery_voltage, battery_current from y2015m4MPPT order by time asc;");


    ?>


    <?php
    while ($row = mysqli_fetch_row($result)) {
    ?>


    var d = new Date("<?php echo $row[0]; ?>");


    var row0 = [];
    var row1 = [];
    var row2 = [];
    var row3 = [];



    row0.push(Date.UTC(d.getFullYear(),  d.getMonth(),  d.getDate(), d.getHours(), d.getMinutes()));
    row1.push(Date.UTC(d.getFullYear(),  d.getMonth(),  d.getDate(), d.getHours(), d.getMinutes()));
    row2.push(Date.UTC(d.getFullYear(),  d.getMonth(),  d.getDate(), d.getHours(), d.getMinutes()));
    row3.push(Date.UTC(d.getFullYear(),  d.getMonth(),  d.getDate(), d.getHours(), d.getMinutes()));

    row0.push(parseFloat("<?php echo $row[1]; ?>"));
    row1.push(parseFloat("<?php echo $row[2]; ?>"));
    row2.push(parseFloat("<?php echo $row[3]; ?>"));
    row3.push(parseFloat("<?php echo $row[4]; ?>"));

    series0.data.push(row0);
    series1.data.push(row1);
    series2.data.push(row2);
    series3.data.push(row3);

    <?php }  
    //die();
    ?>



    options0.series.push(series0);
    options1.series.push(series1);
    options2.series.push(series2);
    options3.series.push(series3);


    var chart0 = new Highcharts.Chart(options0);
    var chart1 = new Highcharts.Chart(options1);
    var chart2 = new Highcharts.Chart(options2);
    var chart3 = new Highcharts.Chart(options3);



});




</script>
</html>

<!-- Also look at Highcharts -->

