<html>
  <head>
    <title>TR - List Area Anomalies</title>
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
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Log out</button>
      </form>
    </nav>

    <h1 class="m-badge"><span class="badge badge-secondary">Anomalies List in the given area</span></h1>
    <h4 class="m-sub-badge">Insert your area, by writing the coordinates of the left top corner (1) and right bottom corner (2).</h4>

      <form 
        id="anomalies-area-form"
        class="needs-validation"
        method="POST"
        action=""
        novalidate
      >
        <div class="form-group row">
          <div class="col-sm-10">
            <label style="width:100%; text-align: center;">
              <h1>
                <span class="badge badge-secondary">Anomalies List in the given area</span>
              </h1>
            </label>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Latitude 1:</label>
            <input type="text" class="form-control" placeholder="Latitude" value="" name="lat1" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Longitude 1:</label>
            <input type="text" class="form-control" placeholder="Longitude" value="" name="long1" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Latitude 2:</label>
            <input type="text" class="form-control" placeholder="Latitude" value="" name="lat2" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Longitude 2:</label>
            <input type="text" class="form-control" placeholder="Longitude" value="" name="long2" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <button id="anomaly-form-btn" class="btn btn-primary" type="submit" name="submit-area">List Anomalies</button>

      </form>
      <!-- <div id="anomalies-form-by-area"> -->
      <!-- <div class="alert alert-success">
        <p>Insert your area, by writing the coordinates of the left top corner (1) and right bottom corner (2).</p>
      </div>
      <form id="anomalies-form" action="" method="POST">

        <div class="input-group mb-3 m-anomaly-form-component">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Latitude 1:</>
          </div>
          <input type="text" class="form-control" name="lat1">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Longitude 1:</>
          </div>
          <input type="text" class="form-control" name="long1">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Latitude 2:</>
          </div>
          <input type="text" class="form-control" name="lat2">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Longitude 2:</>
          </div>
          <input type="text" class="form-control" name="long2">
        </div>

        <button class="btn btn-primary m-submit-btn" type="submit" name="submit-area">List</button>
      </form> -->
    <!-- </div> -->

    <div id="anomalies-table" class="m-table">
      <?php
      if (isset($_POST['submit-area'])) {
        try {
          $host = "db.ist.utl.pt";
          $user = "ist189559";
          $password = "idxi1356";
          $dbname = $user;

          $latitude1  = $_POST['lat1'];
          $latitude2  = $_POST['lat2'];
          $longitude1 = $_POST['long1'];
          $longitude2 = $_POST['long2'];

          $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $query = "SELECT * FROM anomalia WHERE SUBSTRING(a_zona, 1, 4)::int8 >= :latitude1 AND SUBSTRING(a_zona, 1, 4)::int8 <= :latitude2 AND SUBSTRING(a_zona, 7, 4)::int8 >= :longitude1 AND SUBSTRING(a_zona, 7, 4)::int8 <= :longitude2;";
          $result = $db->prepare($query);
          $result->execute(array($latitude1, $latitude2, $longitude1, $longitude2));

          echo("<table class='table'>");
            echo("<thead class='thead-dark'>");
              echo("<tr>");
                echo("<th scope='col'>ID</th>");
                echo("<th scope='col'>Zona</th>");
                echo("<th scope='col'>Imagem</th>");
                echo("<th scope='col'>Língua</th>");
                echo("<th scope='col'>Timestamp</th>");
                echo("<th scope='col'>Descrição</th>");
                echo("<th scope='col'>Tem Redação?</th>");
              echo("<tr/>");
            echo("<thead/>");
            echo("<tbody>");
              foreach($result as $row) {
                echo("<tr>");
                echo("<td>{$row['a_id']}</td>");
                echo("<td>{$row['a_zona']}</td>");
                echo("<td>{$row['a_imagem']}</td>");
                echo("<td>{$row['a_lingua']}</td>");
                echo("<td>{$row['a_ts']}</td>");
                echo("<td>{$row['a_descricao']}</td>");
                if ($row['a_tem_anomalia_redacao']){
                  echo("<td>Sim</td>");
                } else {
                  echo("<td>Não</td>");
                }
                echo("<tr/>");
              }
            echo("<tbody/>");
          echo("<table/>");

        } catch (PDOException $e) {
          echo("<p>ERROR: {$e->getMessage()}</p>");
        }
      }
      ?>
    </div>
  </body>
</html>
