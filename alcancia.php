
<?php
declare(strict_types=1);

// Parte 1. Variables y funciones

$saldo = 0;

function mostrarSaldo(float $saldo): void {
    echo "Saldo: $saldo\n";
}

mostrarSaldo($saldo);

function depositarGlobal(float $monto): void {
    global $saldo;
    $saldo += $monto;
}

depositarGlobal(5000);
echo "Saldo: $saldo\n";

function calcularPropina(float $cuenta): float {
    $propina = $cuenta * 0.10; // local
    return $propina;
}

echo calcularPropina(50000.0) . "\n";

function contarMovimiento(): int {
    static $total = 0; // Se inicializa solo la primera vez
    $total++;
    return $total;
}

contarMovimiento();
contarMovimiento();
echo "Movimientos: " . contarMovimiento() . "\n";

// MI TURNO

$meta = 100000.0;

function mostrarMeta(float $meta): void {
    echo "Mi meta es: $meta\n";
}

mostrarMeta($meta);

// Parte 2. Funciones: parámetros y valores de retorno

function formatearDinero(float $valor): string {
    return '$' . number_format($valor, 0, ',', '.');
}

function calcularInteres(float $monto, float $tasa = 0.02): float {
    return round($monto * $tasa, 2);
}

$saldo = 25000.0;

echo formatearDinero($saldo) . "\n";
echo formatearDinero(calcularInteres($saldo)) . "\n";
echo formatearDinero(calcularInteres($saldo, 0.05)) . "\n";

function totalDepositos(float ...$montos): float {
    return array_sum($montos);
}

echo formatearDinero(totalDepositos(5000, 12000, 3000)) . "\n";

function restarDelSaldo(float &$saldo, float $monto): void {
    $saldo -= $monto;
}

restarDelSaldo($saldo, 3000);
echo formatearDinero($saldo) . "\n";

// MI TURNO

function promedioDepositos(float ...$montos): float {
    if (count($montos) == 0) {
        throw new InvalidArgumentException(
            "Debes ingresar al menos un depósito."
        );
    }

    return array_sum($montos) / count($montos);
}

echo promedioDepositos(5000, 10000, 15000, 20000, 25000) . "\n";

// Parte 3. Funciones predefinidas

$movimientos = [
    ['tipo' => 'depósito', 'monto' => 5000],
    ['tipo' => 'retiro', 'monto' => 2000],
    ['tipo' => 'depósito', 'monto' => 12000],
];

$montos = array_column($movimientos, 'monto');

echo "Movimientos: " . count($movimientos) . "\n";
echo "Mayor: " . formatearDinero(max($montos)) . "\n";
echo "Suma: " . formatearDinero(array_sum($montos)) . "\n";

$depositos = array_filter(
    $movimientos,
    fn($m) => $m['tipo'] === 'depósito'
);

echo "Depósitos: " . count($depositos) . "\n";

echo mb_strtoupper("mi alcancía") . "\n";
echo "Fecha: " . date('d/m/Y') . "\n";

// MI TURNO

$montosConInteres = array_map(
    fn($monto) => $monto * 1.01,
    $montos
);

print_r($montosConInteres);

foreach ($movimientos as $movimiento) {
    echo str_pad($movimiento['tipo'], 10) . "\n";
}

// Parte 4. Cuando algo sale mal: excepciones

class SaldoInsuficienteException extends Exception {
    public function __construct(float $saldo, float $monto) {
        parent::__construct(
            "Saldo insuficiente: tienes " . formatearDinero($saldo) .
            " y quieres retirar " . formatearDinero($monto) . "."
        );
    }
}

function validarMonto(float $monto): void {
    if ($monto <= 0) {
        throw new InvalidArgumentException(
            "El monto debe ser mayor que cero."
        );
    }
}

function depositar(float $saldo, float $monto): float {
    validarMonto($monto);
    return $saldo + $monto;
}

function retirar(float $saldo, float $monto): float {
    validarMonto($monto);

    if ($monto > $saldo) {
        throw new SaldoInsuficienteException($saldo, $monto);
    }

    return $saldo - $monto;
}

try {
    $nuevo = retirar(10000.0, 50000.0);
    echo "Nuevo saldo: " . formatearDinero($nuevo) . "\n";
} catch (SaldoInsuficienteException $e) {
    echo "Aviso: " . $e->getMessage() . "\n";
} catch (InvalidArgumentException $e) {
    echo "Monto inválido: " . $e->getMessage() . "\n";
} finally {
    echo "Operación finalizada.\n";
}

// MI TURNO

try {
    echo promedioDepositos();
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Parte 5. Todo junto

$saldo = 20000.0;

$operaciones = [
    ['depositar', 5000],
    ['retirar', 30000],
    ['retirar', -100],
    ['depositar', 12000],
    ['retirar', 7000],
];

foreach ($operaciones as [$tipo, $monto]) {
    try {
        $saldo = $tipo === 'depositar'
            ? depositar($saldo, $monto)
            : retirar($saldo, $monto);

        echo "OK        - $tipo " . formatearDinero($monto)
           . " -> saldo " . formatearDinero($saldo) . "\n";

    } catch (SaldoInsuficienteException $e) {
        echo "SIN SALDO - " . $e->getMessage() . "\n";
    } catch (InvalidArgumentException $e) {
        echo "ERROR     - " . $e->getMessage() . "\n";
    }
}

echo "\nSaldo final: " . formatearDinero($saldo) . "\n";
?>
