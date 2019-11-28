<html>
<head>
    <title>TR - Delete Correction</title>
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

  
    <?php
        if (isset($_POST['deleteCorrection'])) {
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;
                
                $email=$_POST['email'];
                $pc_nro=$_POST['pc_nro'];


                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
                $query = "DELETE FROM item WHERE u_email=:email AND pc_nro=:pc_nro;";
                $result = $db->prepare($query);
                $result->bindValue(':email',  $_POST['email']);
                $result->bindValue(':pc_nro',  $_POST['pc_nro']);
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
		
          $sql = "SELECT * FROM correcao where u_email=:email;";
          $result = $db->prepare($sql);
          $result->bindValue(':email', $_COOKIE['user']);
          $result->execute();


          echo("<table class='table'>");
          echo("<thead class='thead-dark'>");
          echo("<tr>");
          echo("<th scope='col'>Email</th>");
          echo("<th scope='col'>Correction Proposal Number</th>");
          echo("<th scope='col'>Anomalia ID</th>");
          echo("<th scope='col'>Delete</th>");
          echo("<tr/>");
          echo("<thead/>");
          echo("<tbody>");
            foreach($result as $row) {
              echo("<tr><form action='' method='POST'>");
              echo("<td><input type='readonly'   name='Email'    readonly style='border:none' value='"."{$row['u_email']}"."'></td>");
              echo(    "<input type='text'       name='pc_nro'                              value='"."{$row['pc_nro']}" ."'></td>");
              echo("<td><input type='readonly'   name='AId'      readonly style='border:none' value='"."{$row['a_id']}"   ."'></td>");
              echo("<td>
                  <button class='btn btn-danger m-submit-btn' type='submit' name='deleteCorrection' >
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