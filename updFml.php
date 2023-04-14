<?php
$con = mysqli_connect("localhost","root","","cookies");
$cosas = "";
$numero = "";
if ($con->connect_error){
}
else{
    $producto = $_POST['name'];
    $error = "";
    if (isset($_POST['I1c'])){
        $ingred1 = $_POST['I1'];
        $cant1 = $_POST['I1n'];
        if($ingred1==""){
            $ingred1="Extra";
        }
        if($cant1==""){
            $cant=0;
        }
        $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
        $rest = $con->query($sql_ver);
        if($rest->num_rows==0){
            $sql_add = "INSERT INTO ingredients VALUES('$ingred1','0','')";
            $res = $con->query($sql_add);
            $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
            $rest = $con->query($sql_ver);
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        else{
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        $cosas = $cosas.$id.",";
        $numero = $numero.$cant1.",";
    }
    if (isset($_POST['I2c'])){
        $ingred1 = $_POST['I2'];
        $cant1 = $_POST['I2n'];
        if($ingred1==""){
            $ingred1="Extra";
        }
        if($cant1==""){
            $cant=0;
        }
        $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
        $rest = $con->query($sql_ver);
        if($rest->num_rows==0){
            $sql_add = "INSERT INTO ingredients VALUES('$ingred1','0','')";
            $res = $con->query($sql_add);
            $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
            $rest = $con->query($sql_ver);
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        else{
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        $cosas = $cosas.$id.",";
        $numero = $numero.$cant1.",";
    }
    if (isset($_POST['I3c'])){
        $ingred1 = $_POST['I3'];
        $cant1 = $_POST['I3n'];
        if($ingred1==""){
            $ingred1="Extra";
        }
        if($cant1==""){
            $cant=0;
        }
        $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
        $rest = $con->query($sql_ver);
        if($rest->num_rows==0){
            $sql_add = "INSERT INTO ingredients VALUES('$ingred1','0','')";
            $res = $con->query($sql_add);
            $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
            $rest = $con->query($sql_ver);
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        else{
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        $cosas = $cosas.$id.",";
        $numero = $numero.$cant1.",";
    }
    if (isset($_POST['I4c'])){
        $ingred1 = $_POST['I4'];
        $cant1 = $_POST['I4n'];
        if($ingred1==""){
            $ingred1="Extra";
        }
        if($cant1==""){
            $cant=0;
        }
        $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
        $rest = $con->query($sql_ver);
        if($rest->num_rows==0){
            $sql_add = "INSERT INTO ingredients VALUES('$ingred1','0','')";
            $res = $con->query($sql_add);
            $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred1'";
            $rest = $con->query($sql_ver);
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        else{
            $row = $rest->fetch_assoc();
            $id = $row['identifier'];
        }
        $cosas = $cosas.$id.",";
        $numero = $numero.$cant1.",";
    }
    if ($_POST['type']=="Add") {
        $sql_find = "SELECT * FROM formulas WHERE Prod='$producto'";
        $res = $con->query($sql_find);
        if($res->num_rows==0){
            $sql_exe = "INSERT INTO formulas VALUES('$producto','$cosas','$numero')";
            echo "<h1>Se ha agragado la receta de ".$producto."</h1>";
        }
        else{
            $sql_exe = "UPDATE formulas SET Receta='$cosas',Volumen='$numero' WHERE Prod='$producto'";
            echo "<h1>Se ha actualizado la receta de ".$producto."</h1>";
        }
        $res = $con->query($sql_exe);
    } 
    else if ($_POST['type']=="Update") {
        $sql_find = "SELECT * FROM formulas WHERE Prod='$producto'";
        $res = $con->query($sql_find);
        if($res->num_rows==0){
            $sql_exe = "INSERT INTO formulas VALUES('$producto','$cosas','$numero')";
            echo "<h1>Se ha agragado la receta de ".$producto."</h1>";
        }
        else{
            $row = $res->fetch_assoc();
            $cosones = $row['Receta'];
            $cosones = $cosones.$cosas;
            $cantidades = $row['Volumen'];
            $cantidades = $cantidades.$numero;
            $sql_exe = "UPDATE formulas SET Receta='$cosones',Volumen='$cantidades' WHERE Prod='$producto'";
            echo "<h1>Se ha completado la receta de ".$producto."</h1>";
        }
        $res = $con->query($sql_exe);
    }
    $con->close();
}
echo "<a href=\"index.php\"><button type=\"submit\">Regresar a página principal</button></a>";
?>