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
                
                $PcNro=$_POST['PcNro'];
                $DataHora=$_POST['DataHora'];
                $Texto=$_POST['Texto'];
                $UEmail=$_POST['UEmail'];


                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql = "UPDATE proposta_correcao SET pc_texto='$Texto' WHERE pc_nro=$PcNro AND pc_data_hora='$DataHora' AND u_email='$UEmail';";

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
		
        	$sql = "SELECT * FROM proposta_correcao;";

            $result = $db->prepare($sql);
            $result->execute();


            echo("<table class='table'>");
            echo("<thead class='thead-dark'>");
            echo("<tr>");
            echo("<th scope='col'>Numero Proposta de Correcao</th>");
            echo("<th scope='col'>Data da proposta</th>");
            echo("<th scope='col'>Texto</th>");
            echo("<th scope='col'>Utilizador e-mail</th>");
            echo("<th scope='col'>Editar</th>");
            echo("<tr/>");
            echo("<thead/>");
            echo("<tbody>");
              foreach($result as $row) {
                echo("<tr><form action='' method='POST'>");
                echo("<td><input type='readonly' name='PcNro'    value='"."{$row['pc_nro']}"."'></td>");
                echo("<td><input type='readonly' name='DataHora' value='"."{$row['pc_data_hora']}" ."'></td>");
                echo("<td><input type='text'     name='Texto'     value='"."{$row['pc_texto']}"   ."'></td>");
                echo("<td><input type='readonly' name='UEmail'   value='"."{$row['u_email']}"   ."'></td>");
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