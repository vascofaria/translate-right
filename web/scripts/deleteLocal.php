<html>
<head>
    <title>TR - Delete Local</title>
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

    <h1 class="m-badge"><span class="badge badge-secondary">Select the Local to delete:</span></h1>

    <?php
        if (isset($_POST['deleteLocal'])) {
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "DELETE FROM local_publico WHERE lp_longitude=:lp_longitude AND lp_latitude=:lp_latitude;";
                $result = $db->prepare($query);
                $result->bindValue(':lp_longitude',  $_POST['lp_longitude']);
                $result->bindValue(':lp_latitude',  $_POST['lp_latitude']);
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

          $sql = "SELECT lp_latitude, lp_longitude, lp_nome FROM local_publico;";
          $result = $db->prepare($sql);
          $result->execute();


          echo("<table class='table' style='margin-top: 60px;'>");
          echo("<thead class='thead-dark'>");
          echo("<tr>");
          echo("<th scope='col'>Latitude</th>");
          echo("<th scope='col'>Longitude</th>");
          echo("<th scope='col'>Nome</th>");
          echo("<th scope='col'>Delete</th>");
          echo("<tr/>");
          echo("<thead/>");
          echo("<tbody>");
            foreach($result as $row) {
              echo("<tr><form action='' method='POST'>");
              echo("<td><input type='readonly'   name='lp_latitude'    readonly style='border:none' value='"."{$row['lp_latitude']}"."'></td>");
              echo("<td><input type='readonly'   name='lp_longitude'   readonly style='border:none' value='"."{$row['lp_longitude']}" ."'></td>");
              echo("<td><input type='readonly'   name='lp_nome'      readonly style='border:none' value='"."{$row['lp_nome']}"   ."'></td>");
              echo("<td>
                  <button class='btn btn-danger m-submit-btn' type='submit' name='deleteLocal' >
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
