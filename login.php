<?php 
	include 'header.php'; 
	include 'connect.php';

	if (isset($_POST['login'])) {
		if (isset($_POST['username']) && $_POST['username'] != "") {
			if (isset($_POST['password']) && $_POST['password'] != "") {
				$sql = "SELECT * FROM users WHERE username = '".$_POST['username']."'";
				$response = mysql_query($sql);
				$num = mysql_num_rows($response);
				if ($num > 0) {
					while ($row = mysql_fetch_array($response)) {
						if ($row["password"] == $_POST["password"]) {
							$a = 1;
							session_start();
							$_SESSION['userId'] = $row['userId'];
							break;
						} else $a = 0;
					}
					if ($a == 0) {
						echo "<script>alert(\"Wrong password\");</script>";
					} else if ($a == 1) {
						header("Location: page.php");
					}
				} else {
					echo "<script>alert(\"Wrong username\");</script>";
				}
			}
		}
	}
?>

<div class="w3-container w3-blue">
  <h2>Log In</h2>
</div>

<form class="w3-container" method="post">
	<p>
		<label>Username</label>
		<input class="w3-input" type="text" name="username" id="username">
	</p>
	<p>
		<label>Paswoord</label>
		<input class="w3-input" type="password" name="password" id="password">
	</p>
	<p>
		<input type="submit" class="w3-input"  value="Log In" name="login">
	</p>
</form>