<?php
	session_start();
	$userId =  $_SESSION['userId'];
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
?>
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
  <div class="w3-card-4" style="width:50%;">
	<div class="w3-container w3-center">
		<br>
      	<img src="images/avatar.png" alt="Avatar" style="width:80%; height: 500px;">
      	<h5><?php echo $name." ".$family; ?></h5>

      	<div class="w3-section">
	        <button class="w3-button w3-green">Accept</button>
	        <button class="w3-button w3-red">Decline</button>
      	</div>
    </div>

  </div>

</div>

