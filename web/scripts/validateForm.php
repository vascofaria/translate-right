<html>

<body>
	<?php  
		$email = "";
		$password = "";
		$emailErr = false;
		$passwordErr = false;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST["email"])) {
				$emailErr = "Valid email is required: ex@abc.xyz";
			}
			else {
				$email = test_input($_POST["email"]);
				//check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "Valid email is required: ex@abc.xyz";
				}
			}

			if (empty($_POST["pass"])) {
				$passwordErr = "Password is required";
			}
			else {
				$password = $_POST["pass"];
			}

			if (!$emailErr && !$passwordErr) {
				header("Location: ./index.html");
			}
		}

		function test_input($data) {
  			$data = trim($data);
  			$data = stripslashes($data);
  			$data = htmlspecialchars($data);
 			return $data;
		}
	?>
</body>

</html>
