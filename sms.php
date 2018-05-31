<?php

/*
PHP Quickstart guide - Ideamart Developer Bundle
*/

/*** specify your error log ****/
ini_set('error_log', 'sms-app-error.log');

/*** specify your sms libraries here ****/
include 'lib/SMSSender.php';
include 'lib/SMSReceiver.php';

/*** specify your current timezone here ****/
date_default_timezone_set("Asia/Colombo");

/*** To be filled ****/
$serverurl= "https://api.dialog.lk/sms/send";

//application id which you will receive in provisioning
$applicationId = "APP_044477";

//application password which you will receive in provisioning
$password= "296b00a636e26fabd545f72a091d6726";

try{
	/*************************************************************/
  //creating a receiver and intializing it with your incoming data
	$receiver = new SMSReceiver(file_get_contents('php://input'));
  //Get the message to the app
	$content =$receiver->getMessage();
	$content=preg_replace('/\s{2,}/',' ', $content);
  //Get the phone number from which the message was sent
	$address = $receiver->getAddress();
	$requestId = $receiver->getRequestID();
  //Get the applicationId
	$applicationId = $receiver->getApplicationId();
	/*************************************************************/

	$sender = new SMSSender($serverurl, $applicationId, $password);

	list($key, $second, $third) = explode(" ",$content);

//sample message from the user ["keyword" "<<preferred string>>"]
//if the second string is "go"
		  if ($second=="marvel") {


$marvel_characters = array("Black Panther", "Black Widow", "Captain America", "Hawkeye", "Hulk","Iron Man" , "Falcon" ,  "Falcon");

$mycharacter= $marvel_characters[array_rand($marvel_characters)];

		//Send a Broadcasting Message to all the subscribed users

	    $boradmsg = substr($content,7);
	    error_log("Broadcast Message ".$content.$second.$name);
			    error_log($name.$x);
		  // $response=$sender->broadcastMessage("test");
      $sender->sendMessage($third.",your hidden marvel character is ".$mycharacter,$address);

	   }else{

		//Replying to an individual Message

	    error_log("Message received ".$content);
	    $sender->sendMessage("Sorry you have no super powers".$second,$address);

             }

//Exeptions can be handled here
	}catch(SMSServiceException $e){

	     	error_log("Passed Exception ".$e);


	}

?>
