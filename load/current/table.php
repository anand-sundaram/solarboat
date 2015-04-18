    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
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
      <li role="presentation" ><a href="http://solarboat.d1.comp.nus.edu.sg/load/current/graph.php">Graph</a></li>
      <li role="presentation" class="active"><a href="http://solarboat.d1.comp.nus.edu.sg/load/current/table.php">Table</a></li>


    </ul>


<div class="col-md-8" align=" middle">
    <table class="table table-hover table-bordered" align=" middle">

<tr>
    <th>Time</th>
    <th>Load Current (A)</th> 
  </tr>

    <?php

    $db = new mysqli("localhost","root", "", "bobodata");

    $result = $db->query("select DATE_FORMAT(time,'%m/%d/%Y %H:%i'), loadCurrent from y2015m4Current order by time asc;");


    while ($row = mysqli_fetch_row($result)) {
    ?>

<tr>
    <td><?php echo $row[0]; ?></td>
    <td><?php echo $row[1]; ?></td>

    
</tr>


    <?php }  

    ?>
</table>
</div>

    </body>


    </script>
    </html>