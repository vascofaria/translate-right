<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
  </head>
  <body>
    <?php
      try {
        $host = "db.ist.utl.pt";
        $user = "ist189559";
        $password = "abc";
        $dbname = $user;

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        <!-- $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); -->

        $sql = "SELECT * FROM anomalia;";

        $result = $db->prepare($sql);
        $result->execute();

      }
    ?>
  </body>
</html>