<?php
    $con = mysqli_connect("localhost","root","","cookies");
    if ($con->connect_error){
    }
    else{
        $ingred = $_POST['namer'];
        if($ingred==""){
            $ingred="Extra";
        }
        $cant = $_POST['canty'];
        if($cant==""){
            $cant=0;
        }
        $sql_ver = "SELECT * FROM ingredients WHERE name = '$ingred'";
        $rest = $con->query($sql_ver);
        if($rest->num_rows==0){
            $sql_add = "INSERT INTO ingredients VALUES('$ingred','$cant','')";
            $res = $con->query($sql_add);
        }
        else{
            $row = $rest->fetch_assoc();
            $cantity = $row['numb']+$cant;
            $sql_upt = "UPDATE ingredients SET numb='$cantity' WHERE name='$ingred'";
            $res = $con->query($sql_upt);
        }
        $con->close();
    }
    header('Location: index.php');
?>