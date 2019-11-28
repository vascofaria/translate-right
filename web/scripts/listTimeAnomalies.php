<html>
  <head>
    <title>TR - List Time Anomalies</title>
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

    <h1 style="margin-left: 35%; margin-top: 2%;"><span class="badge badge-secondary">Anomalies List in the given time</span></h1>

    <form 
        id="anomalies-time-form"
        class="needs-validation"
        method="POST"
        action=""
        novalidate
      >
      
        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">Since:</label>
            <input type="text" class="form-control" placeholder="Since" value="2019-01-01 00:00:00" name="lat1" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <label for="validationCustom01">To:</label>
            <input type="text" class="form-control" placeholder="To" value="2019-01-01 00:00:00" name="long1" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </div>

        <button id="anomaly-form-btn" class="btn btn-primary" type="submit" name="submit-time">List Anomalies</button>

      </form>

    <div id="anomalies-table" class="m-table">
    <?php
    if (isset($_POST['submit-time'])) {
      try {
        $host = "db.ist.utl.pt";
        $user = "ist189559";
        $password = "idxi1356";
        $dbname = $user;

        $since_time = $_POST['since_time'];
        $to_time    = $_POST['to_time'];

        echo("<p>{$since_time} {$to_time}</p>");

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM anomalia WHERE a_ts >= :since_time AND a_ts <= :to_time;";
        $result = $db->prepare($query);
        $result->execute(array($since_time, $to_time));

        echo("<table class='table m-table'>");
          echo("<thead class='thead-dark'>");
            echo("<tr>");
              echo("<th scope='col'>ID</th>");
              echo("<th scope='col'>Zona</th>");
              echo("<th scope='col'>Imagem</th>");
              echo("<th scope='col'>Lingua</th>");
              echo("<th scope='col'>TimeStamp</th>");
              echo("<th scope='col'>Descricao</th>");
              echo("<th scope='col'>Tem Redacao?</th>");
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