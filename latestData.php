<?php 

$db = new mysqli("localhost","root", "", "bobodata");

    $tableName = "y".date("Y")."m".date("n");

    $resultMPPT = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), panel_voltage, panel_power, battery_voltage, battery_current from ".$tableName."MPPT order by time desc;");

    $resultVoltage = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), batteryVoltage from ".$tableName."Voltage order by time desc;");

    $resultCurrent = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), loadCurrent from ".$tableName."Current order by time desc;");

    $rowMPPT = mysqli_fetch_row($resultMPPT);
    $rowVoltage = mysqli_fetch_row($resultVoltage);
    $rowCurrent = mysqli_fetch_row($resultCurrent);

    if (strtotime($rowMPPT[0]) < strtotime($rowVoltage[0])) {
        $data = array(0, 0, 0, $rowVoltage[1], $rowCurrent[1]);
    }
    else {
        $data = array($rowMPPT[2], $rowMPPT[1], $rowMPPT[4], $rowVoltage[1], $rowCurrent[1]);   
    }

    echo json_encode($data);




?>
