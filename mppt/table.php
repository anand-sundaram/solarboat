<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'] . "/";
        include($path."libraries.php");
    ?>

    <title>MPPT</title>
    </head>

    <body>

    <?php  include($path."header.php");  ?>
        
    <ul class="nav nav-tabs">
      <li role="presentation" ><a href="http://solarboat.d1.comp.nus.edu.sg/mppt/graph.php">Graph</a></li>
      <li role="presentation" class="active"><a href="http://solarboat.d1.comp.nus.edu.sg/mppt/table.php">Table</a></li>


    </ul>

<br>
<br>
<form action="table.php" class="form-horizontal">


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


<div class="col-md-8" align=" middle">
    <table class="table table-hover table-bordered" align="center" style="margin: 0px auto;">

<tr>
    <th>Time</th>
    <th>Panel Voltage (mV)</th> 
    <th>Panel Power (W)</th> 
    <th>Battery Voltage (mV)</th> 
    <th>Battery Current (mA)</th> 
  </tr>

    <?php

    $db = new mysqli("localhost","root", "", "bobodata");

    $tableName = "y".date("Y")."m".date("n");
    $currentDate = date("Y-m-d");
    $nextDate = date("Y-m-d", strtotime("+1 day"));

    if(isset($_GET['startdate']) && isset($_GET['enddate'])) {
        $start = $_GET['startdate'];
        $end = $_GET['enddate'];


        $result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), panel_voltage, panel_power, battery_voltage, battery_current from ".$tableName."MPPT where time <= '".$end.
            "' and time >='".$start."' order by time desc;");
    }

    else {

        $result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), panel_voltage, panel_power, battery_voltage, battery_current from ".$tableName."MPPT where time <= '".$nextDate.
            "' and time >='".$currentDate."' order by time desc;");
    }


    while ($row = mysqli_fetch_row($result)) {
    ?>

<tr>
    <td><?php echo $row[0]; ?></td>
    <td><?php echo $row[1]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[4]; ?></td>
    
</tr>


    <?php }  

    ?>
</table>
</div>

    </body>

    <script>
    
        $(function() {
             $( "#startdatepicker" ).datepicker({minDate: new Date(2015, 3, 18), dateFormat: "yy-mm-dd"});
        });

        $(function() {
             $( "#enddatepicker" ).datepicker({minDate: new Date(2015, 3, 19), dateFormat: "yy-mm-dd"});
        });

    </script>
    </html>