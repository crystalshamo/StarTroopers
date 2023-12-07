<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "StarTroopers_TEC";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $courseCode = $_GET["courseCode"];

    // Selecting session fee 
    $sql = "SELECT SESSION_FEE FROM SESSION WHERE COURSE_CODE = '$courseCode'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    $currentSessionFee = $row["SESSION_FEE"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseCode = $_POST["courseCode"];
    $newSessionFee = $_POST["newSessionFee"];

    // Update session fee 
    $sql = "UPDATE SESSION SET SESSION_FEE = '$newSessionFee' WHERE COURSE_CODE = '$courseCode'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }

    header("Location: Prereq.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Update Session Fee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: dimgray;
            margin: 0;
            padding: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Update Session Fee</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>">
        <label for="newSessionFee">New Session Fee:</label>
        <input type="text" id="newSessionFee" name="newSessionFee" value="<?php echo $currentSessionFee; ?>">
        <input type="submit" value="Update">
    </form>
</body>
</html>
