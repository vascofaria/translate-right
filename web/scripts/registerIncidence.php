<html>
<head>
    <title>TR - Register Incidence</title>
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
                    
                    $u_email=$_COOKIE['userID'];
                    $a_id=$_POST['aId'];
                    $i_id=$_POST['iId'];

                    //$userToken=$_COOKIE['userID'];

                    //if ($userToken == $email){
                        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                        $query = "INSERT INTO incidencia(a_id, i_id, u_email) VALUES (:a_id, :i_id, :u_email);";
                        $db->beginTransaction();
                        $result = $db->prepare($query);
                        $result->execute(array($a_id, $i_id, $u_email));
                        $db->commit();

                        echo("<div class='alert alert-success' role='alert'>Registed Sucessfully!</div>");

                        $db = null;
                    //}else{
                    //    echo("<p>ERROR: No Permission</p>");
                    //}
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
        
              $sql = "SELECT item.i_id, item.i_descricao, item.i_localizacao, item.lp_latitude, item.lp_longitude FROM item ;";

                $result = $db->prepare($sql);
                $result->execute();

                echo("<h1 class='m-badge'><span class='badge badge-secondary'>Select an item for the incidence:</span></h1>");

                echo("<table class='table' style='margin-top: 60px;'>");
                echo("<thead class='thead-dark'>");
                echo("<tr>");
                echo("<th scope='col'>Item ID</th>");
                echo("<th scope='col'>Descricao</th>");
                echo("<th scope='col'>Localizacao</th>");
                echo("<th scope='col'>Latitude</th>");
                echo("<th scope='col'>Longitude</th>");
                echo("<th scope='col'>Select</th>");
                echo("<thead/>");
                echo("<tr/>");
                echo("<tbody>");
                  foreach($result as $row) {
                    echo("<tr><form action='' method='POST'>");
                    echo("<td><input type='hidden' name='aId'  readonly style='border:none' value='"."{$aId}"."'>");
                    echo("<input type='readonly' name='iId'  readonly style='border:none' value='"."{$row['i_id']}"."'></td>");
                    echo("<td><input type='readonly' name='iDescricao' readonly style='border:none' value='"."{$row['i_descricao']}"."'></td>");
                    echo("<td><input type='readonly' name='iLocalizacao'  readonly style='border:none' value='"."{$row['i_localizacao']}"."'></td>");
                    echo("<td><input type='readonly' name='iLatitude' readonly style='border:none' value='"."{$row['lp_latitude']}" ."'></td>");
                    echo("<td><input type='readonly' name='iLongitude' readonly style='border:none' value='"."{$row['lp_longitude']}" ."'></td>");
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

                echo("<h1 class='m-badge'><span class='badge badge-secondary'>Select an anomalia for the incidence:</span></h1>");

                echo("<table class='table' style='margin-top: 60px;'>");
                echo("<thead class='thead-dark'>");
                echo("<tr>");
                echo("<th scope='col'>Anomaly ID</th>");
                echo("<th scope='col'>Description</th>");
                echo("<th scope='col'>Select</th>");
                echo("<tr/>");
                echo("<thead/>");
                echo("<tbody>");
                  foreach($result as $row) {
                    echo("<tr><form action='' method='POST'>");
                    echo("<td><input type='readonly' readonly name='aId'  style='border:none' value='"."{$row['a_id']}"."'></td>");
                    echo("<td><input type='readonly' readonly name='aDescricao' style='border:none' value='"."{$row['a_descricao']}" ."'>");
                    echo("<td>
                        <button class='btn btn-primary m-submit-btn' type='submit' name='submit-anomalia' >
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


</body>
</html>