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

			  try {
          $host = "db.ist.utl.pt";
          $user = "ist189559";
          $pass = "idxi1356";
					$dbname = $user;

				 	$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					 
					$query = "SELECT u_email, u_password FROM utilizador WHERE u_email=:email";
					$result = $db->prepare($query);
					$result->execute(array($email));

					foreach($result as $row) {
						$emailQuery = $row['u_email'];
						$passQuery  = $row['u_password'];
					}

					if ($emailQuery == $email && $passQuery == $password) {

						$query = "SELECT u_email FROM utilizador_qualificado WHERE u_email =:email;";
				  	$result = $db->prepare($query);
						$result->execute(array($email));
					
						$e = 0;
						foreach($result as $row) $e = 1;

						header("Location: ./index.html");
						setcookie("userID", $email, time() + 86400, '/'); // 1 day
						setcookie("qualificated", $e, time() + 86400, '/');

						$db = null;
					} else {
						header("Location: ../index.html");
						setcookie("userID", "", time() + 86400, '/'); // 1 day
						setcookie("qualificated", "", time() + 86400, '/');
					}

				  } catch (PDOException $e) {
            echo("<p>ERROR: {$e->getMessage()}</p>");
				  }
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
