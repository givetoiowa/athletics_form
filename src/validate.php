 <?php
	require_once('wp-content/themes/football/athletics_form/functions.php');
	$decision = (isset($_POST['correctInfo']) and strlen($_POST['correctInfo']) > 1 ) ? $_POST['correctInfo'] : NULL;
	$user_name = (isset($_POST['user_name']) and strlen($_POST['user_name']) > 1) ? $_POST['user_name'] : NULL;
	$user_address = (isset($_POST['user_address']) and strlen($_POST['user_address']) > 1) ? $_POST['user_address'] : NULL;

	if($decision == 'false'):
		$bgiID = (strlen($_POST['bgiID']) > 1) ? $_POST['bgiID'] : NULL;
		$timestamp = (strlen($_POST['timestamp']) > 1) ? $_POST['timestamp'] : NULL;
?>
	<h3>Confirm Entry</h3>
	<p>Please take a moment and review your information (BGI ID <?php echo $bgiID; ?>):</p>
	<div class="info">
		<p><?php echo $user_name; ?></p>
		<p><?php echo $user_address; ?></p>
	</div>
	<p>If this information is correct please confirm by clicking submit below:</p>
	<form action="" method="POST">
		<input type="hidden" name="confirmed_id" <?php echo 'value="'.$bgiID.'"'; ?>/>
		<input type="hidden" name="confirmed_name" <?php echo 'value="'.$user_name.'"'; ?>/>
		<input type="hidden" name="confirmed_address" <?php echo 'value="'.$user_address.'"'; ?>/>
		<input type="hidden" name="confirmed_timestamp" <?php echo 'value="'.$timestamp.'"'; ?>/>
		<ul class="centerButtons" >
			<li><a class="goback" href="../plaque/?id=<?php echo $bgiID; ?>&user_name=<?php echo $user_name; ?>">Go back</a></li>
			<li><input type="submit" value="Confirm" value/></li>
		</ul>
	</form>
<?php 
  elseif($decision == 'chooseOptOut'): 
    $content = '<h3>New Submission to Athletics Form!</h3>';
    $content .= '<p>Updated information:</p>';
    $content .= "<p>$user_name prefers to not be listed on the honor roll plaque</p>";
  elseif($decision == 'true'):
    $content = '<h3>New Submission to Athletics Form!</h3>';
    $content .= '<p>Updated information:</p>';
    $content .= "<p>" . $user_name;
    $content .= "'s listing is correct as indicated</p>";
    $content .= "<p>No changes made to the data file!</p>";
  elseif(isset($_POST['confirmed_id'])):
    $content = '<h3>New Submission to Athletics Form!</h3>';
    $content .= '<p>Updated information:</p>';
    $content .= "<p>" . $_POST['confirmed_name'];
    $content .= "<br/>" . $_POST['confirmed_address'] . "<br/>";
    $content .= "BGI ID: " . $_POST['confirmed_id'];
    $content .= "</p>";
    // prepare and write updated entry to updated csv file
    $updated_row = array("ID" => $_POST['confirmed_id'], "name" => $_POST['confirmed_name'], "address" => $_POST['confirmed_address'], "timestamp" => $_POST['confirmed_timestamp']);
    echo write_csv_data($updated_row, $_POST['confirmed_id']);
	endif;
	if(isset($content)){
		$sendto = "benzshawel@uifoundation.org";
		$sendto_name = "Addison Benzshawel";
		// send email notifiaction
		echo send_email($sendto, $sendto_name, $content);
	}
?>