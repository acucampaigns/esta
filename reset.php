<?php
/**
 * Save new user password into db
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Reset your password</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link rel="shortcut icon" href="favicon.png" / -->
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<div class="container">
    <?php
    require_once "db.php";
    // if got data
    if ($_POST) {
        // prepare query
        $input = $db->prepare("UPDATE users SET password = :new, resettoken = :empty WHERE resettoken = :token");
        try {
            // update user's password and clear reset token
            $res = $input->execute(array(":new" => password_hash($_POST['password'], PASSWORD_DEFAULT), ":empty" => "", "token" => $_POST['token']));
            if (!$res) { // if password update is failed
                ?>
                <div class="row">
                    <div class="alert alert-danger col-sm-4 col-sm-offset-4">
                        Password reset failed.
                    </div>
                </div>
                <?php
            } else { // if password update is successfull
                ?>
                <div class="row">
                    <div class="alert alert-success col-md-4 col-md-offset-4">
                        Your password is successfully changed. Now you can <a href="<?php echo $server_url; ?>index.html">log in</a>.
                    </div>
                </div>
                <?php
            }
        } catch (PDOException $e) {

        }
    } else { // if script is called without data
        header("Location: index.html");
        die();
    }
    ?>
</div>
</body>