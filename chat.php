<?php
	session_start();
	$userId =  $_SESSION['userId'];
	include 'header.php';
	include 'connect.php';
	$sql_1 = "SELECT * FROM users WHERE userId = ".$userId;
	$response_1 = mysql_query($sql_1);
	while ($row_1 = mysql_fetch_array($response_1)) {
		$username = $row_1['username'];
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
	<form class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" method="POST">
		<div class="w3-row w3-section">
	  		<select class="w3-select" name="option">
				<option value="0" disabled selected>Choose your option</option>
				<?php
					$sql_2 = "SELECT * FROM users WHERE userId != ".$userId;
					$response_2 = mysql_query($sql_2);
					while ($row_2 = mysql_fetch_array($response_2)) {
						if ($_POST['option'] == $row_2['userId']) {
							echo "<option selected value=\"".$row_2['userId']."\">".$row_2['username']."</option>";
						} else
							echo "<option value=\"".$row_2['userId']."\">".$row_2['username']."</option>";
					}
				?>
			</select>
		</div>
		<button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" name="continue">Continue</button>
	</form>
</div>

<?php
	if (isset($_POST['continue'])) {
		if (isset($_POST['option']) && $_POST['option'] != 0) {
			$_SESSION['to'] = $_POST['option'];
			header("Location: room.php");
		}
	}
?>