<html>
<head>
	<link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
</head>

<body>
	<form class="needs-validation" novalidate>
  		<div class="form-row">
    		<div class="col-md-4 mb-3">
    			<label for="validationCustom01">Local name</label>
      			<input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="" required>
      			<div class="valid-feedback">
        			Looks good!
      			</div>
    		</div>
 		</div>
  		<button class="btn btn-primary" type="submit">Submit form</button>
	</form>

	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
  			'use strict';
 	 		window.addEventListener('load', function() {
    			// Fetch all the forms we want to apply custom Bootstrap validation styles to
    			var forms = document.getElementsByClassName('needs-validation');
    			// Loop over them and prevent submission
    			var validation = Array.prototype.filter.call(forms, function(form) {
      				form.addEventListener('submit', function(event) {
        				if (form.checkValidity() === false) {
         	 				event.preventDefault();
          					event.stopPropagation();
       					}
        				form.classList.add('was-validated');
      				}, false);
    			});
  			}, false);
		})();
	</script>

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