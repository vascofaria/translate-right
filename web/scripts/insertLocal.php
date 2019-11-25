<html>
<head>
	<link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
</head>

<body>
	<form class="needs-validation" novalidate>
  		<div class="form-row">
    		<div class="col-md-4 mb-3">
    			<label for="validationCustom01">First name</label>
      			<input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
      			<div class="valid-feedback">
        			Looks good!
      			</div>
    		</div>
 		</div>
  		<button class="btn btn-primary" type="submit">Submit form</button>
	</form>

	<?php
		try {
			$host     = "db.ist.utl.pt";
       		$user     = "ist189559";
        	$password = "idxi1356";
        	$dbname   = $user;
		
        	$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        	$query = "";

        	$result = pg_prepare("myQuery", $query);

        	$db = null;
		}
		catch (PDOException $e) {
        	echo("<p>ERROR: {$e->getMessage()}</p>");
        }

        function makeQuery($latitude, $longitude, $name) {
        	
        }
	?>
</body>

</html>