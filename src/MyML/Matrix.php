<?php
// src/MyML/Matrix.php
namespace MyML;

class Matrix {
    private array $data;

    public function __construct(array $data) {
        // Basic validation
        $this->data = $data;
    }

    public function getNumColumns(): int {
        return count($this->data[0]);
    }

    public function getColumn(int $index): array {
        return array_column($this->data, $index);
    }

    public function getRows(): array {
        return $this->data;
    }

    public function multiply(Matrix $other): Matrix {
        // Implement matrix multiplication
        // ... (this is where FFI would be beneficial)
        return new Matrix($result);
    }

    // Add other matrix operations: add, subtract, transpose, etc.
}
