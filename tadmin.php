<?php
/**
 * Toggle admin status for user
 */
require_once "sessions.php";
require_once "db.php";

// set default messages
$message = "No id for toggle admin status";
$status = 0;
if ($_GET) {
    //prepare query
    $queryStr = "UPDATE `users` SET `is_admin` = NOT is_admin WHERE id = :id";
    $input = $db->prepare($queryStr);
    try {
        //execute query
        $result = $input->execute(array(':id' => $_GET['id']));
        //check query result
        if ($result) {
            $message = "Toggled successfully!";
            $status = 1;
        } else {
            $message = "SQL Error: " . $input->errorInfo()[2];

        }
    } catch (PDOException $e) {
        $message = "SQL Error: " . $e->getMessage();
    }
}
$result = array("status" => $status, "description" => $message);
echo json_encode($result);
?>