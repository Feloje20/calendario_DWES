<?php
/**
 * @author Jesús Ferrer López
 */

function getHolidaysSpain($year) {
    $holidays = [
        // Días festivos fijos (formato Y-m-d)
        "$year-01-01", // Año Nuevo
        "$year-01-06", // Epifanía del Señor
        "$year-05-01", // Día del Trabajo
        "$year-10-12", // Fiesta Nacional de España
        "$year-11-01", // Todos los Santos
        "$year-12-06", // Día de la Constitución
        "$year-12-08", // Inmaculada Concepción
        "$year-12-25", // Navidad
    ];

    return $holidays;
}

$spanishMonths = [
    1 => "Enero",
    2 => "Febrero",
    3 => "Marzo",
    4 => "Abril",
    5 => "Mayo",
    6 => "Junio",
    7 => "Julio",
    8 => "Agosto",
    9 => "Septiembre",
    10 => "Octubre",
    11 => "Noviembre",
    12 => "Diciembre",
];

// Cálcuclo de festivos locales movibles
function holidaysLocal ($year) {
    $holidaysLocal = [];

    $easterDate = date("Y-m-d", easter_date($year)); // Domingo de Resurrección
    $holidaysLocal[] = date("Y-m-d", strtotime("$easterDate -2 days")); // Viernes Santo
    $holidaysLocal[] = date("Y-m-d", strtotime("$easterDate -3 days")); // Jueves Santo (algunas comunidades)

    return $holidaysLocal;
}

function holidaysCommunity ($year) {
    $holidaysCommunity = [
        "$year-02-28" // Día de andalucía
    ];

    return $holidaysCommunity;
}


