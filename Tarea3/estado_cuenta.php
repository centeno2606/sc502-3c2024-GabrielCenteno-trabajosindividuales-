<?php
class EstadoCuenta {
    private $transacciones = [];

    public function agregarTransaccion($descripcion, $monto) {
        $this->transacciones[] = ['descripcion' => $descripcion, 'monto' => $monto];
    }

    public function obtenerMontoContado() {
        $montoTotal = 0;
        foreach ($this->transacciones as $transaccion) {
            $montoTotal += $transaccion['monto'];
        }
        return $montoTotal;
    }

    public function obtenerMontoConInteres() {
        return $this->obtenerMontoContado() * 1.026;
    }

    public function obtenerCashBack() {
        return $this->obtenerMontoContado() * 0.001;
    }

    public function obtenerMontoFinal() {
        return $this->obtenerMontoConInteres() - $this->obtenerCashBack();
    }

    public function mostrarEstadoCuenta() {
        echo "Estado de Cuenta:\n";
        echo "-----------------\n";
        foreach ($this->transacciones as $transaccion) {
            echo "Descripción: {$transaccion['descripcion']} - Monto: ₡" . number_format($transaccion['monto'], 2) . "\n";
        }
        echo "Monto Total de Contado: ₡" . number_format($this->obtenerMontoContado(), 2) . "\n";
        echo "Monto con Interés (2.6%): ₡" . number_format($this->obtenerMontoConInteres(), 2) . "\n";
        echo "Cash Back (0.1%): ₡" . number_format($this->obtenerCashBack(), 2) . "\n";
        echo "Monto Final a Pagar: ₡" . number_format($this->obtenerMontoFinal(), 2) . "\n";
    }

    public function generarArchivoEstadoCuenta() {
        $contenido = "Estado de Cuenta:\n-----------------\n";
        foreach ($this->transacciones as $transaccion) {
            $contenido .= "Descripción: {$transaccion['descripcion']} - Monto: ₡" . number_format($transaccion['monto'], 2) . "\n";
        }
        $contenido .= "Monto Total de Contado: ₡" . number_format($this->obtenerMontoContado(), 2) . "\n";
        $contenido .= "Monto con Interés (2.6%): ₡" . number_format($this->obtenerMontoConInteres(), 2) . "\n";
        $contenido .= "Cash Back (0.1%): ₡" . number_format($this->obtenerCashBack(), 2) . "\n";
        $contenido .= "Monto Final a Pagar: ₡" . number_format($this->obtenerMontoFinal(), 2) . "\n";

        $filePath = "estado_cuenta.txt";
        if (file_put_contents($filePath, $contenido)) {
            echo "Archivo 'estado_cuenta.txt' generado exitosamente.\n";
        } else {
            echo "Hubo un error al generar el archivo.\n";
        }
    }
}

// Ejemplo de uso
$estadoCuenta = new EstadoCuenta();
$estadoCuenta->agregarTransaccion("Compra en supermercado", 25000);
$estadoCuenta->agregarTransaccion("Pago de servicios públicos", 15000);
$estadoCuenta->agregarTransaccion("Compra en tienda de ropa", 30000);

// Mostrar el estado de cuenta en pantalla
$estadoCuenta->mostrarEstadoCuenta();

// Generar el archivo de estado de cuenta
$estadoCuenta->generarArchivoEstadoCuenta();
?>
