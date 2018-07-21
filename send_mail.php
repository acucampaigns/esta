<?php
require_once "dbmanager/settings.php";
	
	
	/*$host="localhost";
    $dbusername="estadhsg_etsag";
    $dbpassword="gfgyf0075ghfbv@";
    $database="estadhsg_est";
    $connect=mysql_connect($host,$dbusername,$dbpassword);
    $select_db=mysql_select_db($database,$connect);*/

	
	
	$family_name = $_POST["family_name"];
	$first_name = $_POST["first_name"];
	$aliases = $_POST["aliases"];
	if($_POST["aliases"]!="No")
	{
		$other_family_name = $_POST["other_family_name"];
		$other_first_name = $_POST["other_first_name"];
	}
	$birth_day = $_POST["birth_day"];
	$birth_month = $_POST["birth_month"];
	$birth_year = $_POST["birth_year"];
	$birth_city = $_POST["birth_city"];
	$country = $_POST["country"];
	$gender = $_POST["gender"];
	$father_family_name = $_POST["father_family_name"];
	$father_name = $_POST["father_name"];
	$mother_family_name = $_POST["mother_family_name"];
	$mother_name = $_POST["mother_name"];
	$email = $_POST["email"];
	$tel_no = $_POST["tel_no"];
	$mob_no = $_POST["mob_no"];
	$address1 = $_POST["address1"];
	$address2 = $_POST["address2"];
	$appartment = $_POST["appartment"];
	$home_city = $_POST["home_city"];
	$home_state = $_POST["home_state"];
	$home_country = $_POST["home_country"];
	$passport_no = $_POST["passport_no"];
	$citizenship_country = $_POST["citizenship_country"];
	$passport_issue_day = $_POST["passport_issue_day"];
	$passport_issue_month = $_POST["passport_issue_month"];
	$passport_issue_year = $_POST["passport_issue_year"];
	$passport_expiry_day = $_POST["passport_expiry_day"];
	$passport_expiry_month = $_POST["passport_expiry_month"];
	$passport_expiry_year = $_POST["passport_expiry_year"];
	$dual_citizen = $_POST["dual_citizen"];
	if($_POST["dual_citizen"] !="No")
	{
		$dual_citizen_country = $_POST["dual_citizen_country"];
		$dual_citizen_passport = $_POST["dual_citizen_passport"];
	}
	$relative_family_name = $_POST["relative_family_name"];
	$relative_name = $_POST["relative_name"];
	$relative_tel_no = $_POST["relative_tel_no"];
	$relative_email = $_POST["relative_email"];
	$transit_check = $_POST["transit_check"];
	if($_POST["transit_check"]!="No")
	{
		$US_contact_point = $_POST["US_contact_point"];
		$US_contact_point_address1 = $_POST["US_contact_point_address1"];
		$US_contact_point_address2 = $_POST["US_contact_point_address2"];
		$US_contact_point_appartment = $_POST["US_contact_point_appartment"];
		$US_contact_point_city = $_POST["US_contact_point_city"];
		$US_contact_point_state = $_POST["US_contact_point_state"];
		$US_contact_point_tel = $_POST["US_contact_point_tel"];
	}
	$employment_status = $_POST["employment_status"];
	if($_POST["employment_status"] != "No")
	{
		$employer_name = $_POST["employer_name"];
		$employer_address1 = $_POST["employer_address1"];
		$employer_address2 = $_POST["employer_address2"];
		$employer_city = $_POST["employer_city"];
		$employer_state = $_POST["employer_state"];
		$employer_country = $_POST["employer_country"];
	}
	$health_status = $_POST["health_status"];
	$crime_records = $_POST["crime_records"];
	$law_violation = $_POST["law_violation"];
	$terrorism_record = $_POST["terrorism_record"];
	$visa_fraud = $_POST["visa_fraud"];
	$employment_seeking = $_POST["employment_seeking"];
	$visa_denial = $_POST["visa_denial"];
	$visa_denial_place = $_POST["visa_denial_place"];
	$overstay_status = $_POST["overstay_status"];
	$urgent_need = $_POST["urgent_need"];
	$rights_waiver_permission = $_POST["rights_waiver_permission"];
	$form_cnt = $_POST["form_cnt"];
	$offset=0*60*60; //converting 5 hours to seconds.
    $dateFormat='Y-m-d H:i:s';
    $timeNdate=gmdate($dateFormat,time()+$offset);

	try {	
    	$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
    	$query = "INSERT INTO entry (family_name, first_name, aliases, other_family_name, 
    		other_first_name, birth_day, birth_month, birth_year, birth_city, country, gender, 
    		father_family_name, father_name, mother_family_name, mother_name, email, tel_no, 
    		mob_no, address1, address2, appartment, home_city, home_state, home_country, 
    		passport_no, citizenship_country, passport_issue_day, passport_issue_month, passport_issue_year, 
    		passport_expiry_day, passport_expiry_month, passport_expiry_year, dual_citizen, dual_citizen_country, 
            dual_citizen_passport, relative_family_name, relative_name, relative_tel_no, relative_email, 
            transit_check, US_contact_point, US_contact_point_address1, US_contact_point_address2,
            US_contact_point_appartment, US_contact_point_city, US_contact_point_state, US_contact_point_tel,
            employment_status, employer_name, employer_address1, employer_address2, employer_city,
            employer_state, employer_country, health_status, crime_records, law_violation, employment_seeking,
            visa_denial, visa_denial_place, overstay_status, urgent_need, rights_waiver_permission, form_cnt, timestamp) 
			VALUES (:family_name, :first_name, :aliases, :other_family_name, :other_first_name, :birth_day, 
			:birth_month, :birth_year, :birth_city, :country, :gender, :father_family_name, :father_name, 
			:mother_family_name, :mother_name, :email, :tel_no, :mob_no, :address1, :address2, :appartment, 
			:home_city, :home_state, :home_country, :passport_no, :citizenship_country, :passport_issue_day, 
			:passport_issue_month, :passport_issue_year, :passport_expiry_day, :passport_expiry_month, 
			:passport_expiry_year, :dual_citizen, :dual_citizen_country, :dual_citizen_passport, :relative_family_name,
            :relative_name, :relative_tel_no, :relative_email, :transit_check, :US_contact_point, :US_contact_point_address1, 
            :US_contact_point_address2, :US_contact_point_appartment, :US_contact_point_city, :US_contact_point_state, 
            :US_contact_point_tel, :employment_status, :employer_name, :employer_address1, :employer_address2, :employer_city,
            :employer_state, :employer_country, :health_status, :crime_records, :law_violation, :employment_seeking,
            :visa_denial, :visa_denial_place, :overstay_status, :urgent_need, :rights_waiver_permission, :form_cnt, :timestamp)";
    	$inputCustomer = $db->prepare($query);
    	$result = $inputCustomer->execute(array(":family_name" => $family_name,          
          ":first_name" => $first_name, ":aliases" => $aliases, ":other_family_name" => $other_family_name,
          ":other_first_name" => $other_first_name, ":birth_day" => $birth_day, ":birth_month" => $birth_month, 
          ":birth_year" => $birth_year, ":birth_city" => $birth_city, ":country" => $country, ":gender" => $gender, 
          ":father_family_name" => $father_family_name, ":father_name" => $father_name, ":mother_family_name" => $mother_family_name, 
          ":mother_name" => $mother_name, ":email" => $email, ":tel_no" => $tel_no, ":mob_no" => $mob_no, ":address1" => $address1, 
          ":address2" => $address2, ":appartment" => $appartment, ":home_city" => $home_city, ":home_state" => $home_state, 
          ":home_country" => $home_country, ":passport_no" => $passport_no, ":citizenship_country" => $citizenship_country,
          ":passport_issue_day" => $passport_issue_day, ":passport_issue_month" => $passport_issue_month, 
          ":passport_issue_year" => $passport_issue_year, ":passport_expiry_day" => $passport_expiry_day, 
          ":passport_expiry_month" => $passport_expiry_month, ":passport_expiry_year" => $passport_expiry_year, 
          ":dual_citizen" => $dual_citizen, ":dual_citizen_country" => $dual_citizen_country, ":dual_citizen_passport" => $dual_citizen_passport,
          ":relative_family_name" => $relative_family_name, ":relative_name" => $relative_name, ":relative_tel_no" => $relative_tel_no,
          ":relative_email" => $relative_email, ":transit_check" => $transit_check, ":US_contact_point" => $US_contact_point, 
          ":US_contact_point_address1" => $US_contact_point_address1, ":US_contact_point_address2" => $US_contact_point_address2, 
          ":US_contact_point_appartment" => $US_contact_point_appartment, ":US_contact_point_city" => $US_contact_point_city, 
          ":US_contact_point_state" => $US_contact_point_state, ":US_contact_point_tel" => $US_contact_point_tel, 
          ":employment_status" => $employment_status, ":employer_name" => $employer_name, ":employer_address1" => $employer_address1, 
          ":employer_address2" => $employer_address2, ":employer_city" => $employer_city, ":employer_state" => $employer_state, 
          ":employer_country" => $employer_country, ":health_status" => $health_status, ":crime_records" => $crime_records, 
          ":law_violation" => $law_violation, ":employment_seeking" => $employment_seeking, ":visa_denial" => $visa_denial, 
          ":visa_denial_place" => $visa_denial_place, ":overstay_status" => $overstay_status, ":urgent_need" => $urgent_need, 
          ":rights_waiver_permission" => $rights_waiver_permission, ":form_cnt" => $form_cnt, ":timestamp" => $timeNdate));	

          //var_dump($result);die();
	} catch (Exception $e) {
	}
	
	//Send mail-----------------------------------------------------------------------------------------------------------------------------------------
	$msg = "<b>Dear Admin</b>".",<br/>We would like to inform you that Mr/ Ms. ".$family_name.", has enrolled for the Application, please find the details below:<br /><br />";
	$msg .= "Applicant Name:"."  ".$first_name."<br/>";
	$msg .= "Applicant Family Name:"."  ".$family_name."<br/>";
	$msg .= "Aliases if any:"."  ".$aliases."<br/>";
	if($aliases != "No")
	{
		$msg .= "Other Family Name:"."  ".$other_family_name."<br/>";
		$msg .= "Other Name:"."  ".$other_first_name."<br/>";
	}
	$msg .= "Birth Day:"."  ".$birth_day."<br/>";
	$msg .= "Birth Month:"."  ".$birth_month."<br/>";
	$msg .= "Birth Year:"."  ".$birth_year."<br/>";
	$msg .= "City of Birth:"."  ".$birth_city."<br/>";
	$msg .= "Country of Birth:"."  ".$country."<br/>";
	$msg .= "Gender:"."  ".$gender."<br/>";
	$msg .= "Father's Family Name:"."  ".$father_family_name."<br/>";
	$msg .= "Father's Name:"."  ".$father_name."<br/>";
	$msg .= "Mother's Family Name:"."  ".$mother_family_name."<br/>";
	$msg .= "Mother's Name:"."  ".$mother_name."<br/>";
	$msg .= "Email ID:"."  ".$email."<br/>";
	$msg .= "Telephone No.:"."  ".$tel_no."<br/>";
	if($mob_no != "")
	{
		$msg .= "Cell No.:"."  ".$mob_no."<br/>";
	}
	$msg .= "Home Address Line 1:"."  ".$address1."<br/>";
	if($address2 != "")
	{
		$msg .= "Home Address Line 2:"."  ".$address2."<br/>";
	}
	if($appartment != "")
	{
		$msg .= "Home Address (Appartment No.):"."  ".$appartment."<br/>";
	}
	$msg .= "Home Address (City):"."  ".$home_city."<br/>";
	$msg .= "Home Address (Province):"."  ".$home_state."<br/>";
	$msg .= "Home Address (Country):"."  ".$home_country."<br/>";
	$msg .= "Passport Number:"."  ".$passport_no."<br/>";
	$msg .= "Country of Citizenship:"."  ".$citizenship_country."<br/>";
	$msg .= "Passport Issuance Day:"."  ".$passport_issue_day."<br/>";
	$msg .= "Passport Issuance Month:"."  ".$passport_issue_month."<br/>";
	$msg .= "Passport Issuance Year:"."  ".$passport_issue_year."<br/>";
	$msg .= "Passport Expiry Day:"."  ".$passport_expiry_day."<br/>";
	$msg .= "Passport Expiry Month:"."  ".$passport_expiry_month."<br/>";
	$msg .= "Passport Expiry Year:"."  ".$passport_expiry_year."<br/>";
	$msg .= "Is Applicant holding multiple Citizenship?:"."  ".$dual_citizen."<br/>";
	if($dual_citizen == "Yes")
	{
		$msg .= "Country of dual citizenship:"."  ".$dual_citizen_country."<br/>";
		$msg .= "Passport of dual citizenship:"."  ".$dual_citizen_passport."<br/>";
	}
	$msg .= "Emergency Contact Family Name:"."  ".$relative_family_name."<br/>";
	$msg .= "Emergency Contact Name:"."  ".$relative_name."<br/>";
	$msg .= "Emergency Contact Telephone No.:"."  ".$relative_tel_no."<br/>";
	$msg .= "Emergency Contact Email ID:"."  ".$relative_email."<br/>";
	$msg .= "Is US a transit country of the applicant:"."  ".$transit_check."<br/>";
	if($transit_check == "Yes")
	{
		$msg .= "US Point of Contact:"."  ".$US_contact_point."<br/>";
		$msg .= "US Point of Contact - Address Line 1:"."  ".$US_contact_point_address1."<br/>";
		$msg .= "US Point of Contact - Address Line 2:"."  ".$US_contact_point_address2."<br/>";
		$msg .= "US Point of Contact - Apartment Number:"."  ".$US_contact_point_appartment."<br/>";
		$msg .= "US Point of Contact - City:"."  ".$US_contact_point_city."<br/>";
		$msg .= "US Point of Contact - State:"."  ".$US_contact_point_state."<br/>";
		$msg .= "US Point of Contact - Telephone Number:"."  ".$US_contact_point_tel."<br/>";
	}
	$msg .= "Applicant Employment Status:"."  ".$employment_status."<br/>";
	if($employment_status == "Yes")
	{
		$msg .= "Employer Name:"."  ".$employer_name."<br/>";
		$msg .= "Employer - Address Line 1:"."  ".$employer_address1."<br/>";
		$msg .= "Employer - Address Line 2:"."  ".$employer_address2."<br/>";
		$msg .= "Employer - City:"."  ".$employer_city."<br/>";
		$msg .= "Employer - State/Province/Region:"."  ".$employer_state."<br/>";
		$msg .= "Employer - Country:"."  ".$employer_country."<br/>";
	}
		$msg .= "Health Disorders if any?:"."  ".$health_status."<br/>";
		$msg .= "Past Criminal conviction/ arrests:"."  ".$crime_records."<br/>";
		$msg .= "Handling illegal drugs:"."  ".$law_violation."<br/>";
		$msg .= "terrorism/ anti national past:"."  ".$terrorism_record."<br/>";
		$msg .= "Past cases in US VISA fraudulence:"."  ".$visa_fraud."<br/>";
		$msg .= "Seeking Employermnt in the US without authorization:"."  ".$employment_seeking."<br/>";
		$msg .= "Cases of VISA Denied:"."  ".$visa_denial."<br/>";
		$msg .= "Details of VISA denial:"."  ".$visa_denial_place."<br/>";
		$msg .= "Overstayed in the US:"."  ".$overstay_status."<br/>";
		$msg .= "Visa Needed in 24 hours:"."  ".$urgent_need."<br/>";
		$msg .= "Undertaking for Customs:"."  ".$rights_waiver_permission."<br/>";
	  $msg .= "<br /><br /><h3><em>Note.</em></h3>&nbsp;Please contact the applicant to verify further actions. <br />" ;
	  $subject="New ESTA  Applicant Alortment";
	  $to="jweinstock121@gmail.com, info@estadhs-gov.us, nournstbrandone@gmail.com";
	  $from = $email;
	  $headers  = 'MIME-Version: 1.0' . "\r\n";
	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  $headers .= 'From: '.$from."\r\n";
/*	      $date=date("Y-m-d");
          $time=date("H:i:s");
	      $messagetorecord=addslashes($msg);   
		  $query="insert into formdata set formdata='$messagetorecord', date='$date', time='$time'";
		  mysql_query($query);
*/	  	  
	  mail('jweinstock121@gmail.com',$subject,$msg,$headers);
	  mail('info@estadhs-gov.us',$subject,$msg,$headers);
	  mail('nournstbrandone@gmail.com',$subject,$msg,$headers);
	  
	  header("Location: https://dhsgov-esta.us/payment.html");
	  die();
?>