<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'] . "/";
        include($path."libraries.php");
    ?>
  <title>FW2</title>
</head>
 
<body>
<?php  include($path."header.php");  ?>

<div class="col-md-4">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Power from Panels</h3>
  </div>
  <h1><div class="panel-body" id="panelPower">
    
  </div></h1>
</div>
</div>

<div class="col-md-4">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Voltage Across Panels</h3>
  </div>
  <h1><div class="panel-body" id="panelVoltage">
    
  </div></h1>
</div>
</div>

<div class="col-md-4">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Charging Current</h3>
  </div>
  <h1><div class="panel-body" id="chargingCurrent">
    
  </div></h1>
</div>
</div>

<div class="col-md-4">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Battery Voltage</h3>
  </div>
  <h1><div class="panel-body" id="batteryVoltage">
    
  </div></h1>
</div>
</div>

<div class="col-md-4">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Discharging Current</h3>
  </div>
  <h1><div class="panel-body" id="dischargingCurrent">
    
  </div></h1>
</div>
</div>

</body>

<script type="text/javascript">

$(document).ready(function() {


	function getData() {
		$.ajax({
		        type: "GET",
		        url: "latestData.php",
		        success: function(data) {
		        	var arr = JSON.parse(data);
		        	$("#panelPower").html(arr[0] + " W");
		        	$("#panelVoltage").html(arr[1] + " mV");
		        	$("#chargingCurrent").html(arr[2] + " mA");
		        	$("#batteryVoltage").html(arr[3] + " V");
		        	$("#dischargingCurrent").html(arr[4] + " A");
		        },
		        async: false
		    });
	}
		
	getData();
	setInterval(getData, 300000);

});

</script>

</html>