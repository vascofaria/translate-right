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
                <label style="width:100%; text-align: center;"><h4>Insert Item</h4></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Location</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Location" value="" name="location" required>
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
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="validationCustom01">Description</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Description" value="" name="description" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
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
            
                $query = makeQuery($_POST['description'], $_POST['location'], $_POST['latitude'], $_POST['longitude']);

                $result = $db->prepare($sql);
                $result->execute();

                $db = null;
            }
            catch (PDOException $e) {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }

        function makeQuery($description, $location, $latitude, $longitude) {
            $query = "INSERT INTO item(i_id, i_descricao, i_localizacao, lp_latitude, lp_longitude) values 
            ($description, $location, $latitude, $longitude);";
            return $query;
        }
    ?>
</body>

</html>