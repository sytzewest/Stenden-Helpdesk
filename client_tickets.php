<?php
    include("./includes/init-db.php");
    include("./includes/init-session.php");
    include("./includes/check-login.php");
    CheckClient();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Client Overview - Stenden Support Desk</title>
</head>
<body>

<div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
            <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a href="input_ticket.php">New Ticket</a> 
                <a href="history.php">Ticket History</a> 
                <a href="overview_client.php">Overview</a> 
                <a class="open" href="client_tickets.php">Your Tickets</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            
<?php // TODO change type, solution, and employee in table

$SQLConnect = OpenDBConnection();

$result = SelectDBResult($SQLConnect, "Incident", "*", "Client_ID", "1");

if($result === false) {
    echo "<p>There are no entries!</p>";
} else {
    $TableName = "incident";
        $SQLstring = "SELECT * FROM ". $TableName;
        if ($stmt = mysqli_prepare($SQLConnect, $SQLstring)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $incidentid, $time, $client, $date, $desc, $type, $solution, $employee, $status);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<p>There are no tickets in your name!</p>";
            } else {
                if ($status = 1){
                echo "<table>";
                echo "<tr><th>Incident</th> <th>Time</th> <th>Client</th> <th>Date</th> <th>Description</th> <th>Type</th> <th>Solution</th> <th>Employee</th> <th>S</tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $incidentid . "</td>";
                    echo "<td>" . $time . "</td>";
                    echo "<td>" . $client . "</td>";
                    echo "<td>" . $date . "</td>";
                    echo "<td>" . $desc . "</td>";
                    echo "<td>" . $type . "</td>";
                    echo "<td>" . $solution . "</td>";
                    echo "<td>" . $employee . "</td></tr>";
                }
                }
            }
    }
}
}

CloseDBConnection($SQLConnect);
?>
         </div>
        </div>
    </div>

<div class="footer">
        <div class="footer_margin">
        </div>
    </div>
</div>

</body>
</html>