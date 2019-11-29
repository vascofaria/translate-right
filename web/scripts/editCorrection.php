<html>
<head>
  <title>TR - Edit Correction</title>
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
        if (isset($_POST['submit-edit'])) {
            try {

                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;
                
                $email=$_POST['e-mail'];
                $pcNro=$_POST['pcNro'];
                $data=$_POST['data'];
                $texto=$_POST['texto'];
                $aId=$_POST['aId'];

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $query = "UPDATE correcao SET a_id=:aId WHERE u_email=:email AND pc_nro=:pcNro;";
                $db->beginTransaction();
                $result = $db->prepare($query);
                $result->execute(array($newPcNro, $email, $oldPcNro, $AId));
                $db->commit();

                $db = null;
            }
            catch (PDOException $e) {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }
    ?>
	<?php
        if (isset($_POST['submit-anomalia'])) {
    		try {
    			$host     = "db.ist.utl.pt";
           		$user     = "ist189559";
            	$password = "idxi1356";
            	$dbname   = $user;
    		
                $aId=$_POST['aId'];
                $aDescricao=$_POST['aDescricao'];

            	$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		
            	$sql = "SELECT proposta_correcao.pc_nro, proposta_correcao.pc_data_hora, proposta_correcao.pc_texto, proposta_correcao.u_email FROM proposta_correcao ;";

                $result = $db->prepare($sql);
                $result->execute();


                echo("<table class='table'>");
                echo("<thead class='thead-dark'>");
                echo("<tr>");
                echo("<th scope='col'>Numero Proposta de Correcao</th>");
                echo("<th scope='col'>Data</th>");
                echo("<th scope='col'>Texto</th>");
                echo("<th scope='col'>Utilizador e-mail</th>");
                echo("<th scope='col'>Select</th>");
                echo("<thead/>");
                echo("<tr/>");
                echo("<tbody>");
                  foreach($result as $row) {
                    echo("<tr><form action='' method='POST'>");
                    echo("<td><input type='hidden' name='aId'  readonly style='border:none' value='"."{$aId}"."'>");
                    echo("<input type='readonly' name='pcNro'  readonly style='border:none' value='"."{$row['pc_nro']}"."'></td>");
                    echo(    "<input type='readonly' name='data'   readonly style='border:none' value='"."{$row['pc_data_hora']}" ."'></td>");
                    echo("<td><input type='readonly' name='texto'  readonly style='border:none' value='"."{$row['pc_texto']}"   ."'></td>");
                    echo("<td><input type='readonly' name='e-mail' readonly style='border:none' value='"."{$row['u_email']}"   ."'></td>");
                    echo("<td>
                        <button class='btn btn-primary m-submit-btn' type='submit' name='submit-edit' >
                            Select
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
        }
	?>
    <?php
        if (!isset($_POST['submit-anomalia']) AND !isset($_POST['submit-edit'])) {
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql = "SELECT anomalia.a_id, anomalia.a_descricao FROM anomalia;";

                $result = $db->prepare($sql);
                $result->execute();


                echo("<table class='table'>");
                echo("<thead class='thead-dark'>");
                echo("<tr>");
                echo("<th scope='col'>Anomalia ID</th>");
                echo("<th scope='col'>Descricao</th>");
                echo("<th scope='col'>Edit</th>");
                echo("<tr/>");
                echo("<thead/>");
                echo("<tbody>");
                  foreach($result as $row) {
                    echo("<tr><form action='' method='POST'>");
                    echo("<td><input type='readonly' name='aId'  style='border:none' value='"."{$row['a_id']}"."'></td>");
                    echo("<td><input type='readonly' name='aDescricao' style='border:none' value='"."{$row['a_descricao']}" ."'>");
                    echo("<td>
                        <button class='btn btn-primary m-submit-btn' type='submit' name='submit-anomalia' >
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
        }
    ?>
</body>

</html>