<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fin del proceso</title>
</head>
<body>
    <h1>La abuelita estaría orgullosa de nosotros</h1>
    <?php
        session_start();
        echo "<p>Hemos producido ".$_SESSION['prod']." (x".$_SESSION['prod_cant'].")</p>";
        echo "<a href=\"index.php\"><button type=\"submit\">Regresar a página principal</button></a>";

    ?>
</body>
</html>