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
    die("Failed to connect to Database: " . $conn->connect_error);
}

// Obtain data from qualifications 
$sqlQualifications = "SELECT * FROM QUALIFICATION";
$result = $conn->query($sqlQualifications);
// HTML style 
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<title>Qualification Table</title>';
echo '<style>';
echo 'body {';
echo '    font-family: Arial, sans-serif;';
echo '    background-color: dimgray;';
echo '    margin: 0;';
echo '    padding: 0;';
echo '}';
echo '';
echo '#title {';
echo '    text-align: center;';
echo '    font-size: 24px;';
echo '    color: white;';
echo '}';
echo '';
echo 'table {';
echo '    max-width: 600px;';
echo '    margin: 20px auto;';
echo '    background-color: white;';
echo '    padding: 20px;';
echo '    border-radius: 8px;';
echo '    box-shadow: 0 0 10px black;';
echo '}';
echo '';
echo 'th, td {';
echo '    padding: 10px;';
echo '    text-align: left;';
echo '}';
echo '';
echo 'button {';
echo '    background-color: #5bc75f;'; 
echo '    color: white;';
echo '    cursor: pointer;';
echo '    padding: 15px 20px;'; 
echo '    font-size: 16px;'; 
echo '    border: none;';
echo '    border-radius: 4px;';
echo '}';
echo '';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<p id="title">Qualification Table</p>';

echo '<table border="1">';
echo '<tr><th>Code</th><th>Description</th></tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr><td>' . $row['QUALIFICATION_CODE'] . '</td><td>' . $row['QUALIFICATION_DESCRIPTION'] . '</td></tr>';
}

echo '</table>';

// Close the database connection
$conn->close();

// Back to the form 
echo '<p style="text-align: center; margin-top: 20px;"><a href="final_insert.html"><button>Go Back to Form</button></a></p>';

echo '</body>';
echo '</html>';
?>
