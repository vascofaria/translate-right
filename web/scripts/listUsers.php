<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
  </head>
  <body>
    <?php
      try {
        $host = "db.ist.utl.pt";
        $user = "ist189559";
        $password = "idxi1356";
        $dbname = $user;

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM utilizador;";

        $result = $db->prepare($sql);
        $result->execute();

        echo("<table class='table'>");
          echo("<thead class='thead-dark'>");
            echo("<tr>");
              echo("<th scope='col'>E-mail</th>");
              echo("<th scope='col'>Password</th>");
            echo("<tr/>");
          echo("<thead/>");
          echo("<tbody>");
            foreach($result as $row) {
              echo("<tr>");
              echo("<td>{$row['u_email']}</td>");
              echo("<td>{$row['u_password']}</td>");
              echo("<tr/>");
            }
          echo("<tbody/>");
        echo("<table/>");

        $db = null;

      } catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
      }
    ?>
  </body>
</html>