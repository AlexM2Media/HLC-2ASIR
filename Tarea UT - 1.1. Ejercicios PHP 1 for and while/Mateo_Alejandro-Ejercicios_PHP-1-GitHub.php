<?php
// 1. Imprimir los primeros 10 números naturales con while
$i = 1;
while ($i <= 10) {
    echo $i . " ";
    $i++;
}
echo "\\n";

// 2. Imprimir los números en orden inverso con while
$i = 10;
while ($i >= 1) {
    echo $i . " ";
    $i--;
}
echo "\\n";

// 3. Imprimir los primeros 10 números naturales con for
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "\\n";

// 4. Imprimir los números en orden inverso con for
for ($i = 10; $i >= 1; $i--) {
    echo $i . " ";
}
echo "\\n";

// 5. Tabla de multiplicar de un número
$numero = 5;
for ($i = 1; $i <= 10; $i++) {
    echo "$numero x $i = " . ($numero * $i) . "\\n";
}
echo "\\n";

// 6. Sumar números hasta que el usuario ingrese 0
$suma = 0;
$conteo = 0;
do {
    $numero = (int)readline("Ingresa un número (0 para terminar): ");
    $suma += $numero;
    
    if ($numero != 0) {
        $conteo++;
    }
    
} while ($numero != 0);
echo "Conteo: " . $conteo . "\n";
echo "Suma: " . $suma . "\n";

// 7. Imprimir patrón 1, 12, 123, 1234
for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
    }
    echo "\\n";
}

// 8. Imprimir patrón 1, 1-2, 1-2-3, 1-2-3-4
for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
        if ($j < $i) echo "-";
    }
    echo "\\n";
}

// 9. Imprimir patrón inverso 4321, 321, 21, 1
for ($i = 4; $i >= 1; $i--) {
    for ($j = $i; $j >= 1; $j--) {
        echo $j;
    }
    echo "\\n";
}

// 10. Imprimir patrón con guiones en orden inverso
for ($i = 4; $i >= 1; $i--) {
    for ($j = $i; $j >= 1; $j--) {
        echo $j;
        if ($j > 1) echo "-";
    }
    echo "\\n";
}

// 11. Sumar números desde 1 hasta un número dado
$numero = 10;
$suma = 0;
for ($i = 1; $i <= $numero; $i++) {
    $suma += $i;
}
echo "Suma: $suma\\n";

// 12. Imprimir números divisibles por 4 o 5
$numeros = [7, 8, 12, 29, 75, 150, 180, 145, 525, 50];
foreach ($numeros as $numero) {
    if ($numero % 4 == 0 || $numero % 5 == 0) {
        echo $numero . " ";
    }
}
echo "\\n";

// 13. Detener el ciclo si un número no es mayor que su predecesor
$anterior = $numeros[0];
foreach ($numeros as $numero) {
    if ($numero <= $anterior) {
        break;
    }
    echo $numero . " ";
    $anterior = $numero;
}
echo "\\n";

// 14. Verificar si un número es primo
$numero = 7;
$esPrimo = true;
for ($i = 2; $i <= sqrt($numero); $i++) {
    if ($numero % $i == 0) {
        $esPrimo = false;
        break;
    }
}
echo $esPrimo ? "Es primo\\n" : "No es primo\\n";

// 15. Calcular el MCD con bucle while
$a = 56;
$b = 98;
while ($a != $b) {
    if ($a > $b) $a -= $b;
    else $b -= $a;
}
echo "MCD: $a\\n";

// 16. Mostrar los divisores de un número
$numero = 24;
echo "Divisores de $numero: ";
for ($i = 1; $i <= $numero; $i++) {
    if ($numero % $i == 0) {
        echo $i . " ";
    }
}
echo "\\n";

// 17. Imprimir la secuencia de Fibonacci
$n = 10;
$a = 0;
$b = 1;
echo "$a $b ";
for ($i = 2; $i < $n; $i++) {
    $c = $a + $b;
    echo "$c ";
    $a = $b;
    $b = $c;
}
echo "\\n";

// 18. Calcular la media, máximo y mínimo de una lista de números
$numeros = [5, 10, 15, 20, 25];
$suma = array_sum($numeros);
$media = $suma / count($numeros);
$maximo = max($numeros);
$minimo = min($numeros);
echo "Media: $media\\nMáximo: $maximo\\nMínimo: $minimo\\n";

// 19. Contar el número de vocales en una palabra
$palabra = "programacion";
$vocales = ['a', 'e', 'i', 'o', 'u'];
$conteo = 0;
for ($i = 0; $i < strlen($palabra); $i++) {
    if (in_array($palabra[$i], $vocales)) {
        $conteo++;
    }
}
echo "Número de vocales: $conteo\\n";

// 20. Calcular el factorial de un número
$numero = 5;
$factorial = 1;
for ($i = 1; $i <= $numero; $i++) {
    $factorial *= $i;
}
echo "Factorial de $numero es: $factorial\\n";

