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
                
                $email=$_POST['email'];
                $PcNro=$_POST['PcNro'];
                $AId=$_POST['AId'];

                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $query = "UPDATE correcao SET pc_nro=:newPcNro WHERE u_email=:email AND pc_nro=:oldPcNro AND a_id=:AId;";
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
    		
                echo("<p>$aId</p>");
            	$sql = "SELECT correcao.u_email, correcao.pc_nro, correcao.a_id FROM correcao WHERE correcao.a_id=:aId;";

                $result = $db->prepare($sql);
                $result->execute(array($aId));


                echo("<table class='table'>");
                echo("<thead class='thead-dark'>");
                echo("<tr>");
                echo("<th scope='col'>Utilizador e-mail</th>");
                echo("<th scope='col'>Numero Proposta de Correcao</th>");
                echo("<th scope='col'>Anomalia ID</th>");
                echo("<th scope='col'>Select</th>");
                echo("<tr/>");
                echo("<thead/>");
                echo("<tbody>");
                  foreach($result as $row) {
                    echo("<tr><form action='' method='POST'>");
                    echo("<td><input type='readonly'   name='Email'    readonly style='border:none' value='"."{$row['u_email']}"."'></td>");
                    echo(    "<input type='readonly'       name='PcNro'                              value='"."{$row['pc_nro']}" ."'></td>");
                    echo("<td><input type='readonly'   name='AId'      readonly style='border:none' value='"."{$row['a_id']}"   ."'></td>");
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
        if (!isset($_POST['submit-anomalia'])) {
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