<html>
<head>
    <title>TR - Insert Anomaly</title>
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
                <label style="width:100%; text-align: center;"><h4>Insert Anomaly</h4></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Zone</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="X" value="" name="x" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="text" class="form-control" id="validationCustom01" placeholder="Y" value="" name="y" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Image</label>
            <input type="file" class="form-control-file" id="validationCustom01" name="image" required>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Language</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Language" value="" name="language" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Description</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Description" value="" name="description" required>
                <div class="valid-feedback"insertAnomaly.php>
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Has redaction?</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="hasRedaction">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <div class="valid-feedback"insertAnomaly.php>
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                 <label><h4>Translation Anomaly</h4></label>
            </div>
        </div>
        <div class="form-group row" id="translate-zone-x">
            <div class="col-sm-10">
                <label for="validationCustom01">Zone</label>
                <input type="text" class="form-control" placeholder="X" value="" name="x2">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row" id="translate-zone-y">
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Y" value="" name="y2">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row" id="translate-language">
            <div class="col-sm-10">
                <label for="validationCustom01">Language</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Language" value="" name="language2">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="submitButtonTA">Insert Translation Anomaly</button>
        <button class="btn btn-primary" type="submit" name="submitButton">Insert Anomaly</button>
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

        function toggleVisibility() {
            document.getElementById('translate-zone-x').style.visibility   = 'visible';
            document.getElementById('translate-zone-y').style.visibility   = 'visible';
            document.getElementById('translate-language').style.visibility = 'visible';
        }
    </script>

	<?php

        if (isset($_POST['submitButton'])) {
    		try {
    			$host     = "db.ist.utl.pt";
           		$user     = "ist189559";
            	$password = "idxi1356";
            	$dbname   = $user;

            	$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query  = makeQuery();
                $result = $db->prepare($query);

                $zone = $_POST['x'] . ", " . $_POST['y'];

                if($_POST['hasRedaction'] == 'yes') {
                    $hasRedaction = 1;
                }
                else {
                  $hasRedaction = 0;
                }

                $result->bindValue(':zone', $zone);
                $result->bindValue(':image', $_POST["image"]);
                $result->bindValue(':language', $_POST['language']);
                $result->bindValue(':description', $_POST['description']);
                $result->bindValue(':description', $_POST['description']);
                $result->bindValue(':hasRedaction', $hasRedaction);

                $result->execute();

                if (isset($_POST['translactionAnomaly'])) {
                    echo "string";
                    $query  = "INSERT INTO anomalia_traducao(a_zona a_lingua) values (:zone2, :language2);";
                    $result = $db->prepare($query);

                    $zone2 = $_POST['x2'] . ", " . $_POST['y2'];

                    $result->bindValue(':zone2', $zone2);
                    $result->bindValue(':language2', $_POST['language2']);

                    $result->execute(); 
                }

              $db = null;
    		}
    		catch (PDOException $e) {
            	echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }

        else if (isset($_POST['submitButtonTA'])) {
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query  = makeQuery();
                $result = $db->prepare($query);

                $zone = $_POST['x'] . ", " . $_POST['y'];

                if($_POST['hasRedaction'] == 'yes') {
                    $hasRedaction = 1;
                }
                else {
                  $hasRedaction = 0;
                }

                $result->bindValue(':zone', $zone);
                $result->bindValue(':image', $_POST["image"]);
                $result->bindValue(':language', $_POST['language']);
                $result->bindValue(':description', $_POST['description']);
                $result->bindValue(':description', $_POST['description']);
                $result->bindValue(':hasRedaction', $hasRedaction);

                $result->execute();

                echo "string";
                $query  = "INSERT INTO anomalia_traducao(at_zona2, at_lingua2) values (:zone2, :language2);";
                $result = $db->prepare($query);

                $zone2 = $_POST['x2'] . ", " . $_POST['y2'];

                $result->bindValue(':zone2', $zone2);
                $result->bindValue(':language2', $_POST['language2']);

                $result->execute(); 

                $db = null;
            }
            catch (PDOException $e) {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }

        function makeQuery($zone, $image, $language, $description) {
            $query = "INSERT INTO anomalia(a_zona, a_imagem, a_lingua, a_descricao, a_tem_anomalia_redacao) values
            (:zone, :image, :language, :description, :hasRedaction);";
            return $query;
        }
	?>
</body>

</html>
