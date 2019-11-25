<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
  </head>
  <body>
    <div id="anomalies-form">

      <div class="alert alert-success">
        <p>Insert your area, by writing the coordinates of the left top corner (1) and right bottom corner (2).</p>
      </div>
      <form id="anomalies-form" action="">
    
        <div class="input-group mb-3 m-anomaly-form-component">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Latitude 1:</>
          </div>
          <input type="text" class="form-control">
        </div>
    
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Longitude 1:</>
          </div>
          <input type="text" class="form-control">
        </div>
    
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Latitude 2:</>
          </div>
          <input type="text" class="form-control">
        </div>
    
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Longitude 2:</>
          </div>
          <input type="text" class="form-control">
        </div>

        <button class="btn btn-primary m-submit-btn" type="submit" name="stest">List</button>
      </form>
    </div>

    <div id="anomalies-table" class="m-table">
      <?php
      if (isset($_POST['stest'])) {
        try {
          $host = "db.ist.utl.pt";
          $user = "ist189559";
          $password = "idxi1356";
          $dbname = $user;

          $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = "SELECT * FROM anomalia;";

          $result = $db->prepare($sql);
          $result->execute();

          echo("<table class='table'>");
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