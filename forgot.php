<?php
/**
 * Forgot password reset form
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

    if ($_GET) {
        // check if token exists in database
        $input = $db->prepare("SELECT id FROM users WHERE resettoken = :token");
        try {
            $input->execute(array(":token" => $_GET['token']));
            $user = $input->fetch();
            if (!$user) { // if there is no such token
                ?>
                <div class="row">
                    <div class="alert alert-danger col-sm-4 col-sm-offset-4">
                        Can't find user with this reset token
                    </div>
                </div>
                <?php
            } else { // if we found user with this token - show password reset form
                ?>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="alert alert-success frm-hidden reset-alert-ok">
                            <button type="button" class="close">&times;</button>
                            Your account is successfully created. Now you can <span class="frm-toggle">log in</span>.
                        </div>
                        <div class="alert alert-danger frm-hidden reset-alert-fail">
                            <button type="button" class="close">&times;</button>
                            <p></p>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Enter new password here</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" id="form-reset" method="POST" action="reset.php">
                                    <fieldset>
                                        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Password" name="password" type="password" value="" id="pass" required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Password Verify" name="passwordVerify" type="password" value="" id="pass-verify" title="Password missmatch" required>
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <button id="reset-btn" type="button" class="btn btn-success btn-block">Set new password</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } catch (PDOException $e) {

        }
    } else { // if somebody open this page without any token
        header("Location: index.html");
        die();
    }
    ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        jQuery("#reset-btn").click(function() {
            var emptyField = 0;
            // if user try tosabmit form with empty fields
            // we need to make empty fields borders red
            jQuery("#form-reset input").each(function() {
                if (jQuery(this).val() == "") {
                    jQuery(this).css("border-color", "red");
                    emptyField = 1;
                } else {
                    jQuery(this).css("border-color", "#ccc");
                }
            })
            // and show error message
            if (emptyField) {
                jQuery(".reset-alert-fail").find("p").text("Please, fill all fields");
                jQuery(".reset-alert-fail").removeClass('frm-hidden');
                return false;
            }
            // check if password verify correct
            if (jQuery("#pass").val() !== jQuery("#pass-verify").val()) {
                jQuery("#form-reset input").css("border-color", "red");
                jQuery(".reset-alert-fail").find("p").text("Password missmatch");
                jQuery(".reset-alert-fail").removeClass('frm-hidden');
                return false;
            }
            // if everything OK
            jQuery("#form-reset").submit();
        })
    </script>
</body>