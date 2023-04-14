<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cookie Factory</title>
</head>
<body>
    <h1 align="center">Amasador "La abuelita" e Inventario "La alacena"</h1>
    <div style="width:100%">
        <div style = "width:22%; float:left;">
            <h1 align = "center">Inventario</h1>
            <table style="border: 5px solid black;" align = "center">
                <thead>
                    <tr>
                        <th style ="padding-left:30px;padding-right:30px;border: 3px solid black;">Ingrediente</th>
                        <th style = "padding-left:12px;padding-right:12px;border: 3px solid black;">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $con = mysqli_connect("localhost","root","","cookies");
                        if ($con->connect_error){
                            echo"<p>connection failed</p>";
                        }
                        else{
                            $sql = "SELECT * FROM ingredients";
                            $result = $con->query($sql);
                            if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                                    echo"<tr><td style=\"border: 1px solid black;\">".$row["name"]."</td><td style=\"border: 1px solid black;\">".$row["numb"]."</td></tr>";
                                }
                            }
                            else{
                            }
                            $con->close();
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <h1 align = "center">Agregar Ingrediente</h1>
            <form action = "updIng.php" method = "POST">
                <table align = "center">
                    <tr>
                        <th style = "padding-left:50px;padding-right:50px">Ingrediente</th>
                        <th>Cantidad</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="namer" placeholder = "Ingrediente" size = "20"></td>
                        <td><input type="number" name="canty" placeholder = "0" min="0" style="width:70px"></td>
                    </tr>
                </table>
                <button type = "submit"style="display:block; margin: 0 auto;">Agregar Ingrediente</button>
                <br>
                <br>
            </form>
        </div>
        <div style = "width:78%; float:right;">
            <h1 align = "center">Fórmulas</h1>
            <table align = "center">
                <thead>
                    <tr>
                        <th style ="padding-left:70px;padding-right:70px;border: 5px solid black;">Producto</th>
                        <th style = "padding-left:150px;padding-right:500px;border: 5px solid black;">Ingredientes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $con = mysqli_connect("localhost","root","","cookies");
                        if ($con->connect_error){
                            echo"<p>connection failed</p>";
                        }
                        else{
                            $sql = "SELECT * FROM formulas";
                            $result = $con->query($sql);
                            if($result->num_rows>0){
                                $df = $con->query("SELECT name,identifier FROM ingredients");
                                $dfcheck = $df->fetch_all();
                                while($row = $result->fetch_assoc()){
                                    $receta = "";
                                    echo"<tr><td style=\"border: 1px solid black;\">".$row["Prod"]."</td>";
                                    $cosas = explode(",",$row["Receta"]);
                                    $cuantas = explode(",",$row["Volumen"]);
                                    $cicle = count($cosas)-1;
                                    for($i = 0; $i<$cicle; $i++){
                                        foreach($dfcheck as $fila){
                                            if($cosas[$i]==$fila[1]){
                                                break;
                                            }
                                        }
                                        $receta = $receta.$fila[0]." ".$cuantas[$i]." + ";
                                    }
                                    echo"<td style=\"border: 1px solid black;\">".substr($receta,0,-3)."</td>";
                                }
                            }
                            else{
                            }
                            $con->close();
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <div style = "width:60%; float:left;">
                <div style = "width:50%; float:left;">
                <h1>Editar fórmulas</h1>
                <form action="updFml.php" method="POST">
                    <input type = "text" placeholder = "Nombre de receta" name = "name" size = "35"><br>
                    <input type="text" placeholder = "Ingrediente 1" name = "I1" size="20"><input type="number" placeholder="0" min="0" name="I1n" style = "width:70px"><input type="checkbox" name="I1c"><br>
                    <input type="text" placeholder = "Ingrediente 2" name = "I2" size="20"><input type="number" placeholder="0" min="0" name="I2n" style = "width:70px"><input type="checkbox" name="I2c"><br>
                    <input type="text" placeholder = "Ingrediente 3" name = "I3" size="20"><input type="number" placeholder="0" min="0" name="I3n" style = "width:70px"><input type="checkbox" name="I3c"><br>
                    <input type="text" placeholder = "Ingrediente 4" name = "I4" size="20"><input type="number" placeholder="0" min="0" name="I4n" style = "width:70px"><input type="checkbox" name="I4c"><br>
                    <select name="type">
                        <option value="Add">Agregar/Actualizar</option>
                        <option value="Update">Completar</option>
                    </select>
                    <br>
                    <button type="submit">Submit</button>
                </form>
                </div>
                <div style = "width:50%; float:right;">
                <h1>
                    Eliminar Fórmula
                </h1>
                <form action="delFml.php" method = "GET">
                    <select name="elimina">
                        <?php
                            $con = mysqli_connect("localhost","root","","cookies");
                            $sql = "SELECT Prod FROM formulas";
                            if ($con->connect_error){
                                echo "<p>Algo salió mal, pero la neta no sé qué</p>";
                            }
                            else{
                                $res = $con->query($sql);
                                if($res->num_rows==0){
                                    echo "<p>Plankton se llevó las fórmulas...</p>";
                                }
                                else{
                                    while($productos = $res->fetch_assoc()){
                                        echo"<option value = \"".$productos["Prod"]."\">".$productos["Prod"]."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                    <button type="submit">Eliminar fórmula</button>
                </form>
                <h1>
                    Eliminar Ingrediente
                </h1>
                <form action="delIng.php" method = "GET">
                    <select name="eliminaIng">
                        <?php
                            $con = mysqli_connect("localhost","root","","cookies");
                            $sql = "SELECT name FROM ingredients";
                            if ($con->connect_error){
                                echo "<p>Algo salió mal, pero la neta no sé qué</p>";
                            }
                            else{
                                $res = $con->query($sql);
                                if($res->num_rows==0){
                                    echo "<p>Plankton se llevó las fórmulas...</p>";
                                }
                                else{
                                    while($productos = $res->fetch_assoc()){
                                        echo"<option value = \"".$productos["name"]."\">".$productos["name"]."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                    <button type="submit">Eliminar Ingrediente</button>
                </form>
                </div>
            </div>
            <div style = "width:40%; float:right;">
                <h1>Producir ...</h1>
                <form action="preprod.php" method="GET">
                    <select name="producing">
                    <?php
                        $con = mysqli_connect("localhost","root","","cookies");
                        $sql = "SELECT Prod FROM formulas";
                        if ($con->connect_error){
                            echo "<p>Algo salió mal, pero la neta no sé qué</p>";
                        }
                        else{
                            $res = $con->query($sql);
                            if($res->num_rows==0){
                                echo "<p>Plankton se llevó las fórmulas...</p>";
                            }
                            else{
                                while($productos = $res->fetch_assoc()){
                                    echo"<option value = \"".$productos["Prod"]."\">".$productos["Prod"]."</option>";
                                }
                            }
                        }
                    ?>
                    </select>
                    <input type="number" name="cant_cookies" placeholder = "0" min="0" style = "width:50px"><br>
                    <button type="submit">Cocinar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>