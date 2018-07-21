<?php
/**
 * Edit contact
 */
require_once "sessions.php";
require_once "db.php";

if (!isset($_GET['id'])) {
    header("Location: main.php");
    die();
}

$queryStr = "SELECT * FROM entry WHERE id = :id";
$item = $db->prepare($queryStr);
try {
    $item->execute(array("id" => $_GET['id']));
    $info = $item->fetch();
    if (!$info) {
        $message = "Customer with this ID is not found!";
        $error_flag = 1;
    }
} catch (PDOException $e) {
    $message = "SQL Error: " . $e->getMessage();
    $error_flag = 1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Show Application Details</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link rel="shortcut icon" href="favicon.png" / -->
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?php if ($message) { // show status message to user ?>
                <div class="alert <?php echo ($error_flag ? "alert-danger" : "alert-success"); ?>">
                    <button type="button" class="close">&times;</button>
                    <?php echo $message; ?>
                </div>
            <?php }; ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Application Details
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                    <?php
                        echo "<tr><td>Applicant Name: </td><td>".$info['first_name']."</td></tr>";
                        echo "<tr><td>Applicant Family Name: </td><td>".$info['family_name']."</td></tr>";                  
                        if ($info['aliases'] != "No") {
                            echo "<tr><td>Other Family Name: </td><td>".$info['other_family_name']."</td></tr>";
                            echo "<tr><td>Other Name: </td><td>".$info['other_first_name']."</td></tr>";
                        }
                        echo "<tr><td>Birth Day: </td><td>".$info['birth_day']."</td></tr>";
                        echo "<tr><td>Birth Month: </td><td>".$info['birth_month']."</td></tr>";
                        echo "<tr><td>Birth Year: </td><td>".$info['birth_year']."</td></tr>";
                        echo "<tr><td>City of Birth: </td><td>".$info['birth_city']."</td></tr>";
                        echo "<tr><td>Country of Birth: </td><td>".$info['country']."</td></tr>";
                        echo "<tr><td>Gender: </td><td>".$info['gender']."</td></tr>";
                        echo "<tr><td>Father's Family Name: </td><td>".$info['father_family_name']."</td></tr>";
                        echo "<tr><td>Father's Name: </td><td>".$info['father_name']."</td></tr>";
                        echo "<tr><td>Mother's Family Name: </td><td>".$info['mother_family_name']."</td></tr>";
                        echo "<tr><td>Mother's Name: </td><td>".$info['mother_name']."</td></tr>";
                        echo "<tr><td>Email ID: </td><td>".$info['email']."</td></tr>";
                        echo "<tr><td>Telephone No.: </td><td>".$info['tel_no']."</td></tr>";
                        if ($info['mob_no'] != "") {
                            echo "<tr><td>Cell No.: </td><td>".$info['mob_no']."</td></tr>";
                        }
                        echo "<tr><td>Home Address Line 1: </td><td>".$info['address1']."</td></tr>";
                        if ($info['address2'] != "")
                        {
                            echo "<tr><td>Home Address Line 2: </td><td>".$info['address2']."</td></tr>";
                        }
                        if ($info['appartment'] != "")
                        {
                            echo "<tr><td>Home Address (Appartment No.): </td><td>".$info['appartment']."</td></tr>";
                        }
                        echo "<tr><td>Home Address (City): </td><td>".$info['home_city']."</td></tr>";
                        echo "<tr><td>Home Address (Province): </td><td>".$info['home_state']."</td></tr>";
                        echo "<tr><td>Home Address (Country): </td><td>".$info['home_country']."</td></tr>";
                        echo "<tr><td>Passport Number: </td><td>".$info['passport_no']."</td></tr>";
                        echo "<tr><td>Country of Citizenship: </td><td>".$info['citizenship_country']."</td></tr>";
                        echo "<tr><td>Passport Issuance Day: </td><td>".$info['passport_issue_day']."</td></tr>";
                        echo "<tr><td>Passport Issuance Month: </td><td>".$info['passport_issue_month']."</td></tr>";
                        echo "<tr><td>Passport Issuance Year: </td><td>".$info['passport_issue_year']."</td></tr>";
                        echo "<tr><td>Passport Expiry Day: </td><td>".$info['passport_expiry_day']."</td></tr>";
                        echo "<tr><td>Passport Expiry Month: </td><td>".$info['passport_expiry_month']."</td></tr>";
                        echo "<tr><td>Passport Expiry Year: </td><td>".$info['passport_expiry_year']."</td></tr>";
                        echo "<tr><td>Is Applicant holding multiple Citizenship?: </td><td>".$info['dual_citizen']."</td></tr>";
                        if ($info['dual_citizen'] == "Yes")
                        {
                            echo "<tr><td>Country of dual citizenship: </td><td>".$info['dual_citizen_country']."</td></tr>";
                            echo "<tr><td>Passport of dual citizenship: </td><td>".$info['dual_citizen_passport']."</td></tr>";
                        }
                        echo "<tr><td>Emergency Contact Family Name: </td><td>".$info['relative_family_name']."</td></tr>";
                        echo "<tr><td>Emergency Contact Name: </td><td>".$info['relative_name']."</td></tr>";
                        echo "<tr><td>Emergency Contact Telephone No.: </td><td>".$info['relative_tel_no']."</td></tr>";
                        echo "<tr><td>Emergency Contact Email ID: </td><td>".$info['relative_email']."</td></tr>";
                        echo "<tr><td>Is US a transit country of the applicant: </td><td>".$info['transit_check']."</td></tr>";
                        if ($info['transit_check'] == "Yes")
                        {
                            echo "<tr><td>US Point of Contact: </td><td>".$info['US_contact_point']."</td></tr>";
                            echo "<tr><td>US Point of Contact - Address Line 1: </td><td>".$info['US_contact_point_address1']."</td></tr>";
                            echo "<tr><td>US Point of Contact - Address Line 2: </td><td>".$info['US_contact_point_address2']."</td></tr>";
                            echo "<tr><td>US Point of Contact - Apartment Number: </td><td>".$info['US_contact_point_appartment']."</td></tr>";
                            echo "<tr><td>US Point of Contact - City: </td><td>".$info['US_contact_point_city']."</td></tr>";
                            echo "<tr><td>US Point of Contact - State: </td><td>".$info['US_contact_point_state']."</td></tr>";
                            echo "<tr><td>US Point of Contact - Telephone Number: </td><td>".$info['US_contact_point_tel']."</td></tr>";
                        }
                        echo "<tr><td>Applicant Employment Status: </td><td>".$info['employment_status']."</td></tr>";
                        if ($info['employment_status'] == "Yes")
                        {
                            echo "<tr><td>Employer Name: </td><td>".$info['employer_name']."</td></tr>";
                            echo "<tr><td>Employer - Address Line 1: </td><td>".$info['employer_address1']."</td></tr>";
                            echo "<tr><td>Employer - Address Line 2: </td><td>".$info['employer_address2']."</td></tr>";
                            echo "<tr><td>Employer - City: </td><td>".$info['employer_city']."</td></tr>";
                            echo "<tr><td>Employer - State/Province/Region: </td><td>".$info['employer_state']."</td></tr>";
                            echo "<tr><td>Employer - Country: </td><td>".$info['employer_country']."</td></tr>";
                        }
                        echo "<tr><td>Health Disorders if any?: </td><td>".$info['health_status']."</td></tr>";
                        echo "<tr><td>Past Criminal conviction/ arrests: </td><td>".$info['crime_records']."</td></tr>";
                        echo "<tr><td>Handling illegal drugs: </td><td>".$info['law_violation']."</td></tr>";
                        echo "<tr><td>terrorism/ anti national past: </td><td>".$info['terrorism_record']."</td></tr>";
                        echo "<tr><td>Past cases in US VISA fraudulence: </td><td>".$info['visa_fraud']."</td></tr>";
                        echo "<tr><td>Seeking Employermnt in the US without authorization: </td><td>".$info['employment_seeking']."</td></tr>";
                        echo "<tr><td>Cases of VISA Denied: </td><td>".$info['visa_denial']."</td></tr>";
                        echo "<tr><td>Details of VISA denial: </td><td>".$info['visa_denial_place']."</td></tr>";
                        echo "<tr><td>Overstayed in the US: </td><td>".$info['overstay_status']."</td></tr>";
                        echo "<tr><td>Visa Needed in 24 hours: </td><td>".$info['urgent_need']."</td></tr>";
                        echo "<tr><td>Undertaking for Customs: </td><td>".$info['rights_waiver_permission']."</td></tr>";
                    ?>
                    </table>
                    <div class="pull-center">
                        <br><a href="main.php">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // close alert message
    jQuery(document).ready(function() {
        jQuery(".close").click(function() {
            jQuery(".alert").css('display', 'none');
        })
    });
</script>
</body>