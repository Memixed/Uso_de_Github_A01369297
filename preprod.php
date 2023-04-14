<?php
    $con = mysqli_connect("localhost","root","","cookies");
    $prod = $_GET['producing'];
    $factor = intval($_GET['cant_cookies']);
    $sql_1 = "SELECT * FROM formulas WHERE Prod='$prod'";
    $res = $con->query($sql_1);
    if($res->num_rows==0){
        echo "<h3>Parece que no existe la fórmula</h3>";
    }
    else{
        $error = "";
        $row = $res->fetch_assoc();
        $keys = explode(",",$row['Receta']);
        $wholes = explode(",",$row['Volumen']);
        foreach($wholes as &$it){
            $it = intval($it);
            $it = $it*$factor;
        }
        array_pop($wholes);
        array_pop($keys);
        $sql_ing = "SELECT * FROM ingredients";
        $df = $con->query($sql_ing);
        $names = [];
        $existente = [];
        $ids = [];
        while($it = $df->fetch_assoc()){
            array_push($names,$it["name"]);
            array_push($existente,$it["numb"]);
            array_push($ids,$it["identifier"]);
        }
        $repeat = count($keys);
        $len = count($ids);
        $overs = [];
        $prods = [];
        for($i = 0; $i<$repeat; $i++){
            for($j = 0;$j < $len; $j++){
                if($keys[$i] == $ids[$j]){
                    $over = intval($existente[$j]) - intval($wholes[$i]);
                    array_push($overs,$over);
                    array_push($prods,$names[$j]);
                    if($over < 0){
                        $error = $error."<br>Hace falta ".strval(intval($wholes[$i])-intval($existente[$j]))." unidades de ".$names[$j];
                    }
                    break;
                }
            }
        }
    }
    $con->close();
    if (strlen($error) != 0){
        echo "<p>".$error."</p>";
        echo "<a href=\"index.php\"><button type=\"submit\">Regresar a página principal</button></a>";
    }
    else{
        $con = mysqli_connect("localhost","root","","cookies");
        for($i = 0;$i<$repeat;$i++){
            $new_cant = $overs[$i];
            $id_changer = $keys[$i];
            $sql = "UPDATE ingredients SET numb='$new_cant' WHERE identifier='$id_changer'";
            $res = $con->query($sql);
        }
        $con->close();
        session_start();
        $_SESSION['prod'] = $prod;
        $_SESSION['ingred_key'] = $keys;
        $_SESSION['ingred'] = $prods;
        $_SESSION['new_ord'] = $overs;
        $_SESSION['requested'] = $wholes;
        $_SESSION['cant'] = $repeat;
        $_SESSION['prod_cant'] = $factor;
        $_SESSION['One'] = 0;
        $_SESSION['Prod_Line'] = "";
        header('Location: produccion.php');
    }
?>