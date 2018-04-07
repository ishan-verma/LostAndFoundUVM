<?php include "top.php"; 

$admin = true;
$update = false;
if (DEBUG) {
    print '<p>Post Array:</p><pre>';
    print_r($_POST);
    print '</pre>';
    print "URL: " . $domain . $phpSelf;
}

$yourURL = $domain . $phpSelf;

$pmkItemID = -1;
$userName = "";
$timeLost = "";
$dateLost = "";
$description = "";
$locationX = 0.0;
$locationY = 0.0;

$firstMistake = "";

$userNameError = false;
$timeError = false;
$dateError = false;
$descriptionError = false;
$locationXError = false;
$locationYError = false;

$errorMsg = array();

$data = array();

if (isset($_POST["btnSubmit"])) {
    if (!securityCheck($yourURL)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg .= "Security breach detected and reported.</p>";
        die($msg);
    }
    
    $pmkItemID = (int) htmlentities($_POST["hidItemId"], ENT_QUOTES, "UTF-8");
    
    $userName = htmlentities($_POST["hidUserName"], ENT_QUOTES, "UTF-8");
    $data[] = $userName;
    
    $timeLost = htmlentities($_POST["txtTimeLost"], ENT_QUOTES, "UTF-8");
    $data[] = $timeLost;
    
    $description = htmlentities($_POST["txtDescription"], ENT_QUOTES, "UTF-8");
    $data[] = $description;
    
    $locationX = htmlentities($_POST["txtLocX"], ENT_QUOTES, "UTF-8");
    $data[] = $locationX;
    
    $locationY = htmlentities($_POST["txtLocY"], ENT_QUOTES, "UTF-8");
    $data[] = $locationY;
    
    // error handling
    if ($userName == "") {
        $errorMsg[] = "Username Error";
        $userNameError = true;
    }
    
    if ($firstMistake == "" and $userNameError) {
        $firstMistake = "userName";
    }
    
    if ($timeLost == "") {
        $errorMsg[] = "Please enter the time you lost the item";
        $timeError = true;
    } elseif (!verifyTime($timeLost)) {
        $errorMsg[] = "Error in time lost";
        $timeError = true;
    }
    
    
}

?>



<?php include "footer.php"; ?>