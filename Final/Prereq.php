<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 



$server = "localhost";
$username = "root";
$password = "";
$database = "StarTroopers_TEC";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all courses with related information
$sql = "SELECT c.COURSE_CODE, c.QUALIFICATION_CODE, c.COURSE_NAME, pc.PREREQUISITE_QUALIFICATION_CODE, s.SESSION_FEE
        FROM COURSE c
        LEFT JOIN PREREQUISITE_COURSE pc ON c.COURSE_CODE = pc.COURSE_CODE
        LEFT JOIN SESSION s ON c.COURSE_CODE = s.COURSE_CODE";

$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Course Code</th>
                <th>Qualification Code</th>
                <th>Course Name</th>
                <th>Prerequisite</th>
                <th>Session Fee</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $courseCode = $row["COURSE_CODE"];
        $qualificationCode = $row["QUALIFICATION_CODE"];
        $courseName = $row["COURSE_NAME"];
        $prerequisite = $row["PREREQUISITE_QUALIFICATION_CODE"];
        $sessionFee = $row["SESSION_FEE"];

        echo "<tr>
                <td>$courseCode</td>
                <td>$qualificationCode</td>
                <td>$courseName</td>
                <td>$prerequisite</td>
                <td>";

        if ($sessionFee !== null && $sessionFee !== '') {
            echo "$sessionFee";
        } else {
            echo "No Session Available";
        }

        echo "</td>
        <td><a href='update_session_fee.php?courseCode=$courseCode'>Edit</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No courses available currently.</p>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Course Information</title>
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

</body>
</html>



