<html>
<head>
    <title>TR - Delete Item</title>
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

    <h1 class="m-badge"><span class="badge badge-secondary">Select an item to delete:</span></h1>

    <?php
      //if (isset($_COOKIE['userID'])) {
      //  echo("<p>{$_COOKIE['userID']}</p>");
      //}
      try {
        $host = "db.ist.utl.pt";
        $user = "ist189559";
        $password = "idxi1356";
        $dbname = $user;

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM item;";
        $result = $db->prepare($query);
        $result->execute();

        echo("<table style='margin-top: 60px;' id='items-list' class='table'>");
          echo("<thead class='thead-dark'>");
            echo("<tr>");
              echo("<th scope='col'>Descrição</th>");
              echo("<th scope='col'>Localização</th>");
              echo("<th scope='col'>Latitude</th>");
              echo("<th scope='col'>Longitude</th>");
              echo("<th scope='col'>Delete</th>");
            echo("<tr/>");
          echo("<thead/>");
          echo("<tbody>");
            foreach($result as $row) {
              echo("<tr>");
              echo("<td>{$row['i_descricao']}</td>");
              echo("<td>{$row['i_localizacao']}</td>");
              echo("<td>{$row['lp_latitude']}</td>");
              echo("<td>{$row['lp_longitude']}</td>");
              echo("<td><form class='form-inline my-2 my-lg-0' action='../index.html'>
              <button class='btn btn-danger my-2 my-sm-0' type='submit'>Delete</button>
            </form></td>");
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
