<?php
if(isset($_POST['email'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "ricardonalves@gmail.com";
     
    $email_subject = "Cleaning Estimate Request";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['firstName']) ||
        !isset($_POST['lastName']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $firstName = $_POST['firstName']; // required
    $lastName = $_POST['lastName']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // not required
    $address = $_POST['Address']; // not required
    $city = $_POST['City'];
    $zip = $_POST['ZipCode'];
    $bedrooms = $_POST['Bedrooms'];
    $bathrooms = $_POST['Bathrooms'];
    $sqft = $_POST['SquareFootage'];
    $type = $_POST['ServiceType'];
    if ($_POST['FridgeCleaning']) {
        $additionalServices = 'Fridge Cleaning - ';
    }
    if ($_POST['OvenCleaning']) {
        $additionalServices .= 'Oven Cleaning - ';
    }
    if ($_POST['InteriorWindowCleaning']) {
        $additionalServices .= 'Interior Window Cleaning - ';
    }
    if ($_POST['Laundry']) {
        $additionalServices .= 'Laundry';
    }
    $AdditionalQuestions = $_POST['AdditionalQuestions'];
    $pets = $_POST['PetsInHouse'];
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$firstName)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$lastName)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Estimate request from SorellasCleaning.com\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "First Name: ".clean_string($firstName)."\n";
    $email_message .= "Last Name: ".clean_string($lastName)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Phone Number: ".clean_string($phone)."\n";
    $email_message .= "Address: ".clean_string($address)." ".clean_string($city)." ".clean_string($zipcode)."\n";
    $email_message .= "Number of Bedrooms: ".clean_string($bedrooms)."\n";
    $email_message .= "Number of Bathrooms: ".clean_string($bathrooms)."\n";
    $email_message .= "Square Footage: ".clean_string($sqft)."\n";
    $email_message .= "Service Type: ".clean_string($type)."\n";
    $email_message .= "Additional Services: ".clean_string($additionalServices)."\n";
    $email_message .= "Are there any pets in your house? ".clean_string($pets)."\n\n";
    $email_message .= "Additional Questions/Comments: ".clean_string($AdditionalQuestions)."\n";
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- place your own success html below -->
 
Thank you for contacting us. We will be in touch with you very soon.
<?php
header("Location: https://www.sorellascleaning.com/success.html"); /* Redirect browser */
exit;
?>
 
<?php
}
die();
?>