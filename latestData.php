<?php 

$db = new mysqli("localhost","root", "", "bobodata");

    $tableName = "y".date("Y")."m".date("n");

    $resultMPPT = $db->query("select DATE_FORMAT(time,'%D %M %Y %h:%i %p'), panel_voltage, panel_power, battery_voltage, battery_current from ".$tableName."MPPT order by time desc;");

    $resultVoltage = $db->query("select DATE_FORMAT(time,'%D %M %Y %h:%i %p'), batteryVoltage from ".$tableName."Voltage order by time desc;");

    $resultCurrent = $db->query("select DATE_FORMAT(time,'%D %M %Y %h:%i %p'), loadCurrent from ".$tableName."Current order by time desc;");

    $rowMPPT = mysqli_fetch_row($resultMPPT);
    $rowVoltage = mysqli_fetch_row($resultVoltage);
    $rowCurrent = mysqli_fetch_row($resultCurrent);

    if (strtotime($rowMPPT[0]) < strtotime($rowVoltage[0])) {
        
        $date = strtotime($rowVoltage[0]);
        //$dateString = $date->format("dd").$date->format("M").$date->format("Y").$date->format("Y")
        $data = array(0, 0, 0, $rowVoltage[1], $rowCurrent[1], $rowVoltage[0]);

    }
    else {
        $data = array($rowMPPT[2], $rowMPPT[1], $rowMPPT[4], $rowVoltage[1], $rowCurrent[1], $rowMPPT[0]);   
    }

    echo json_encode($data);




?>
