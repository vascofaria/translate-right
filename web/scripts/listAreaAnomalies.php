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

    <h1 style="margin-left: 35%; margin-top: 2%;"><span class="badge badge-secondary">Anomalies List in the given area</span></h1>
    <h4 style="margin-left: 20%">Insert your area, by writing the latitude, longitude and dX, dY.</h4>

      <form 
        id="anomalies-area-form"
        class="needs-validation"
        method="POST"
        action=""
        novalidate
      >
      
        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Latitude(X):</label>
            <input type="text" class="form-control" placeholder="X(-90, 90)" value="" name="x" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Longitude(Y):</label>
            <input type="text" class="form-control" placeholder="Y(0, 180)" value="" name="y" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">dX:</label>
            <input type="text" class="form-control" placeholder="dX(0, 90)" value="" name="dx" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">dY:</label>
            <input type="text" class="form-control" placeholder="dY(0, 90)" value="" name="dy" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <button id="anomaly-form-btn" class="btn btn-primary" type="submit" name="submit-area">List Anomalies</button>

      </form>

    <div id="anomalies-table" class="m-table">
      <?php
      if (isset($_POST['submit-area'])) {
        try {
          $host = "db.ist.utl.pt";
          $user = "ist189559";
          $password = "idxi1356";
          $dbname = $user;

          $x1  = $_POST['x'] - $_POST['dx'];
          $x2  = $_POST['x'] + $_POST['dx'];
          $y1  = $_POST['y'] - $_POST['dy'];
          $y2  = $_POST['y'] + $_POST['dy'];

          $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $query = "SELECT anomalia.a_id, anomalia.a_zona, anomalia_traducao.at_zona2, anomalia.a_imagem, anomalia.a_lingua, anomalia_traducao.at_lingua2, anomalia.a_ts, anomalia.a_descricao, anomalia.a_tem_anomalia_redacao
           FROM anomalia NATURAL JOIN incidencia NATURAL JOIN item FULL OUTER JOIN anomalia_traducao WHERE item.lp_latitude >= :x1 AND item.lp_latitude <= :x2 AND item.lp_longitude >= :y1 AND item.lp_longitude <= :y2;";
          $result = $db->prepare($query);
          $result->execute(array($x1, $x2, $y1, $y2));

          echo("<table class='table'>");
            echo("<thead class='thead-dark'>");
              echo("<tr>");
                echo("<th scope='col'>ID</th>");
                echo("<th scope='col'>Zone</th>");
                echo("<th scope='col'>Zone 2</th>");
                echo("<th scope='col'>Image</th>");
                echo("<th scope='col'>Language</th>");
                echo("<th scope='col'>Language 2</th>");
                echo("<th scope='col'>Timestamp</th>");
                echo("<th scope='col'>Description</th>");
                echo("<th scope='col'>Has Redaction?</th>");
              echo("<tr/>");
            echo("<thead/>");
            echo("<tbody>");
              foreach($result as $row) {
                echo("<tr>");
                echo("<td>{$row['a_id']}</td>");
                echo("<td>{$row['a_zona']}</td>");
                if ($row['at_zona2']) echo("<td>{$row['at_zona2']}</td>");
                else echo("<td>--</td>");
                echo("<td>{$row['a_imagem']}</td>");
                echo("<td>{$row['a_lingua']}</td>");
                if ($row['at_lingua2']) echo("<td>{$row['at_lingua2']}</td>");
                else echo("<td>--</td>");
                echo("<td>{$row['a_ts']}</td>");
                echo("<td>{$row['a_descricao']}</td>");
                if ($row['a_tem_anomalia_redacao']) echo("<td>Sim</td>");
                else echo("<td>Não</td>");
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
