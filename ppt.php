<!DOCTYPE html>
<html>
<head>
    <title>Piedra, papel o tijera</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div id="container">
    <h2>Piedra, papel o tijera</h2>

    <?php
    session_start();
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }

    function generarJugadaComputadora() {
        $opciones = array("piedra", "papel", "tijera");
        return $opciones[array_rand($opciones)];
    }

    if (isset($_POST['jugada'])) {
        $jugadaUsuario = strtolower($_POST['jugada']);
        $jugadaComputadora = generarJugadaComputadora();

        echo "<p>Tu jugada: $jugadaUsuario</p>";
        echo "<p>Jugada de la computadora: $jugadaComputadora</p>";

        if ($jugadaUsuario == $jugadaComputadora) {
            echo "<p id='result' class='fadeIn'>¡Empate!</p>";
        } elseif (($jugadaUsuario == 'piedra' && $jugadaComputadora == 'tijera') ||
                  ($jugadaUsuario == 'papel' && $jugadaComputadora == 'piedra') ||
                  ($jugadaUsuario == 'tijera' && $jugadaComputadora == 'papel')) {
            echo "<p id='result' class='fadeIn'>¡Ganaste!</p>";
            $_SESSION['score'] = max(0, $_SESSION['score'] + 1);
        } else {
            echo "<p id='result' class='fadeIn'>¡La computadora gana!</p>";
            $_SESSION['score'] = 0; 
        }
    }

    if (isset($_POST['restaurar'])) {
        $_SESSION['score'] = 0;
    }
    ?>

    <div id="score">
        <p>Puntuación: <?php echo $_SESSION['score']; ?></p>
        <form method="post">
            <button type="submit" name="restaurar" class="reset-button">Restaurar puntuación</button>
        </form>
    </div>

    <form method="post">
        <label for="jugada">Elige tu jugada:</label>
        <select id="jugada" name="jugada">
            <option value="piedra">Piedra</option>
            <option value="papel">Papel</option>
            <option value="tijera">Tijera</option>
        </select>
        <br><br>
        <button type="submit">Jugar</button>
    </form>
</div>

</body>
</html>