<?php
/**
 * Login into system
 */
require_once "db.php";

// set up default answer
$status = 0;
$message = 'Invalid user or password. ';
// check if got data
if ($_POST) {
    // prepare db query to check if user exists and if yes - get his password hash and is_admin flag
    $queryStr = "SELECT password, is_admin FROM users WHERE login = :login";
    $input = $db->prepare($queryStr);
    try {
        // execute query
        $input->execute(array(":login" => $_POST['login']));
        $user = $input->fetch();
        // if user with such login exists
        if ($user) {
            // verify user password
            if (password_verify($_POST['password'], $user['password'])) {
                // prepare answer
                $message = 'Password is valid ';
                $status = 1;
                /*// start user session
                session_start();
                // set up session variables for user
                $_SESSION['user'] = $_POST['login'];
                $_SESSION['admin'] = $user['is_admin'] ? true : false;*/
                $tmpSessId = md5(uniqid(rand(), true)); // generate token;
                $sess = $db->prepare("UPDATE users SET sessionId = :sessid WHERE login = :login");
                $res = $sess->execute(array(":sessid" => $tmpSessId, ":login" => $_POST['login']));
                setcookie("logged", $tmpSessId, time()+3600);
            } 
        }
    } catch (PDOException $e) {

    }
}
// return ajax answer
$result = array("status" => $status, "description" => $message);
echo json_encode($result);