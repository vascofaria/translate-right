<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
  </head>
  <body>

    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="../assets/right-alignment.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Translate Right
      </a>
      <form class="form-inline my-2 my-lg-0" action="./index.html">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Go back</button>
      </form>
      <form class="form-inline my-2 my-lg-0" action="../index.html">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
      </form>
    </nav>

    <div id="anomalies-form-by-time">

      <div class="alert alert-success">
        <p>Insert your area, by writing the coordinates of the left top corner (1) and right bottom corner (2).</p>
      </div>

      <form id="anomalies-form" action="" method="POST">

        <div class="input-group mb-3 m-anomaly-form-component">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Since:</>
          </div>
          <input type="text" class="form-control" name="since_time">
        </div>

        <div class="input-group mb-3 m-anomaly-form-component">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">To:</>
          </div>
          <input type="text" class="form-control" name="to_time">
        </div>

      </form>
    </div>

    <div class="m-table">
    <?php
    if (isset($_POST['submit-time'])) {
      try {
        $host = "db.ist.utl.pt";
        $user = "ist189559";
        $password = "idxi1356";
        $dbname = $user;

        $since_time = $_POST['since_time'];
        $to_time    = $_POST['to_time'];

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM anomalia WHERE a_ts >= $since_time AND a_ts <= $to_time;";

        $result = $db->prepare($sql);
        $result->execute();

        echo("<table class='table m-table'>");
          echo("<thead class='thead-dark'>");
            echo("<tr>");
              echo("<th scope='col'>ID</th>");
              echo("<th scope='col'>Zona</th>");
              echo("<th scope='col'>Imagem</th>");
              echo("<th scope='col'>Lingua</th>");
              echo("<th scope='col'>TimeStamp</th>");
              echo("<th scope='col'>Descricao</th>");
              echo("<th scope='col'>Redacao?</th>");
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
              echo("<td>{$row['a_tem_anomalia_redacao']}</td>");
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