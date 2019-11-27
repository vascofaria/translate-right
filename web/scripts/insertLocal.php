<html>
<head>
    <link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
</head>

<body>
    <form 
        class="needs-validation" 
        method="POST" 
        novalidate 
        style="width: 50%; height: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -60%);">
        <div class="form-group row">
            <div class="col-sm-10">
                <label style="width:100%; text-align: center;"><h4>Insert Local</h4></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Local name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="" name="name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Longitude</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Longitude" value="" name="longitude" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Latitude</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Latitude" value="" name="latitude" required>
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
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo $_POST['latitude'];
                $query = makeQuery();
                $result = $db->prepare("SELECT * FROM local_publico");
                $result->execute();
                #$result = pg_execute($db, "myQuery", array($_POST['latitude'], $_POST['longitude'], $_POST['name']));

                $db = null;
            }
            catch (PDOException $e) {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }

        function makeQuery() {
            $query = "INSERT INTO local_publico(lp_latitude, lp_longitude, lp_nome) VALUES ($1, $2, $3);";
            return $query;
        }
    ?>
</body>

</html>