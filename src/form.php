<?php
	require_once('wp-content/themes/football/athletics_form/functions.php');
	$date = new DateTime();
	$bgiID = (isset($_GET['id']) and strlen($_GET['id']) > 1 ) ? $_GET['id'] : NULL;
	$ID_placeholder = isset($bgiID) ? 'value="' . $bgiID . '"' : "";
	$data = get_csv_data('athletics_form/data/new_data.csv');
	$user_info = isset($bgiID) ? get_user_info($bgiID, $data) : NULL;
	if(isset($_GET['user_name']) and strlen($_GET['user_name']) > 1){
		$user_info['name'] = $_GET['user_name'];
		$checked = 'checked';
	} else {
		$checked = '';
	} 
	?>
<form action="" method="GET" id="ID-LOOKUP">
	<label for="lookupID">Lookup BGI ID</label>
	<input type="text" id="lookupID" name="id" <?php echo $ID_placeholder; ?>/>
	<input type="submit" value="Lookup ID" class="lookupButton" id="lookupButton" />
</form>
<?php if(is_array($user_info)): ?>
<div class="info">
	<p><?php echo $user_info['name']; ?></p>
	<p><?php echo $user_info['address']; ?></p>
</div>
<form action="http://www.uifoundation.org/football-legacy/validate-form/" method="POST">
  <h4>Please choose one of the following options:</h4>
    <ul class="options">
	    <li>
	    	<input type="radio" name="correctInfo" value="true" id="chooseYes" required/> 
	    	<label for="chooseYes">Listing correct as indicated </label>
	    </li>
	    <li>
		    <input type="radio" name="correctInfo" value="false" id="chooseNo"<?php echo $checked; ?>/>
		    <label for="chooseNo">Change listing to:</label>
		</li>
		<li id="corrections" style="display:none;">
			<ul>
			   <li>
				    <input type="text" id="Name" name="user_name" <?php echo 'value="'. $user_info['name'] .'"'; ?>/><br/>
				    <input type="text" id="Name" name="user_address" <?php echo 'value="'. $user_info['address'] .'"'; ?>/>
				</li>
			</ul>
		</li>
		 <li>
	    	<input type="radio" name="correctInfo" value="chooseOptOut" id="chooseOptOut" required/> 
	    	<label for="chooseOptOut">I/We prefer not to be listed on the honor roll plaque</label>
	    </li>
	</ul>

  <input type="hidden" name="bgiID" id="bgiID" <?php echo $ID_placeholder; ?> />
  <input type="hidden" name="timestamp" id="last_update" <?php echo 'value="' . $date->getTimestamp() . '"'; ?> />
  <input type="submit" value="Submit" style="margin:12px auto; display:block;"/>
</form>
<?php elseif(isset($user_info)): ?>
<p class="noID"><em><?php echo $user_info; ?></em></p>
<?php endif; ?>
