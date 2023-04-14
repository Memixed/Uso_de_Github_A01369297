<?php
    $con = mysqli_connect("localhost","root","","cookies");
    if ($con->connect_error){
    }
    else{
        $deleted = $_GET['eliminaIng'];
        $sql = "DELETE FROM ingredients WHERE name='$deleted'";
        $res = $con->query($sql);
        if($res){
            echo "<p>El ingrediente ".$deleted." se ha eliminado del almacén</p>";
        }
        else{
            echo "<p>El ingrediente ".$deleted." se niega a morir, reintente más tarde...</p>";
        }
        $con->close();
    }
    echo "<a href=\"index.php\"><button type=\"submit\">Regresar a página principal</button></a>";
?>