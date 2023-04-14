<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Horneando</title>
</head>
<body>
<h1>Cocinando con el amor de abuelita...</h1>
    <?php
        session_start();
        if($_SESSION['Two'] < 10){
            echo "<p>Please stand by ... </p>";
            sleep(1);
            $_SESSION['Two']++;
            header("Refresh:0");
        }
        else{
            echo "<p>Todo listo</p>";
            echo "<a href=\"fin.php\"><button type=\"submit\">Terminar</button></a>";
        }
    ?>
</body>
</html>