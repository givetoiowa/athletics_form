<?php
/**
 * Functions for Athletics address Confirmation Form
 * Author: Addison Benzshawel / UIF
 * Date Created: 5/5/2014
 * Last Updated: 5/5/2014 by Addison
 */
require_once('lib/swiftmailer/swift_required.php');


/**
 * @param $fileName is a string of the path to the CSV file that you wish extracted
 * returns multidimensional array with the indexes of [row]['fieldName'] 
 * for example array(0 => array("ID" => 999999, "name" => John Doe, => "address"), ... ) 
 */
function get_csv_data(){
	$fileName = 'http://www.uifoundation.org/football-legacy/wp-content/themes/football/athletics_form/data/new_data.csv';
	// if file path is string get file and put int into an array
	if($fileName !== NULL){
		$row = 1;
		if (($handle = fopen($fileName, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	if(isset($data[0])){
			        $num = count($data);
			        $row++;
			        $orig_data[$row]['ID'] = $data[0]; 
		        	$orig_data[$row]['name'] = $data[1]; 
		        	$orig_data[$row]['address'] = $data[2]; 
		        	$orig_data[$row]['timestamp'] = $data[3]; 
		        }
		    }
		    fclose($handle);
		}

		// Reindex array to get rid of title row
		$c = 0;
		$cleaned_data = array();
		for($r = 3; $r < count($orig_data) + 2; $r++){
			$cleaned_data[$c]['ID'] = $orig_data[$r]['ID']; 
	        $cleaned_data[$c]['name'] = $orig_data[$r]['name']; 
	        $cleaned_data[$c]['address'] = $orig_data[$r]['address']; 
	        $cleaned_data[$c]['timestamp'] = $orig_data[$r]['timestamp']; 
	        $c++;
		}
	} else {
		$cleaned_data = "Filename must be a string!";
	}
	return $cleaned_data;
}

function get_user_info($bgiID, $data){
	foreach($data as $entry){
		if($entry['ID'] == $bgiID){
			$res = $entry;
		}
	}
	if(!isset($res)){
		$res = "There are no entries corresponding to the ID '$bgiID'";
	}
	
	return $res;
}

function write_csv_data($row, $bgiID){
	$addition = is_array($row) ? $row : NULL;
	// If user id is not already in updated file returns true if not false 
	$data = get_csv_data('data/new_data.csv');
	$updated_data = array(array("ID", "NAME", "ADDRESS", "TIMESTAMP"));
		if(is_user_update_unique($bgiID)){
		$data[]= $addition;
		$updated_data = $data;
	} else {
		foreach($data as $entry){
			if($entry['ID'] == $bgiID){
				$updated_data[] = $addition;

			} else {
				$updated_data[] = $entry;
			}
		}
	}

	if(isset($updated_data)){
		$fp = fopen('wp-content/themes/football/athletics_form/data/new_data.csv', 'w');

		foreach ($updated_data as $fields) {
			//echo "<br/>";
			//var_dump($fields);
		    fputcsv($fp, $fields);
		
		}
	}
}

function get_updated_data(){
	$row = 1;
	if (($handle = fopen('http://www.uifoundation.org/football-legacy/wp-content/themes/football/athletics_form/data/new_data.csv', "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        $num = count($data);
	        $row++;
	        $userdata[$row]['ID'] = $data[0]; 
        	$userdata[$row]['name'] = $data[1]; 
        	$userdata[$row]['address'] = $data[2]; 

	    }
	    fclose($handle);
	     return $userdata;
	}  
}

function is_user_update_unique($ID){
	$data = get_csv_data();
	foreach($data as $entry){
		if($entry['ID'] == $ID){
			$unique = FALSE;
		}
	}
	if(!isset($unique)){
		$unique = TRUE;
	}

	return $unique;
}

/** 
 * @param $sendto string of email address you are sending to
 * @param $sendto_name string of person's name your are sending email ti
 * @param $content string content of email
 */
function send_email($sendto, $sendto_name, $content){
	$todays_date = date('l jS \of F Y h:i:s A');
	// Create the mail transport configuration
	$transport = Swift_MailTransport::newInstance();
	 
	// Create the message
	$message = Swift_Message::newInstance();
	$message->setTo(array(
	  "benzshawel@uifoundation.org" => "Addison",
	));
	$message->attach(Swift_Attachment::fromPath('http://www.uifoundation.org/football-legacy/wp-content/themes/football/athletics_form/data/new_data.csv'));
	$message->setSubject("New entry to Athletics Form");
	$message->setBody(
			'<html>' .
			'<head></head>' .
			'<body>' .
			"<p>$todays_date<br/>\n".
			"$content  </p><br/><br/>\n" .
			'<p><em>This message was automatically generated from the Athletics form. If there is an error in this message or you would not like to get these emails please <a href="mailto:benzshawel@uifoundation.org">reply here</a> to unsubscribe.</em></p>' .
			'</body>' .
			'</html>' ,
			'text/html'
			);
	$message->setFrom("NoReply@uifoundation.org", "See email disclaimer for contact info");
	 
	// Send the email
	$mailer = Swift_Mailer::newInstance($transport);
	
	if($result = $mailer->send($message, $failures)){
		$email_res = '<span style="margin:30px auto; display:block; width:100%; padding: 30px; background-color: #FFFFCC;">Thanks! You information has been recorded.</span>';
	} else {
		$email_res =  "There was an error:\n";
		$email_res .= "<br/>$failures";
	}

	return $email_res;
}
