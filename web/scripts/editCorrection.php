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
                
                $Email=$_POST['Email'];
                $oldPcNro=$_POST['oldPcNro'];
                $newPcNro=$_POST['newPcNro'];
                $AId=$_POST['AId'];

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql = "UPDATE correcao SET pc_nro=$newPcNro WHERE u_email='$Email' AND pc_nro=$oldPcNro AND a_id=$AId;";

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
                echo("<td><input type='readonly'   name='Email'    style='border:none' value='"."{$row['u_email']}"."'></td>");
                echo("<td><input type='hidden'     name='oldPcNro'                     value='"."{$row['pc_nro']}" ."'>");
                echo(    "<input type='text'       name='newPcNro'                     value='"."{$row['pc_nro']}" ."'></td>");
                echo("<td><input type='readonly'   name='AId'      style='border:none' value='"."{$row['a_id']}"   ."'></td>");
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