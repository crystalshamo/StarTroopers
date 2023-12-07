<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['opening_ids'])) {

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


    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "StarTroopers_TEC";

    // Deletion logic
    $idsToDelete = $_POST['opening_ids'];
    foreach ($idsToDelete as $id) {
        // Delete the forgein keys that is in Placement 
        $placementDeleteStmt = $conn->prepare("DELETE FROM PLACEMENT WHERE OPENING_ID = ?");
        $placementDeleteStmt->bind_param("i", $id);
        $placementDeleteStmt->execute();
        $placementDeleteStmt->close();
        
        // Delete the row from opeings 
        $openingDeleteStmt = $conn->prepare("DELETE FROM OPENING WHERE OPENING_ID = ?");
        $openingDeleteStmt->bind_param("i", $id);
        $openingDeleteStmt->execute();
        $openingDeleteStmt->close();
    }
    
    // Close the connection
    $conn->close();
    header("Location: final_delete.php?status=success");
    exit();
} else {
    header("Location: final_delete.php?status=error");
    exit();
}
?>