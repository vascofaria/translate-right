<html>
<head>
	<link rel="stylesheet" type="text/css" href="../modules/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../modules/mylib/css/general.css">
</head>

<body>
    <?php
        if (isset($_POST['submit-edit'])) {
            try {

                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;
                
                $oldEmail=$_POST['oldEmail'];
                $oldPcNro=$_POST['oldPcNro'];
                $oldAId=$_POST['oldAId'];
                $newEmail=$_POST['newEmail'];
                $newPcNro=$_POST['newPcNro'];
                $newAId=$_POST['newAId'];

                echo('$oldAId');
                echo('$newAId');


                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql = "UPDATE correcao SET u_email=$newEmail, pc_nro=$newPcNro, a_id=$newAId WHERE u_email='$oldEmail' AND pc_nro='$oldPcNro' AND a_id='$oldAId';";

                $result = $db->prepare($sql);
                $result->execute();


                $db = null;
            }
            catch (PDOException $e) {
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
		
        	$sql = "SELECT * FROM correcao;";

            $result = $db->prepare($sql);
            $result->execute();


            echo("<table class='table'>");
            echo("<thead class='thead-dark'>");
              echo("<tr>");
                echo("<th scope='col'>Utilizador e-mail</th>");
                echo("<th scope='col'>Numero Proposta de Correcao</th>");
                echo("<th scope='col'>Anomalia ID</th>");
                echo("<th scope='col'>Editar</th>");
              echo("<tr/>");
            echo("<thead/>");
            echo("<tbody>");
              foreach($result as $row) {
                echo("<tr><form action='' method='POST'>");
                echo("<td><input type='hidden' name='oldEmail' value='"."{$row['u_email']}"."'>");
                echo(    "<input type='text'   name='newEmail' value='"."{$row['u_email']}"."'></td>");
                echo("<td><input type='hidden' name='oldPcNro' value='"."{$row['pc_nro']}" ."'>");
                echo(    "<input type='text'   name='newPcNro' value='"."{$row['pc_nro']}" ."'></td>");
                echo("<td><input type='hidden' name='oldAId'   value='"."{$row['a_id']}"   ."'>");
                echo(    "<input type='text'   name='newAId'   value='"."{$row['a_id']}"   ."'></td>");
                echo("<td>
                    <button class='btn btn-primary m-submit-btn' type='submit' name='submit-edit' >
                        Edit
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