<?php
mb_internal_encoding("UTF-8");

// Inicialización de variables y funciones auxiliares
$num_saltadores = rand(4, 8); // Número de participantes aleatorio entre 4 y 8
$saltadores = array();

// Función para generar puntuaciones aleatorias
function generarPuntuaciones() {
    $puntuaciones = array();
    for ($i = 0; $i < 5; $i++) {
        // Genera puntuaciones en múltiplos de 0.5 (0 a 10)
        $puntuaciones[] = round(rand(0, 20) / 2, 1);
    }
    return $puntuaciones;
}

// Función para calcular la puntuación de un salto (quitando la más alta y la más baja)
function calcularPuntuacionSalto($puntuaciones) {
    sort($puntuaciones); // Ordena para descartar extremos
    return array_sum(array_slice($puntuaciones, 1, -1)); // Suma intermedios
}

// Arrays de datos base para nombres y federaciones
$nombres = ['Raúl', 'Luis', 'Miguel', 'Antonio', 'Javier', 'David', 'José', 'Manuel', 'Luis Mariano', 'Víctor', 'Enrique', 'Sergio'];
$apellidos = ['Capablanca', 'Blanco', 'Rodríguez', 'Fernández', 'López', 'Martínez', 'Pérez', 'Sánchez', 'García', 'Antolín', 'Pastor', 'Marquina'];
$federaciones = ['Cubana', 'Española', 'Argentina', 'Mexicana', 'Colombiana', 'Chilena', 'Venezolana', 'Peruana', 'Argentina', 'Países Bajos', 'Española', 'Italiana'];

// Generar lista de saltadores sin "Raúl Capablanca"
$otrosSaltadores = array();
for ($i = 1; $i < count($nombres); $i++) {
    $otrosSaltadores[] = array(
        'nombre' => $nombres[$i],
        'apellido' => $apellidos[$i],
        'federacion' => $federaciones[$i],
    );
}

// Selección aleatoria de saltadores (entre 3 y 7, porque Raúl ya está incluido)
$num_otros = $num_saltadores - 1; // Restamos 1 porque Raúl siempre está
$seleccionados = array_rand($otrosSaltadores, $num_otros);

// Crear el array final de saltadores incluyendo a Raúl
$saltadores[] = array(
    'nombre' => 'Raúl',
    'apellido' => 'Capablanca',
    'ranking' => 2780,
    'federacion' => 'Cubana',
    'saltos' => array()
);

// Agregar los saltadores seleccionados aleatoriamente
foreach ((array)$seleccionados as $indice) {
    $saltador = $otrosSaltadores[$indice];
    $saltador['ranking'] = rand(2000, 2900); // Asignamos ranking aleatorio
    $saltador['saltos'] = array();
    $saltadores[] = $saltador;
}

// Generación de saltos para cada saltador
foreach ($saltadores as &$saltador) {
    for ($j = 0; $j < 3; $j++) {
        $puntuaciones = generarPuntuaciones();
        $saltador['saltos'][] = array(
            'puntuaciones' => $puntuaciones,
            'dificultad' => round(rand(1, 10) / 10, 1), // Dificultad entre 0.1 y 1.0
            'puntuacion' => calcularPuntuacionSalto($puntuaciones)
        );
    }
}

// Calcular puntuaciones totales para cada saltador
foreach ($saltadores as &$saltador) {
    $total = 0;
    foreach ($saltador['saltos'] as $salto) {
        $total += $salto['puntuacion'] * $salto['dificultad']; // Total por salto * dificultad
    }
    $saltador['total'] = round($total, 2); // Total final redondeado
}

// Ordenar saltadores por puntuación total (de mayor a menor)
usort($saltadores, function($a, $b) {
    return $b['total'] <=> $a['total'];
});

// Asignar puestos de acuerdo con el orden
foreach ($saltadores as $index => &$saltador) {
    $saltador['puesto'] = $index + 1; // Puesto basado en índice
}

// Función para generar una tabla HTML dinámica
function generarTabla($saltadores, $columnas, $titulo) {
    echo "<h2>$titulo</h2>";
    echo "<table>";
    echo "<tr>";
    foreach ($columnas as $columna) {
        echo "<th>$columna</th>"; // Cabeceras dinámicas
    }
    echo "</tr>";

    foreach ($saltadores as $saltador) {
        echo "<tr>";
        foreach ($columnas as $columna) {
            if (strpos($columna, 'SALTO') !== false) {
                $saltoNum = substr($columna, -1) - 1; // Extrae el número del salto
                echo "<td>" . round($saltador['saltos'][$saltoNum]['puntuacion'], 2) . "</td>";
            } else {
                echo "<td>" . $saltador[strtolower($columna)] . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Inicio del HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competición de Saltos</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

<?php

// Actividad 1
generarTabla($saltadores, ['NOMBRE', 'APELLIDO', 'RANKING', 'SALTO 1', 'SALTO 2', 'SALTO 3', 'TOTAL', 'PUESTO'], 'Clasificación General');

// Actividad 2
echo "<h2>Mejores Saltos por Ronda</h2>";
for ($i = 0; $i < 3; $i++) {
    $mejorSaltador = null;
    $mejorPuntuacion = -1;
    foreach ($saltadores as $saltador) {
        if ($saltador['saltos'][$i]['puntuacion'] > $mejorPuntuacion) {
            $mejorSaltador = $saltador;
            $mejorPuntuacion = $saltador['saltos'][$i]['puntuacion'];
        }
    }
    echo "El saltador \"" . strtoupper($mejorSaltador['nombre'] . " " . $mejorSaltador['apellido']) . "\" hizo el mejor salto " . ($i + 1) . " obteniendo: " . round($mejorPuntuacion, 2) . " puntos.<br>";
}

// Actividad 3
$clasificacionSegundaRonda = $saltadores;
usort($clasificacionSegundaRonda, function($a, $b) {
    return $b['saltos'][1]['puntuacion'] <=> $a['saltos'][1]['puntuacion'];
});

// Mostrar resultados de las rondas y clasificación de segunda ronda
generarTabla($clasificacionSegundaRonda, ['NOMBRE', 'APELLIDO', 'SALTO 1', 'SALTO 2', 'SALTO 3', 'TOTAL', 'PUESTO'], 'Clasificación Provisional (Segunda Ronda)');

// Actividad 4
$top5 = array_slice($saltadores, 0, 5);
generarTabla($top5, ['PUESTO', 'NOMBRE', 'APELLIDO', 'RANKING', 'FEDERACION'], 'Top 5 Saltadores');

// Actividad 5
$saltadoresSinCapablanca = array_filter($saltadores, function($saltador) {
    return $saltador['nombre'] != 'Raúl' || $saltador['apellido'] != 'Capablanca';
});
generarTabla($saltadoresSinCapablanca, ['NOMBRE', 'APELLIDO', 'RANKING', 'SALTO 1', 'SALTO 2', 'SALTO 3', 'TOTAL', 'PUESTO'], 'Clasificación Final (Sin Raúl Capablanca)');
?>

</body>
</html>
