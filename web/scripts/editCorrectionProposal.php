<html>
<head>
  <title>TR - Edit Correction Proposal</title>
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
            if (isset($_COOKIE['userID'])) {
                try {
                    $host     = "db.ist.utl.pt";
                    $user     = "ist189559";
                    $password = "idxi1356";
                    $dbname   = $user;
                    
                    $pcNro=$_POST['PcNro'];
                    $dataHora=$_POST['DataHora'];
                    $texto=$_POST['Texto'];
                    $uEmail=$_POST['UEmail'];

                    $userToken=$_COOKIE['userID'];

                    if ($userToken == $uEmail){
                        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                        $query = "UPDATE proposta_correcao SET pc_texto=:texto WHERE pc_nro=:pcNro AND pc_data_hora=:dataHora AND u_email=:uEmail;";
                        $db->beginTransaction();
                        $result = $db->prepare($query);
                        $result->execute(array($texto, $pcNro, $dataHora, $uEmail));
                        $db->commit();

                        $db = null;
                    }else{
                        echo("<p>ERROR: No Permission</p>");
                    }
                }
                catch (PDOException $e) {
                    echo("<p>ERROR: {$e->getMessage()}</p>");
                }
            }else{
                echo("<p>ERROR: Please Login</p>");
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
		
        	$sql = "SELECT proposta_correcao.pc_nro, proposta_correcao.pc_data_hora,proposta_correcao.pc_texto,proposta_correcao.u_email FROM proposta_correcao;";

            $result = $db->prepare($sql);
            $result->execute();

            echo("<h1 class='m-badge'><span class='badge badge-secondary'>Edit your Correction Proposal:</span></h1>");

            echo("<table class='table' style='margin-top: 60px;'>");
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
                echo("<td><input type='readonly' name='PcNro'    readonly style='border:none'value='"."{$row['pc_nro']}"."'></td>");
                echo("<td><input type='readonly' name='DataHora' readonly style='border:none'value='"."{$row['pc_data_hora']}" ."'></td>");
                echo("<td><input type='text'     name='Texto'                       value='"."{$row['pc_texto']}"   ."'></td>");
                echo("<td><input type='readonly' name='UEmail'   readonly style='border:none'value='"."{$row['u_email']}"   ."'></td>");
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