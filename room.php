<?php
	session_start();
	$userId =  $_SESSION['userId'];
	$to = $_SESSION['to'];
	include 'header.php';
	include 'connect.php';
	$sql_1 = "SELECT * FROM users WHERE userId = ".$userId;
	$response_1 = mysql_query($sql_1);
	while ($row_1 = mysql_fetch_array($response_1)) {
		$username = $row_1['username'];
		$name = $row_1['firstName'];
		$family = $row_1['lastName'];
	}
	if (isset($_POST['logout'])) {
		session_destroy();
		header("Location: login.php");
	}
	$sql_2 = "SELECT * FROM users WHERE userId = ".$to;
	$response_2 = mysql_query($sql_2);
	while ($row_2 = mysql_fetch_array($response_2)) {
		$to_username = $row_2['username'];
		$to_name = $row_2['firstName'];
		$to_family = $row_2['lastName'];
	}
	$page = $_SERVER['PHP_SELF'];
	$sec = "3";
?>
<style type="text/css">
	.scrollClass {
		height: 400px;
		overflow-x: hidden; 
  		overflow-y: scroll;
	}
</style>

<div class="w3-container">
	<div class="w3-bar w3-light-grey w3-border w3-padding">
		<form method="POST">
			<a href="page.php" class="w3-bar-item w3-button w3-mobile">Home</a>
		    <a href="chat.php" class="w3-bar-item w3-button w3-mobile">Chat</a>
		    <div class="w3-right">
		    	<input type="text" class="w3-bar-item w3-input w3-white w3-mobile" readonly="true" value="<?php echo $username ?>">
		    	<button class="w3-bar-item w3-button w3-blue w3-mobile" name="logout">Log out</button>
		    </div>
		</form>
  	</div>
  	<br>
  	<div class="w3-card-4">
	  	<div class="w3-container w3-teal">
	    	<h2>Chatting Room (<?php echo $to_name." ".$to_family; ?>)</h2>
	  	</div>
	  	<form class="w3-container" method="POST">
	    	<p>      
	    		<label class="w3-text-teal"><b>Conversation</b></label>
	    		<div class="scrollClass">
		    		<ul class="w3-ul w3-card-4">
	    				<?php
	    					$all_msg = "SELECT * FROM messages WHERE (fromId = ".$userId." AND toId = ".$to.") OR (fromId = ".$to." AND toId = ".$userId.")";
	    					$response_to_all_msg = mysql_query($all_msg);
	    					$num_of_msg = mysql_num_rows($response_to_all_msg);
	    					if ($num_of_msg > 0) {
	    						while ($rows = mysql_fetch_array($response_to_all_msg)) {
	    				?>
	    							<li class="w3-bar">
				      					<div class="w3-bar-item">
				        					<span class="w3-large"><?php 
				        												if($rows['sender'] == $userId)
				        													echo "You: (".$username.")";
				        												else if($rows['sender'] == $to)
				        													echo $to_username; ?></span><br>
				        					<span><?php echo $rows['text']; ?></span>
				      					</div>
				    				</li>
	    				<?php
	    						}
	    					}
	    				?>
	  				</ul>
	  			</div>
	    	</p>
	    	<p>      
	    		<label class="w3-text-teal"><b>Send Text</b></label>
	    		<input class="w3-input w3-border w3-light-grey" name="textField" type="text">
	    	</p>
	    	<p>
	    		<input type="submit" class="w3-btn w3-teal" name="send" value="Send">
	    	</p>
	  	</form>
	</div>
	<div id="txtHint"></div>
</div>
<?php
	if (isset($_POST['send'])) {
		if (isset($_POST['textField']) && $_POST['textField'] != "") {
			$msg = "INSERT INTO messages VALUES(".$userId.", ".$to.", '".$_POST['textField']."', ".$userId.")";
			$insert_msg = mysql_query($msg);
		}
	}
?>
