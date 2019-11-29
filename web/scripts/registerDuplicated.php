<html>
<head>
    <title>TR - Register Duplicated</title>
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
        if (isset($_POST['submit-item2'])) {
            if (isset($_COOKIE['userID'])) {
                try {

                    $host     = "db.ist.utl.pt";
                    $user     = "ist189559";
                    $password = "idxi1356";
                    $dbname   = $user;
                    
                    $i_id2=$_POST['iId2'];
                    $i_id1=$_POST['iId1'];

                    //$userToken=$_COOKIE['userID'];

                    //if ($userToken == $email){
                        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                        $query = "INSERT INTO duplicado(i_id1, i_id2) VALUES (:i_id1, :i_id2);";
                        $db->beginTransaction();
                        $result = $db->prepare($query);
                        $result->execute(array($i_id1, $i_id2));
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
        if (isset($_POST['submit-item1'])) {
        try {
          $host     = "db.ist.utl.pt";
              $user     = "ist189559";
              $password = "idxi1356";
              $dbname   = $user;
        
                $iId1=$_POST['iId1'];

              $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
              $sql =  "SELECT item.i_id, item.i_descricao, item.i_localizacao, item.lp_latitude, item.lp_longitude FROM item WHERE item.i_id>:iId1;";

                $result = $db->prepare($sql);
                $result->execute(array($iId1));

                echo("<h1 class='m-badge'><span class='badge badge-secondary'>Choose the item whose other is duplicated</span></h1>");

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
                    echo("<td><input type='hidden' name='iId1'  readonly style='border:none' value='"."{$iId1}"."'>");
                    echo("<input type='readonly' name='iId2'  readonly style='border:none' value='"."{$row['i_id']}"."'></td>");
                    echo("<td><input type='readonly' name='iDescricao' readonly style='border:none' value='"."{$row['i_descricao']}"."'></td>");
                    echo("<td><input type='readonly' name='iLocalizacao'  readonly style='border:none' value='"."{$row['i_localizacao']}"."'></td>");
                    echo("<td><input type='readonly' name='iLatitude' readonly style='border:none' value='"."{$row['lp_latitude']}" ."'></td>");
                    echo("<td><input type='readonly' name='iLongitude' readonly style='border:none' value='"."{$row['lp_longitude']}" ."'></td>");
                    echo("<td>
                        <button class='btn btn-primary m-submit-btn' type='submit' name='submit-item2' >
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
        if (!isset($_POST['submit-item1'])) {
            try {
                $host     = "db.ist.utl.pt";
                $user     = "ist189559";
                $password = "idxi1356";
                $dbname   = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql =  "SELECT item.i_id, item.i_descricao, item.i_localizacao, item.lp_latitude, item.lp_longitude FROM item ;";

                $result = $db->prepare($sql);
                $result->execute();

                echo("<h1 class='m-badge'><span class='badge badge-secondary'>Select the item that is duplicated:</span></h1>");

                echo("<table class='table'>");
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
                    echo("<td><input type='readonly' name='iId1'  readonly style='border:none' value='"."{$row['i_id']}"."'></td>");
                    echo("<td><input type='readonly' name='iDescricao' readonly style='border:none' value='"."{$row['i_descricao']}"."'></td>");
                    echo("<td><input type='readonly' name='iLocalizacao'  readonly style='border:none' value='"."{$row['i_localizacao']}"."'></td>");
                    echo("<td><input type='readonly' name='iLatitude' readonly style='border:none' value='"."{$row['lp_latitude']}" ."'></td>");
                    echo("<td><input type='readonly' name='iLongitude' readonly style='border:none' value='"."{$row['lp_longitude']}" ."'></td>");
                    echo("<td>
                        <button class='btn btn-primary m-submit-btn' type='submit' name='submit-item1' >
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