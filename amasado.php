<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Amasando</title>
</head>
<body>
    <h1>Amasando...</h1>
    <?php
        session_start();
        if($_SESSION['Two'] < 5){
            echo "<p>Please stand by ... </p>";
            sleep(1);
            $_SESSION['Two']++;
            header("Refresh:0");
        }
        else{
            echo "<p>Todo listo</p>";
            echo "<a href=\"horneando.php\"><button type=\"submit\">Iniciar horneado</button></a>";
        }
    ?>
</body>
</html>