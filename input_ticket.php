<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <title>Ticket Submission - Stenden Helpdesk</title>
    </head>
    <body>
    <div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
            <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a class="open" href="input_ticket.php">New Ticket</a> 
                <a href="#">Ticket History</a> 
                <a href="overview_client">Overview</a> 
                <a href="#">Your Tickets</a>
                <a href="faq.html">FAQ</a>
            </div>
        </div>
        <div class="content">
            <div class="content_margin">
            <h2>Ticket Submission - Stenden Helpdesk</h2>
        <form method="POST" action="">
            <p>Description <input type="text" name="desc"/></p>
            <p>Type of Issue <input type="text" name="type"/></p>
            <p><input type="submit" value="Submit"></p>
        </form>
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

<?php
        if (empty($_POST['desc']) || empty($_POST['type'])) {
            echo "<p>You must fill in all the required elements.
                Click your browser's back button to return to the message form.</p>";
        } else {
            include ("includes/init-db.php");

            mysqli_select_db($DBConnect, $db_name);

            $desc = htmlentities($_POST['name']);
            $type = htmlentities($_POST['message']);

            $SQLstring2 = "INSERT INTO incident (Incident_ID, Time_Registered, Client_ID, Date, Description, Type_ID, Other, Solution_ID, Employee_ID) VALUES (NULL, CURRENT_TIME, NULL, CURRENT_DATE, ?, ?, NULL, NULL, NULL)";

            if ($stmt = mysqli_prepare($DBConnect, $SQLstring2)) {
                mysqli_stmt_bind_param($stmt, 'ss', $desc, $type);
                $QueryResult2 = mysqli_stmt_execute($stmt);
                if ($QueryResult2 === FALSE) {
                    echo "<p>Unable to execute the query.</p>"
                    . "<p>Error code "
                    . mysqli_errno($DBConnect)
                    . ": "
                    . mysqli_error($DBConnect)
                    . "</p>";
                } else {
                    echo "<h1>Thank you for submitting your ticket!</h1>";
                }
                //Clean up the $stmt after use
                mysqli_stmt_close($stmt);
            } else {
                echo "error";
            }
            mysqli_close($DBConnect);
        }
        ?>
