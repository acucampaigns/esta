<?php
/**
 * Register a new user
 */
require_once "db.php";

// set default answer
$status = 0;
$message = 'Failed attempt to create new user.';
if ($_POST) {
    // check if already exists user with such email or login
    $check = $db->prepare("SELECT id FROM users WHERE email = :email OR login = :login");
    $check->execute(array(":login" => $_POST['login'], ":email" => $_POST['email']));
    if ($check->fetch()) { // if yes - return error
        $status = 0;
        $message = 'User with this login or email already exists.';
    } else { // if not exists
        // prepare query
        $queryStr = "INSERT INTO users (firstname, lastname, login, email, password) VALUES (:firstname, :lastname, :login, :email, :password)";
        $input = $db->prepare($queryStr);
        try {
            // execute query and save user into db
            $result = $input->execute(array(":firstname" => $_POST['firstname'], ":lastname" => $_POST['lastname'], ":login" => $_POST['login'], ":email" => $_POST['email'], ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT)));
            // check operation result
            if ($result) {
                $message = 'New user was successfully created';
                $status = 1;
            }
        } catch (PDOException $e) {

        }
    }
}
// return json-coded result
$result = array("status" => $status, "description" => $message);
echo json_encode($result);