<html>
<head>
    <title>TR - Insert Correction Proposal</title>
    <meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="./index.html">
        <img src="../assets/right-alignment.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Translate Right
      </a>
      <form class="form-inline my-2 my-lg-0" action="../index.html">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
      </form>
    </nav>

    <form
        class="needs-validation"
        method="POST"
        novalidate
        style="width: 50%; height: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -60%);">
        <div class="form-group row">
            <div class="col-sm-10">
                <label style="width:100%; text-align: center;"><h4>Insert Correction Proposal</h4></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Date</label>
                <input type="date" class="form-control" id="validationCustom01" placeholder="" value="" name="date" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Hour</label>
                <input type="time" class="form-control" id="validationCustom01" placeholder="" value="" name="hour" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Text</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Text" value="" name="text" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="submitButton">Submit form</button>
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
        if (isset($_POST['submitButton'])) {
            if (isset($_COOKIE['qualificated']) && isset($_COOKIE['userID'])) {
            if ($_COOKIE['qualificated']) {
    		try {
    			    $host     = "db.ist.utl.pt";
           		$user     = "ist189559";
            	$password = "idxi1356";
            	$dbname   = $user;

            	$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $dateHour = $_POST['date'] . ' ' . $_POST['hour'];

              //Gets correction proposal number for selected user.
              $query = "SELECT MAX(pc_nro) as max FROM proposta_correcao WHERE u_email = :email;";
              $result = $db->prepare($query);
              $result->bindValue(':email', $_POST['email']);
              $result->execute();
              $row = $result->fetch(PDO::FETCH_ASSOC);
              $number = $row['max'] + 1;

              $query  = makeQuery();
              $db->beginTransaction();
              $result = $db->prepare($query);
              $result->bindValue(':cpNumber', $number);
              $result->bindValue(':dateHour', $dateHour);
              $result->bindValue(':cpText', $_POST['text']);
              $result->bindValue(':email', $_COOKIE['userID']);

              $result->execute();
              $db->commit();
              
              $db = null;
    		}
    		catch (PDOException $e) {
            	echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            } else {
                echo("<p>ERROR: No Permission</p>");
            }
            } else {
                echo("<p>ERROR: Please Login</p>");
            }
        }

        function makeQuery() {
            $date_hour = "";
            $query = "INSERT INTO proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values
            (:cpNumber, :dateHour, :cpText, :email);";
            return $query;
        }
	?>
</body>

</html>
