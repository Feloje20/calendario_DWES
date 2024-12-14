<?php
/**
* Proyecto de calendario v.Arrays.
* @autor = Jesús Ferrer López
* @date = 29/09/2024
* @ultima_modificación = 14/10/2024
*/

include "config/config.php";

// Si no se envía el formulario, asignamos la fecha actual a las variables.
if (isset($_POST['enviar'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
}   
else {
    $month = date('m');
    $year = date('Y');
}
// Por lo demás, creamos las variables pertinentes.
$day = date('d');
$monthName = $spanishMonths[$month];
$first_day_of_month = date('N', strtotime("$year-$month-01"));
$day_counter = 1;

// Usamos funciones para obtener los festivos.
$holidays = getHolidaysSpain($year);
$holidaysLocal = holidaysLocal($year);
$holidaysCommunity = holidaysCommunity($year);

// La función cal_days_in_month devuelve la cantidad de días del mes usando el calendario especificado.
$month_numdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

?>
<!-- VISTA -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario U3</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Calendario Jesús Ferrer López</h1>
    <form method="POST" action="calendario.php">
        <label for="month">Mes:</label>
        <input type="number" id="month" name="month" min="1" max="12" required>
        <label for="year">Año:</label>
        <input type="number" id="year" name="year" min="1970" max="2100" required>
        <button type="submit" name="enviar">Generar Calendario</button>
    </form>
    <div>
        <?php
            echo "<h2>$monthName de $year</h2>";
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>L</th>
                    <th>M</th>
                    <th>X</th>
                    <th>J</th>
                    <th>V</th>
                    <th>S</th>
                    <th>D</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Recorremos bucles para generar nuestro calendario.
                    for ($week = 0; $week < 6; $week++) {
                        echo "<tr>";
                        for ($day_of_week = 1; $day_of_week <= 7; $day_of_week++) {
                            if ($week == 0 && $day_of_week < $first_day_of_month || $day_counter > $month_numdays) {
                                echo "<td></td>";
                            } else {
                                // Nos aseguramos de que la fecha tenga 0's de ser necesario.
                                $formatted_date = sprintf('%04d-%02d-%02d', $year, $month, $day_counter);

                                // En función del día, marcamos el calendario de forma acorde.
                                $cell_class = '';
                                if ($day_counter == $day && $month == date('m') && $year == date('Y')) {
                                    $cell_class = ' class="today"';
                                } elseif ($day_of_week == 7) {
                                    $cell_class = ' class="domingo"';
                                } elseif (in_array($formatted_date, $holidays)) {
                                    $cell_class = ' class="nacionales"';
                                } elseif (in_array($formatted_date, $holidaysLocal)) {
                                    $cell_class = ' class="locales"';
                                } elseif (in_array($formatted_date, $holidaysCommunity)) {
                                    $cell_class = ' class="comunidad"';
                                }
                                echo "<td$cell_class>$day_counter</td>";
                                $day_counter++;
                            }
                        }
                        echo "</tr>";
                        if ($day_counter > $month_numdays) {
                            break;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="ver_codigo">
        <button type="button"><a href="https://github.com/Feloje20/calendario_DWES/blob/main/calendario.php">Ver código</a></button>
    </div>   
</body>
</html>