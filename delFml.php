<?php
    $con = mysqli_connect("localhost","root","","cookies");
    if ($con->connect_error){
    }
    else{
        $deleted = $_GET['elimina'];
        $sql = "DELETE FROM formulas WHERE Prod='$deleted'";
        $res = $con->query($sql);
        if($res){
            echo "<p>La fórmula ".$deleted." se ha eliminado correctamente</p>";
        }
        else{
            echo "<p>La fórmula ".$deleted." se niega a morir, reintente más tarde...</p>";
        }
        $con->close();
    }
    echo "<a href=\"index.php\"><button type=\"submit\">Regresar a página principal</button></a>";
?>