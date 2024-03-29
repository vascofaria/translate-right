<html>
<head>
    <title>TR - Delete Anomaly</title>
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

    <h1 class="m-badge"><span class="badge badge-secondary">Select the anomaly to delete:</span></h1>

    <?php
        if (isset($_POST['deleteAnomaly'])) {
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "DELETE FROM anomalia WHERE a_id=:a_id;";
                $result = $db->prepare($query);
                $result->bindValue(':a_id',  $_POST['a_id']);
                $result->execute();
                $db = null;
              } catch (PDOException $e) {
                echo("<p>ERROR: {$e->getMessage()}</p>");
              }
        }
    ?>
    <?php
      try {
        $host     = "db.ist.utl.pt";
            $user     = "ist189559";
            $password = "idxi1356";
            $dbname   = $user;

            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM anomalia;";
            $result = $db->prepare($sql);
            $result->execute();


            echo("<table class='table' style='margin-top: 60px;'>");
            echo("<thead class='thead-dark'>");
            echo("<tr>");
            echo("<th scope='col'>Identification</th>");
            echo("<th scope='col'>Zone</th>");
            echo("<th scope='col'>Image</th>");
            echo("<th scope='col'>Language</th>");
            echo("<th scope='col'>Timestamp</th>");
            echo("<th scope='col'>Description</th>");
            echo("<th scope='col'>Has Redaction?</th>");
            echo("<th scope='col'>Delete</th>");
            echo("<tr/>");
            echo("<thead/>");
            echo("<tbody>");
              foreach($result as $row) {
                echo("<tr><form action='' method='POST'>");
                echo("<td><input type='readonly'   name='a_id'    readonly style='border:none' value='"."{$row['a_id']}"."'></td>");
                echo("<td><input type='readonly'   name='a_zona'   readonly style='border:none' value='"."{$row['a_zona']}" ."'></td>");
                echo("<td><input type='readonly'   name='a_imagem'      readonly style='border:none' value='"."{$row['a_imagem']}"   ."'></td>");
                echo("<td><input type='readonly'   name='a_lingua'   readonly style='border:none' value='"."{$row['a_lingua']}" ."'></td>");
                echo("<td><input type='readonly'   name='a_ts'   readonly style='border:none' value='"."{$row['a_ts']}" ."'></td>");
                echo("<td><input type='readonly'   name='a_descricao'   readonly style='border:none' value='"."{$row['a_descricao']}" ."'></td>");
                if ($row['a_tem_anomalia_redacao']){
                  echo("<td><input type='readonly'   name='a_tem_anomalia_redacao'   readonly style='border:none' value='YES'></td>");
                } else {
                  echo("<td><input type='readonly'   name='a_tem_anomalia_redacao'   readonly style='border:none' value='NO'></td>");
                }
                echo("<td>
                    <button class='btn btn-danger m-submit-btn' type='submit' name='deleteAnomaly' >
                        Delete
                    </button>
                    </td>");
                echo("</form><tr/>");
              }
            echo("<tbody/>");
            echo("<table/>");

            $db = null;
      }
      catch (PDOException $e) {
            echo("<p>ERROR: {$e->getMessage()}</p>");
          }
    ?>

</body>
</html>