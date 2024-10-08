<?php
    /**
    * Sumar los tres primeros números pares.
    * @autor = Jesús Ferrer López
    * @date = 29/09/2024
    */

    // Adquirimos la fecha de nuestro dispositivo y la asignamos en una variable.
    $today_date = new DateTime();

    /* Obtenemos la hora y mes del año y los asignamos a variables junto a un cambio
    de tipos a entero. Es posible asignar valores enteros a mano.*/

    $year = $today_date->format('Y');
    settype($hour, "integer");
    $month = $today_date->format('m');
    settype($month, "integer");
    $month_str = $today_date->format('F'); // String del mes para la presentación del calendario.
    $day = $today_date->format('d');

    // La función cal_days_in_month devuelve la cantidad de días del mes usando el calendario especificado.
    $month_numdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Array que guarda los días festivos
    $diasFestivos = [
        "1-1", //año nuevo
        "1-6", //Epifanía del señor
        "5-1", //Día del trabajador
        "8-15", //Asunción de la virgen
        "9-2", //Día de prueba para ej
        "9-27", //Día de prueba para ej
        "1-12", //Día de la hispanidad
        "11-1", //Día de todos los santos
        "12-6", //Día de la constitución
        "12-8", //Día de la inmaculada
        "12-25" // Navidad
    ];

    // Averiguamos el día de la semana usando la función date y strtotime
    $fecha = "$year-$month-01";
    $dia_semana_inicial = date("l", strtotime($fecha));

    // Creamos un array que guarde los días de la semana para usar su valor por índice.
    $dias_semana = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

    // asignamos el valor del día de la semana inicial del mes en una variable para darle uso más adelante.
    $dia_semana_inicial_valor = (array_search($dia_semana_inicial, $dias_semana));

    // Contadores para ayudar con la creación del calendario en los bucles.
    $contador_dias = 1;
    $contador_relleno = $dia_semana_inicial_valor;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario U3</title>
    <style>
        .ver_codigo {
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div>
    <?php
        echo "<h2>$month_str de $year</h2>"
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
                // Bucle que funcionará en función de cuantas lineas vaya a tener nuestro mes en el calendario.
                for ($i = 0; $i <= intdiv($dia_semana_inicial_valor + $month_numdays, 7); $i++) {
                    echo "<tr>";
                    // Bucle que recorre cada linea del calendario
                    for ($j = 0; $j <= 6; $j++) {
                        // Relleno de X para los días que no pertenecen a nuestro mes
                        if ($contador_relleno > 0) {
                            echo "<td>X</td>";
                            $contador_relleno -= 1;
                        }
                        // Si quedan días en nuestro mes, pondremos números y colores de ser necesario.
                        elseif ($contador_dias <= $month_numdays) {
                            if ($contador_dias == $day) {
                                echo "<td><div style='background-color: green;'>$contador_dias</div></td>";
                            }
                            elseif (in_array("$month-$contador_dias", $diasFestivos)) {
                                echo "<td><div style='background-color: red;'>$contador_dias</div></td>";
                            }
                            elseif ((($dia_semana_inicial_valor + $contador_dias)%7) == 0) {
                                echo "<td><div style='background-color: red;'>$contador_dias</div></td>";
                            }
                            else {
                                echo "<td>$contador_dias</td>";
                            }
                            $contador_dias += 1;
                        }
                        // Si no, rellenamos con más X porque son días del siguientes mes. 
                        else {
                            echo "<td>X</td>";
                        }
                        };
                    }
                    echo "</tr>";
                ?>
            </tbody>
        </table>
    </div>
    <div class="ver_codigo">
        <button type="button"><a href="https://github.com/Feloje20/calendario_DWES/blob/main/calendario.php">Ver código</a></button>
    </div>   
</body>
</html>