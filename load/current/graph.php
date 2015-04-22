<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'] . "/";
        include($path."libraries.php");
    ?>   
    <title>Load Current</title>
</head>

<body>

    <?php  include($path."header.php");  ?>

    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="http://solarboat.d1.comp.nus.edu.sg/load/current/graph.php">Graph</a></li>
      <li role="presentation" ><a href="http://solarboat.d1.comp.nus.edu.sg/load/current/table.php">Table</a></li>


    </ul>

    <br>
<br>
<form action="graph.php" class="form-horizontal">


  <div class="form-group">
    <label for="startdatepicker" class="col-sm-2 control-label">Start Date</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="startdatepicker" name="startdate">
    </div>
  </div>
  <div class="form-group">
    <label for="enddatepicker" class="col-sm-2 control-label">End Date</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="enddatepicker" name="enddate">
    </div>
  </div>
   <!--  <p >  Start Date: <input type="text" id="startdatepicker" name="startdate"></p>
    <p >  End Date: <input type="text" id="enddatepicker" name="enddate"></p> -->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input class="btn btn-default" type="submit" value="Submit">
    </div>
  </div>
    
    </form>

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

</body>
<?php

$db = new mysqli("localhost","root", "", "bobodata");

if(isset($_GET['startdate']) && isset($_GET['enddate'])) {
        $start = $_GET['startdate'];
        $end = $_GET['enddate'];


        $result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), loadCurrent from y2015m4Current where time <= '".$end.
            "' and time >='".$start."' order by time asc;");
    }

    else {

        $result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), loadCurrent from y2015m4Current order by time asc;");
    }

?>

<script type="text/javascript">

$(function() {
         $( "#startdatepicker" ).datepicker({minDate: new Date(2015, 3, 18), dateFormat: "yy-mm-dd"});
    });

    $(function() {
         $( "#enddatepicker" ).datepicker({minDate: new Date(2015, 3, 19), dateFormat: "yy-mm-dd"});
    });


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