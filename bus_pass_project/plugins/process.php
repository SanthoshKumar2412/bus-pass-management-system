<?php
 include("database.php");
// Process approval or rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $appId = $_POST['approve'];
        $updateQuery = "UPDATE payment SET status = 'Approved' WHERE id = :appId";
    } elseif (isset($_POST['reject'])) {
        $appId = $_POST['reject'];
        $updateQuery = "UPDATE payment SET status = 'Rejected' WHERE id = :appId";
    }

    // if (isset($updateQuery)) {
    //     $stmt = $con->prepare($updateQuery);
    //     $stmt->execute();
    // }
}

?>