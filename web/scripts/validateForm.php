<html>

<body>
	<?php  
		$email = $password = "";
		$emailErr = $passwordErr = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST["email"])) {
				$emailErr = "Valid email is required: ex@abc.xyz";
			}

			if (empty($_POST["pass"])) {
				$password = "Password is required";
			}
		}
	?>
</body>

</html>