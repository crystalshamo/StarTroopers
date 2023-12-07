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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $value1 = $_POST['value1'];
    $selectedQualifications = $_POST['qualifications'];
    $value3 = $_POST['value3'];
    $value4 = $_POST['value4'];
    $value5 = $_POST['value5'];
    
    $conn->begin_transaction();
    
    try {
        // Insert into CANDIDATE table
        $sqlCandidate = "INSERT INTO CANDIDATE (CANDIDATE_NAME) VALUES ('$value1')";
        $conn->query($sqlCandidate);
    
        // Obtain key from CandidateID
        $generatedCandidateID = $conn->insert_id;

        foreach ($selectedQualifications as $qualificationCode) {
            // Convert the qualification code to uppercase
            $qualificationCode = strtoupper($qualificationCode);
            
            // Fetch qualification description from the database
            $sqlDescription = "SELECT QUALIFICATION_DESCRIPTION FROM QUALIFICATION WHERE QUALIFICATION_CODE = '$qualificationCode'";
            $result = $conn->query($sqlDescription);
            $row = $result->fetch_assoc();
            $qualificationDescription = $row['QUALIFICATION_DESCRIPTION'];
            
            // Insert into CANDIDATE_QUALIFICATIONS 
            $sqlQualifications = "INSERT INTO CANDIDATE_QUALIFICATIONS (CANDIDATE_ID, QUALIFICATION_CODE) VALUES ('$generatedCandidateID', '$qualificationCode')";
            $conn->query($sqlQualifications);
            
            // Display qualification description
            echo "<p>Qualification: $qualificationCode - $qualificationDescription</p>";
        }
    
        // Insert into JOB_HISTORY table
        $sqlJobHistory = "INSERT INTO JOB_HISTORY (CANDIDATE_ID, JOB_HISTORY_DETAIL, JOB_HISTORY_START, JOB_HISTORY_END) VALUES ('$generatedCandidateID', '$value3', '$value4', '$value5')";
        $conn->query($sqlJobHistory);

        echo '<p>Candidate Added!</p>';

        // Commit 
        $conn->commit();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

