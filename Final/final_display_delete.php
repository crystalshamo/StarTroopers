<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Job Openings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: dimgray;
            margin: 0;
            padding: 20px;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid white;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #5bc75f;
        }

        tr:nth-child(even) {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Job Openings</h1>

    <?php
    // Database connection parameters
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "StarTroopers_TEC";

    // Create a connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM OPENING";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Select</th>
                <th>Opening ID</th>
                <th>Company ID</th>
                <th>Qualification Code</th>
                <th>Date Start</th>
                <th>Date End</th>
                <th>Hourly Pay</th>
              </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='opening_ids[]' value='" . $row["OPENING_ID"] . "'></td>";
            echo "<td>" . $row["OPENING_ID"] . "</td>";
            echo "<td>" . $row["COMPANY_ID"] . "</td>";
            echo "<td>" . $row["QUALIFICATION_CODE"] . "</td>";
            echo "<td>" . $row["DATE_START"] . "</td>";
            echo "<td>" . $row["DATE_END"] . "</td>";
            echo "<td>" . $row["PAY_HOURLY"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No job openings found</p>";
    }

    $conn->close();
    ?>
</body>
</html>

