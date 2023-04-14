<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Producción</title>
</head>
<body>
    <?php
        error_reporting(0);
        session_start();
        $_SESSION['Two'] = 0;
        $it = $_SESSION['One'];
        echo "<h1> Produciendo ".$_SESSION['prod']." (x".$_SESSION['prod_cant'].")</h1>";
        $cantidades = $_SESSION['requested'];
        $cosas = $_SESSION['ingred'];
        if($_SESSION['Prod_Line']==""){
            $_SESSION['Prod_Line'] = $_SESSION['Prod_Line']."Se agregaron ".$cantidades[$it]." de ".$cosas[$it];
            $_SESSION['One'] = $_SESSION['One']+1; 
            header("Refresh:0");
        }
        else{
            echo "<p>".$_SESSION['Prod_Line']."</p>";
            if($_SESSION['One'] < $_SESSION['cant']){
                $_SESSION['Prod_Line'] = $_SESSION['Prod_Line']."<br>Se agregaron ".$cantidades[$it]." de ".$cosas[$it];
                $_SESSION['One'] = $it +1; 
                sleep($cantidades[$it]);
                header("Refresh:0");
            }
            else{
                echo"<p><br> Se agregó el Agua necesaria</p>";
                sleep($_SESSION['prod_cant']);
                $_SESSION['Two'] = 1;
                echo "<a href=\"amasado.php\"><button type=\"submit\">Iniciar Amasado</button></a>";
            }
        }
    ?>
</body>
</html>