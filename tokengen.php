<?php
/**
 * Generate password reset token
 */
require_once "db.php";

$status = 0;
$message = 'Invalid user';
if ($_POST) {
    // find user with such email
    $queryStr = "SELECT id FROM users WHERE email = :email";
    $input = $db->prepare($queryStr);
    try {
        $input->execute(array(":email" => $_POST['email']));
        $user = $input->fetch();
        if ($user) { // if user exists
            $token = md5(uniqid(rand(), true)); // generate token
            // and save it into db
            $input = $db->prepare("UPDATE users SET resettoken = :token WHERE id = :id");
            $input->execute(array(":id" => $user['id'], ":token" => $token));

            // send email to user with reset link
            $result = mail($_POST['email'], "Password reset link", "You can reset your password using next link: ".$server_url."forgot.php?token=".$token);
            if ($result) {
                $status = 1;
                $message = 'Link was sent successfully';
            } else {
                $message = 'Error during email sending';
            }
        }
    } catch (PDOException $e) {

    }
}
$result = array("status" => $status, "description" => $message);
echo json_encode($result);