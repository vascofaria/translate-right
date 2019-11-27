<html>
<head>
	<link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
</head>

<body>
    <form 
        class="needs-validation" 
        novalidate 
        style="width: 50%; height: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -60%);">
        <div class="form-group row">
            <div class="col-sm-10">
                <label style="width:100%; text-align: center;"><h4>Insert Correction</h4></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Email</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Email" value="" name="email" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Number</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Number" value="" name="number" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Anomaly Id</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Anomaly Id" value="" name="anomalyId" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submitButton">Submit form</button>
    </form>

	<?php
        if (isset($_POST['submitButton'])) {
    		try {
    			$host     = "db.ist.utl.pt";
           		$user     = "ist189559";
            	$password = "idxi1356";
            	$dbname   = $user;
    		
            	$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		
            	$query = makeQuery($_POST['email'], $_POST['number'], $_POST['anomalyId'])

            	$result = $db->prepare($sql);
                $result->execute();

            	$db = null;
    		}
    		catch (PDOException $e) {
            	echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }

        function makeQuery($email, $number, $anomalyId) {
            $query = "INSERT INTO correcao(u_email, pc_nro, a_id) values ($email, $number, $anomalyId);";
            return $query;
        }
	?>
</body>

</html>