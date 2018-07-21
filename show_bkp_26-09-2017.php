<?php
/**
 * Edit contact
 */
require_once "sessions.php";
require_once "db.php";

$message = "";
// if edit form was just opened
if ($_GET) {
    if (isset($_GET['id'])) {
        // select contact data from DB
        $queryStr = "SELECT * FROM customers WHERE id = :id";
        $item = $db->prepare($queryStr);
        try {
            $item->execute(array("id" => $_GET['id']));
            $contact = $item->fetch();
            if ($contact) {
                  $countryName = $contact['countryName'];
                  $permanentResident = $contact['permanentResident'];
                  $travellingCanada = $contact['travellingCanada'];
                  $landorSee = $contact['landorSee'];
                  $isRepresentativecon = $contact['isRepresentativecon'];
                  $minorChild= $contact['minorChild'];
                  $representative= $contact['representative'];
                  $representApplicant= $contact['representApplicant'];
                  $lastname = $contact['lastname'];
                  $firstname = $contact['firstname'];
                  $mailingAddress = $contact['mailingAddress'];
                  $tellNumb = $contact['tellNumb'];
                  $faxNumber = $contact['faxNumber'];
                  $emailAddress = $contact['emailAddress'];
                  
                  //personal information
                  $plastname = $contact['plastname'];
                  $pfirstName = $contact['pfirstName'];
                  $pdate = $contact['pdate'];
                  $pcountrybirth = $contact['pcountrybirth'];
                  $pcityofbirth = $contact['pcityofbirth'];
                  $phasOtherCitizenship = $contact['phasOtherCitizenship'];
                  $CitizenshipsInfo = $contact['CitizenshipsInfo'];
                  $papplyGender = $contact['papplyGender'];
                  $phasPreviouslyAppliedToCanada = $contact['phasPreviouslyAppliedToCanada'];
                  $UICnuumb = $contact['UICnuumb'];
                  $pavailableFunds = $contact['pavailableFunds'];
                  $ppassportNumber = $contact['ppassportNumber'];
                  $pcountryOfIssuance = $contact['pcountryOfIssuance'];
                  $pissueDate = $contact['pissueDate'];
                  $pexpiryDat  = $contact['pexpiryDat'];
                  $maritalStatus = $contact['maritalStatus'];

                  // employment details
                  $employmentOccupation  = $contact['employmentOccupation'];
                  $employmentTitle  = $contact['employmentTitle'];
                  $employmentName  = $contact['employmentName'];
                  $employmentCity  = $contact['employmentCity'];
                  $employmentCountry  = $contact['employmentCountry'];
                  $employmentStartYear  = $contact['employmentStartYear'];
                  
                  // contact Details
                  $languageOfPreference = $contact['languageOfPreference'];
                  $CemailAddress = $contact['CemailAddress'];
                  
                  //Residential address
                  $aptUnit = $contact['aptUnit'];
                  $streetNo = $contact['streetNo'];
                  $streetAddress = $contact['streetAddress'];
                  $cityTown = $contact['cityTown'];
                  $countryterri = $contact['countryterri'];
                  $applysignature = $contact['applysignature'];
            } else {
                $message = "Customer with this ID is not found!";
                $error_flag = 1;
            }
        } catch (PDOException $e) {
            $message = "SQL Error: " . $e->getMessage();
            $error_flag = 1;
        }
    }
}
// if got some error - fill contact object with empty fields
if (!$contact) {
    $contact = array(
        "id" => "",
        "firstname" => "",
        "lastname" => "",
        "address" => "",
        "city" => "",
        "state" => "",
        "zip" => "",
        "cellphone" => "",
        "homephone" => "",
        "email" => "",
        "memo" => ""
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Show contact</title>
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
                    <h3 class="panel-title">Show contact</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>What is the Country/Territory of your passport?</td>
                            <td><?php echo $countryName; ?></td>
                        </tr>
                        <tr>
                            <td>Are you a lawful permanent resident of the United States with a valid alien registration card (Green Card)?</td>
                            <td><?php echo $permanentResident; ?></td>
                        </tr>
                        <tr>
                            <td>Are you travelling to Canada by air?</td>
                            <td><?php echo $travellingCanada; ?></td>
                        </tr>
                        <tr>
                            <td>
                                Are you any of the following?
                                <ul>
                                    <li>A visitor entering Canada by land or sea</li>
                                    <li>A citizen of France residing in and travelling from St. Pierre and Miquelon</li>
                                    <li>A student with a valid study permit for Canada, which I obtained on or after August 1, 2015</li>
                                    <li>A foreign worker with a valid work permit for Canada, which I obtained on or after August 1, 2015</li>
                                    <li>A person holding valid status in Canada and entering Canada from the United States or St. Pierre and Miquelon</li>
                                    <li>A member of Visiting Forces visiting Canada on official duties/orders</li>
                                    <li>A member of flight crew, a civil aviation inspector or an accident investigator</li>
                                    <li>An accredited diplomat</li>
                                </ul>
                            </td>
                            <td><?php echo $landorSee; ?></td>
                        </tr>
                        <tr>
                            <td>Are you a representative or a parent/guardian applying on behalf of an eTA applicant?</td>
                            <td><?php echo $isRepresentativecon; ?></td>
                        </tr>
                        <tr>
                            <td>Are you applying on behalf of a minor child?</td>
                            <td><?php echo $minorChild; ?></td>
                        </tr>
                        <tr>
                            <td><b>REPRESENTATIVE INFORMATION<b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>My representative is</td>
                            <td><?php echo $representative; ?></td>
                        </tr>
                        <tr>
                            <td>Are you being paid to represent the applicant and complete the form on their behalf?</td>
                            <td><?php echo $representApplicant; ?></td>
                        </tr>
                        <tr>
                            <td>Last name(s)</td>
                            <td><?php echo $lastname; ?></td>
                        </tr>
                        <tr>
                            <td>First name(s)</td>
                            <td><?php echo $firstname; ?></td>
                        </tr>
                        <tr>
                            <td>Last name(s)</td>
                            <td><?php echo $lastname; ?></td>
                        </tr>
                        <tr>
                            <td>Mailing Address</td>
                            <td><?php echo $tellNumb; ?></td>
                        </tr>
                        <tr>
                            <td>Telephone number</td>
                            <td><?php echo $lastname; ?></td>
                        </tr>
                        <tr>
                            <td>Fax number</td>
                            <td><?php echo $faxNumber; ?></td>
                        </tr>
                        <tr>
                            <td>Email address</td>
                            <td><?php echo $emailAddress; ?></td>
                        </tr>
                        <tr>
                            <td><b>REPRESENTATIVE INFORMATION</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Last name(s)</td>
                            <td><?php echo $plastname; ?></td>
                        </tr>
                        <tr>
                            <td>First name(s)</td>
                            <td><?php echo $pfirstName; ?></td>
                        </tr>

                        <tr>
                            <td>Date of birth</td>
                            <td><?php echo $pdate; ?></td>
                        </tr>
                        <tr>
                            <td>Country/territory of birth</td>
                            <td><?php echo $pcountrybirth; ?></td>
                        </tr>
                        <tr>
                            <td>City of birth</td>
                            <td><?php echo $pcityofbirth; ?></td>
                        </tr>
                        <tr>
                            <td>Are you a citizen of a country/territory other than the one on your passport?</td>
                            <td><?php echo $phasOtherCitizenship; ?></td>
                        </tr>
                        <tr>
                            <td>Citizenships Information</td>
                            <td><?php echo $CitizenshipsInfo; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo $papplyGender; ?></td>
                        </tr>
                        <tr>
                            <td>Marital status</td>
                            <td><?php echo $maritalStatus; ?></td>
                        </tr>
                        <tr>
                            <td>Have you previously applied to enter or remain in Canada? Select YES if, in the past, you submitted an application to come to Canada, such as a study permit, work permit or visitor visa?</td>
                            <td><?php echo $phasPreviouslyAppliedToCanada; ?></td>
                        </tr>
                        <tr>
                            <td>Unique client identifier (UCI) / Previous Canadian visa or permit number?</td>
                            <td><?php echo $UICnuumb; ?></td>
                        </tr>
                        <tr>
                            <td>Funds available for travel to Canada?</td>
                            <td><?php echo $pavailableFunds; ?></td>
                        </tr>
                        <tr>
                            <td>Passport number?</td>
                            <td><?php echo $ppassportNumber; ?></td>
                        </tr>
                        <tr>
                            <td>Country/territory of issue</td>
                            <td><?php echo $pcountryOfIssuance; ?></td>
                        </tr>
                        <tr>
                            <td>Issue date?</td>
                            <td><?php echo $pissueDate; ?></td>
                        </tr>
                        <tr>
                            <td>Expiry date?</td>
                            <td><?php echo $pexpiryDat; ?></td>
                        </tr>
                        <tr>
                            <td><b>EMPLOIMENT DETAILS</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>What is your current employment situation?</td>
                            <td><?php echo $employmentOccupation; ?></td>
                        </tr>
                        <tr>
                            <td>What is your job title?</td>
                            <td><?php echo $employmentTitle; ?></td>
                        </tr>
                        <tr>
                            <td>What is your company, employer, school or facility name?</td>
                            <td><?php echo $employmentName; ?></td>
                        </tr>
                        <tr>
                            <td>Employment Country/territory</td>
                            <td><?php echo $employmentCountry; ?></td>
                        </tr>
                        <tr>
                            <td>Employment City/town</td>
                            <td><?php echo $employmentCity; ?></td>
                        </tr>
                        <tr>
                            <td>Start date</td>
                            <td><?php echo $employmentStartYear; ?></td>
                        </tr>
                        <tr>
                            <td><b>CONTACT DETAILS</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Preferred language to contact you?</td>
                            <td><?php echo $languageOfPreference; ?></td>
                        </tr>
                        <tr>
                            <td>Email address?</td>
                            <td><?php echo $CemailAddress; ?></td>
                        </tr>
                        <tr>
                            <td><b>RESIDENTIAL ADDRESS</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Apartment number/address?</td>
                            <td><?php echo $aptUnit; ?></td>
                        </tr>
                        <tr>
                            <td>Residence/House/Street number</td>
                            <td><?php echo $streetNo; ?></td>
                        </tr>
                        <tr>
                            <td>Street Name</td>
                            <td><?php echo $streetAddress; ?></td>
                        </tr>
                        <tr>
                            <td>City/town?</td>
                            <td><?php echo $cityTown; ?></td>
                        </tr>
                        <tr>
                            <td>Country/territory?</td>
                            <td><?php echo $countryterri; ?></td>
                        </tr>
                        <tr>
                            <td>Signature</td>
                            <td><?php echo $applysignature; ?></td>
                        </tr>
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