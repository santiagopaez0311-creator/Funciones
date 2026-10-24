<?php
// 6 EJERCICIOS DE LA ALCANCIA

// EJERCICIO 1: META DE AHORRO
function porcentajeMeta(float $saldo, float $meta = 100000.0): float {
    if ($meta <= 0) {
        throw new InvalidArgumentException("La meta debe ser mayor que cero.");
    }
    
    return ($saldo / $meta) * 100;
}

echo "EJERCICIO 1: META DE AHORRO<br>";
echo porcentajeMeta(30000) . "%<br><br>";


// EJERCICIO 2: HISTORIAL DE OPERACIONES
function guardarHistorial(array &$historial, string $tipo, float $monto): void {
    $historial[] = [
        'tipo' => $tipo,
        'monto' => $monto,
        'fecha' => date('d/m/Y H:i')
    ];
}

$historial = [];

guardarHistorial($historial, 'depósito', 5000);
guardarHistorial($historial, 'retiro', 2000);

echo "EJERCICIO 2: HISTORIAL DE OPERACIONES<br>";
echo "<pre>";
print_r($historial);
echo "</pre>";


// EJERCICIO 3: LÍMITE DE RETIRO
class LimiteExcedidoException extends Exception {
}

function retirarConLimite(float $saldo, float $monto): float {
    echo "<pre>";
    var_dump($saldo);
    var_dump($monto);
    echo "</pre>";

    if ($monto <= 0) {
        throw new InvalidArgumentException("El monto debe ser mayor que cero.");
    }

    if ($monto > 20000) {
        throw new LimiteExcedidoException(
            "No puedes retirar más de $20.000 por operación."
        );
    }

    if ($monto > $saldo) {
        throw new InvalidArgumentException("No tienes saldo suficiente.");
    }

    return $saldo - $monto;
}

echo "EJERCICIO 3: LÍMITE DE RETIRO<br>";

try {
    echo retirarConLimite(50000, 25000);
} catch (LimiteExcedidoException | InvalidArgumentException $e) {
    echo $e->getMessage();
}

echo "<br><br>";


// EJERCICIO 4: DEPOSITAR SIN GLOBAL
function depositarSinGlobal(float $saldo, float $monto): float {
    return $saldo + $monto;
}

echo "EJERCICIO 4: DEPOSITAR SIN GLOBAL<br>";
$saldo = depositarSinGlobal(20000, 5000);
echo "Saldo: $" . number_format($saldo, 0, ',', '.') . "<br><br>";


// EJERCICIO 5: GENERAR RECIBO
function generarRecibo(array $lineas): string {
    $recibo = "MI ALCANCÍA\n";
    $recibo .= str_repeat("-", 30) . "\n";
    $recibo .= "Fecha: " . date('d/m/Y H:i') . "\n";

    $lineasFormateadas = [];

    foreach ($lineas as $linea) {
        $lineasFormateadas[] = str_pad($linea, 30);
    }

    $recibo .= implode("\n", $lineasFormateadas);

    return $recibo . "\n";
}

echo "EJERCICIO 5: GENERAR RECIBO<br>";
echo "<pre>";
echo generarRecibo([
    "Depósito: $5.000",
    "Retiro: $2.000",
    "Saldo: $23.000"
]);
echo "</pre>";


// EJERCICIO 6: DEPURACIÓN MANUAL
echo "EJERCICIO 6: DEPURACIÓN MANUAL<br>";

try {
    retirarConLimite(50000, 25000);
} catch (LimiteExcedidoException | InvalidArgumentException $e) {
    echo "Excepción controlada: " . $e->getMessage();
}
?>
